<x-panel padding="p-0" class="bg-transparent pt-5">
    <div class="row g-6 g-xl-9 text-center py-5">

        @foreach($standards->where('id', '!=', $financialStandard->id) as $standard)
            <div class="col-12 col-md-6">
                <x-card card-title="{{ $standard->name }}">
                    <x-slot name="cardActions">
                        <x-button.link class="btn-sm btn-secondary"
                                       href="{{ route('standard.review.create', $standard) }}">
                            @if($standard->reviews->first()?->pivot?->progress === null)
                                ابدأ الإختبار
                            @else
                                إستكمال الإختبار
                            @endif
                        </x-button.link>
                        <h3 class="mx-4"><a href="{{route('total-report', $standard->id)}}?question-type=all"> تقرير</a></h3>

                    @if ($standard->reviewStandar)
                            <x-button.link class="btn-sm btn-primary" href="{{ route('standard.review.report',
                                ['standard'=>$standard->id, 'review'=> optional($standard->reviews->first()?->pivot)->id]) }}">
                                @lang('Show report')
                            </x-button.link>
                        @endif
                    </x-slot>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fs-4x fw-bolder">{{ optional($standard->reviews->first()?->pivot)->degree ?? 0 }}</div>
                            <div class="fs-4 fw-bold text-gray-400 mb-7">الدرجة</div>
                        </div>
                        <div class="col-md-4">
                            <div class="fs-4x fw-bolder">{{ optional($standard->reviews->first()?->pivot)->progress ?? 0 }}%
                            </div>
                            <div class="fs-4 fw-bold text-gray-400 mb-7">نسبة التقدم</div>
                        </div>
                        <div class="col-md-4">
                            <div
                                class="fs-4x fw-bolder">
                                {{ $standard->total_standard_questions -optional($standard->reviews->first()?->pivot)->answered_question_count }}
                            </div>
                            <div class="fs-4 fw-bold text-gray-400 mb-7"> عدد الاسئله المتبقه</div>
                        </div>
                    </div>
                </x-card>
            </div>
        @endforeach

        <div class="col-12 col-md-12">
            <x-card card-title="{{ $financialStandard->name }}">
                <x-slot name="cardTitle">
                    <a href="{{route('total-report', \App\Services\FinancialService::getFinancialPerformanceStandardId())}}?question-type=all">{{ $financialStandard->name }}</a>
                </x-slot>
                <x-slot name="cardActions">
                    <h3>
                        الدرجة: {{ $appraisal->result }} %
                    </h3>
                    <h3 class="mx-4"><a href="{{route('total-report', \App\Services\FinancialService::getFinancialPerformanceStandardId())}}?question-type=all"> تقرير</a></h3>
                </x-slot>
                <div class="row g-xl-9 g-5">

                    <x-card class="col-lg-6 border" card-title="{{__('financial performance')}}">
                        <x-slot name="cardActions">
                            <x-button.link class="btn-sm btn-secondary"
                                           href="{{ route('financial.edit') }}{{$appraisal->performance_result===null?'?open=inputs':''}}">
                                @if($appraisal->performance_result===null)
                                    ابدأ الإختبار
                                @else
                                    استعراض النتائج
                                @endif
                            </x-button.link>
                            @if ($financialStandard->reviewStandar)
                                <x-button.link class="btn-sm btn-primary" href="{{ route('standard.review.report',
                                ['standard'=>$financialStandard->id, 'review'=> optional($financialStandard->reviews->first()?->pivot)->id]) }}">
                                    @lang('Show report')
                                </x-button.link>
                            @endif
                        </x-slot>
                        <div class="row">
                            <div class="col-md-4">
                                <div
                                    class="fs-4x fw-bolder">{{ round($appraisal->performance_result, 2) ?? 0 }}</div>
                                <div class="fs-4 fw-bold text-gray-400 mb-7">الدرجة</div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="fs-4x fw-bolder">
                                    {{ $appraisal->performance_result?100:0 }}
                                    %
                                </div>
                                <div class="fs-4 fw-bold text-gray-400 mb-7">نسبة التقدم</div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="fs-4x fw-bolder"> {{ $appraisal->performance_result?0:$financialStandard->questions()->equational()->count() }} </div>
                                <div class="fs-4 fw-bold text-gray-400 mb-7"> عدد الاسئله المتبقه</div>
                            </div>
                        </div>
                    </x-card>
                    <x-card class="col-md-6 border" card-title="{{ __('financial organization') }}">
                        <x-slot name="cardActions">
                            <x-button.link class="btn-sm btn-secondary"
                                           href="{{ route('standard.review.create', $financialStandard) }}">
                                @if($financialStandard->reviews->first()?->pivot?->progress === null)
                                    ابدأ الإختبار
                                @else
                                    إستكمال الإختبار
                                @endif
                            </x-button.link>
                            @if ($financialStandard->reviewStandar)
                                <x-button.link class="btn-sm btn-primary" href="{{ route('standard.review.report',
                                ['standard'=>$financialStandard->id, 'review'=> optional($financialStandard->reviews->first()?->pivot)->id]) }}">
                                    @lang('Show report')
                                </x-button.link>
                            @endif
                        </x-slot>
                        <div class="row">
                            <div class="col-md-4">
                                <div
                                    class="fs-4x fw-bolder">{{ round($appraisal->organization_result, 2) ?? 0 }}</div>
                                <div class="fs-4 fw-bold text-gray-400 mb-7">الدرجة</div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="fs-4x fw-bolder">{{ optional($financialStandard->reviews->first()?->pivot)->progress ?? 0 }}
                                    %
                                </div>
                                <div class="fs-4 fw-bold text-gray-400 mb-7">نسبة التقدم</div>
                            </div>
                            <div class="col-md-4">
                                <div class="fs-4x fw-bolder">
{{--            @dd($standards[2]->reviews->first()?->pivot--}}

                                    {{ $financialStandard->total_standard_questions -optional($financialStandard->reviews->first()?->pivot)->answered_question_count }}
                                </div>
                                <div class="fs-4 fw-bold text-gray-400 mb-7"> عدد الاسئله المتبقه</div>
                            </div>
                        </div>
                    </x-card>
                </div>


            </x-card>
        </div>
    </div>
</x-panel>
