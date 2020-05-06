@extends('layouts.app')
@section('title')
    <title>{{__('Home')}}</title>
@endsection

@section('content')
    <div class="bg-top main_bg_color"></div>

    <div class="container" style="position: relative;">

        <!-- Header Component -->
        <header-component></header-component>
        <!-- End Header Component -->

        <div class="body_container" style="background-color: #FFFFFF; padding-bottom: 20px;">

            <!-- SlideShow Component -->
            <slideshow-component></slideshow-component>
            <!-- End of SlideShow Component -->

            <!-- Router View -->
            <router-view></router-view>
            <!-- End Router View -->


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
    <script>
    </script>
@endsection
