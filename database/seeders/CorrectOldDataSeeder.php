<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReviewStandard;
use App\Models\Review;
use App\Models\Answer;
class CorrectOldDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews = Review::all();

        foreach ($reviews as $review) {

            $review->load(['standards'  , 'standards.standard' ]);

            foreach ($review->standards as $review_standard) {
                $review_standard->update([
                    'total_standard_questions' => $review_standard->standard->questions()->where('parent_id' , null )->count() , 
                    'answered_question_count' => Answer::where([
                        ['review_id' , '=' , $review->id ] , 
                        ['standard_id' , '=' , $review_standard->standard_id ] , 
                    ])->whereHas('question' , function($query){
                        $query->where('parent_id' , null);
                    })->count() ? : 0 , 
                ]);

            }
            
        }

    }
}
