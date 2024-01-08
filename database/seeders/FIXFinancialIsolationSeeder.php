<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\ReviewStandard;
use App\Models\Standard;
use Illuminate\Database\Seeder;

class FIXFinancialIsolationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $organizationQuestionsCount=Question
            ::choical()
            ->where('standard_id', Standard::Financial_ID)
            ->root()
            ->count();
        $organizationAnsweredQuestionsCount=Question
            ::choical()
            ->where('standard_id', Standard::Financial_ID)
            ->root()
            ->whereHas('answer')
            ->count();

        ReviewStandard::where('standard_id', Standard::Financial_ID)->update([
            'total_standard_questions'=>$organizationQuestionsCount,
            'answered_question_count'=>$organizationAnsweredQuestionsCount,

        ]);
        $firstChoicalQuestion=Question::choical()
            ->where('standard_id', Standard::Financial_ID)
            ->root()->first();
        $equationQuestionsIds=Question::equational()
            ->where('standard_id', Standard::Financial_ID)
            ->root()->pluck('id');
        ReviewStandard::whereIn('question_id',$equationQuestionsIds )
            ->where('standard_id', Standard::Financial_ID)
            ->update(
            [
                'question_id'=>$firstChoicalQuestion->id,
                'field_id'=>$firstChoicalQuestion->field->id
            ]
        );
//        dd(
//        ReviewStandard
//            ::whereIn('question_id',$equationQuestionsIds )
//            ->where('standard_id', Standard::Financial_ID)
//            ->get()
//        );
    }
}
