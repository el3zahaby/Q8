@extends('layouts.app')
@section('title')
    <title>Q8-Tshirt | Dashboard</title>
    <style>
        .btn-group,option,td {
        direction: ltr !important;
        }
        [type="radio"],[type="checkbox"]{
            height: unset !important;
        }    </style>
    <script>
        {{--let _LOGO = "{{ setting('app_logo') }}"--}}
        {{--let _about_us_desc = "{{ setting('app_desc') }}"--}}
    </script>
@endsection

@section('styles')
    <style>
        body {
            background: #f4f4f4 !important;
        }
    </style>
@endsection

@section('content')
    <div class="content">

        <dashboard-content></dashboard-content>

    </div>
@endsection

@section('scripts')
    <script>
    </script>
@endsection
