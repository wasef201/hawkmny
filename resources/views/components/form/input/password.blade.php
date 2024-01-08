<!--begin::Input group-->
<div class="mb-5 {{ $col ?? null }}" data-kt-password-meter="true">
    <!--begin::Wrapper-->
    <div class="d-flex flex-stack mb-2">
        <!--begin::Label-->
        <x-form.input.label :label="$label??null" :id="$id ?? $name" :required="$attributes->has('required')"></x-form.input.label>
        <!--end::Label-->
        <!--begin::Link-->
        @if ($reset?? false)
            <a href="{{ theme()->getPageUrl('password.request') }}" class="link-success fs-6 fw-bolder">
                نسيت كلمة المرور؟
            </a>
    @endif
    <!--end::Link-->
    </div>
    <!--end::Wrapper-->

    <!--begin::Input-->
    <div class="position-relative mb-3">
        <input id="{{ $id ?? $name }}" class="form-control form-control-lg {{ $errors->has($name) ? 'is-invalid' : null }}" type="password" name="{{ $name }}" {{ $attributes }}/>
        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>
                        <i class="bi bi-eye fs-2 d-none"></i>
                    </span>
        @error($name)<span class="invalid-feedback">{{ $message }}</span>@enderror
    </div>                <!--end::Input-->
</div>
<!--end::Input group-->
