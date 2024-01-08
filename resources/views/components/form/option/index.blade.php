<div class="{{ $col ?? 'col-12' }}">
    <!--begin::Option-->
    <input type="radio" class="btn-check" name="{{ $name }}" value="{{ $value }}"  id="{{ $id ?? $name }}" {{ $attributes }}/>
    <label class="btn btn-outline btn-outline-dashed btn-outline-success btn-active-light-success p-7 d-flex align-items-center mb-5" for="{{ $id ?? $name }}">
        {{ $icon ?? null }}
        <span class="d-block fw-bold text-start">
        <span class="text-dark fw-bolder d-block fs-3">{{ $title }}</span>
        <span class="text-muted fw-bold fs-6">
            {{ $description ?? null }}
        </span>
    </span>
    </label>
    <!--end::Option-->
</div>
