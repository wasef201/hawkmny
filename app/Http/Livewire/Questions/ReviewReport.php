<?php

namespace App\Http\Livewire\Questions;

use App\Exports\AssociationsExport;
use App\Models\FinancialAppraisalUser;
use App\Models\Review;
use App\Models\Standard;
use App\Models\User;
use App\Services\PracticesReportService;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\ReviewStandard;
use Maatwebsite\Excel\Facades\Excel;

class ReviewReport extends Component
{

    public Review $review;
    public Standard $standard;
    public String|null $questionType='choical';
    public  $weakPoints;
    public ReviewStandard $review_standard ;

    protected $listeners = [ 'exportReport' => 'generatePDF', 'updateReport'=>'mount'];


    public function mount(PracticesReportService $practicesReportService)
    {

        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */

        $this->review_standard=$practicesReportService->getReviewStandardWithSummation($this->review, $this->standard, request()->get('question-type', 'choical'));

        $this->weakPoints = optional(optional($this->review_standard)->answers)->where('degree', 0);
    }

    public function generatePDF()
    {
        return Excel::download(new AssociationsExport($this->generateAssociationQuery()), 'associations.xlsx');
    }

    protected function generatePDFReport(): Builder
    {
        $user = Auth::user();

        $associations = User::query()
            ->with('area', 'city')
            ->where('type', User::ASSOCIATION);

        return $associations->latest('id');
    }


    public function render(PracticesReportService $practicesReportService)
    {
        $standard = $this->standard;
        $review = $this->review;
        $financialAppaisal=FinancialAppraisalUser::firstWhere('user_id', $review->user_id);
        $practices =  $practicesReportService->getStandardPracticesWithQuestionsSum($standard, $review, $this->questionType);
        return view('livewire.questions.review-report' , compact('practices', 'financialAppaisal') );
    }
}
