<x-panel  title="الجمعيات - {{ $association->name }} " >

    <div class="content flex-row-fluid" id="kt_content">
        <!--begin::Navbar-->
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                    <!--begin: Pic-->
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                          @if($association->logo)
                                <img src="{{ $association->logoUrl() }}" alt="image" />
                            @else
                                <div class="symbol-label fs-3 bg-light-success text-success">{{ mb_substr($association->name, 0, 1, 'utf8') }}</div>
                          @endif
                        </div>
                 </div>
                 <!--end::Pic-->
                 <!--begin::Info-->
                 <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ $association->name }}</a>
                            </div>
                            <!--end::Name-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black" />
                                            <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black" />
                                        </svg>
                                    </span>
                                    {{ $association->sectionText }}
                                </a>
                                <a href="https://wa.me/966{{ $association->phone }}" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="black" />
                                            <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    {{ $association->phone }}
                                </a>
                                    <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="black" />
                                                <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="black" />
                                            </svg>
                                        </span>
                                        {{ $association->email }}
                                    </a>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::User-->
                            <!--begin::Actions-->
                            @if($canEditOrDelete)
                            <div class="d-flex my-4">
                                <x-button.delete href="{{ route('association.destroy', $association) }}" class="btn-danger"> حذف</x-button.delete>
                                <a href="{{ route('association.edit' , ['association' => $association->id ] ) }}" class="btn btn-sm btn-warning me-2" >
                                    تعدييل
                                </a>

                                </div>
                            @endif
                            <!--begin::Menu-->

                            <!--end::Menu-->

                    </div>
                    <!--end::Title-->
                    <!--begin::Stats-->
                    <div class="d-flex flex-wrap flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap">
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                        <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                                                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{ $mo2sher_elhwkmah }}" data-kt-countup-prefix=" % ">0</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400"> مؤشر الحوكمة
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">

                                    <div class="d-flex align-items-center">

                                        <div class="fs-2 fw-bolder" > {{ optional(optional($last_review)->updated_at)->diffForHumans() ?? 0 }} </div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">
                                      اخر تحديث
                                  </div>
                                  <!--end::Label-->
                              </div>
                              <!--end::Stat-->
                              <!--begin::Stat-->
                              <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                    <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                                            <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{
                                        (($questions_count * optional(optional($last_review)->answers)->count()) ) / 100
                                    }}" data-kt-countup-prefix="%">0</div>
                                </div>
                                <!--end::Number-->
                                <!--begin::Label-->
                                <div class="fw-bold fs-6 text-gray-400"> نسبه الاجابه على الاسئله  </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Progress-->
                    <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                            <span class="fw-bold fs-6 text-gray-400"> نسبه اكمال اخر تقييم </span>
                            <span class="fw-bolder fs-6">{{ optional($last_review)->governance_meter() ?? 0 }} % </span>
                        </div>
                        <div class="h-5px mx-3 w-100 bg-light mb-3">
                            <div class="bg-success rounded h-5px" role="progressbar" style="width: {{ optional(optional($last_review)->standards)->avg('progress') ?? 0 }}%;" ></div>
                        </div>
                    </div>
                    <!--end::Progress-->
                </div>
                <!--end::Stats-->
            </div>
            <!--end::Info-->
        </div>
        <!--end::Details-->
        <div class="card card-flush h-xxl-100">

            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Nav-->
                <ul class="nav nav-pills nav-pills-custom row position-relative mx-0 mb-9">
                    <!--begin::Item-->
                    <li class="nav-item col-4 mx-0 p-0">
                        <!--begin::Link-->
                        <a class="nav-link active d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#comments">
                            <!--begin::Subtitle-->
                            <span class="nav-text text-gray-800 fw-bolder fs-6 mb-3">  عن الجمعيه </span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item col-4 mx-0 px-0">
                        <!--begin::Link-->
                        <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#reviews">
                            <!--begin::Subtitle-->
                            <span class="nav-text text-gray-800 fw-bolder fs-6 mb-3"> التقييمات </span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item col-4 mx-0 px-0">
                        <!--begin::Link-->
                        <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#financial">
                            <!--begin::Subtitle-->
                            <span class="nav-text text-gray-800 fw-bolder fs-6 mb-3"> المعيار المالي </span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->


                </ul>
                <!--end::Nav-->
                <!--begin::Tab Content-->
                <div class="tab-content">
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade show active" id="comments">


                        <div class="card-body" id="kt_chat_messenger_body">

                            <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" >
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted"> الاسم </label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800">{{ $association->name }}</span>
                                    </div>
                                </div>

                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted"> رقم الترخيص </label>
                                    <div class="col-lg-8 fv-row">
                                        <span class="fw-bold text-gray-800 fs-6">{{ $association->number }}</span>
                                    </div>
                                </div>

                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted"> رقم الجوال
                                    </label>
                                    <div class="col-lg-8 d-flex align-items-center">
                                        <span class="fw-bolder fs-6 text-gray-800 me-2"> {{ $association->phone }} </span>
                                    </div>
                                </div>

                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted"> البريد الاكتورنى </label>
                                    <div class="col-lg-8">
                                        <a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary">{{ $association->email }}</a>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted"> المنطقه
                                    </label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800"> {{ optional($association->area)->name }} </span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted"> المدنيه
                                    </label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800"> {{ optional($association->city)->name }} </span>
                                    </div>
                                </div>

                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-bold text-muted"> التخصص </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800"> {{ $association->section_text }} </span>
                                    </div>
                                    <!--end::Col-->
                                </div>

                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold text-muted"> إيصال الدفع </label>
                                    <div class="col-lg-8">
                                        <a class="fw-bolder fs-6  " target="_blank" href=" {{ $association->payment_url    }} "> تحميل ايصال الدفع</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="reviews">
                        @include('pages.association.inc.reviews')
                    </div>
                    <div class="tab-pane fade" id="financial">
                        @include('pages.financial.show')
                    </div>
            <!--end::Tap pane-->

        </div>
        <!--end::Tab Content-->
    </div>
    <!--end: Card Body-->
</div>
</div>
</div>
<!--end::Navbar-->


</div>
</x-panel>
