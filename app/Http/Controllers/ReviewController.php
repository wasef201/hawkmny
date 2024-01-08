<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\FinancialAppraisalUser;
use App\Models\Practice;
use App\Models\Question;
use App\Models\Review;
use App\Models\Standard;
use App\Models\User;
use App\Services\FinancialService;
use App\Services\PracticesReportService;
use Illuminate\Contracts\View\View;
use Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class ReviewController extends Controller
{
    final public function index(): View
    {
        return view('pages.review.index');
    }

    final public function create(Standard $standard, FinancialService $financialService)
    {

        $user = Auth::user();
        $appraisal = FinancialAppraisalUser::firstWhere('user_id', auth()->id());


        $review = Review::where(
            'user_id', '=', Auth::id()
        )->with('standards', 'answers')->first();

        if (!$review) {

            $review = new review;
            $review->user_id = Auth::id();
            $review->status = Review::IN_PROGRESS;
            $review->save();
        }


        $review_standard = $review->standards()->where('standard_id', $standard->id)->first();
        if (!$review_standard) {

            $total_standard_questions = $standard->questions()
                ->choical()->root()
                ->count();
            $review->standards()->create([
                'field_id' => null,
                'question_id' => $standard->questions()->root()->choical()->first()?->id,
                'practice_id' => null,
                'progress' => 0,
                'degree' => 0,
                'total_standard_questions' => $total_standard_questions,
                'answered_question_count' => 0,
                'standard_id' => $standard->id,
            ]);
        }
        return view('pages.review.create', [
            'standard' => $standard,
            'review' => $review,
            'appraisal' => $appraisal
        ]);
    }

    final public function store()
    {

    }

    final public function edit(Review $review): View
    {
        return view('pages.review.edit');
    }

    final public function show(Review $review, $standard): View
    {
        $standard = Standard::find($standard);
        $appraisal = FinancialAppraisalUser::firstWhere('user_id', $review->user_id);
        $appraisal = $appraisal ? $appraisal : new FinancialAppraisalUser();
        return view('pages.review.create', compact('standard', 'review', 'appraisal'));
    }

    final public function report(Review $review, $standard): View
    {
        $standard = Standard::find($standard);
        return view('pages.review.report', compact('standard', 'review'));
    }


    final public function report_pdf(Review $review, $standard, PracticesReportService $practicesReportService)
    {
        $questionType = request()->get('question-type', 'choical');
        $standard = Standard::find($standard);
        $practices = $practicesReportService->getStandardPracticesWithQuestionsSum($standard, $review, $questionType);
        $review_standard = $practicesReportService->getReviewStandardWithSummation($review, $standard, $questionType);
        $financialAppaisal = FinancialAppraisalUser::firstWhere('user_id', $review->user_id);
        $weakPoints = optional(optional($review_standard)->answers)->where('degree', 0);

        $pdf = PDF::loadView('pdf.report', compact('practices', 'financialAppaisal', 'standard', 'weakPoints', 'review_standard'));
        return $pdf->download($standard->name . '.pdf');
    }

    final public function update(Review $review)
    {

    }

    final public function totalFinancialReport($id)
    {

        $standard = Standard::findOrFail($id);

        $review = Review::where(
            'user_id', '=', Auth::id()
        )->with('standards', 'answers')->first();

        if (!$review) {
            $review = new review;
            $review->user_id = Auth::id();
            $review->status = Review::IN_PROGRESS;
            $review->save();
        }


        $review_standard = $review->standards()->where('standard_id', $standard->id)->first();
        if (!$review_standard) {

            $total_standard_questions = $standard->questions()
                ->choical()->root()
                ->count();
            $review->standards()->create([
                'field_id' => null,
                'question_id' => $standard->questions()->root()->choical()->first()?->id,
                'practice_id' => null,
                'progress' => 0,
                'degree' => 0,
                'total_standard_questions' => $total_standard_questions,
                'answered_question_count' => 0,
                'standard_id' => $standard->id,
            ]);
        }
        return view('pages.review.total-financial-report', [
            'standard' => $standard,
            'review' => $review
        ]);

    }

    public function final_report_pdf()
    {
        $association = User::find(23);//TODO auth()->user();
        $review=Review::query()->firstWhere('user_id', $association->id);
        DB::connection()->enableQueryLog();

        $standards = Standard::query()
            ->with('fields')
            ->with('practices', function ($q) use($review){
                $q->leftJoinSub(
                    Question::query()
                        ->whereNull('question_type')
                        ->select('practice_id')
                        ->selectRaw('sum(answers.degree) as practice_degree')
                        ->join('answers', 'answers.question_id', '=', 'questions.id')
                        ->whereRaw("review_id=$review->id")
                        ->groupBy('practice_id')
                    , 'q', 'q.practice_id', '=', 'practices.id');
            })
            ->get()
        ;

        $fieldsReports = Field::query()
            ->select('field_id', 'user_id')
            ->selectRaw('sum(rs.degree) as fields_sum')
            ->leftJoin('review_standards as rs', 'rs.field_id', '=', 'fields.id')
            ->leftJoin('reviews', 'reviews.id', '=', 'rs.review_id')
            ->groupBy('field_id', 'user_id')
            ->having('reviews.user_id', $association->id)
            ->orderBy('field_id')
            ->get();

        $financialAppraisal = FinancialAppraisalUser::query()
            ->where('user_id', $association->id)
            ->first();
        $pdf = PDF::loadView('pdf.final-report', compact('fieldsReports', 'standards', 'association', 'financialAppraisal'));
        dd($pdf->stream());
        return $pdf->download('fina-report.pdf');
    }
}
