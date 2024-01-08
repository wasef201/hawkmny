<x-panel title="المعايير / {{ $standard->name }}/ اضافة ممارسة ">
    <x-form action="{{ route('standard.practice.store', $standard) }}" submit-text="اضافة ممارسة">
        <div class="row">
            <div class="col-12 col-md-8">
                <x-form.select name="field_id" label="المجال" select2 required>
                    @foreach($standard->fields as $field)
                        <option value="{{ $field->id }}">{{ $field->name }}</option>
                    @endforeach
                </x-form.select>
                <x-form.input name="name" label="اسم الممارسة" required/>
                <x-form.editor name="description" label="تعريف الممارسة" required/>
            </div>
            <div class="col-12 col-md-4">
                <x-form.input step="0.1" type="number" name="degree" label="درجة الممارسة" required/>
                <br />
                <x-form.input.check-box name="is_active" label="نشر الممارسة" />
            </div>
        </div>
    </x-form>
</x-panel>
