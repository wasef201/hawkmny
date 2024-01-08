<x-panel title="{{ $standard->name }}">

    <ul class="nav nav-tabs row mb-8" id="myTab" role="tablist">
        <li class="nav-item col-sm-6" role="presentation">
            <button class="nav-link active w-100 fs-4" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                    type="button" role="tab" aria-controls="home" aria-selected="true">
                {{__('questions')}}
            </button>
        </li>
        <li class="nav-item col-sm-6" role="presentation">
            <button class="nav-link w-100 fs-4" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                    type="button" role="tab" onclick="window.livewire.emit('updateReport')" aria-controls="profile" aria-selected="false">
                {{__('report')}}
            </button>
        </li>

    </ul>

    <div class="tab-content my-4" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            <livewire:questions.review-statistics  :standard="$standard" :review="$review"/>
            <br>
            <x-card>

                <livewire:questions.questions-review :standard="$standard" :review="$review"/>

            </x-card>
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

            <livewire:questions.review-report questionType="choical" :standard="$standard" :review="$review" />

        </div>
    </div>
</x-panel>
