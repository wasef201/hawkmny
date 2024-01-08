@extends('front.layout.master')
@section('content')
    <div class="w-full p-2 py-6 md:px-10 lg:px-20 mx-auto mt-[4rem] lg:grid lg:grid-cols-2 lg:gap-3">

        <x-form action="{{ route('register') }}" enctype="multipart/form-data" class="w-100 md:pt-16">
            @csrf
            <div class="text-center mb-2">
                <h1 class="text-color_1 mb-3">
                    تسجيل حساب جديد
                </h1>
                <div class="text-gray-400 fw-bold fs-4">
                    هل لديك حساب؟
                    <a href="{{ theme()->getPageUrl('login') }}" class="font-bold text-color_2">
                        تسجيل الدخول
                    </a>
                </div>
            </div>
            <div class="lg:grid lg:grid-cols-2 lg:gap-2">
                <x-tailwind.form-input label="اسم الجهة" name="name" required></x-tailwind.form-input>
                <x-tailwind.form-input label="الجوال" name="phone" required></x-tailwind.form-input>
                <x-tailwind.form-select nothing-selected :options="collect($sections)" name="section" label="التخصص"
                                        required></x-tailwind.form-select>

                <x-tailwind.form-select select2 nothing-selected :options="($areas->pluck('name', 'id'))" name="area"
                                        label="المنطقة" required></x-tailwind.form-select>


                <x-tailwind.form-select select2 nothing-selected :options="collect([])" name="city" label="المدينة"
                                        required></x-tailwind.form-select>

                <x-tailwind.form-input col="col-12" name="email" type="email" label="البريد الالكتروني" required
                                       help="سوف يتم التحقق من البريد الالكتروني"/>

                <x-tailwind.form-input :classes="'col-span-full'" name="password" type="password" label="كلمة المرور"/>

                <x-tailwind.form-input col="col-12" name="logo" type="file" label="الشعار"/>
                <div>

                    <x-tailwind.form-input col="col-12" name="payment_receipt" required type="file" label="إيصال الدفع"/>
                    <small class="text-danger text-small text-red-600 fs-4">
                        لتفعيل الحساب يرجى تحويل مبلغ 100 ريال الى ايبان رقم:
                    <br/>
                        SA2605000068208070000000
                        بنك الإنماء
                    </small>
                </div>

                <div class="col-span-2">
                    <x-tailwind.form-checkbox display="inline-block" class="col-span-2" name="term">
                        <x-slot name="label">
                            اوافق علي <a href="#" class="ms-1 text-color_2">سياسة الخصوصية والشروط والاحكام</a>.
                        </x-slot>
                    </x-tailwind.form-checkbox>
                </div>
            </div>

            <x-slot name="submitBtn">
                <div class="text-center">
                     <x-button type="submit" class="w-100 mb-5  btn btn-primary"> تسجيل حساب جديد</x-button>
                 </div>
            </x-slot>
         </x-form>

         @push('scripts')
            <script>
                const areaId = $('#area').find(':selected').attr('value');
                if (areaId) {
                    loadCities(areaId);
                }
                $("#area").on('select2:select', function (e) {
                    loadCities(e.params.data.id)
                });

                function loadCities(id) {
                    fetch("{{ route('api.cities' ) }}", {
                        method: "post",
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({area_id: id})
                    }).then(response => response.json())
                        .then(response => {
                            let data = $.map(response.data, function (obj) {
                                obj.text = obj.name; // replace pk with your identifier
                                return obj;
                            });
                            $("#city").html('').select2({data});
                        }).catch((error) => {
                        console.error('Error:', error);
                    });
                }
            </script>
        @endpush
        <div class="flex self-center">
            <div>
                <img class="w-3/4 block m-auto align-middle" src="{{asset('images/front/login.jpg')}}" alt="">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
