<x-panel title="المعايير /  {{ $field->standard->name }} / {{ $field->name }}">
    <x-form action="{{ route('fields.update', $field) }}" submit-text=" حفظ البيانات" method="PUT">
        <div class="row">
            <div class="col-12 col-md-8">
                <x-form.input name="name" label="اسم المجال" value="{{ $field->name }}" required/>
                <x-form.editor name="description" label="تعريف المجال" required>{!! $field->description !!}</x-form.editor>
            </div>
            <div class="col-12 col-md-4">
                <x-form.input step="0.1" type="number" name="degree" label="درجة المجال" required value="{{ $field->degree }}" />
                <br />
                <x-form.input.check-box name="is_active" label="نشر المجال" :checked="$field->is_active"/>
            </div>
        </div>
    </x-form>
</x-panel>
