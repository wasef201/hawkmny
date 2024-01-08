<!--begin::Input group-->
<div class="my-2 {{ $col ?? 'col-12' }}">
    <x-form.input.label :label="$label??null" :id="$id ?? $name ?? ''" :required="$attributes->has('required')"></x-form.input.label>
    <!--begin::Input-->
    <input class="form-control form-control-lg @if($errors->count()){{ $errors->has($errorname?? $name ?? '') ? 'is-invalid' : 'is-valid'}} @endif " name="{{ $name ?? '' }}" id="{{ $id ?? $name ?? '' }}"
           autocomplete="off"
           value="{{ old($name ?? '', $value ?? null) }}" {{ $attributes }}/>
    @isset($help)<div class="form-text">{{ $help }}</div>@endisset
    @error($errorname ?? $name ?? '' )<span class="invalid-feedback">{{ $message }}</span>@enderror
    <!--end::Input-->
</div>
<!--end::Input group-->
