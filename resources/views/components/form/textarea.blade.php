<!--begin::Input group-->
<div class="{{ $col ?? null }} my-2">
    <div class="form-floating">
    <textarea name="{{ $name }}" id="{{ $id ?? $name }}"
              style="height: 100px" {{ $attributes->class(['form-control']) }}>{{ $slot }}</textarea>
        <x-form.input.label :label="$label??null" :id="$id ?? $name" :required="$attributes->has('required')"></x-form.input.label>
    </div>
</div>
<!--end::Input group-->
