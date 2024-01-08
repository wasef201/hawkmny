<x-panel title="المعايير / {{ $standard->name }}/ اضافة مجال ">
    <x-form action="{{ route('standard.fields.store', $standard) }}" submit-text="اضافة مجال">
        <div class="row">
            <div class="col-12 col-md-8">
                <x-form.input name="name" label="اسم المجال" required/>
                <x-form.editor name="description" label="تعريف المجال" required/>
            </div>
            <div class="col-12 col-md-4">
                <x-form.input step="0.1" type="number" name="degree" label="درجة المجال" required/>
                <br />
                <x-form.input.check-box name="is_active" label="نشر المجال" />
            </div>
        </div>
    </x-form>
</x-panel>
