<div wire:loading.class="overlay overlay-block">
    <div class="row">
        <div class="col-12">
            <div class="d-flex flex-column w-90 me-2">
                <div class="row">
                    <div class="col-md-11 py-4">
                        <div class="progress h-6px w-100">
                            <div class="progress-bar bg-theme-color" role="progressbar"
                                 style=" width: {{ $this->progress }}%" aria-valuenow="{{ $this->progress }}"
                                 aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <a class="badge bg-theme-color fs-6 lh-1 py-1 d-flex flex-center" style="height: 45px">
                            <span style='line-height: 19px;'>
                                الدرجه  <br>
                                <span style='font-size: 20px;'>  {{ $currentQuestion->degree }} </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 py-10">
            <h1 class="py-10 m-4 fs-1 text-center">{{ $currentQuestion->name }} - {{ $currentQuestion->id }} </h1>
            <div class="row">
                @foreach($currentQuestion->choices as $choice)
                    <div wire:change="saveChoice('{{ $choice->id }}')" class="col-md-{{12/$currentQuestion->choices?->count()}}">
                        <x-form.option name="choice" id="choice_{{ $choice->id }}"
                                       :checked="(boolean)$review->answers->where('choice_id', $choice->id)->count()"
                                       :title="$choice->name" :value="$choice->id">
                            <x-slot name="icon">
                                <i class="las la-check-circle fs-3x"></i>
                            </x-slot>
                        </x-form.option>
                    </div>
                @endforeach

            </div>
        </div>
        @php
            $lastSubQuestion=null;
        @endphp
        @if ($this->question_have_childrens)
            @if ($this->show_question_childrens)
                @foreach ($currentQuestion->children as $child)
                    @php
                        $lastSubQuestion=$child;
                    @endphp
                    <div class="col-12 py-10">
                        <h1 class="py-10 m-4 fs-1 text-center"> {{ $child->name }} {{ $child->id }} </h1>
                        <div class="row">
                            @foreach($child->choices as $children_choice)
                                <div wire:change="saveChoice('{{ $children_choice->id }}')" class="col-md-{{12/$child->choices?->count()}}">
                                    <x-form.option name="choice_children" id="choice_{{ $children_choice->id }}"
                                                   :checked="(boolean)$review->answers->where('choice_id', $children_choice->id)->count()"
                                                   :title="$children_choice->name" :value="$children_choice->id">
                                        <x-slot name="icon">
                                            <i class="las la-check-circle fs-3x"></i>
                                        </x-slot>
                                    </x-form.option>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        @endif


        @if ($this->question_have_childrens )
            @if ($this->show_child_question_childrens)
                @foreach ($child->children as $subQuestion)
                    @php
                        $lastSubQuestion=$subQuestion;
                    @endphp
                    <div class="col-12 py-10">
                        <h1 class="py-10 m-4 fs-1 text-center"> {{ $subQuestion->name }} {{ $subQuestion->id }} </h1>
                        <div class="row">
                            @foreach($subQuestion->choices as $sub_children_choice)
                                <div wire:change="saveChoice('{{ $sub_children_choice->id }}')" class="col-ms-{{12/$subQuestion->choices->count()}}">
                                    <x-form.option name="sub_choice_children"
                                                   id="sub_choice_{{ $sub_children_choice->id }}"
                                                   :checked="(boolean)$review->answers->where('choice_id', $sub_children_choice->id)->count()"
                                                   :title="$sub_children_choice->name"
                                                   :value="$sub_children_choice->id">
                                        <x-slot name="icon">
                                            <i class="las la-check-circle fs-3x"></i>
                                        </x-slot>
                                    </x-form.option>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        @endif



        @if($this->questions->count() - $this->getIndex() === 1)
            <div class="p-3">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">@lang('Well done!')</h4>
                    <p>@lang('You have completed this standard') @lang('You start another standard') <a
                            href="{{route('standard.index')}}">@lang('From here').</a></p>
                </div>
            </div>
        @endif
        @if($currentQuestion->question_type!="financial_equation")
            @if($review->answers()->firstWhere('question_id', ($lastSubQuestion??$currentQuestion)->id))
                <div class="col-12 py-10 text-center">

                    <h2>الدرجة
                        : {{$review->answers()->firstWhere('question_id', ($lastSubQuestion??$currentQuestion)->id)->degree??''}}</h2>
                </div>
            @endif
        @endif

        <div class="col-12 py-10 text-center">
            <span
                @if(($this->questions->count() - $this->getIndex()) === 1) title="@lang('You have completed this standard')" @endif>
            <x-button wire:click="prev()" color="warning"
                      class="btn-warning px-10 {{ $this->getIndex() === 0 ? 'disabled' : '' }}"
                      type="button">السابق</x-button>
            <span class="w-30px d-inline-block"></span>
            <x-button wire:click="next()"

                      class="px-10 bg-theme-color
            {{ ($this->questions->count() - $this->getIndex()) === 1 ? 'disabled' : '' }}"
                      type="button">
            @lang('Next')
            </x-button>
            </span>
            @php
                    $verficationQuestion=($lastSubQuestion?->verifications()?->count())?$lastSubQuestion:$currentQuestion;
            @endphp
            @if($lastSubQuestion?->question_type!='financial_equation')
                @livewire('questions.question-verfication' , ['question' => $verficationQuestion , 'review' => $this->review  ] , key(Str::random(40)) )
            @endif

        </div>

    </div>
    <div wire:loading.flex class="overlay-layer card-rounded bg-dark bg-opacity-0">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    @livewire('questions.question-comment' , ['question' => $currentQuestion  , 'review' => $this->review],  key($currentQuestion->id)  )

</div>



