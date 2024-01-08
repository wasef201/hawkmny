<x-panel title="المعايير /  {{ $standard->name }}">
    <x-form action="{{ route('standard.update', $standard) }}" submit-text=" حفظ البيانات" method="PUT">
        <div class="row">
            <div class="col-12 col-md-8">
                <x-form.input name="name" label="اسم المعيار" value="{{ $standard->name }}"/>
                <x-form.editor name="description" label="تعريف المعيار">{!! $standard->description !!}</x-form.editor>
            </div>
            <div class="col-12 col-md-4">
                <x-form.input type="number" name="percentage" label="نسبة المعيار" value="{{ $standard->percentage }}" />
                <br />
                <x-form.input.check-box name="is_active" label="نشر المعيار" :checked="$standard->is_active"/>
            </div>
        </div>
    </x-form>
</x-panel>
