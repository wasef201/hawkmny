<?php

namespace App\Imports;

use App\Models\Choice;
use App\Models\Field;
use App\Models\Practice;
use App\Models\Question;
use App\Models\Standard;
use App\Models\Verification;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InitFinOrganizationImport implements ToCollection, WithHeadingRow
{
    private ?int $parentId = null;
    private ?Command $command;

    public function __construct(?Command $command)
    {
        $this->command = $command;
    }

    /**
     * @param Collection $collection
     */
    final public function collection(Collection $collection): void
    {

        $standard = $collection->first();
        $standard = Standard::query()->firstOrCreate(
            ['name' => $standard['standard']],
            ['percentage' => $standard['standard_percentage']
            ]);
        $rows = $collection
            // ->whereNotNull('field')
            // ->whereNotNull('practice')
            ->whereNotNull('choice');
            // ->whereNotNull('question');
            // dd($rows->count());
      $this->command->withProgressBar($rows,function ($row) use ($standard) {
          usleep(1000);
          if ($this->parentId) {
            // dd($row);
          }
          global $filed;
          if ($row['field']) {
              $filed = Field::query()->firstOrCreate([
                  'standard_id' => $standard->id,
                  'name' => $row['field'],
                  'degree' => $row['field_degree']
              ]);
          }
          global $practice;
          if ($row['practice']) {
            $practice = Practice::query()->firstOrCreate([
                'standard_id' => $standard->id,
                'name' => $row['practice'],
            ],
                [

                    'field_id' => $filed->id,
                    'degree' => $row['practice_degree']
                ]
            );
          }
          global $question;
          if ($row['question']) {
            $question = Question::query()->create([
                'standard_id' => $standard->id,
                'field_id' => $filed->id,
                'practice_id' => $practice->id,
                'name' => $row['question'],
                'parent_id' => $this->parentId,
                'degree' => $row['question_degree'] ?$row['question_degree']: $question->degree
            ],[
            ]);
          }
          if($row['q_verification']) {
              $verifications = explode("\n",$row['q_verification']);
              foreach ($verifications as $verification) {
                  if(!empty($verification) && $verification !== ' ') {
                      Verification::query()->firstOrCreate([
                          'standard_id' => $standard->id,
                          'field_id' => $filed->id,
                          'practice_id' => $practice->id,
                          'question_id' => $question->id,
                          'name' => $verification
                      ]);
                  }
              }
          }
          global $choice_degree;
          $choice_degree=$row['choice_degree'];
          $move_words=['يتم الإنتقال للسؤال التالي', 'يتم الانتقال للسؤال التالي', 'يتم الأنتقال للسؤال التالي'];
          if (\Str::contains($row['choice'], $move_words) ) {
              $row['choice']=str_replace(array_merge($move_words, [':']),'', $row['choice']);
              $row['choice_degree']=-1;
          }
          Choice::query()->firstOrCreate([
              'question_id' => $question->id,
              'name' => $row['choice'],
              'percentage' => $row['choice_degree'],
          ]);

          if((int)$row['choice_degree'] === -1) {
              $this->parentId = $question->id;
          } else {
              $this->parentId = null;
          }
      });
    }
}
