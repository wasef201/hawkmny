<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Answer;
use App\Models\ReviewStandard;
use App\Models\Standard;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AssociationReviewExport;
class AssociationReviewController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {


        $mo2sher_elhwkmah = $review->governance_meter();

        return view('pages.association.reviews.show' , compact('review' , 'mo2sher_elhwkmah' ));
    }


    public function generateExcelSheet(Review $review) {
        $questions = Answer::with(['question' , 'choice'])->where('review_id' , $review->id)->get();
        return Excel::download(new AssociationReviewExport($questions), 'associations_review.xlsx');

    }

}
