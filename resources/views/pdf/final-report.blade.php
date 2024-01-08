<!DOCTYPE html>
<html lang="ar" dir="rtl" class="full-w-h">
<title>حوكمني</title>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <style>

        .bg-purple-cell {
            background: #45225d;
            color: white;
        }

        .bg-white-cell {
            background: white;
            color: #45225d;
        }

        table.collapse {
            border-collapse: collapse;
            border: 1pt solid black;
        }

        table.collapse td {
            padding: 7px 3px;
            border: 1pt solid black;
            line-break: unset;
            text-align: center;
        }

        table.collapse td.id-cell {
            padding: 1px 3px;
            border: 1pt solid black;
            width: 30px;
        }

        td.header-cell {
            width: 60px;
        }

        table.collapse td {
            /*width: 170px;*/
        }
    </style>
    <style type="text/css">
        body {
            /*font-family: sans-serif;*/
            font-family: 'almarai';
            /*font-family: 'tajawal'!important;*/
            font-size: 10pt;
        }

        div.absolute {
            position: absolute;
        }

        div.relative {
            position: relative;
        }

        .section-title {
            color: #43b7a0;
        }

        .section-sub-title {
            color: #43b7a0;
            font-size: 18px;
            font-weight: 50;
        }

        .col-4 {
            width: 50%;
            float: right;
            text-align: center;
        }

        table {
            border: 1px solid #acc898;
        }

        thead tr th {
            border-bottom: 2px solid #c1d69b;
        }

        tbody tr td {
            border-bottom: 1px solid #c1d69b;
            border-left: 1px solid #c1d69b;
        }


        .mb-8 {
            margin-bottom: 8px;
        }

        th {
            background-color: #e8f0d9;
        }

        .floatedTable {
            min-width: 50%;
            max-width: 100%;

            float: left;
        }

        .inlineTable {
            min-width: 50%;
            max-width: 100%;
            display: inline-block;
        }

        .full-w-h {
            height: 100% !important;
            width: 100% !important;
        }

        .page-break {
            page-break-after: always;
        }

        .page-before {
            page-break-before: always;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }

        .label {
            color: #54a4a5;
            font-weight: bold;
        }

        .label-value {
            color: black;
            font-weight: bold;
        }
    </style>
</head>
<body dir="rtl">
<div class="page-break" style="width: 100%; height: 100%;margin: 0;padding: 0;">
    <img src="{{public_path('images/final-report-0.jpg')}}"
         alt=""
         width="100%"
         height=""
         style="width: 100%; height: 220%;">
</div>

<div class="absolute" style="top: 0px; right: 0px;">
    <img src="{{public_path('images/top-left-report.png')}}">
</div>

<div class="absolute" style="bottom: 0px; left: 0px;">
    <img height="170px" width="300px" src="{{public_path('images/report-bottom-left.png')}}">
</div>

<div class="page-break" style="margin: 3rem">
    <div>&nbsp;</div>
    <div style="margin-top: 13rem">
        <div>
            <h2 class="section-title">
                <img width="20px" style="margin-bottom:-10px" src="{{public_path('images/report-arrow.png')}}">
                اخلاء مسئولية
            </h2>
        </div>
        <p>
            تؤكــد منصــة حــوكمني أن هـــذا التقــرير هو تقــرير داخــلي توجيهي بيــن المنصــة
            والجمعيات الأهلية ولا يمثل التقييم الكــامل لمــدى التزام الجمعية بالحــوكمة بل
            يعكس واقع تقييم معيار الامتثال والالتزام والشفافية والإفصاح والسلامة المالية
            كا أداء مالي وتنظيم مالي وفق تاريخ التقييم وفي حدود مجالات المعيـار والشواهد
            المعطاه وقت التقييم كـما ننوه أن للمنصـة الحــق الكـــامل في إضــافة او تعــــديل
            ً لتلك المعايير مستقبلا حسب توجيه المركز الوطني لتنمية القطاع غير الربحي مما
            قد ينعكس على الدرجات المقدمة للجمعية في هذا التقرير

        </p>
    </div>
</div>
@include('pdf.fixed-imgs')

<div>&nbsp;</div>
<div class="page-break" style="margin: 3rem">
    <h2 class="section-title">
        <img width="20px" style="margin-bottom:-10px" src="{{public_path('images/report-arrow.png')}}">
        تفاصيل بيانات المنظمة
    </h2>
    <div style="margin-right: 2rem">
        <span class="label">اسم المنظمة:</span>
        <span class="label-value">{{$association->name}}</span>
    </div>
    <div style="margin-right: 2rem">
        <span class="label">رقم تسجيل المنظمة:</span>
        <span class="label-value">{{$association->number}}</span>
    </div>
    <div style="margin-right: 2rem">
        <span class="label">العنوان:</span>
        <span class="label-value">{{$association->address}}</span>
    </div>
    <div style="margin-right: 2rem">
        <span class="label">الهاتف:</span>
        <span class="label-value">{{$association->phone}}</span>
    </div>
    {{--        <div style="margin-right: 2rem">--}}
    {{--            <span class="label">المنظقة:</span>--}}
    {{--            <span class="label-value"></span>--}}
    {{--        </div>--}}

    {{--        <h2 class="section-title">--}}
    {{--            <img width="20px" style="margin-bottom:-10px" src="{{public_path('images/report-arrow.png')}}">--}}
    {{--            نتائج التقييم--}}
    {{--        </h2>--}}
    {{--        <div style="width: 190px">--}}
    {{--            <div class="c100 p90 big green" >--}}
    {{--                <span style="left: 0; top: 0;"></span>--}}
    {{--                <div class="slice">--}}
    {{--                    <div class="bar"></div>--}}
    {{--                    <div class="fill"></div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
</div>

@include('pdf.fixed-imgs')
<div>&nbsp;</div>

<div class="page-break" style="margin: 3rem">
    <div style="z-index: 2">
        <h2 class="section-title">
            <img width="20px" style="margin-bottom:-10px" src="{{public_path('images/report-arrow.png')}}">
            نتائج التقييم بحسب المؤشرت
        </h2>

        @foreach($standards as $standard)
            <div class="section-sub-title" style="margin-bottom: 4px; font-weight:bold">{{$standard->name}}</div>

            <table class="collapse" style="margin-bottom: 20px">
                <thead>
                <tr class="bg-purple-cell">
                    <td class="bg-purple-cell id-cell">#</td>
                    <td class="bg-purple-cell header-cell" style="width: 250px">المؤشرات</td>
                    <td class="bg-purple-cell" style="width: 100px">درحة المؤشر</td>
                    <td class="bg-purple-cell" style="width: 100px">الدرجة المحققة</td>
                    <td class="bg-purple-cell" style="width: 100px">النسبة</td>
                </tr>
                </thead>
                <tbody style="">
                @if($standard->id===\App\Services\FinancialService::getFinancialPerformanceStandardId())
                    @php
                        $performanceFullDegree=$standard->fields()->whereHas('questions', fn($q)=>$q->where('question_type', 'financial_equation'))->sum('degree');
                        $organizationFullDegree=$standard->fields()->whereHas('questions', fn($q)=>$q->whereNull('question_type'))->sum('degree');
                    @endphp
                    <tr>
                        <td class="bg-purple-cell id-cell">{{$loop->iteration}}</td>
                        <td class=" bg-purple-cell">{{__('financial performance')}}</td>
                        <td class="bg-white-cell">{{$performanceFullDegree}}</td>
                        <td class="bg-white-cell">{{$financialAppraisal?->performance_result>0?$financialAppraisal?->performance_result:0}}</td>
                        <td class="bg-white-cell">{{($financialAppraisal?->performance_result>0?$financialAppraisal?->performance_result:0)/$performanceFullDegree}}</td>
                    </tr>
                    <tr>
                        <td class="bg-purple-cell id-cell">{{$loop->iteration}}</td>
                        <td class=" bg-purple-cell">{{__('financial organization')}}</td>
                        <td class="bg-white-cell">{{$organizationFullDegree}}</td>
                        <td class="bg-white-cell">{{$financialAppraisal?->organization_result}}</td>
                        <td class="bg-white-cell">{{$financialAppraisal?->organization_result/$organizationFullDegree}}</td>
                    </tr>
                @else
                    @foreach($standard->fields as $field)
                        @php
                            $fieldsReport=$fieldsReports->firstWhere('field_id', $field->id);
//                        @endphp
                        <tr>
                            <td class="bg-purple-cell id-cell">{{$loop->iteration}}</td>
                            <td class=" bg-purple-cell">{{$field->name}}</td>
                            <td class="bg-white-cell">{{$field->degree}}</td>
                            <td class="bg-white-cell">{{is_null($fieldsReport?->fields_sum)?'':round($fieldsReport?->fields_sum*$field->degree/100 ,2)}}</td>
                            <td class="bg-white-cell">{{$fieldsReport?->fields_sum?$fieldsReport?->fields_sum.'%':''}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">المجموع</td>
                        <td>{{$standard->fields->sum('degree')}}</td>
                        <td colspan="2">{{$fieldsReports->where('field_id', $field->id)->sum('fields_sum')}}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        @endforeach
    </div>
</div>

<div>&nbsp;</div>
<h2 class="section-title" style="margin: 3rem">
    <img width="20px" style="margin-bottom:-10px" src="{{public_path('images/report-arrow.png')}}">
    نتائج التقييم بحسب الممارسات
</h2>
@foreach($standards as $standard)
    @include('pdf.fixed-imgs')
    <div>&nbsp;</div>

    <div class="page-break" style="z-index: 20; margin: 2rem">

        <div class="section-sub-title" style="margin-bottom: 4px; font-weight:bold">
            {{$standard->name}}
        </div>

        <table class="collapse" style="margin-bottom: 20px">
            <thead>
            <tr class="bg-purple-cell">
                @if($standard->practices->count()>28)

                    <td class="bg-purple-cell id-cell">#</td>
                    <td class="bg-purple-cell header-cell" style="width: 170px">المؤشرات</td>
                    <td class="bg-purple-cell" style="width: 50px">درحة المؤشر</td>
                    <td class="bg-purple-cell" style="width: 50px">الدرجة المحققة</td>
                    <td class="bg-purple-cell" style="width: 50px">النسبة</td>
                    <td class="bg-purple-cell id-cell">#</td>
                    <td class="bg-purple-cell header-cell" style="width: 170px">المؤشرات</td>
                    <td class="bg-purple-cell" style="width: 50px">درحة المؤشر</td>
                    <td class="bg-purple-cell" style="width: 50px">الدرجة المحققة</td>
                    <td class="bg-purple-cell" style="width: 50px">النسبة</td>
                @else
                    <td class="bg-purple-cell id-cell">#</td>
                    <td class="bg-purple-cell header-cell" style="width: 250px">المؤشرات</td>
                    <td class="bg-purple-cell" style="width: 100px">درحة المؤشر</td>
                    <td class="bg-purple-cell" style="width: 100px">الدرجة المحققة</td>
                    <td class="bg-purple-cell" style="width: 100px">النسبة</td>
                @endif
            </tr>
            </thead>
            <tbody style="">
            @php
                $i=0;
            @endphp
            @while($i<$standard->practices->count())
                @php
                    $practice=($standard->practices)[$i];
                @endphp
                <tr>
                    <td class="bg-purple-cell id-cell">{{$i+1}}</td>
                    <td class=" bg-purple-cell">{{$practice->name}}</td>
                    <td class="bg-white-cell">{{$practice->degree}}</td>
                    <td class="bg-white-cell">{{round($practice->practice_degree, 2)}}</td>
                    <td class="bg-white-cell"></td>
                    @php
                        $i++
                    @endphp
                    @if($standard->practices->count()>28 && isset(($standard->practices)[$i]))
                        @php
                            $practice=($standard->practices)[$i];
                        @endphp
                        <td class="bg-purple-cell id-cell">{{$i+1}}</td>
                        <td class=" bg-purple-cell">{{$practice->name}}</td>
                        <td class="bg-white-cell">{{$practice->degree}}</td>
                        <td class="bg-white-cell">{{round($practice->practice_degree, 2)}}</td>
                        <td class="bg-white-cell"></td>
                        @php
                            $i++
                        @endphp
                    @endif
                </tr>

            @endwhile
            <tr style="background: white">
                <td class="bg-white" colspan="{{$standard->practices->count()>28?8:2}}">المجموع</td>
                <td class="bg-white">{{$standard->fields->sum('degree')}}</td>
                <td class="bg-white"
                    colspan="2">{{$fieldsReports->where('field_id', $field->id)->sum('fields_sum')}}</td>
            </tr>
            </tbody>
        </table>

    </div>

@endforeach

<img src="{{public_path('images/final-report-1.jpg')}}"
     alt=""
     width="150%"
     style="width: 150%; height: 300%;">
</body>
</html>
