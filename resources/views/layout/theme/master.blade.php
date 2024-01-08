@extends('base.base')

@section('content')
    @if (theme()->getOption('layout', 'main/type') === 'blank')
        <div class="d-flex flex-column flex-root">
            {{ $slot }}
        </div>
    @else
        <div class="d-flex flex-column flex-root">
            <div class="page d-flex flex-row flex-column-fluid">
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                {{ theme()->getView('layout/header/_base') }}
                    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start {{ theme()->printHtmlClasses('content-container', false) }}">
                    @if (theme()->getOption('layout', 'aside/display') === true)
						{{ theme()->getView('layout/aside/_base') }}
					@endif
                        <div class="content flex-row-fluid" id="kt_content">
                            {{ $slot }}
                        </div>
                    </div>
                    {{ theme()->getView('layout/_footer') }}
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::Root-->

        <!--begin::Drawers-->
        {{ theme()->getView('partials/topbar/_activity-drawer') }}
        <!--end::Drawers-->

        <!--begin::Engage-->
        {{ theme()->getView('partials/engage/_main') }}
        <!--end::Engage-->

        @if(theme()->getOption('layout', 'scrolltop/display') === true)
            {{ theme()->getView('layout/_scrolltop') }}
        @endif
    @endif
    <!--end::Main-->

@endsection
