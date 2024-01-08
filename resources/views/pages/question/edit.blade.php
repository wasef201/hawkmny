<x-panel title="الأسئلة / {{ $question->name }}">
    <x-form action="{{ route('question.update', $question) }}" submit-text="حفظ البيانات" method="PUT">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="row">
                    <x-form.select col="col-12 col-md-4" name="standard_id" label="المعيار" select2 required>
                        @foreach($standards as $standard)
                            <option @if($standard->id === $question->standard_id) selected @endif value="{{ $standard->id }}">{{ $standard->name }}</option>
                        @endforeach
                    </x-form.select>
                    <x-form.select col="col-12 col-md-4" name="field_id" label="المجال" select2 required>
                    </x-form.select>
                    <x-form.select col="col-12 col-md-4" name="practice_id" label="الممارسة" select2 required>
                    </x-form.select>
                </div>

                <x-form.input name="name" label="السؤال" required value="{{ $question->name }}"/>
                <x-form.editor name="description" label="تعريف السؤال" >{!! $question->description !!}</x-form.editor>
            </div>
            <div class="col-12 col-md-4">
                <x-form.input step="0.1" type="number" name="degree" label="درجة السؤال" value="{{ $question->degree }}" required/>
                <br />
                <x-form.input.check-box name="is_active" label="نشر السؤال" :checked="$question->is_active" />
            </div>
        </div>
    </x-form>
    <br/>
    <livewire:questions.question-choices :choices="$question->choices"/>
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
                        $("#field_id").html('').select2({data}).val({{ $question->field_id }}).trigger('change');
                        const fieldId = $('#field_id').find(':selected').attr('value');
                        if(fieldId) {
                            loadPractices(fieldId);
                        }
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
                        $("#practice_id").html('').select2({data}).val({{ $question->practice_id }}).trigger('change');
                    }).catch((error) => {
                    console.error('Error:', error);
                });
            }
        </script>
    @endpush
</x-panel>
