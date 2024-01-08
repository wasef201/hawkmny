<?php

namespace App\Http\Livewire\Questions;

use App\Models\Answer;
use App\Models\Choice;
use App\Models\FinancialAppraisalUser;
use App\Models\Question;
use App\Models\Review;
use App\Models\Standard;
use App\Models\ReviewStandard;

use App\Services\FinancialService;
use Log;
use Illuminate\Support\Collection;
use Livewire\Component;

/**
 * @property Question question
 * @property float progress
 */
class QuestionsReview extends Component
{
    public Standard $standard;
    public Review $review;
    public ?Choice $choice = null;
    //public int $index = 0;// TODO Change use qId
    public Collection $questions;
    protected $financialService;
    public $question_have_childrens = false;
    public $show_question_childrens = false;
    public $child_question_have_childrens = false;
    public $show_child_question_childrens = false;
    public $question_is_parent = false;
    public ?int $currentQId = null;
    public ?Question $currentQuestion = null;

    protected $listeners = ['answerChoosed'  , 'goToSomeQuestion' ];
    public ?array $computations = null;
    public  $appraisal = null;

    public function answerChoosed()
    {
        $this->checkChildren();
        $this->checkChildChildren();
    }


    final public function mount(): void
    {
        $this->standard->load(['questions' => function($q){
            $q->root()->choical();
        }]);

        $this->questions = $this->standard->questions;

        $this->currentQId = $this->review->standards->where('standard_id', $this->standard->id)
        ->first()->question_id ?? $this->standard->questions->first()->id;
        $this->currentQuestion = $this->questions->where('id', $this->currentQId)->first();
        $this->checkChildren();
        $this->checkChildChildren();


    }

    final public function getProgressProperty(): float
    {
        return round( (( ($this->getIndex() + 1) / $this->questions->count() ) * 100),2);
    }

    final public function render(FinancialService $financialService)
    {
        $this->financialService=$financialService;
        return view('pages.review.inc.questions');
    }

    final public function saveChoice(Choice $choice): void
    {
        $this->choice = $choice;
        // if choice belongs to a question that has children
        // then remove answers of children question
        if ($this->choice->question->children()->count()) {
            $this->review
                ->answers()
                ->whereIn('question_id', $this->choice->question?->children()->pluck('id'))
                ->orWhereIn('question_id', $this->choice->question?->children()->first()?->children()->pluck('id'))
                ->delete();
        }
        $this->review->answers()->updateOrCreate([
            'question_id' => $this->choice->question_id,
            'standard_id' => $this->standard->id,
        ],[
            'choice_id' => $choice->id,
            'degree' =>  ((int)$choice->percentage !== -1)? ($choice->percentage * $choice->question->degree) / 100 : 0 ,
        ]);
        $this->review->refresh();
        if((int) $choice->percentage !== -1) {
            $this->show_question_childrens = true;
            $this->question_have_childrens = true;
        }
        $this->show_question_childrens = false;
        $this->saveReviewState();
//        $this->review->update([
//            'degree' => $this->review->answers->sum('degree') ,
//        ]);
        $this->review->update([
            'degree' => $this->review->standards->sum('degree') ,
        ]);
        $this->emit('answerChoosed');
        $this->emit('updateStatistics');
    }



    public function goToSomeQuestion()
    {

        $this->questions->map(function(Question $question){
            $question['answerd'] = Answer::where([
                ['review_id' , '=' , $this->review->id ] ,
                ['standard_id' , '=' , $this->standard->id ] ,
                ['question_id' , '=' , $question->id ] ,
            ])->first() ? true : false ;
        });

        if ($this->questions->where('answerd' , false)->first()) {
            $this->currentQuestion = $this->questions->where('answerd' , false)->first();
            $this->currentQId  =  $this->questions->where('answerd' , false)->first()->id;
        }
    }


    public function setQuestionHaveChildrensProperty() {

        $this->checkChildren();

    }

    final public function next(): void
    {
        $this->currentQuestion = $this->questions[$this->getIndex()+1];
        $this->currentQId = $this->currentQuestion->id;
        $this->checkChildren();
        $this->checkChildChildren();

        if ($this->questions->count() > $this->getIndex()  ) {
            $this->saveReviewState();
            $this->emit('questionChanged');
        }
    }

    final public function prev(): void
    {
        $this->currentQuestion = $this->questions[$this->getIndex()-1];
        $this->currentQId = $this->currentQuestion->id;
        $this->checkChildren();
        $this->checkChildChildren();

        if($this->getIndex() >= 1) {
            $this->saveReviewState();
            $this->emit('questionChanged');
        }
    }



    private function saveReviewState(): void
    {

        $degree=0;
        if ($this->standard->id==Standard::Financial_ID){
            $appraisal=FinancialAppraisalUser::firstOrCreate(['user_id'=> auth()->id()]);
            $appraisal->organization_result=$this->review->answers()
                ->where('standard_id', $this->standard->id)
                ->whereHas('question', function($q){
                    $q->choical();
                })
                ->sum('degree');
            $appraisal->result=($appraisal->organization_result/2)+($appraisal->performance_result/2);
            $appraisal->save();
            $degree=$appraisal->result;
        }else{
            $degree=$this->review->answers->where('standard_id', $this->standard->id)->sum('degree');
        }
        $this->review->standards->where('standard_id' , $this->standard->id )->first()
        ->update([
            'progress' => $this->progress,
            'question_id' => $this->currentQuestion->id,
            'field_id' => $this->currentQuestion->field_id,
            'practice_id' => $this->currentQuestion->practice_id,
            'degree' => $degree
        ]);
        $this->setQuestionHaveChildrensProperty();
    }

    private function checkChildren(): void
    {
        if ((int)optional(optional($this->review->answers->where('question_id' , $this->currentQId )->first())->choice)->percentage === -1 ) {
            $this->show_question_childrens = true;
            $this->question_have_childrens = true;

        } else {
            $this->show_question_childrens = false;
            $this->question_have_childrens = false;

        }
    }




    private function checkChildChildren(): void
    {
//        if ((int)optional(optional($this->review->answers->where('question_id' , $this->currentQId )->first())->choice)->percentage === -1 ) {
        if ((int)optional(optional($this->review->answers->where('question_id' , Question::findOrFail($this->currentQId)?->children->first()?->id )->first())?->choice)->percentage === -1 ) {
            $this->child_question_have_childrens = true;
            $this->show_child_question_childrens = true;

        } else {
            $this->child_question_have_childrens = false;
            $this->show_child_question_childrens = false;

        }
    }




    private function getIndex(): int
    {
        return $this->questions->pluck('id')->search($this->currentQId);
    }
}
