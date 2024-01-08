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
                                <span style='font-size: 20px;'>  {{ number_format($currentPractice['practice_weight'],1) }} </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 py-10">

            <h1 class="py-3 m-4 fs-1 text-center">
                {{ $currentPractice['field'] }}
            </h1>
            <h2 class="py-3 m-4 fs-1 text-center">
                {{ $currentPractice['practice'] }}
            </h2>
            <p class="py-3 m-4 fs-1 text-center">{{ $currentPractice['equation'] }}   </p>
            <p class="py-3 m-4 fs-1 text-center">
                النتيجة:
                {{ number_format($currentPractice['result'], 2) }}
            </p>
            <p class="py-3 m-4 fs-1 text-center">
                الدرجة:
                {{ number_format($currentPractice['degree'], 2) }}   </p>
            <div class="row">

            </div>
        </div>




        @if(count($this->questions) - $this->getIndex() === 1)
            <div class="p-3">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">@lang('Well done!')</h4>
                    <p>@lang('You have completed this standard') @lang('You start another standard') <a
                            href="{{route('standard.index')}}">@lang('From here').</a></p>
                </div>
            </div>
        @endif
        <div class="col-12 py-10 text-center">
            <span
                @if((count($this->questions) - $this->getIndex()) === 1) title="@lang('You have completed this standard')" @endif>
            <x-button wire:click="prev()" class="btn-warning px-10 {{ $this->getIndex() === 0 ? 'disabled' : '' }}"
                      type="button">السابق</x-button>
            <span class="w-30px d-inline-block"></span>
            <x-button wire:click="next()"

                      class="px-10 bg-theme-color
            {{ (count($this->questions) - $this->getIndex()) === 1 ? 'disabled' : '' }}"
                      type="button">
            @lang('Next')
            </x-button>
            </span>


        </div>

    </div>
    <div wire:loading.flex class="overlay-layer card-rounded bg-dark bg-opacity-0">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

</div>



