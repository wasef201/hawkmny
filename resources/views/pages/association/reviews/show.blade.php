<x-panel padding="p-0" class="bg-transparent pt-5" title="تقيمات الجمعيه" >

    <x-slot name="toolBarActions">
        <a href="{{ route('reviews.excel' , ['review' => $review->id ] ) }}" class="btn btn-success"><i class="fas fa-file-excel fs-4 me-2"></i> تقرير Excel </a>
    </x-slot>


    <div class="row g-6 g-xl-9 text-center">

        <div class="col-md-6 col-lg-4">
            <!--begin::Card-->
            <div class="card h-100">
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Heading-->
                    <div class="fs-4x fw-bolder">{{ $mo2sher_elhwkmah ?? '' }} % </div>
                    <div class="fs-4 fw-bold text-gray-400 mb-7"> مؤشر الحوكمة  </div>
                    <!--end::Heading-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <div class="py-1">
                        <span class="text-dark fs-3x fw-bolder">{{ round(optional(optional($review)->standards)->avg('progress'),2) }} %</span>
                        {{--<span class="fw-bold text-muted fs-7">Avarage</span>--}}
                    </div>
                    <div class="progress h-7px mt-3">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ optional(optional($review)->standards)->avg('progress') }} }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <a  class="card-title fw-bolder text-success fs-5 mt-3 d-block">نسبة اكتمال التقييم</a>

                </div>
                <!--end:: Body-->
            </div>
            <!--begin::Card-->

            <!--end::Card-->
        </div>
        <div class="col-md-6 col-lg-4">
            <!--begin::Card-->
            <div class="card h-100">
                <!--begin::Card body-->

                <div class="card-body p-9">
                    <!--begin::Heading-->
                    <div class="fs-4x fw-bolder">{{ $review->degree }}</div>
                    <div class="fs-4 fw-bold text-gray-400 mb-7"> عدد النقاط </div>
                    <!--end::Heading-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
    </div>
    <div class="row g-6 g-xl-9 text-center py-5">
        <div class="col-12">
            <x-card>

                <x-table>
                    <x-slot name="head">
                        <th>  المعيار  </th>
                        <th> الدرجه </th>
                        <th> عدد الاسئله </th>
                        <th>  الاسئله المجابه </th>
                        <th>  الاسئله غير المجابه </th>
                        <th> نسبه الاكمال  </th>
                    </x-slot>
                    <x-slot name="body">
                        @foreach($review->standards as $review_stander)
                        <tr>
                            <td class="fw-bold fs-4">{{ optional($review_stander->standard)->name }}</td>
                            <td>{{ $review_stander->degree }}  نقطه </td>
                            <td>{{ $review_stander->total_standard_questions }} سؤال </td>
                            <td>{{ $review_stander->answered_question_count }} سؤال </td>
                            <td>{{ $review_stander->total_standard_questions - $review_stander->answered_question_count }} سؤال </td>
                            <td>{{ $review_stander->progress }} % </td>
                            <td>
                                @if (Auth::user()->type == App\Models\User::ASSOCIATION)
                                <a class='btn btn-primary btn-sm py-2' href="{{ route('standard.review.create' , ['standard'=> $review_stander->standard_id ] ) }}"> اكمل التقييم
                                </a>
                                @else
                                <a class='btn btn-primary btn-sm py-2' href="{{ route('standard.review.show' , ['review'=> $review->id , 'standard' => $review_stander->standard_id ] ) }}"> مشاهده
                                </a>
                                @endif
                                    <x-button.link class="btn-sm btn-primary" href="{{ route('standard.review.report',
                                ['standard'=>optional($review_stander->standard)->id, 'review'=> $review->id]) }}">
                                        @lang('Show report')
                                    </x-button.link>
                            </td>
                        </tr>
                        @endforeach
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
</x-panel>
