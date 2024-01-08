<!--begin::Input group-->
<div class="my-2 {{ $col ?? 'col-12' }}">
    <div class="form-check form-check-success">
        <input class="form-check-input  @if($errors->count()){{ $errors->has($name) ? 'is-invalid' : 'is-valid'}} @endif" type="checkbox" @if(old($name, $checked??'')) checked @endif
        id="{{ $id ?? $name }}" name="{{ $name }}" {{ $attributes }}>
        <x-form.input.label :label="$label??null" :id="$id ?? $name" :required="$attributes->has('required')"></x-form.input.label>
        @error($name)<div id="invalidCheck3Feedback" class="invalid-feedback">
            {{ $message }}
        </div>@enderror
    </div>
</div>
<!--end::Input group-->
