<x-panel title="الجمعيات / تعديل {{ $association->name }}">
    <div class="row">
        <div class="col-12 col-md-8">
            <x-form action="{{ route('association.update', $association) }}" submit-text="حفظ تعديل البيانات"
                    method="PUT" enctype="multipart/form-data">
                <div class="row">
                    <b>بيانات الجمعية</b>
                    <x-form.input value="{{ $association->name }}" col="col-12 col-md-6" name="name" label="الاسم"
                                  required/>
                    <x-form.select select2="" col="col-12 col-md-6" name="section" label="التخصص" required>
                        @foreach($sections as $id=>$label)
                            <option @if((int) old('section', $association->section) === $id) selected
                                    @endif value="{{ $id }}">{{ $label }}</option>
                        @endforeach
                    </x-form.select>
                    <x-form.select select2="" col="col-12 col-md-6" name="area" label="المنطقة" required>
                        @foreach($areas as $area)
                            <option @if((int) old('area', $association->area_id) === $area->id) selected
                                    @endif  value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </x-form.select>
                    <x-form.select select2="" col="col-12 col-md-6" name="city" label="المدينة" required/>
                    <x-form.input name="phone" value="{{ $association->phone }}" type="tel" col="col-12 col-md-6"
                                  label="رقم الجوال"/>
                    <x-form.input name="number" value="{{ $association->number }}" type="tel" col="col-12 col-md-6"
                                  label="رقم الترخيص"/>
                    <x-form.input col="col-12" name="email" value="{{ $association->email }}" type="email"
                                  label="البريد الالكتروني" required/>
                    <x-form.input name="logo" type="file" col="col-12 " label="شعار الجمعيه"/>
                    <div class="my-3">

                        <x-form.input.check-box :checked="$association->featured" name="featured" class="my-6 mt-4" label="اظهار علي الويب سايت">

                        </x-form.input.check-box>
                    </div>

                @if($association->logo)
                        <div class="my-2 col-12">
                            <label class="form-label fs-6 fw-bolder text-dark  required " for="logo"> الشعر الحالى
                                للجمعيه </label>
                            <img class='img-thumbnail' src="{{ $association->logoUrl() }}" alt="">
                        </div>
                    @endif
                </div>
            </x-form>
        </div>
        <div class="col-12 col-md-4">
            <x-form action="{{ route('association.change-password', $association) }}" method="PUT">
                <x-form.input.password col="col-12" name="password" label="كلمة المرور" required/>
                <x-form.input.password col="col-12" name="password_confirmation" label="تأكيد كلمة المرور" required/>
            </x-form>
        </div>
    </div>
    @push('script')
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
                        $("#city").html('').select2({data}).val({{ $association->city_id }}).trigger('change');
                    }).catch((error) => {
                    console.error('Error:', error);
                });
            }
        </script>
    @endpush
</x-panel>
