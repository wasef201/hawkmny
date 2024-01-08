<?php

namespace App\Http\Livewire\Questions;

use App\Models\Question;
use App\Models\Review;
use App\Models\Standard;
use Livewire\Component;
use App\Models\ReviewStandard;
use App\Models\Answer;
// use Log;
class ReviewStatistics extends Component
{

    public Review $review;
    public Standard $standard;
    public  $review_standard;
    // public $remian_questions_count = 0;

    protected $listeners = ['updateStatistics'];


    public function updateStatistics()
    {
        // Log::info('once');
        $answered_question_count = Answer::where([
            ['review_id', '=', $this->review->id],
            ['standard_id', '=', $this->standard->id],
        ])->whereHas('question', function ($query) {
            $query->root()->choical();
        })->count();
        $this->review_standard->update([

            'answered_question_count' => $answered_question_count,
        ]);


    }


    public function goToFirstUnanswerdQuestion()
    {
        $this->emit('goToSomeQuestion');
    }

    public function render()
    {
        $this->review_standard = ReviewStandard::query()
            ->withCount(
                [
                    'questions' => fn($q) => $q->root()->choical(),

                    'answers' => fn($q) => $q->whereReviewId($this->review->id)
                        ->whereHas('question', fn($q) => $q->choical()->root())
                ]
            )
            ->withSum([
                'answers'=>fn($q)=>$q->whereHas('question', fn($q2) => $q2->whereReviewId($this->review->id)->choical())],'degree'
            )
            ->where('standard_id', $this->standard->id)
            ->where('review_id', $this->review->id)
            ->first();
//
        return view('livewire.questions.review-statistics');
    }
}
