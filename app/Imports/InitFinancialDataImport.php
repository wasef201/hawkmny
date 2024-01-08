<?php

namespace App\Imports;

use App\Models\Choice;
use App\Models\Field;
use App\Models\FinancialConditionalResult;
use App\Models\Practice;
use App\Models\Question;
use App\Models\questionDurationType;
use App\Models\Standard;
use App\Models\Verification;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InitFinancialDataImport implements ToCollection, WithHeadingRow
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
            [
                'name' => $standard['standard'],
                'percentage' => $standard['standard_percentage']
            ]);
        $rows = $collection
            ->whereNotNull('applied_equation');
//            ->whereNotNull('practice');
        $k = 1;
        $this->command->withProgressBar($rows, function ($row) use ($standard, &$k) {
            usleep(1000);
            global $filed;
            if ($row['field']){
                $filed = Field::query()->updateOrCreate(
                    [
                        'standard_id' => $standard->id,
                        'name' => $row['field'],
                    ],
                    [
                        'degree' => $row['field_degree']
                    ]
                );
            }

            global $practice;
            if ($row['practice']){
                $practice = Practice::updateOrCreate(
                    [
                        'standard_id' => $standard->id,
                        'field_id' => $filed->id,
                        'name' => $row['practice']
                    ],
                    [
                        'degree' => $row['practice_degree']
                    ]
                );
            }

            global $question;
            if ($row['practice_equation']){
                $question = Question::updateOrCreate([
                    'standard_id' => $standard->id,
                    'field_id' => $filed->id,
                    'practice_id' => $practice->id,
                    'name' => $row['practice_equation']
                ],
                    [
                        'degree' => $row['practice_degree'],
                        'question_type' => $row['question_type'],
                        'name' => $row['new_equation'] ?? $row['practice_equation']
                    ]
                );
            }

            if($row['equation_duration_type']){
                questionDurationType::updateOrCreate([
                    'question_id'=>$question->id,
                    'duration_type'=>$row['equation_duration_type']
                ],
                    [
                        'equation'=>$row['duration_equation']
                    ]
                );
            }
            Choice::updateOrCreate(
                [
                    'question_id' => $question->id,
                    'name' => $row['applied_equation']
                ],
                [
                    'description' => $row['condition'],
                ]

            );
            $k++;
        });
    }
}
