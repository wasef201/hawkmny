<!--begin::Toolbar-->
<div class="toolbar py-5" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="w-100 d-flex flex-stack flex-wrap p-0">
        <h1 class="d-flex text-white fw-bolder fs-1">{{ $title ?? null }}</h1>
    <!--begin::Actions-->
        <div class="d-flex align-items-center py-3 py-md-1">
            <!--begin::Wrapper-->
            <div>
            @if($href ?? $createRoute ?? null)
            <a href="{{ $href ?? route($createRoute) }}" class="btn btn-bg-white btn-active-color-success">
                {{ $createLabel }}
            </a>
           @endif
                {{ $slot }}
                <!--end::Button-->
        </div>
        <!--end::Actions-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->
