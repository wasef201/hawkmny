<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"{!! theme()->printHtmlAttributes('html') !!} {{ theme()->printHtmlClasses('html') }}>
{{-- begin::Head --}}
<head>
    <meta charset="utf-8"/>
    <title>{{ ucfirst(theme()->getOption('meta', 'title')) }}</title>
    <meta name="description" content="{{ ucfirst(theme()->getOption('meta', 'description')) }}"/>
    <meta name="keywords" content="{{ theme()->getOption('meta', 'keywords') }}"/>
    <link rel="canonical" href="{{ ucfirst(theme()->getOption('meta', 'canonical')) }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/icons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('/icons/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ asset('icons/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#1f4216">
    <meta name="msapplication-config" content="{{ asset('icons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

    {{-- begin::Fonts --}}
{{--    {{ theme()->includeFonts() }}--}}
    <link rel="stylesheet" href="{{asset('fonts/ArbFONTS-Questv1-Bold.otf')}}"/>

    {{-- end::Fonts --}}
    <style>
        @font-face {
            font-family: Questv1Bold;
            src: url("/fonts/ArbFONTS-Questv1-Bold.otf");
        }

        *{
            font-family:'Questv1Bold';

        }
    </style>
    @if (theme()->hasOption('page', 'assets/vendors/css'))
        {{-- begin::Page Vendor Stylesheets(used by this page) --}}
        @foreach (array_unique(theme()->getOption('page', 'assets/vendors/css')) as $file)
            {!! preloadCss(assetCustom($file)) !!}
        @endforeach
        {{-- end::Page Vendor Stylesheets --}}
    @endif

    @if (theme()->hasOption('page', 'assets/custom/css'))
        {{-- begin::Page Custom Stylesheets(used by this page) --}}
        @foreach (array_unique(theme()->getOption('page', 'assets/custom/css')) as $file)
            {!! preloadCss(assetCustom($file)) !!}
        @endforeach
        {{-- end::Page Custom Stylesheets --}}
    @endif

    @if (theme()->hasOption('assets', 'css'))
        {{-- begin::Global Stylesheets Bundle(used by all pages) --}}
        @foreach (array_unique(theme()->getOption('assets', 'css')) as $file)
            @if (strpos($file, 'plugins') !== false)
                {!! preloadCss(assetCustom($file)) !!}
            @else
                <link href="{{ assetCustom($file) }}" rel="stylesheet" type="text/css"/>
            @endif
        @endforeach
        {{-- end::Global Stylesheets Bundle --}}
    @endif

    @if (theme()->getViewMode() === 'preview')
        {{ theme()->getView('partials/trackers/_ga-general') }}
        {{ theme()->getView('partials/trackers/_ga-tag-manager-for-head') }}
    @endif
    @livewireStyles
    @yield('styles')
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
{{-- end::Head --}}

{{-- begin::Body --}}
<body {!! theme()->printHtmlAttributes('body') !!} {!! theme()->printHtmlClasses('body') !!} {!! theme()->printCssVariables('body') !!}>

@if (theme()->getOption('layout', 'loader/display') === true)
    {{ theme()->getView('layout/_loader') }}
@endif

<div class="pattern">
    @yield('content')
</div>
{{-- begin::Javascript --}}
@if (theme()->hasOption('assets', 'js'))
    {{-- begin::Global Javascript Bundle(used by all pages) --}}
    @foreach (array_unique(theme()->getOption('assets', 'js')) as $file)
        <script src="{{ asset(theme()->getDemo() . '/' .$file) }}"></script>
    @endforeach
    {{-- end::Global Javascript Bundle --}}
@endif

@if (theme()->hasOption('page', 'assets/vendors/js'))
    {{-- begin::Page Vendors Javascript(used by this page) --}}
    @foreach (array_unique(theme()->getOption('page', 'assets/vendors/js')) as $file)
        <script src="{{ asset(theme()->getDemo() . '/' .$file) }}"></script>
    @endforeach
    {{-- end::Page Vendors Javascript --}}
@endif

@if (theme()->hasOption('page', 'assets/custom/js'))
    {{-- begin::Page Custom Javascript(used by this page) --}}
    @foreach (array_unique(theme()->getOption('page', 'assets/custom/js')) as $file)
        <script src="{{ asset(theme()->getDemo() . '/' .$file) }}"></script>
    @endforeach
    {{-- end::Page Custom Javascript --}}
@endif
{{-- end::Javascript --}}

@if (theme()->getViewMode() === 'preview')
    {{ theme()->getView('partials/trackers/_ga-tag-manager-for-body') }}
@endif

@yield('scripts')
@livewireScripts
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    @if(session('flash'))
        Toast.fire({
            icon: 'info',
            title: '{{ session('flash') }}'
        });
    @endif
    Livewire.on('notification', message => {
        Toast.fire({
            icon: 'info',
            title: message
        })
    });
</script>

@stack('script')
<script>
    $('.btn.btn-primary').mousemove(function (event){
        const getMousePos = (evt) => {
            const pos = evt.currentTarget.getBoundingClientRect();
            return {
                x: evt.clientX - pos.left,
                y: evt.clientY - pos.top
            };
        };
        const mPos = getMousePos(event);

        const width = $(this).innerWidth();
        const mouseXpercentage = (mPos.x / width ) * 100;
       // $(this).css('background', 'linear-gradient(90deg, rgba(12,109,174,1) 0%, rgba(32,179,129,1) '+mouseXpercentage+'%, rgba(12,109,174,1) 100%)');

    });
</script>

<script>
    window.addEventListener('swal',function(e){
        Swal.fire(e.detail);
    });
</script>
</body>
{{-- end::Body --}}
</html>
