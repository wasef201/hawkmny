<x-panel title="الأسئلة / اضافة سؤال">
    <x-form action="{{ route('question.store') }}" submit-text="اضافة سؤال">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="row">
                    <x-form.select col="col-12 col-md-4" name="standard_id" label="المعيار" select2 required>
                        @foreach($standards as $standard)
                            <option value="{{ $standard->id }}">{{ $standard->name }}</option>
                        @endforeach
                    </x-form.select>
                    <x-form.select col="col-12 col-md-4" name="field_id" label="المجال" select2 required>
                    </x-form.select>
                    <x-form.select col="col-12 col-md-4" name="practice_id" label="الممارسة" select2 required>
                    </x-form.select>
                </div>

                <x-form.input name="name" label="السؤال" required/>
                <x-form.editor name="description" label="تعريف السؤال" required/>
            </div>
            <div class="col-12 col-md-4">
                <x-form.input step="0.1" type="number" name="degree" label="درجة السؤال" required/>
                <br />
                <x-form.input.check-box name="is_active" label="نشر السؤال" />
            </div>
        </div>
    </x-form>
    @push('script')
        <script>
            const standardId = $('#standard_id').find(':selected').attr('value');
            if(standardId) {
                loadFields(standardId);
            }
            $("#standard_id").on('select2:select', function (e) {
                loadFields(e.params.data.id)
            });
            const fieldId = $('#field_id').find(':selected').attr('value');
            if(fieldId) {
                loadPractices(fieldId);
            }
            $("#field_id").on('select2:select', function (e) {
                loadPractices(e.params.data.id)
            });
            function loadFields(id) {
                fetch("{{ route('api.fields' ) }}", {
                    method: "post",
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({standard_id: id})
                }).then(response => response.json())
                    .then(response => {
                        let data = $.map(response.data, function (obj) {
                            obj.text = obj.name;
                            return obj;
                        });
                        $("#field_id").html('').select2({data}).val(null).trigger('change');
                    }).catch((error) => {
                    console.error('Error:', error);
                });
            }
            function loadPractices(id) {
                fetch("{{ route('api.practices' ) }}", {
                    method: "post",
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({field_id: id})
                }).then(response => response.json())
                    .then(response => {
                        let data = $.map(response.data, function (obj) {
                            obj.text = obj.name;
                            return obj;
                        });
                        $("#practice_id").html('').select2({data}).val(null).trigger('change');
                    }).catch((error) => {
                    console.error('Error:', error);
                });
            }
        </script>
    @endpush
</x-panel>
