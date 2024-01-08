<x-panel title="الملف الشخصي / تعديل ">
    <div class="row">
        <div class="col-12 col-md-8">
            <x-form action="{{ route('profile.update') }}" submit-text="حفظ تعديل البيانات" method="PUT" enctype="multipart/form-data" >
                <div class="row">
                    <b>بياناتي</b>
                    <x-form.input value="{{ $user->name }}" col="col-12 col-md-6" name="name" label="الاسم" required />
                        <x-form.select select2="" col="col-12 col-md-6" name="section" label="التخصص">
                                @foreach($sections as $id=>$label)

                                <option @if((int) old('section', $user->section) === $id) selected @endif value="{{ $id }}">{{ $label }}</option>
                                @endforeach
                            </x-form.select>

                            <x-form.select select2="" col="col-12 col-md-6" name="area" label="المنطقة" required>
                            @foreach($areas as $area)
                            <option @if((int) old('area', $user->area_id) === $area->id) selected @endif  value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                            </x-form.select>
                            <x-form.select select2="" col="col-12 col-md-6" name="city" label="المدينة" required/>
                            <x-form.input name="phone" value="{{ $user->phone }}" type="tel" col="col-12 col-md-6" label="رقم الجوال"/>
                            <x-form.input name="number" value="{{ $user->number }}" type="tel" col="col-12 col-md-6" label="رقم الترخيص"/>
                            <x-form.input col="col-12" name="email" value="{{ $user->email }}" type="email" label="البريد الالكتروني" required />

                            @if ($user->type == App\Models\User::ASSOCIATION)
                            <x-form.input col="col-12" name="logo"  type="file" label=" شعار الجمعيه" />

                            <div>
                            <span class="label label-default">
                            شعار الجمعيه الحالى
                            </span>
                            <img class='img-thumbnail' src="{{ url('storage/associations/'.$user->logo) }}" alt="">
                            </div>
                            @endif


                            </div>
                            </x-form>
                            </div>
                            <div class="col-12 col-md-4">
                            <x-form action="{{ route('profile.change-password') }}" method="PUT">
                            <x-form.input.password col="col-12" name="password" label="كلمة المرور"  required/>
                            <x-form.input.password col="col-12" name="password_confirmation" label="تأكيد كلمة المرور"  required/>
                            </x-form>
                            </div>
                            </div>
                            @push('script')
                            <script>
                            const areaId = $('#area').find(':selected').attr('value');
                            if(areaId) {
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
                                    $("#city").html('').select2({data}).val({{ $user->city_id }}).trigger('change');
                                }).catch((error) => {
                                    console.error('Error:', error);
                                });
                            }
                            </script>
                            @endpush
                            </x-panel>
