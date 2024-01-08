<?php

namespace App\Http\Livewire\Questions;

use App\Http\Controllers\FinancialInputController;
use App\Models\Answer;
use App\Models\Choice;
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
class EquationsReview extends Component
{
    //public int $index = 0;// TODO Change use qId
    public array $questions;
    public array $computations;
    public ?int $currentPId = null;
    public ?int $currentQId = 0;

    public $currentPractice = null;
    protected $listeners = ['answerChoosed'  , 'goToSomeQuestion' ];

    final public function mount(FinancialService $financialService):void
    {
        $computations=$this->computations;
        if (!$computations){
            $this->redirect(route('login'));
        }
        $this->questions = data_get($computations,'details')??[];
        $this->currentQId = 0;
        $this->currentPractice = data_get($this->questions,$this->currentQId );

    }

    final public function getProgressProperty(): float
    {
        if ($this->questions){
            return round( (( ($this->getIndex() + 1) / count($this->questions) ) * 100),2);
        }
        return 0;
    }

    final public function render()
    {
        return view('pages.review.inc.equations');
    }




    final public function next(): void
    {
        $this->currentPractice = $this->questions[$this->getIndex()+1];
        $this->currentQId = $this->getIndex()+1;

        if (count($this->questions) > $this->getIndex()  ) {
            $this->emit('questionChanged');
        }
    }

    final public function prev(): void
    {
        $this->currentPractice = $this->questions[$this->getIndex() - 1];
        $this->currentQId = $this->getIndex()-1;

        if ($this->getIndex() >= 1) {
//            $this->saveReviewState();
            $this->emit('questionChanged');
        }
    }
        private function getIndex(): int
        {
            return $this->currentQId;
        }






}
