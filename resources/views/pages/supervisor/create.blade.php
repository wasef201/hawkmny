<x-panel title="المشرفين / اضافة مشرف">
    <x-form action="{{ route('supervisor.store') }}" submit-text="اضافة المشرف">
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
            <x-form.input name="phone" type="tel" col="col-12 col-md-4" label="رقم الجوال"/>
            <x-form.input col="col-12 col-md-4" name="email" type="email" label="البريد الالكتروني" required />
            <x-form.input.password col="col-12 col-md-4" name="password" label="كلمة المرور"  required/>
            <div class="col-12 form-group">
                <x-form.input.label label="نطاق الاشراف" required id=""/>
            <div class="row">
                @foreach($scopes as $scope => $title)
                    <x-form.option col="col-md-4" name="scope" id="scope_{{ $scope }}" :checked="$loop->first" :title="$title" :value="$scope" />
                @endforeach
            </div>
            </div>
            <div id="associations-wrap">
            <x-form.select name="associations[]" id="associations" label="الجمعيات" multiple>
                @foreach($associations as $association)
                    <option value="{{ $association->id }}">{{ $association->name }}</option>
                @endforeach
            </x-form.select>
            </div>
        </div>
    </x-form>
    @push('script')
        <script>
            $("#associations-wrap").hide()
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
            $("input[name='scope']").change(function (){
                const val = $("input[name='scope']:checked").val();
                if(val === '{{ \App\Models\User::SCOPE_LIMIT }}') {
                    $("#associations-wrap").show();
                    $("#associations").select2();
                } else {
                    $("#associations-wrap").hide();
                    $("#associations").select2('destroy');
                }
            });
        </script>
    @endpush
</x-panel>
