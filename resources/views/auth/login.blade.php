@extends('front.layout.master')

@section('content')
    <!--begin::Signin Form-->
    <div class="w-full p-2 py-6 md:px-10 lg:px-20 mx-auto mt-[4rem] lg:grid lg:grid-cols-2 lg:gap-3">

        <x-form action="{{ route('login') }}" class="w-100 md:pt-16">
            <!--begin::Heading-->
            <div class="text-center mb-10">
                <!--begin::Link-->
                <div class="text-gray-400 fw-bold fs-4">
                    اذا لم يكن لديك حساب يمكنك
                    <a href="{{ theme()->getPageUrl('register') }}" class="font-bold text-color_2">
                        انشاء حساب جديد
                    </a>
                </div>
                <!--end::Link-->
            </div>

            @if (Session::has('message'))
                <p class='text-danger'> {{ Session::get('message') }} </p>
            @endif
            <!--begin::Heading-->
            <div class="fv-row">
                <x-tailwind.form-input name="email" wire-modifier=".defer" label="البريد الالكتروني"></x-tailwind.form-input>
                <x-tailwind.form-input type="password" name="password" wire-modifier=".defer" label="كلمة المرور"></x-tailwind.form-input>
                <div class="inline">
                    <x-tailwind.form-checkbox display="inline-block" class="inline" wire-modifier=".defer"  name="remember" label="تذكرني"/>
                </div>



            </div>
            <!--begin::Actions-->
            <x-slot name="submitBtn">
                <div class="text-center">
                    <!--begin::Submit button-->
                    <x-button type="submit" class="w-100 mb-5 btn btn-primary"> تسجيل الدخول</x-button>
                    <!--end::Submit button-->
                </div>
            </x-slot>
            <!--end::Actions-->
            <a class="text-color_2 my-2" href="{{route('password.request')}}"> نسيت كلمة المرور؟</a>
        </x-form>
        <div class="flex self-center">
            <div>
                <img class="w-3/4 block m-auto align-middle" src="{{asset('images/front/login.jpg')}}" alt="">
            </div>
        </div>

    </div>
@endsection
@section('scripts')
@endsection

