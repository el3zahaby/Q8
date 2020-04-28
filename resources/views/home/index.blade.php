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

            <div class="most_sell_title text-center mb-4">
                <h2>{{ __('Designs')}}</h2>
            </div>
            <!-- Products -->
            <div class="most_sell_content">
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="t-shirt_data mb-2">
                            <span>ID : {{$product->design->id}}</span>
                            <div class="t-shirt_image_div position-relative">
                                <img src="" alt="">
{{--                                <product-designer design="product" :type="'view'"></product-designer>--}}
                                <ul
                                    class="cart_ul_btn list-icon list-unstyled product_btn_div d-flex align-items-center text-center mb-0">
                                    <li>
                                        <a
                                            href="#"
                                            data-id="hidden-denim-shirt"
                                            class="quickview_btn"
                                            title="Product Details"
                                            data-toggle="modal"
                                            data-target="{{'#d'.$product->design->id}}">
                                            <img src="/images/eye.png" alt=""/>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" onclick="addToCart({{ $product->id }})" class="add-to-cart quickview_btn">
                                            <img
                                                src="images/add-cart.png"
                                                alt=""
                                            />
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="t-shirt_inner_data d-flex justify-content-between align-items-center px-1 my-2">
                                <span class="t-shirt_name">{{ $product->name }}</span>
                            </div>
                            <div class="t-shirt_inner_price px-1 my-2">
                            <span if="product.discount !== 0"
                                class="t-shirt_price_nosale d-none">{{ '$'.$product->price }}</span>
                                <span
                                    if="product.discount === 0"
                                    class="t-shirt_price_sale mx-3">{{ 'priceDefault(product.price,product.discount) | currency' }}</span>
                                <span else class="t-shirt_price_sale mx-3">{{ 'priceDefault(product.price,product.discount) | currency' }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <footer-component>
            @foreach(\App\Page::where('status','ACTIVE')->where('slug', 'not like', "%-ar%")->orderBy('id','desc')->get() as $page)
                @if($_COOKIE['locale'] =='ar' or $_COOKIE['locale'] =='AR') @php($page = $page->ar()) @endif
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
