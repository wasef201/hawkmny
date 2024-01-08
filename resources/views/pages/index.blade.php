
<x-panel padding="p-0" class="bg-transparent pt-5" title="احصائيات " >
    <div class="row">
        <div class="col-md-6">
            <x-card card-title="احصائيات اشتراك الجمعيات" >
                <div class="mixed-widget-10-chart22" data-kt-color="green" style="height: 175px"></div>
            </x-card>
        </div>
        <div class="col-md-6">
            <x-card card-title="احصائيات تخصصات الجمعيات" >
                <div class="mixed-widget-10-chart55" data-kt-color="green" style="height: 175px"></div>
            </x-card>
        </div>
    </div>

    <div class="row pt-5">
        <div class="col-md-6">
            <x-card card-title="احصائيات اشتراك المشرفين" >
                <div class="mixed-widget-10-chart44" data-kt-color="green" style="height: 175px"></div>
            </x-card>
        </div>
        <div class="col-md-6">
            <x-card card-title="احصائيات تخصصات المشرفين" >
                <div class="mixed-widget-10-chart33" data-kt-color="green" style="height: 175px"></div>
            </x-card>
        </div>
    </div>

    <div class="row pt-5">
        <div class="col-md-12">
            <x-card card-title="احصائيات المناطق للجميعات" >
                <div class="mixed-widget-10-chart66" data-kt-color="green" style="height: 175px"></div>
            </x-card>
        </div>
    </div>


    <div class="row pt-5">
        <div class="col-md-12">
            <x-card card-title="احصائيات المناطق للمشرفين" >
                <div class="mixed-widget-10-chart99" data-kt-color="green" style="height: 175px"></div>
            </x-card>
        </div>
    </div>
    <div class="row pt-5">
        <div class="col-md-12">
            <x-card card-title="جمعيات تحتاج الى الموافقه" >
                <x-table>
                    <x-slot name="head">
                        <th class="px-2 text-start">الجمعية</th>
                        <th>التخصص</th>
                        <th>المنطقة</th>
                        <th>المدينة</th>
                        <th>رقم الترخيص</th>
                        <th>تاريخ التسجيل</th>
                    </x-slot>
                    <x-slot name="body">
                        @foreach($un_approved_associations as $association)
                        <tr>
                            <td class="d-flex align-items-center">
                                <!--begin:: Avatar -->
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    <a href="{{ route('association.show' ,  $association) }}">
                                        @if ($association->logo)
                                        <img  width="50" height="50" src="{{ $association->logoUrl() }}" alt="">
                                        @else
                                        <div class="symbol-label fs-3 bg-light-success text-success">{{ mb_substr($association->name, 0, 1, 'utf8') }}</div>
                                        @endif
                                    </a>
                                </div>

                                <div class="d-flex flex-column">
                                    <a href="{{ route('association.show' , $association->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ $association->name }}</a>
                                    <a class="text-muted"><i class="bi-mailbox2"></i> {{ $association->email }}</a>
                                    <a class="text-muted"><i class="bi-telephone-plus"></i>{{ $association->phone }}</a>
                                </div>

                            </td>
                            <td class="text-center">{{ $association->section_text }}</td>
                            <td class="text-center">{{ optional($association->area)->name ?? '- - -'}}</td>
                            <td class="text-center">{{ optional($association->city)->name ?? '- - -'}}</td>
                            <td class="text-center">{{ $association->number }}</td>
                            <td class="text-center">{{ $association->created_at->toDateString() }}</td>
                            <td>
                                <x-button.link href="{{ route('association.show', $association ) }}" class="btn-info btn-sm"> استعراض </x-button.link>
                                <x-button.link href="{{ route('association.approve', $association ) }}" class="btn-primary btn-sm"> موافقه </x-button.link>
                            </td>

                        </tr>
                        @endforeach
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

    @push('script')
    <link href="{{ asset('theme/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('theme/plugins/global/plugins.bundle.js') }}"></script>




    <script>
        $(function() {
            var e,
            t,
            a,
            o = document.querySelectorAll(".mixed-widget-10-chart22"),
            s = KTUtil.getCssVariableValue("--bs-gray-500"),
            r = KTUtil.getCssVariableValue("--bs-gray-200"),
            i = KTUtil.getCssVariableValue("--bs-gray-300");
            [].slice.call(o).map(function (o) {
                (e = o.getAttribute("data-kt-color")),
                (t = parseInt(KTUtil.css(o, "height"))),
                (a = KTUtil.getCssVariableValue("--bs-" + e)),
                new ApexCharts(o, {
                    series: [
                    { name: "عدد الجمعيات المشتركه", data: @json($counts) },
                    ],
                    chart: { fontFamily: "inherit", type: "bar", height: t, toolbar: { show: !1 } },
                    plotOptions: { bar: { horizontal: !1, columnWidth: ["50%"], borderRadius: 4 } },
                    legend: { show: !1 },
                    dataLabels: { enabled: !1 },
                    stroke: { show: !0, width: 2, colors: ["transparent"] },
                    xaxis: {
                        categories: @json($months), axisBorder: { show: !1 }, axisTicks: { show: !1 }, labels: { style: { colors: s, fontSize: "12px" } } },
                        yaxis: { y: 0, offsetX: 0, offsetY: 0, labels: { style: { colors: s, fontSize: "12px" } } },
                        fill: { type: "solid" },
                        states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "none", value: 0 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } } },
                        tooltip: {
                            followCursor: true,
                            fixed: {
                                enabled: true,
                                position: 'topLeft',
                                offsetX: 0,
                                offsetY: 0,
                            },
                            style: { fontSize: "12px" },
                            y: {
                                formatter: function (e) {
                                    return  e + " جمعيه";
                                },
                            },
                        },
                        colors: ['#1CA08C', i],
                        grid: { padding: { top: 10 }, borderColor: r, strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
                    }).render();
            });
        });
    </script>

    <script>

        $(function() {
            var e,
            t,
            a,
            o = document.querySelectorAll(".mixed-widget-10-chart55"),
            s = KTUtil.getCssVariableValue("--bs-gray-500"),
            r = KTUtil.getCssVariableValue("--bs-gray-200"),
            i = KTUtil.getCssVariableValue("--bs-gray-300");
            [].slice.call(o).map(function (o) {
                (e = o.getAttribute("data-kt-color")),
                (t = parseInt(KTUtil.css(o, "height"))),
                (a = KTUtil.getCssVariableValue("--bs-" + e)),
                new ApexCharts(o, {
                    series: [
                    { name: "عدد الجمعيات التى تندرج تحت هذا التصنيف", data: @json($total_section_association) },
                    {{-- { name: "عدد الجمعيات", data: @json($total_section_association) }, --}}
                    ],
                    chart: { fontFamily: "inherit", type: "bar", height: t, toolbar: { show: !1 } },
                    plotOptions: { bar: { horizontal: !1, columnWidth: ["50%"], borderRadius: 4 } },
                    legend: { show: !1 },
                    dataLabels: { enabled: !1 },
                    stroke: { show: !0, width: 2, colors: ["transparent"] },
                    xaxis: {
                        categories: @json($sections), axisBorder: { show: !1 }, axisTicks: { show: !1 }, labels: { style: { colors: s, fontSize: "12px" } } },
                        yaxis: { y: 0, offsetX: 0, offsetY: 0, labels: { style: { colors: s, fontSize: "12px" } } },
                        fill: { type: "solid" },
                        states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "none", value: 0 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } } },
                        tooltip: {
                            followCursor: true,
                            fixed: {
                                enabled: true,
                                position: 'topLeft',
                                offsetX: 0,
                                offsetY: 0,
                            },
                            style: { fontSize: "12px" },
                            y: {
                                formatter: function (e) {
                                    return  e + " جمعيه";
                                },
                            },
                        },
                        colors: ['#1CA08C', i],
                        grid: { padding: { top: 10 }, borderColor: r, strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
                    }).render();
            });
        });


    </script>

    <script>

        $(function() {
            var e,
            t,
            a,
            o = document.querySelectorAll(".mixed-widget-10-chart44"),
            s = KTUtil.getCssVariableValue("--bs-gray-500"),
            r = KTUtil.getCssVariableValue("--bs-gray-200"),
            i = KTUtil.getCssVariableValue("--bs-gray-300");
            [].slice.call(o).map(function (o) {
                (e = o.getAttribute("data-kt-color")),
                (t = parseInt(KTUtil.css(o, "height"))),
                (a = KTUtil.getCssVariableValue("--bs-" + e)),
                new ApexCharts(o, {
                    series: [
                    { name: "عدد المشرفين  المشتركن هذا الشهر ", data: @json($supervisors_counts) },
                    ],
                    chart: { fontFamily: "inherit", type: "bar", height: t, toolbar: { show: !1 } },
                    plotOptions: { bar: { horizontal: !1, columnWidth: ["50%"], borderRadius: 4 } },
                    legend: { show: !1 },
                    dataLabels: { enabled: !1 },
                    stroke: { show: !0, width: 2, colors: ["transparent"] },
                    xaxis: {
                        categories: @json($supervisors_months), axisBorder: { show: !1 }, axisTicks: { show: !1 }, labels: { style: { colors: s, fontSize: "12px" } } },
                        yaxis: { y: 0, offsetX: 0, offsetY: 0, labels: { style: { colors: s, fontSize: "12px" } } },
                        fill: { type: "solid" },
                        states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "none", value: 0 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } } },
                        tooltip: {
                            followCursor: true,
                            fixed: {
                                enabled: true,
                                position: 'topLeft',
                                offsetX: 0,
                                offsetY: 0,
                            },
                            style: { fontSize: "12px" },
                            y: {
                                formatter: function (e) {
                                    return  e + " مشرف";
                                },
                            },
                        },
                        colors: ['#1CA08C', i],
                        grid: { padding: { top: 10 }, borderColor: r, strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
                    }).render();
            });
        });


    </script>


    <script>
        $(function() {
            var e,
            t,
            a,
            o = document.querySelectorAll(".mixed-widget-10-chart33"),
            s = KTUtil.getCssVariableValue("--bs-gray-500"),
            r = KTUtil.getCssVariableValue("--bs-gray-200"),
            i = KTUtil.getCssVariableValue("--bs-gray-300");
            [].slice.call(o).map(function (o) {
                (e = o.getAttribute("data-kt-color")),
                (t = parseInt(KTUtil.css(o, "height"))),
                (a = KTUtil.getCssVariableValue("--bs-" + e)),
                new ApexCharts(o, {
                    series: [
                    { name: "عدد المشرفين  المرتبطين تحت هذا التخصص ", data: @json($total_section_supervisors) },
                    ],
                    chart: { fontFamily: "inherit", type: "bar", height: t, toolbar: { show: !1 } },
                    plotOptions: { bar: { horizontal: !1, columnWidth: ["50%"], borderRadius: 4 } },
                    legend: { show: !1 },
                    dataLabels: { enabled: !1 },
                    stroke: { show: !0, width: 2, colors: ["transparent"] },
                    xaxis: {
                        categories: @json($supervisor_sections), axisBorder: { show: !1 }, axisTicks: { show: !1 }, labels: { style: { colors: s, fontSize: "12px" } } },
                        yaxis: { y: 0, offsetX: 0, offsetY: 0, labels: { style: { colors: s, fontSize: "12px" } } },
                        fill: { type: "solid" },
                        states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "none", value: 0 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } } },
                        tooltip: {
                            followCursor: true,
                            fixed: {
                                enabled: true,
                                position: 'topLeft',
                                offsetX: 0,
                                offsetY: 0,
                            },
                            style: { fontSize: "12px" },
                            y: {
                                formatter: function (e) {
                                    return  e + " مشرف";
                                },
                            },
                        },
                        colors: ['#1CA08C', i],
                        grid: { padding: { top: 10 }, borderColor: r, strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
                    }).render();
            });
        });
    </script>

    <script>
        $(function() {
            var e,
            t,
            a,
            o = document.querySelectorAll(".mixed-widget-10-chart66"),
            s = KTUtil.getCssVariableValue("--bs-gray-500"),
            r = KTUtil.getCssVariableValue("--bs-gray-200"),
            i = KTUtil.getCssVariableValue("--bs-gray-300");
            [].slice.call(o).map(function (o) {
                (e = o.getAttribute("data-kt-color")),
                (t = parseInt(KTUtil.css(o, "height"))),
                (a = KTUtil.getCssVariableValue("--bs-" + e)),
                new ApexCharts(o, {
                    series: [
                    { name: "عدد الجمعيات  داخل المنطقه", data: @json($total_area_associations) },
                    ],
                    chart: { fontFamily: "inherit", type: "bar", height: t, toolbar: { show: !1 } },
                    plotOptions: { bar: { horizontal: !1, columnWidth: ["50%"], borderRadius: 4 } },
                    legend: { show: !1 },
                    dataLabels: { enabled: !1 },
                    stroke: { show: !0, width: 2, colors: ["transparent"] },
                    xaxis: {
                        categories: @json($areas), axisBorder: { show: !1 }, axisTicks: { show: !1 }, labels: { style: { colors: s, fontSize: "12px" } } },
                        yaxis: { y: 0, offsetX: 0, offsetY: 0, labels: { style: { colors: s, fontSize: "12px" } } },
                        fill: { type: "solid" },
                        states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "none", value: 0 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } } },
                        tooltip: {
                            followCursor: true,
                            fixed: {
                                enabled: true,
                                position: 'topLeft',
                                offsetX: 0,
                                offsetY: 0,
                            },
                            style: { fontSize: "12px" },
                            y: {
                                formatter: function (e) {
                                    return  e + " جمعيه";
                                },
                            },
                        },
                        colors: ['#1CA08C', i],
                        grid: { padding: { top: 10 }, borderColor: r, strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
                    }).render();
            });
        });
    </script>


    <script>
        $(function() {
            var e,
            t,
            a,
            o = document.querySelectorAll(".mixed-widget-10-chart99"),
            s = KTUtil.getCssVariableValue("--bs-gray-500"),
            r = KTUtil.getCssVariableValue("--bs-gray-200"),
            i = KTUtil.getCssVariableValue("--bs-gray-300");
            [].slice.call(o).map(function (o) {
                (e = o.getAttribute("data-kt-color")),
                (t = parseInt(KTUtil.css(o, "height"))),
                (a = KTUtil.getCssVariableValue("--bs-" + e)),
                new ApexCharts(o, {
                    series: [
                    { name: "عدد المشرفين  داخل المنطقه", data: @json($total_area_supervisors) },
                    ],
                    chart: { fontFamily: "inherit", type: "bar", height: t, toolbar: { show: !1 } },
                    plotOptions: { bar: { horizontal: !1, columnWidth: ["50%"], borderRadius: 4 } },
                    legend: { show: !1 },
                    dataLabels: { enabled: !1 },
                    stroke: { show: !0, width: 2, colors: ["transparent"] },
                    xaxis: {
                        categories: @json($supervisors_areas), axisBorder: { show: !1 }, axisTicks: { show: !1 }, labels: { style: { colors: s, fontSize: "12px" } } },
                        yaxis: { y: 0, offsetX: 0, offsetY: 0, labels: { style: { colors: s, fontSize: "12px" } } },
                        fill: { type: "solid" },
                        states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "none", value: 0 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } } },
                        tooltip: {
                            followCursor: true,
                            fixed: {
                                enabled: true,
                                position: 'topLeft',
                                offsetX: 0,
                                offsetY: 0,
                            },
                            style: { fontSize: "12px" },
                            y: {
                                formatter: function (e) {
                                    return  e + " مشرف";
                                },
                            },
                        },
                        colors: ['#1CA08C', i],
                        grid: { padding: { top: 10 }, borderColor: r, strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
                    }).render();
            });
        });
    </script>


    @endpush
</x-panel>



