<?php

namespace App\Services;

use App\Models\FinancialAppraisalUser;
use App\Models\Review;
use App\Models\ReviewStandard;
use App\Models\Standard;
use Illuminate\Support\Collection;

class PracticesReportService{


    public function getStandardPractices(Standard $standard, $questionType='choical'):Collection
    {
        if ($questionType=='all'){
            $practices=$standard->practices()
                ->whereHas('questions', fn($q)=>$q->select('id'))
                ->get();
        }elseif ($questionType=='equational'){
            $practices=$standard->practices()
                ->whereHas('questions', fn($q)=>$q->equational()->select('id'))
                ->get();
        }else{
            $practices=$standard->practices()
                ->whereHas('questions', fn($q)=>$q->choical()->select('id'))
                ->get();
        }
        return $practices;
    }


    public function getStandardPracticesWithQuestionsSum(Standard $standard, Review $review,$questionType='choical'):Collection
    {
        $practices=$this->getStandardPractices($standard, $questionType);

        return $practices->each(function($practice) use($review , $standard ){
            $practice->questions_degree =
                $review->answers()->where('standard_id' , $standard->id )
                ->whereHas('question', function($query) use($practice) {
                    $query->where('practice_id' , $practice->id );
                })->sum('degree');
        });
    }

    public function getReviewStandardWithSummation(Review $review, Standard $standard,$questionType='choical')
    {
        if ($questionType=='all'){
            $review_standard= ReviewStandard::query()
                ->withCount(['questions' =>  fn($q) => $q->whereNull('parent_id'),
                    'answers' => fn($q) => $q->whereReviewId($review->id)
                        ->whereHas('question' , fn($q) => $q->root())])
                ->with(['answers' => fn($q) => $q->whereReviewId($review->id)->with('question')
                    ->whereHas('question' , fn($q) => $q->root())])
                ->where('standard_id'  , $standard->id)
                ->where('review_id' , $review->id)
                ->first();
        }else{
            $financialAppraisal=FinancialAppraisalUser::firstOrCreate(['user_id'=> $review->user_id]);

            $review_standard= ReviewStandard::query()
                ->withCount(['questions' =>  fn($q) => $q->whereNull('parent_id'),
                    'answers' => fn($q) => $q->whereReviewId($review->id)
                        ->whereHas('question' , fn($q) => $q->root()->choical())])
                ->with(['answers' => fn($q) => $q->whereReviewId($review->id)->with('question')
                    ->whereHas('question' , fn($q) => $q->root()->choical())])
                ->where('standard_id'  , $standard->id)
                ->where('review_id' , $review->id)
                ->first();
            if ($review_standard){
                $review_standard->degree=$financialAppraisal->organization_result;
            }
        }
        return $review_standard;
    }

}
