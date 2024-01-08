<x-panel title="المعايير / {{ $practice->standard->name }}/ {{ $practice->name }} ">
<x-form action="{{ route('practice.update', $practice) }}" submit-text=" حفظ البيانات" method="PUT">
        <div class="row">
            <div class="col-12 col-md-8">
                <x-form.select name="field_id" label="المجال" select2 required>
                    @foreach($practice->standard->fields as $field)
                        <option @if($practice->field_id === $field->id) selected @endif value="{{ $field->id }}">{{ $field->name }}</option>
                    @endforeach
                </x-form.select>
                <x-form.input name="name" label="اسم الممارسة" value="{{ $practice->name }}" required/>
                <x-form.editor name="description" label="تعريف الممارسة" required>{!! $practice->description !!}</x-form.editor>
            </div>
            <div class="col-12 col-md-4">
                <x-form.input step="0.1" type="number" name="degree" label="درجة الممارسة" required value="{{ $practice->degree }}" />
                <br />
                <x-form.input.check-box name="is_active" label="نشر الممارسة" :checked="$practice->is_active"/>
            </div>
        </div>
    </x-form>
</x-panel>
