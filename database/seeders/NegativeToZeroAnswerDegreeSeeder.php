<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;

class NegativeToZeroAnswerDegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $negativeAnswers=Answer::where('degree', '<', 0);
        foreach ($negativeAnswers as $negativeAnswer){
            $negativeAnswer->update(['answer'=>0]);
        }
        echo "done";
    }
}
