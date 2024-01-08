<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;

class FIXOldAnswersWithStandardId extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Answer::query()->with('question.standard')
            ->get()
            ->each(function (Answer $answer) {
               $answer->update(['standard_id' => $answer->question->standard_id]);
            });
    }
}
