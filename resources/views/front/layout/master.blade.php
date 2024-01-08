<!DOCTYPE html>
@php
    $lang='ar';//app()->getLocale();
    $dir=$lang=='ar'?'rtl':'ltr';
@endphp
<html lang="{{$lang}}" dir="{{$dir}}" class="overflow-x-hidden">

@include('front.layout.header')

@yield('styles')

<body >

@include('front.layout._nav')

@yield('content')

<!--Footer-->
@include('front.layout.footer')

<!--scripts-->

@include('front.layout.scripts')


</body>
</html>
