<x-panel title="الجمعيات / اضافة جمعية">
    <x-form action="{{ route('association.store') }}" submit-text="اضافة الجمعية" enctype="multipart/form-data" >
        <div class="row">
            <x-form.input col="col-12 col-md-6" name="name" label="الاسم" required />
            <x-form.select select2="" col="col-12 col-md-6" name="section" label="التخصص" required>
                @foreach($sections as $id=>$label)
                    <option @if((int) old('section') === $id) selected @endif value="{{ $id }}">{{ $label }}</option>
                @endforeach
            </x-form.select>
            <x-form.select select2="" col="col-12 col-md-6" name="area" label="المنطقة" required>
                @foreach($areas as $area)
                    <option @if((int) old('area') === $area->id) selected @endif  value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </x-form.select>
            <x-form.select select2="" col="col-12 col-md-6" name="city" label="المدينة" required/>
            <x-form.input name="phone" type="tel" col="col-12 col-md-6" label="رقم الجوال"/>
            <x-form.input name="number" type="tel" col="col-12 col-md-6" label="رقم الترخيص" required />
            <x-form.input col="col-12" name="email" type="email" label="البريد الالكتروني" required />
            <x-form.input.password col="col-12" name="password" label="كلمة المرور"  required/>
            <x-form.input col="col-12" type='file' name="logo" label="شعار الجمعيه"  />

        </div>
    </x-form>
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
                        $("#city").html('').select2({data});
                    }).catch((error) => {
                    console.error('Error:', error);
                });
            }
        </script>
    @endpush
</x-panel>
