<x-panel title="المعايير / اضافة معيار">
    <x-form action="{{ route('standard.store') }}" submit-text="اضافة معيار">
        <div class="row">
            <div class="col-12 col-md-8">
                <x-form.input name="name" label="اسم المعيار" />
                <x-form.editor name="description" label="تعريف المعيار" />
            </div>
            <div class="col-12 col-md-4">
                <x-form.input type="number" name="percentage" label="نسبة المعيار" />
                <br />
                <x-form.input.check-box name="is_active" label="نشر المعيار" />
            </div>
        </div>
    </x-form>
</x-panel>
