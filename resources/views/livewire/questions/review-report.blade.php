<div>
    <div wire:loading >
        <h1 class="text-center mx-auto">
            ...جاري التحميل
        </h1>

    </div>
    <div class="row pt-5 text-center" wire:loading.remove>
        <div class="col-md-10 col-lg-10 m-auto">
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-toolbar flex-row-fluid justify-content-start gap-5">
                        <a href="{{ route('standard.review.report.pdf' , ['review' => $review->id , 'standard' => $standard->id ] ) }}?question-type={{request()->get('question-type', 'choical')}}" id="generatePDF" type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black"></rect>
                                    <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black"></path>
                                    <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4"></path>
                                </svg>
                            </span>
                            @lang('Print')
                        </a>
                    </div>
                </div>
                <div class="card-body pt-0" id="reviewReport">
                    <div class="d-flex  flex-column gap-5">
                        <div class="text-center text-black fs-2x">
                            @lang('Report of')
                                @if($standard->id==3 && request()->get('question-type')!='all')
                                    التنظيم المالي
                                @else
                                    {{ $standard->name }}
                                @endif
                        </div>

                        <div class="row pt-6">
                            <div class="col-6">
                                <div class="fs-3x fw-bolder">{{ optional($review_standard)->degree ?? 0 }}</div>
                                <div class="fs-4 fw-bold text-gray-700 mb-7">الدرجة</div>
                            </div>
                            <div class="col-6">
                                <div class="fs-3x fw-bolder"> {{ round((($review_standard->answers_count / $review_standard->questions_count) * 100),2 ) }} %</div>
                                <div class="fs-4 fw-bold text-gray-700 mb-7">نسبه الاكمال</div>
                            </div>

                            @if($standard->id==3 && request()->get('question-type')=='all')

                            <div class="col-6">
                                <div class="fs-5 fw-bolder"> {{__($financialAppaisal?->reservation_type) }} {{$financialAppaisal?->reservations_count? "($financialAppaisal?->reservations_count)":""}} </div>
                                <div class="fs-4 fw-bold text-gray-700 mb-7">راي المراجع القانوني</div>
                            </div>
                            <div class="col-6">
                                <div class="fs-5 fw-bolder"> {{__($financialAppaisal?->duration_type) }} </div>
                                <div class="fs-4 fw-bold text-gray-700 mb-7">نوع التقييم</div>
                            </div>
                            @endif
                            {{-- <div class="col-4">
                                <div class="fs-3x fw-bolder"> {{optional($weakPoints)->count()}}</div>
                                <div class="fs-4 fw-bold text-gray-700 mb-7">نقاط الضعف  </div>
                            </div> --}}
                        </div>

{{--                        <div class="separator-dashed"></div>--}}

{{--                        <div class="separator-dashed"></div>--}}
{{--                        <div class="d-flex p-lg-5  flex-stack">--}}
{{--                            --}}{{-- <span class="fs-6 fw-bolder text-gray-800 text-hover-primary text-active-primary "> نقاط الضعف</span> --}}
{{--                            <div class="text-active-dark"></div>--}}
{{--                        </div>--}}
                        <div>
                            {{-- <ul style="text-align: right !important; direction: rtl ; list-style: none">
                                @foreach($weakPoints as $weakPoints)
                                    <li  style="text-align: right !important; direction: rtl " class=" p-1"> {{optional($weakPoints)->question->name}}</li>
                                    <div class="dropdown-divider"></div>
                                @endforeach
                            </ul> --}}

                            <table  style='text-align: center; width: 100%; border : 1px solid #acc898; ' >
                                <thead>
                                    <tr>
                                        <th style='border-bottom: 2px solid #c1d69b;' > # </th>
                                        <th style='border-bottom: 2px solid #c1d69b;' > الممارسه </th>
                                        <th style='border-bottom: 2px solid #c1d69b;' > الدرجه </th>
                                        <th style='border-bottom: 2px solid #c1d69b;' > الدرجه المحققه </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($practices as $practice)
                                    <tr>
                                        <td style='background-color:#e8f0d9;border-bottom : 1px solid #c1d69b;
            border-left : 1px solid #c1d69b;' > {{ $i++ }} </td>
                                        <td style='background-color:#e8f0d9;border-bottom : 1px solid #c1d69b;
            border-left : 1px solid #c1d69b;' > {{ $practice->name }} </td>
                                        <td style="border-bottom : 1px solid #c1d69b;
            border-left : 1px solid #c1d69b;" > {{ $practice->degree }} </td>
                                        <td style='border-bottom : 1px solid #c1d69b;
            border-left : 1px solid #c1d69b;background-color: {{ $practice->degree == $practice->questions_degree   ? '#c1d69b' : 'white'  }} ;' > {{ $practice->questions_degree }} </td>
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

                        </div>
                    </div>
                    <hr/>
                    <div class="d-flex p-lg-5 mt-8 flex-stack">
                        <span class="fs-6 fw-bolder text-gray-800 text-hover-primary text-active-primary "> {{env('APP_URL')}}   </span>
                        <div class= "text-active-dark"> {{\Carbon\Carbon::now()->toDateTimeString()}}</div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    @push('script')
    <<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script>
        $('#generatePDF').on('click', function (){
            CreatePDFfromHTML();
        });

        function CreatePDFfromHTML() {
            var HTML_Width = $("#reviewReport").width();
            var HTML_Height = $("#reviewReport").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            html2canvas($("#reviewReport")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) {
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("review-report.pdf");

            });
        }
    </script>
    @endpush
</div>
