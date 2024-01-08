<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Lang;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;

class AssociationReviewExport implements FromCollection, Responsable, WithHeadings, WithMapping
{
    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'associations_review.xlsx';

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLSX;

    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public $questions;


    public function __construct($questions)
    {
        $this->questions = $questions;
    }


    public function headings(): array
    {
        return [
            'الؤال',
            'الاجابه ',
            ' الدرجه',
        ];
    }


    public function map($question): array
    {
        return [
            optional($question->question)->name ,
            optional($question->choice)->name ,
            $question->degree ,
        ];
    }




    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->questions;
    }
}
