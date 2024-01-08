<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Lang;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;

class SupervisorsExport implements FromCollection, Responsable, WithHeadings, WithMapping
{

    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'supervisors.xlsx';

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

    public $supervisors;


    public function __construct($supervisors)
    {
        $this->supervisors = $supervisors;
    }


    public function headings(): array
    {
        return [
            '#',
            'المشرف',
            'البريد الاكتورنى ',
            'رقم الجوال ',
            'التخصص',
            'المنطقه',
            'المدينه',
            'نطاق الاشراف',
            'تاريخ التسجيل',
        ];
    }


    public function map($supervisor): array
    {
        return [
            $supervisor->id,
            $supervisor->name , 
            $supervisor->email , 
            $supervisor->phone ,
            $supervisor->section_text , 
            $supervisor->area?->name , 
            $supervisor->city?->name , 
            $supervisor->scopeText() , 
            $supervisor->created_at , 
        ];
    }





    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->supervisors;
    }
}
