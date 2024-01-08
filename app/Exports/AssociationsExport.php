<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Lang;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;

class AssociationsExport implements FromQuery, Responsable, WithHeadings, WithMapping
{

    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'associations.xlsx';

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

    public Builder $associations;


    public function __construct($associations)
    {
        $this->associations = $associations;
    }


    public function headings(): array
    {
        return [
            '#',
            'اسم الجمعيه',
            'البريد الاكتورنى ',
            'رقم الجوال ',
            'رقم الترخيص ',
            'التخصص',
            'المنطقه',
            'المدينه',
            'تاريخ التسجيل',
        ];
    }


    public function map($association): array
    {
        return [
            $association->id,
            $association->name ,
            $association->email ,
            $association->phone ,
            $association->number ,
            $association->section_text ,
            optional($association->area)->name ,
            optional($association->city)->name ,
            $association->created_at ,
        ];
    }


    public function query()
    {
        return $this->associations;
    }
}
