@php
    $prefix=\Request::route()->getName()=='front.home'?'':route('front.home');
@endphp

<nav id="header" class="fixed top-0 z-40 w-full text-white bg-white border-b border-b-gray-300 text-color_3">

    <div class="container flex flex-wrap items-center justify-between w-full p-1 mx-auto mt-0 lg:p-0">

        <div class="flex items-center pl-4">
            <a href="{{route('home')}}">

                <img class="max-w-[120px] md:max-w-[150px]" src="{{ asset('/images/logo.png') }}" alt="">
            </a>
        </div>

        <div class="block pl-4 lg:hidden">
            <button id="nav-toggle"
                    class="flex items-center px-3 py-2 text-black border border-gray-700 rounded appearance-none hover:text-gray-800 hover:border-teal-500 focus:outline-none">
                <svg width="20" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.8592 3.66197H1.83099C0.816901 3.66197 0 2.84507 0 1.83099C0 0.816901 0.816901 0 1.83099 0H19.8592C20.8732 0 21.6901 0.816901 21.6901 1.83099C21.6901 2.84507 20.8732 3.66197 19.8592 3.66197ZM21.6901 10C21.6901 8.98592 20.8732 8.16901 19.8592 8.16901H1.83099C0.816901 8.16901 0 8.98592 0 10C0 11.0141 0.816901 11.831 1.83099 11.831H19.8592C20.8732 11.831 21.6901 11.0141 21.6901 10ZM21.6901 18.169C21.6901 17.1549 20.8732 16.338 19.8592 16.338H1.83099C0.816901 16.338 0 17.1549 0 18.169C0 19.1831 0.816901 20 1.83099 20H19.8592C20.8732 20 21.6901 19.1831 21.6901 18.169Z" fill="#331F52"/>
                </svg>

            </button>
        </div>

        <div
            class="z-[40] flex-grow hidden w-full p-4 mt-2  bg-white lg:flex lg:items-center lg:w-auto lg:block lg:mt-0 lg:bg-transparent lg:p-0"
            id="nav-content">
            <ul class="items-center flex-grow justify-center lg:justify-start  font-bold text-color_3  lg:flex">
                <li class="nav-item  scroll">
                    <a class="scroll active" href="{{$prefix}}#home">
                        {{__('front.home')}}
                    </a>
                </li>
                <li class="nav-item  ">
                    <a class="scroll" href="{{$prefix}}#who_us" c>
                        {{__('front.who_us')}}
                    </a>
                </li>
                <li class="nav-item  ">
                    <a class="scroll" href="{{$prefix}}#haokmny_advantages">
                        {{__('front.haokmny_advantages')}}
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="scroll" href="{{$prefix}}#success_partners">
                        {{__('front.success_partners')}}
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="scroll" href="{{$prefix}}#how_to_subscribe">
                        {{__('front.how_to_subscribe')}}
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="scroll" href="{{$prefix}}#contact_us">
                        {{__('front.contact_us')}}
                    </a>
                </li>

            </ul>

            <ul class="items-center justify-end  lg:flex">
                <li class="flex mx-3">
                    <img class="mx-1" src="{{asset('images/front/saudi-flag.png')}}" alt="">
                    <a href="tel: {{general_setting()->site_phone}}" class="mx-1 flex">
                        <img class="mx-1" src="{{asset('images/front/call.svg')}}" alt="">
                        {{general_setting()->site_phone}}
                    </a>
                </li>
                <li>

                    <a href="{{route('home')}}" class="btn ">
                        <span class="text-white">
                            {{auth()->check() ? __('lang.dashboard') : __('front.login')}}
                        </span>
                    </a>
                </li>


            </ul>


        </div>
        <div
            class="z-[40] w-full p-4 mt-2  bg-white hidden lg:hidden"
            id="nav-content-2">
            <div class="flex justify-center">
            <ul class="items-center flex-col justify-center align-items-center grid grid-cols-1 text-center">
                <li class="my-1 min-w-[150px] ">
                    <a class="scroll   " href="{{$prefix}}#home">
                        {{__('front.home')}}
                    </a>
                </li>
                <li class="my-1 min-w-[150px]  ">
                    <a class="scroll   " href="{{$prefix}}#who_us" >
                        {{__('front.who_us')}}
                    </a>
                </li>
                <li class="my-1 min-w-[150px]  ">
                    <a class="scroll   " href="{{$prefix}}#haokmny_advantages">
                        {{__('front.haokmny_advantages')}}
                    </a>
                </li>
                <li class="my-1 min-w-[150px] ">
                    <a class="scroll   " href="{{$prefix}}#success_partners">
                        {{__('front.success_partners')}}
                    </a>
                </li>
                <li class="my-1 min-w-[150px] ">
                    <a class="scroll   " href="{{$prefix}}#how_to_subscribe">
                        {{__('front.how_to_subscribe')}}
                    </a>
                </li>
                <li class="my-1 min-w-[150px] ">
                    <a class="scroll   " href="{{$prefix}}#contact_us">
                        {{__('front.contact_us')}}
                    </a>
                </li>
                <li class="my-1">
                    <a href="{{route('home')}}" class="">
                       <span class="text-color_1 text-[1rem]">
                           {{auth()->check() ? __('lang.dashboard') : __('front.login')}}
                       </span>
                    </a>
                </li>
            </ul>
            </div>
        </div>

    </div>

</nav>
