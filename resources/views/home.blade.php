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
            <router-link to="/terms_and_conditions" class="text-decoration-none">Privacy Policy</router-link>
        </footer-component>
    </div>
@endsection

@section('scripts')
    <script>
    </script>
@endsection
