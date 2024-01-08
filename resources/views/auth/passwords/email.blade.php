@extends('front.layout.master')

@section('content')

    <div class="w-full p-2 py-6 md:px-10 lg:px-20 mx-auto mt-[7rem] lg:grid lg:grid-cols-2 lg:gap-3">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <x-form action="{{ route('password.email') }}" class="w-100 md:pt-20">

            @csrf

            <div class="row mb-3">
                <x-tailwind.form-input name="email" wire-modifier=".defer"
                                       label="البريد الالكتروني"></x-tailwind.form-input>


            </div>
            <x-slot name="submitBtn">
                <div class="text-center">
                    <!--begin::Submit button-->
                    <x-button type="submit" class="w-100 mb-5 btn btn-primary">ارسال رابط اعادة تعيين كلمة المرور
                    </x-button>
                    <!--end::Submit button-->
                </div>
            </x-slot>
            <a class="text-color_2 my-2" href="{{route('login')}}">تسجيل الدخول</a>

                        <x-slot name="submitBtn">
                            <div class="text-center">
                                <!--begin::Submit button-->
                                <x-button type="submit" class="w-100 mb-5 btn btn-primary"> ارسال رابط اعادة تعيين كلمة المرور
                                </x-button>
                                <!--end::Submit button-->
                            </div>
                        </x-slot>
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
