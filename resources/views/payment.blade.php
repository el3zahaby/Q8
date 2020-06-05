@extends('layouts.app')
@section('title')
    <title>{{__('Home')}}</title>
    <script>
        let _LOGO = "{{ setting('app_logo') }}"
        let _about_us_desc = "{{ setting('app_desc') }}"
    </script>
    <style>
        option {
            direction: ltr !important;
        }
    </style>
@endsection

@section('content')
    <div class="bg-top main_bg_color"></div>

    <div class="container" style="position: relative;">

        <!-- Header Component -->
        <header-component></header-component>
        <!-- End Header Component -->


        <div class="body_container card">
            <div class="card-body ">
                <div class="alert-pay alert alert-{{$alert}}">{{ $status }}</div>
                <router-view></router-view>
            </div>
        </div>

        <footer-component>
            @foreach(\App\Page::where('status','ACTIVE')->where('slug', 'not like', "%-ar%")->orderBy('id','desc')->get() as $page)
                @if(isset($_COOKIE['locale']) && $_COOKIE['locale'] =='ar' or $_COOKIE['locale'] =='AR') @php($page = $page->ar()) @endif
            <li>
                <router-link to="{{ $page->base_slug }}" class="text-decoration-none">{{$page->title}}</router-link>
            </li>
            @endforeach
        </footer-component>
    </div>
@endsection

@section('scripts')

@endsection
