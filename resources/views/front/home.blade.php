@extends('front.layout.master')
@section('styles')
@endsection
@section('content')
    <div>
        <div id="home" class="w-full p-2 md:p-10 mx-auto mt-20">
            <div>
                <!-- Carousel wrapper -->
                <div id="main-slider" class="owl-carousel owl-theme ">
                    <!-- Item 1 -->
                    @foreach($mainSliders as $slider)

                        <div class="item">

                            <img class="max-w-fit" src="{{$slider->image}}"

                                 alt="...">
                        </div>
                    @endforeach
                </div>
                <!-- Slider controls -->

            </div>
        </div>

        <!--Hero-->

        <section id="who_us" class="container p-2 md:p-10 mx-auto md:my-10">
            <div class="md:grid md:grid-cols-3">
                <div
                    class="min-h-[170px] sm:w-[80%] w-full flex justify-center place-items-center relative md:ml-10 bg-[#FCFCFC] mx-auto md:mr-0">

                    <img class="z-1 mx-auto md:mx-0 max-w-[120px]  " src="{{asset('images/logo.png')}}" alt="">

                    <x-icons.arrow2 class="  absolute top-5 right-5 "></x-icons.arrow2>
                    <x-icons.arrow2 class="  absolute top-5 left-5 rotate-[270deg]"></x-icons.arrow2>
                    <x-icons.arrow2 class="  absolute bottom-5 left-5 rotate-180"></x-icons.arrow2>
                    <x-icons.arrow2 class="  absolute bottom-5 right-5 rotate-90"></x-icons.arrow2>

                </div>
                <div class="col-span-2">
                    <h1 class="   text-start mt-4 md:mt-0 ">
                        <x-icons.haokmny-arrow class=" inline"></x-icons.haokmny-arrow>
                        من نحن
                        <x-icons.haokmny-arrow class=" inline"></x-icons.haokmny-arrow>
                    </h1>
                    <p class="text-center">{{general_setting()->who_us_description}}</p>
                </div>
            </div>

        </section>


        <section id="haokmny_advantages" class=" bg-color_1 text-white relative">

            <x-icons.arrow2 fill="none" color="white"
                            class="absolute md:top-10 top-0 md:right-10 right-0"></x-icons.arrow2>
            <x-icons.arrow2 fill="none" color="white"
                            class="absolute md:top-10 top-0 md:left-10 left-0 rotate-[270deg]"></x-icons.arrow2>

            <div class="mx-auto ">

                <div class="col-span-2 p-6">
                    <div class="mx-auto ">

                        <h1 class="     mx-auto text-center">
                            <x-icons.haokmny-arrow class="align-self-center inline"></x-icons.haokmny-arrow>
                            مميزات حوكمني
                            <x-icons.haokmny-arrow class="align-self-center inline"></x-icons.haokmny-arrow>
                        </h1>
                        <p class="max-w-[520px] text-center mx-auto my-6">
                            {{general_setting()->haokmny_advantages_description}}
                        </p>
                        <div class="grid gap-4 md:gap-8 md:grid-cols-2 lg:max-w-[800px] mx-auto my-8">
                            @foreach($advantages as $advantage)
                                <div class="px-3 py-6 bg-color_4 rounded">
                                    {{--                                <span class="rounded-full p-2 bg-color_3">--}}
                                    <img src="{{$advantage->image}}" alt="">
                                    {{--                                </span>--}}

                                    <h5>
                                        {{$advantage->title}}
                                    </h5>
                                    <p class="text-color_5 font-sm">
                                        {{$advantage->description}}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="associations" class="container my-4 md:my-15 p-2 md:p-10 mx-auto">
            <h1 class="     mx-auto text-center">
                <x-icons.haokmny-arrow class="align-self-center inline"></x-icons.haokmny-arrow>
                {{general_setting()->associations_title}}
                <x-icons.haokmny-arrow class="align-self-center inline"></x-icons.haokmny-arrow>
            </h1>
            <p class="lg:w-[600px] mx-auto text-center">
                {{general_setting()->associations_description}}
            </p>
            <div id="associations-slider" class="owl-carousel owl-theme">

                @foreach($associations as $association)

                    <div
                        class=" h-32 bg-[white] flex justify-center p-4 ">
                        <img class=" aspect-square w-unset" style="width: unset!important;" src="{{$association->logoUrl()}}" alt="">
                    </div>
                @endforeach
            </div>
        </section>


        <section id="how_to_subscribe" class="p-2 md:p-10 mx-auto bg-color_1 text-white relative">
            <x-icons.arrow2 fill="none" color="white"
                            class="absolute md:top-5 top-0 md:right-5 right-0 rotate-[180deg]"></x-icons.arrow2>
            <x-icons.arrow2 fill="none" color="white"
                            class="absolute md:top-5 top-0 md:left-5 left-0 rotate-[90deg]"></x-icons.arrow2>

            <h1 class="     mx-auto text-center">
                <x-icons.haokmny-arrow class="align-self-center inline"></x-icons.haokmny-arrow>
                {{__('front.how_to_subscribe')}}
                <x-icons.haokmny-arrow class="align-self-center inline"></x-icons.haokmny-arrow>
            </h1>
            <p class="lg:w-[600px] mx-auto text-center">
                {{general_setting()->how_subscribe_description}}
            </p>
            <div class="flex justify-center lg:mx-60 my-4">
                <img sizes="(max-width: 600px) 200px"
                     srcset="{{asset('images/front/img_1.png')}} 600w, {{asset('images/front/how-subscribe.png')}} 800w"
                     src="{{asset('images/front/how-subscribe.png')}}" alt="">
            </div>

            <div class="flex justify-center ">
                <a href="{{route('register')}}"
                   class="btn px-10 hover:bg-white hover:text-color_4">{{__('front.subscribe_now')}}</a>

            </div>

        </section>

        <section id="contact_us" class="container p-2 md:p-10 mx-auto">
            <h1 class="     mx-auto text-center">
                <x-icons.haokmny-arrow class="align-self-center inline"></x-icons.haokmny-arrow>
                {{__('front.contact_us')}}
                <x-icons.haokmny-arrow class="align-self-center inline"></x-icons.haokmny-arrow>
            </h1>
            <p class="lg:w-[600px] mx-auto text-center">
                {{general_setting()->contact_us_description}}
            </p>
            <div class="md:grid md:grid-cols-3 lg:px-[100px] mx-auto justify-center">
                <a href="tel: {{general_setting()->site_phone}}" class="flex justify-start md:justify-center my-1">
                    <svg width="45" height="45" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="35" cy="35" r="35" fill="#309561"/>
                        <path
                            d="M40.62 33.7501C40.19 33.7501 39.85 33.4001 39.85 32.9801C39.85 32.6101 39.48 31.8401 38.86 31.1701C38.25 30.5201 37.58 30.1401 37.02 30.1401C36.59 30.1401 36.25 29.7901 36.25 29.3701C36.25 28.9501 36.6 28.6001 37.02 28.6001C38.02 28.6001 39.07 29.1401 39.99 30.1101C40.85 31.0201 41.4 32.1501 41.4 32.9701C41.4 33.4001 41.05 33.7501 40.62 33.7501Z"
                            fill="white"/>
                        <path
                            d="M44.2298 33.75C43.7998 33.75 43.4598 33.4 43.4598 32.98C43.4598 29.43 40.5698 26.55 37.0298 26.55C36.5998 26.55 36.2598 26.2 36.2598 25.78C36.2598 25.36 36.5998 25 37.0198 25C41.4198 25 44.9998 28.58 44.9998 32.98C44.9998 33.4 44.6498 33.75 44.2298 33.75Z"
                            fill="white"/>
                        <path
                            d="M34.05 37.95L32.2 39.8C31.81 40.19 31.19 40.19 30.79 39.81C30.68 39.7 30.57 39.6 30.46 39.49C29.43 38.45 28.5 37.36 27.67 36.22C26.85 35.08 26.19 33.94 25.71 32.81C25.24 31.67 25 30.58 25 29.54C25 28.86 25.12 28.21 25.36 27.61C25.6 27 25.98 26.44 26.51 25.94C27.15 25.31 27.85 25 28.59 25C28.87 25 29.15 25.06 29.4 25.18C29.66 25.3 29.89 25.48 30.07 25.74L32.39 29.01C32.57 29.26 32.7 29.49 32.79 29.71C32.88 29.92 32.93 30.13 32.93 30.32C32.93 30.56 32.86 30.8 32.72 31.03C32.59 31.26 32.4 31.5 32.16 31.74L31.4 32.53C31.29 32.64 31.24 32.77 31.24 32.93C31.24 33.01 31.25 33.08 31.27 33.16C31.3 33.24 31.33 33.3 31.35 33.36C31.53 33.69 31.84 34.12 32.28 34.64C32.73 35.16 33.21 35.69 33.73 36.22C33.83 36.32 33.94 36.42 34.04 36.52C34.44 36.91 34.45 37.55 34.05 37.95Z"
                            fill="white"/>
                        <path
                            d="M44.9696 41.33C44.9696 41.61 44.9196 41.9 44.8196 42.18C44.7896 42.26 44.7596 42.34 44.7196 42.42C44.5496 42.78 44.3296 43.12 44.0396 43.44C43.5496 43.98 43.0096 44.37 42.3996 44.62C42.3896 44.62 42.3796 44.63 42.3696 44.63C41.7796 44.87 41.1396 45 40.4496 45C39.4296 45 38.3396 44.76 37.1896 44.27C36.0396 43.78 34.8896 43.12 33.7496 42.29C33.3596 42 32.9696 41.71 32.5996 41.4L35.8696 38.13C36.1496 38.34 36.3996 38.5 36.6096 38.61C36.6596 38.63 36.7196 38.66 36.7896 38.69C36.8696 38.72 36.9496 38.73 37.0396 38.73C37.2096 38.73 37.3396 38.67 37.4496 38.56L38.2096 37.81C38.4596 37.56 38.6996 37.37 38.9296 37.25C39.1596 37.11 39.3896 37.04 39.6396 37.04C39.8296 37.04 40.0296 37.08 40.2496 37.17C40.4696 37.26 40.6996 37.39 40.9496 37.56L44.2596 39.91C44.5196 40.09 44.6996 40.3 44.8096 40.55C44.9096 40.8 44.9696 41.05 44.9696 41.33Z"
                            fill="white"/>
                    </svg>
                    <span class="my-auto mx-1">{{general_setting()->site_phone}}</span>

                </a>
                <a href="mailto: {{general_setting()->site_email}}" class="flex justify-start md:justify-center my-1">

                    <svg width="45" height="45" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="35" cy="35" r="35" fill="#309561"/>
                        <path
                            d="M40 26.5H30C27 26.5 25 28 25 31.5V38.5C25 42 27 43.5 30 43.5H40C43 43.5 45 42 45 38.5V31.5C45 28 43 26.5 40 26.5ZM40.47 32.59L37.34 35.09C36.68 35.62 35.84 35.88 35 35.88C34.16 35.88 33.31 35.62 32.66 35.09L29.53 32.59C29.21 32.33 29.16 31.85 29.41 31.53C29.67 31.21 30.14 31.15 30.46 31.41L33.59 33.91C34.35 34.52 35.64 34.52 36.4 33.91L39.53 31.41C39.85 31.15 40.33 31.2 40.58 31.53C40.84 31.85 40.79 32.33 40.47 32.59Z"
                            fill="white"/>
                    </svg>
                    <span class="my-auto mx-1">{{general_setting()->site_email}}</span>
                </a>
                <a onclick="return false;" class="flex justify-start md:justify-center my-1">

                    <svg width="45" height="45" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="35" cy="35" r="35" fill="#309561"/>
                        <path
                            d="M43.6201 31.45C42.5701 26.83 38.5401 24.75 35.0001 24.75C35.0001 24.75 35.0001 24.75 34.9901 24.75C31.4601 24.75 27.4201 26.82 26.3701 31.44C25.2001 36.6 28.3601 40.97 31.2201 43.72C32.2801 44.74 33.6401 45.25 35.0001 45.25C36.3601 45.25 37.7201 44.74 38.7701 43.72C41.6301 40.97 44.7901 36.61 43.6201 31.45ZM35.0001 36.46C33.2601 36.46 31.8501 35.05 31.8501 33.31C31.8501 31.57 33.2601 30.16 35.0001 30.16C36.7401 30.16 38.1501 31.57 38.1501 33.31C38.1501 35.05 36.7401 36.46 35.0001 36.46Z"
                            fill="white"/>
                    </svg>
                    <span class="my-auto mx-1">{{general_setting()->site_location}}</span>
                </a>
            </div>
            <div class="grid lg:grid-cols-2">
                <div>
                    <livewire:front.contact-us-form></livewire:front.contact-us-form>
                </div>
                <div class="flex self-center">
                    <div>

                        <img class="" src="{{asset('images/front/contact-us.png')}}" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section id="success_partners" class="container my-4 md:my-15 p-2 md:p-10 mx-auto">
            <h1 class="     mx-auto text-center">
                <x-icons.haokmny-arrow class="align-self-center inline"></x-icons.haokmny-arrow>
                {{__('front.success_partners')}}
                <x-icons.haokmny-arrow class="align-self-center inline"></x-icons.haokmny-arrow>
            </h1>
            <p class="lg:w-[600px] mx-auto text-center">
                {{general_setting()->partners_description}}
            </p>
            <div id="partners" class="owl-carousel owl-theme">

                @foreach($partners as $partner)

                    <div
                        class=" h-32  bg-color_1 flex justify-center p-4 ">
                        <img class="w-unset" style="width: unset!important;" src="{{$partner->image}}" alt="">
                    </div>
                @endforeach
            </div>
        </section>

    </div>

    @push('scripts')
        <script>

            $(".scroll").click(function (e) {

                let id = $(e.target).attr('href')
                $("#nav-content-2").addClass('hidden')
                $('html, body').animate({

                    scrollTop: $(id).offset().top - 70
                }, 1000, (function () {

                    $(".nav-item a").removeClass('active')
                    $(`.nav-item a[href='${id}']`).addClass('active')
                }));
            });

            $(window).scroll(function (event) {
                var scroll = $(window).scrollTop();
                s = [
                    '#contact_us',
                    '#how_to_subscribe',
                    '#success_partners',
                    '#associations',
                    '#haokmny_advantages',
                    '#who_us',
                    '#home',
                ]
                for (i = 0; i < s.length; i++) {
                    ss = s[i]

                    if ($(ss).offset().top < scroll + 200) {
                        $(".nav-item a").removeClass('active')
                        $(`.nav-item a[href='${ss}']`).addClass('active')
                        break
                    }
                }
            });

        </script>

        <script></script>
    @endpush
@endsection
@section('scripts')
@endsection
