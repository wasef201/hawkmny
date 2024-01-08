<x-panel title="مدخلات الاداء المالي">
    @include('partials.flash-message')
    <ul class="nav nav-tabs row" id="myTab" role="tablist">
        <li class="nav-item col-sm-6" role="presentation">
            <button class="nav-link active w-100 fs-4" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                    type="button" role="tab" aria-controls="home" aria-selected="true">
                {{__('indicators')}}
            </button>
        </li>
        <li class="nav-item col-sm-6" role="presentation">
            <button class="nav-link w-100 fs-4" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">
                {{__('financial inputs')}}
            </button>
        </li>

    </ul>
    <div class="tab-content my-4" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            @if($userInputsArr)

                @foreach($questions->groupBy('field_id') as $fieldGroup)
                    <div class="card card-custom gutter-b mt-10">
                        <div class=" d-flex justify-content-between">
                            <h3>{{$fieldGroup->first()->practice->field->name}}</h3>
                            <h3>{{$fieldGroup->first()->practice->field->degree}} %</h3>
                        </div>
                        <div class="card-body">

                            @foreach($fieldGroup as $question)

                                <div class="card my-4 card-custom gutter-b">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <p>{{$question->practice->name}}</p>
                                            <p>{{$question->practice->degree}}</p>
                                        </div>
                                        <p class="text-center">
                                            {{--                        {{__('equation')}} : --}}
                                            {{$question->readable_equation}}
                                        </p>
                                        <div class="d-flex justify-content-between">

                                            <p class="text-center">
                                                {{$question->result($userInputsArr)}}
                                                <br>
                                                {{__('question result')}}
                                            </p>
                                            <br>
                                            <p class="text-center">
                                                {{$question->answer?->degree}}
                                                <br>
                                                {{__('degree')}}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <h1 class="text-center text-danger my-20"> برجاء ملء المدخلات اولا</h1>
            @endif

        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                <x-form action="{{ route('user.financial.inputs.update') }}" method="put" submit-text="حفظ">
                    <div class="row">
                        @foreach($financial_inputs->groupBy('type') as $type => $financial_input2)
                            <fieldset class="mt-4 text-danger">
                                <legend>{{$type}}</legend>
                                <div class="row">

                                    @foreach($financial_input2 as $financial_input)
                                        @php
                                            $current_input=$user_financial_inputs->firstWhere('financial_input_id', $financial_input->id);
                                            $old=old('financial_inputs.'.$financial_input->id);
                                            $val=$old?$old:($current_input?$current_input->financial_value:0);
                                        @endphp

                                        <div class="col-6 col-md-6">
                                            <x-form.input
                                                errorname="financial_inputs.{{$financial_input->id}}"
                                                type="number"
                                                required
                                                step="0.1"
                                                value="{{$val}}"
                                                min="0" name="financial_inputs[{{$financial_input->id}}]"
                                                label="{{$financial_input->label }}"/>
                                        </div>
                                    @endforeach
                                </div>
                            </fieldset>
                        @endforeach
                        <hr>
                        <div class="col-6 col-md-6">

                            <x-form.select required id="e1" name="reservation_type" label="{{__('reservations type')}}"
                                           placeholder="Choose">
                                <option value="">Choose</option>
                                @foreach(\App\Models\FinancialAppraisalUser::getReviewsTypes() as $key => $opinion)
                                    <option
                                        {{  old('reservation_type', $appraisal->reservation_type)==$opinion?'selected':''}} value="{{$opinion}}">{{__($opinion)}}</option>
                                @endforeach
                            </x-form.select>
                        </div>

                        <div class="col-6 col-md-6">

                            <x-form.input
                                type="number"
                                id="e2"
                                value="{{old('reservations_count', $appraisal->reservations_count)}}"
                                min="0" name="reservations_count"
                                label="{{__('reservations count')}}"/>
                        </div>
                        <div class="col-6 col-md-6">

                            <x-form.select required id="f1" name="duration_type"
                                           label="{{__('duration type')}}" placeholder="">
                                <option value="">Choose</option>
                                @foreach(\App\Models\FinancialAppraisalUser::getAppraisalTypes() as  $type)
                                    <option
                                        {{ old('duration_type', $appraisal->duration_type)==$type?'selected':''}} value="{{$type}}">{{__($type)}}</option>
                                @endforeach
                            </x-form.select>
                        </div>

                    </div>
                </x-form>

        </div>
    </div>

    @push('script')
        <script>

            $(function () {
                e1 = $("#e1")
                e2 = $("#e2")
                e1.change(function () {
                    e2.parent().hide()
                    e2.val()
                    if (e1.val() == 'have reservations') {
                        e2.parent().show()
                    } else {
                        e2.val(0)
                    }
                })
                e1.trigger('change')
                e2.val("{{old('reservations_count', $appraisal->reservations_count)}}")
            })
        </script>
        @if(request()->open=='inputs')
            <script>
                $("#profile-tab").trigger('click')
            </script>
        @endif
    @endpush
</x-panel>

