<div style="background:#F5F8FA">
    <div class="row gx-5 p-5 text-center">
        <div class="col-md-3 col-lg-3">
            <div class="card h-100">
                <div class="card-body p-9">

                    <div class="fs-4x fw-bolder"> {{ optional($review_standard)->answers_sum_degree ?? 0 }} </div>
                    <div class="fs-4 fw-bold text-gray-400 mb-7"> الدرجه </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="card h-100">
                <div class="card-body p-9">
                    <div class="fs-4x fw-bolder">  {{ $review_standard->questions_count }}  </div>
                    <div class="fs-4 fw-bold text-gray-400 mb-7"> اجمالى اسئله المعيار </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="card h-100">
                <div class="card-body p-9">
                    <div class="fs-4x fw-bolder">  {{  $review_standard->answers_count  }}  </div>
                    <div class="fs-4 fw-bold text-gray-400 mb-7"> عدد الاسئله المجابه </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="card h-100">
                <div class="card-body p-9">
                    <div class="fs-4x fw-bolder">  {{ $review_standard->total_standard_questions - $review_standard->answers_count }}  </div>
                    <div class="fs-4 fw-bold text-gray-400 mb-7" >
                        <a  wire:click='goToFirstUnanswerdQuestion()' href="#!">
                            عدد الاسئله غير المجابه

                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
