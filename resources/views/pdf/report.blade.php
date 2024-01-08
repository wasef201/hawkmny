<!DOCTYPE html>
<html lang="ar" dir="rtl">
<title>حوكمني</title>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"> --}}

    <meta charset="UTF-8">

    <style>

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

        body {
            font-family: 'Almarai', sans-serif;
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

        .page-break {
            page-break-after: always;
        }
        @page {
            header: page-header;
            footer: page-footer;
        }
    </style>
</head>
<body dir="rtl" style=''>
    <htmlpageheader name="page-header">

        <img style="width: 85px; margin-top:-15px;margin-left:-15px; float: left"
             src="{{asset('images/logo.png')}}"
             alt="">
    </htmlpageheader>
<h1 style='color:#1d8777; text-align: center'> نتائج التقييم بحسب الممارسات </h1>

<h3 style='color:#7ccbab; text-align: center'>
    @if($standard->id==3 && request()->get('question-type')!='all')
        التنظيم المالي
    @else
        {{ $standard->name }}
    @endif
</h3>


<div class="row pt-6">
    <div class="col-4 mb-8">
        <div class="fs-3x fw-bolder">{{ optional($review_standard)->degree ?? 0 }}</div>
        <div class="fs-4 fw-bold text-gray-700 mb-7">الدرجة</div>
    </div>
    <div class="col-4 mb-8">
        <div
            class="fs-3x fw-bolder"> {{ round((($review_standard->answers_count / $review_standard->questions_count) * 100),2 ) }}
            %
        </div>
        <div class="fs-4 fw-bold text-gray-700 mb-7">نسبه الاكمال</div>
    </div>
    <br>

    @if($standard->id==3 && request()->get('question-type')=='all')

        <div class="col-4 mb-8">
            <div
                class="fs-5 fw-bolder mb-3"> {{__($financialAppaisal?->reservation_type) }} {{$financialAppaisal?->reservations_count? "($financialAppaisal?->reservations_count)":""}} </div>
            <div class="fs-4 fw-bold text-gray-700 mb-7">راي المراجع القانوني</div>
        </div>
        <div class="col-4 mb-8">
            <div class="fs-5 fw-bolder"> {{__($financialAppaisal?->duration_type) }} </div>
            <div class="fs-4 fw-bold text-gray-700 mb-7">نوع التقييم</div>
        </div>
    @endif
</div>


<br>
<table style='text-align: center; width: 100%; '>
    <thead>
    <tr>
        <th> #</th>
        <th> الممارسه</th>
        <th> الدرجه</th>
        <th> الدرجه المحققه</th>
    </tr>
    </thead>
    <tbody>
    @php
        $i = 1;
    @endphp
    @foreach ($practices as $practice)
        <tr>
            <td style='background-color:#e8f0d9'> {{ $i++ }} </td>
            <td style='background-color:#e8f0d9'> {{ $practice->name }} </td>
            <td> {{ $practice->degree }} </td>
            <td style='background-color: {{ $practice->degree == $practice->questions_degree   ? '#c1d69b' : 'white'  }} ;'> {{ $practice->questions_degree }} </td>
        </tr>
    @endforeach
    @if(request()->get('question-type')!='all')

        <tr>
            <td>

            </td>
            <td>
                المجموع
            </td>
            <td>
                {{ $practices->sum('degree') }}
            </td>
            <td>
                {{ $practices->sum('questions_degree') }}
            </td>
        </tr>
    @endif
    </tbody>
</table>

<hr>
</body>
</html>
