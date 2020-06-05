<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('general.meta')
    @include('general.fonts')
    @include('general.styles')
    <base href="{{url('/')}}">
    <script>
        let _LOGO = "{{ setting('app_logo') }}"
        let _about_us_desc = "{{ setting('app_desc') }}"
    </script>
    <style>
        option {
            direction: ltr !important;
        }
        [type="radio"],[type="checkbox"]{
            height: unset !important;
        }
    </style>

</head>
<body>
<div id="app">
    @yield('content')
</div>
<script>
    {{--    let about_us_desc = '{{setting('footer.about_us')}}';--}}
    {{--    let privacy_policy = `{!! setting('privacy-policy.privacy_policy') !!}`;--}}
</script>
@include('general.scripts')
</body>
</html>
