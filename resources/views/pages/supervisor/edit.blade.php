<x-panel title="المشرفين / تعديل / {{ $supervisor->name }}">
    <div class="row">
        <div class="col-12 col-md-8">
            <x-form action="{{ route('supervisor.update', $supervisor) }}" submit-text="حفظ تعديل البيانات" method="PUT">
                <div class="row">
                    <b>بيانات المشرف</b>
                    <x-form.input value="{{ $supervisor->name }}" col="col-12 col-md-6" name="name" label="الاسم" required />
                    <x-form.select select2="" col="col-12 col-md-6" name="section" label="التخصص" required>
                        @foreach($sections as $id=>$label)
                            <option @if((int) old('section', $supervisor->section) === $id) selected @endif value="{{ $id }}">{{ $label }}</option>
                        @endforeach
                    </x-form.select>
                    <x-form.select select2="" col="col-12 col-md-6" name="area" label="المنطقة" required>
                        @foreach($areas as $area)
                            <option @if((int) old('area', $supervisor->area_id) === $area->id) selected @endif  value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </x-form.select>
                    <x-form.select select2="" col="col-12 col-md-6" name="city" label="المدينة" required/>
                    <x-form.input name="phone" value="{{ $supervisor->phone }}" type="tel" col="col-12 col-md-6" label="رقم الجوال"/>
                    <x-form.input col="col-12 col-md-6" name="email" type="email" value="{{ $supervisor->email }}" label="البريد الالكتروني" required />
                    <div class="col-12 form-group">
                        <x-form.input.label label="نطاق الاشراف" required id=""/>
                        <div class="row">
                            @foreach($scopes as $scope => $title)
                                <x-form.option col="col-md-4" name="scope" id="scope_{{ $scope }}" :checked="$supervisor->scope === $scope" :title="$title" :value="$scope" />
                            @endforeach
                        </div>
                    </div>
                    <div id="associations-wrap">
                        <x-form.select select2 name="associations[]" id="associations" label="الجمعيات" multiple>
                            @foreach($associations as $association)
                                <option @if(in_array($association->id, $supervisor->associations->pluck('id')->toArray(), false)) selected @endif value="{{ $association->id }}">{{ $association->name }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>
            </x-form>
        </div>
        <div class="col-12 col-md-4">
            <x-form action="{{ route('supervisor.change-password', $supervisor) }}" method="PUT">
                <x-form.input.password col="col-12" name="password" label="كلمة المرور"  required/>
                <x-form.input.password col="col-12" name="password_confirmation" label="تأكيد كلمة المرور"  required/>
            </x-form>
        </div>
    </div>

    @push('script')
        <script>
            @if($supervisor->scope !== \App\Models\User::SCOPE_LIMIT)
            $("#associations-wrap").hide()
            @endif
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
