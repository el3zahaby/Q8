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
            <div class="most_sell_content container">
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-3">
                        <div class="t-shirt_data mb-2">
                            <span>ID : {{$product->design->id}}</span>
                            <div class="t-shirt_image_div position-relative">
                                <div class="w-100 clothing-designer" data-type="view" data-id="{{ $product->design->id }}" style="height: 200px">
                                    <div>
                                        <div class="w-100" style="height: 200px">
                                            <img id="{{'img-'.$product->design->id.'-view' }}"
                                                 class="position-absolute w-100"
                                                 data-img="{{ asset($product->design->thump) }}"
                                                 style="clip: rect(0px, auto, 200px, 0px);width: 200%;display: block;"
                                                 src="">
                                        </div>

                                        <div id="main-container" class="px-3 d-none">
                                            <div id="{{'clothing-designer-'.$product->design->id.'-view' }}"></div>
                                            <br/>
                                        </div>
                                    </div>
                                </div>
                                <ul class="cart_ul_btn list-icon list-unstyled product_btn_div d-flex align-items-center text-center mb-0">
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
                                            <img src="images/add-cart.png" alt=""/>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="t-shirt_inner_data d-flex justify-content-between align-items-center px-1 my-2">
                                <span class="t-shirt_name">{{ $product->name }}</span>
                            </div>
                            <div class="t-shirt_inner_price px-1 my-2">
                            <span class="t-shirt_price_nosale d-none">{{ '$'.$product->price }}</span>
                                @if ($product->discount == 0)
                                    <span class="t-shirt_price_sale mx-3">{{ '$'.priceDefault($product->price,$product->discount) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @foreach($products as $product)
        <div
            class="modal fade"
            id="{{'d'.$product->design->id}}"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content bg-white">
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="content">
                        <div class="row p-3">
                            <div class="col-md-6 h-100">
                                <div class="product-img d-flex justify-content-center">
                                    <div class="w-100 clothing-designer" data-type="popup" data-id="{{ $product->design->id }}">
                                            <img data-img="{{ asset($product->design->thump) }}" id="{{'img-'.$product->design->id.'-popup' }}" class="w-100 h-100" src="">

                                            <div id="main-container" class="px-3 d-none">
                                                <div id="{{'clothing-designer-'.$product->design->id.'-popup' }}"></div>
                                                <br/>
                                            </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="productName">{{$product->design->name}}</h3>
                                <h5>ID: <span>{{$product->design->id}}</span></h5>
                                <span
                                    class="productPrice">{{ '34' }}</span>
                                <p class="ProductDetails pt-3">
                                    {{$product->des}}
                                </p>
                                <div class="form-action">
                                    <form method="post" class="form-group" @submit.prevent="addToCart(product)">
                                        <div class="mb-2">
                                            <label class="my-1 mr-2 font-weight-bold text-capitalize">{{__('print_options')}}* : </label>
                                            <div class="d-inline-block mx-2">
                                                <input class="printOpt" type="radio" id="'front'+product.design.id" value="front" vv-model="printOptions">
                                                <label class="printOpt" for="'front'+product.design.id">{{__('Front')}}</label>
                                            </div>
                                            <div class="d-inline-block mx-2">
                                                <input class="printOpt" type="radio" id="'back'+product.design.id"
                                                       value="back"
                                                       vv-model="printOptions">
                                                <label class="printOpt" for="'back'+product.design.id">{{__('Back')}}</label>
                                            </div>
                                            <div class="d-inline-block mx-2">
                                                <input class="printOpt" type="radio" id="'front_back'+product.design.id"
                                                       value="front_back"
                                                       vv-model="printOptions">
                                                <label class="printOpt" for="'front_back'+product.design.id">{{__('Front_and_Back')}}</label>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <div vv-if="printOptions.includes('front')">
                                                <label
                                                    class="my-1 mr-2 font-weight-bold text-capitalize"
                                                    for="'frontSizeInputFiled'+product.design.id"
                                                >{{__('front_size')}}*</label
                                                >
                                                <select
                                                    @click.prevent="frontprintPrice(frontprint)"
                                                    vv-model="frontprint"
                                                    class="custom-select my-1 mr-sm-2"
                                                    id="{{'frontSizeInputFiled'.$product->design->id}}"
                                                >
                                                    <option value="null" selected>- {{__('Please_Select')}} -</option>
                                                    @foreach($product->design->dsizes as $dsize)
                                                        <option value="{{$dsize->id}}">{{$dsize->length}}<span> X </span>{{$dsize->width}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div vv-if="printOptions.includes('back')">
                                                <label
                                                    class="my-1 mr-2 font-weight-bold text-capitalize"
                                                    for="{{'backSizeInputFiled'.$product->design->id}}"
                                                >{{__('back_size')}}*</label
                                                >
                                                <select
                                                    @click.prevent="backprintPrice(backprint)"
                                                    vv-model="backprint"
                                                    class="custom-select my-1 mr-sm-2"
                                                    id="{{'backSizeInputFiled'.$product->design->id}}"
                                                >
                                                    <option :value="null" selected>- {{__('Please_Select')}} -</option>
                                                    @foreach($product->design->dsizes as $dsize)
                                                        <option value="{{$dsize->id}}">{{$dsize->length}}<span> X </span>{{$dsize->width}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label
                                                class="my-1 mr-2 font-weight-bold"
                                                for="{{'colorInput'.$product->design->id}}">{{__('TShirt_Color')}}*</label
                                            >
                                            <select

                                                class="custom-select my-1 mr-sm-2"
                                                id="{{'colorInput'.$product->design->id}}"
                                            >
                                                <option :value="null" selected>- {{__('Please_Select')}} -</option>
                                                @foreach($product->tshirts as $tshirt)
                                                <option value="{{$tshirt->color->id}}">
                                                    {{$tshirt->color->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label class="my-1 mr-2 font-weight-bold" for="{{'sizeInput'.$product->design->id}}">{{__('TShirt_Size')}}*</label
                                            >
                                            <select
                                                class="custom-select my-1 mr-sm-2"
                                                id="{{'sizeInput'.$product->design->id}}"
                                            >
                                                <option :value="null" selected>- {{__('Please_Select')}} -</option>
                                                @foreach($product->tshirts as $tshirt)
                                                    <option value="{{$tshirt->tsize->id}}">
                                                        {{$tshirt->tsize->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-3">
                                                <input
                                                    vv-model="count"
                                                    type="number"
                                                    value="1"
                                                    name="mount"
                                                    min="1"
                                                    style="background-color:#ffffff; border-radius: 5px"
                                                />
                                            </div>
                                            <div class="col-6">
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary my-1"
                                                    style="outline: none;">
                                                    <i class="fas fa-shopping-cart"></i>
                                                    {{__('Add_to_cart')}}
                                                </button>
                                            </div>
                                            <h5 class="productPrice" style="margin-top:10px">{{__('total')}} :
                                                <span class="productPrice">{{ 'count' }}</span>
                                            </h5>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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
        var $Designes = $(".clothing-designer");

            $Designes.each(function () {
                var $this  = $(this);
                var designID = $this.attr('data-id');
                var type = $this.attr('data-type');

                var $yourDesigner = $("#clothing-designer-" + designID +'-' +type),
                    pluginOpts = {
                        mainBarModules: [],
                        productsJSON: getProductJson($this.find('img').attr('data-img'),type), //see JSON folder for products sorted in categories
                        actions: {
                            top: [],
                            right: [],
                            bottom: [],
                            left: []
                        }
                    };
                let yourDesigner = new FancyProductDesigner(
                    $yourDesigner,
                    pluginOpts
                );
                console.log("#clothing-designer-" + designID +'-' +type)
                $yourDesigner.on('productCreate', async function () {
                    yourDesigner.getProductDataURL( function(dataURL){
                        $this.find('img').attr('src',dataURL)
                    } );
                });

            });


        function _get_color() {
            // var colors = ['#0dd4ad', '#ff5050', '#ff80ff', '#ffff1b', '#00b3e6','#FFFFFF'];
            var colors = ['#efda1a'];
            return colors[Math.floor(Math.random() * colors.length)];
        }
        function getProductJson(img,viewType,color,backprint) {

            $tcolor = color? color: _get_color();


            $front = {
                "title": "Front",
                "thumbnail": "/images/color_shirt/color/front/base.png",
                "elements": [
                    {
                        "title": "Shadow",
                        "source": "/images/color_shirt/Shadow3.png",
                        "parameters": {
                            "advancedEditing": false,
                            "angle": 0,
                            "autoCenter": false,
                            "autoSelect": false,
                            "boundingBox": "",
                            "boundingBoxMode": "inside",
                            "colorLinkGroup": false,
                            "colorPrices": {},
                            "colors": "",
                            "copyable": false,
                            "cornerSize": 24,
                            "draggable": false,
                            "evented": false,
                            "excludeFromExport": false,
                            "fill": false,
                            "filter": null,
                            "flipX": false,
                            "flipY": false,
                            "height": 633,
                            "left": 400,
                            "lockUniScaling": true,
                            "locked": false,
                            "minScaleLimit": 0.01,
                            "objectCaching": false,
                            "opacity": 1,
                            "originParams": {
                                "objectCaching": false,
                                "z": 0,
                                "price": 0,
                                "colors": "",
                                "removable": false,
                                "draggable": false,
                                "rotatable": false,
                                "resizable": false,
                                "copyable": false,
                                "zChangeable": false,
                                "boundingBox": "",
                                "boundingBoxMode": "inside",
                                "autoCenter": false,
                                "replace": "",
                                "replaceInAllViews": false,
                                "autoSelect": false,
                                "topped": false,
                                "colorPrices": {},
                                "colorLinkGroup": false,
                                "patterns": [],
                                "sku": "",
                                "excludeFromExport": false,
                                "showInColorSelection": false,
                                "locked": false,
                                "uniScalingUnlockable": false,
                                "originX": "center",
                                "originY": "center",
                                "cornerSize": 24,
                                "fill": false,
                                "lockUniScaling": true,
                                "pattern": false,
                                "top": 300,
                                "left": 400,
                                "angle": 0,
                                "flipX": false,
                                "flipY": false,
                                "opacity": 1,
                                "scaleX": 1,
                                "scaleY": 1,
                                "uploadZone": false,
                                "filter": null,
                                "scaleMode": "fit",
                                "resizeToW": "0",
                                "resizeToH": "0",
                                "advancedEditing": false,
                                "uploadZoneMovable": false,
                                "uploadZoneRemovable": false,
                                "padding": 0,
                                "minScaleLimit": 0.01,
                                "customAdds": [],
                                "_isInitial": true,
                                "source": "/images/color_shirt/Shadow3.png",
                                "title": "Shadow",
                                "id": "1588100453287",
                                "cornerColor": "#f5f5f5",
                                "cornerIconColor": "#000000",
                                "selectable": false,
                                "lockRotation": true,
                                "hasRotatingPoint": false,
                                "lockScalingX": true,
                                "lockScalingY": true,
                                "lockMovementX": true,
                                "lockMovementY": true,
                                "hasControls": false,
                                "evented": false,
                                "lockScalingFlip": true,
                                "crossOrigin": ""
                            },
                            "originX": "center",
                            "originY": "center",
                            "padding": 0,
                            "patterns": [],
                            "price": 0,
                            "removable": false,
                            "replace": "",
                            "replaceInAllViews": false,
                            "resizable": false,
                            "resizeToH": "0",
                            "resizeToW": "0",
                            "rotatable": false,
                            "scaleMode": "fit",
                            "scaleX": 1,
                            "scaleY": 1,
                            "showInColorSelection": false,
                            "sku": "",
                            "top": 300,
                            "topped": false,
                            "uniScalingUnlockable": false,
                            "uploadZone": false,
                            "uploadZoneMovable": false,
                            "uploadZoneRemovable": false,
                            "width": 717,
                            "z": -1,
                            "zChangeable": false,
                            "topLeftX": 41.5,
                            "topLeftY": -16.5
                        },
                        "type": "image"
                    },
                    {
                        "title": "Shirt",
                        "source": "/images/color_shirt/color/front/base.png",
                        "parameters": {
                            "advancedEditing": false,
                            "angle": 0,
                            "autoCenter": false,
                            "autoSelect": false,
                            "boundingBox": "",
                            "boundingBoxMode": "inside",
                            "colorLinkGroup": "base",
                            "colorPrices": {},
                            "colors": [
                                "#b33939"
                            ],
                            "copyable": false,
                            "cornerSize": 24,
                            "draggable": false,
                            "evented": true,
                            "excludeFromExport": false,
                            "fill": $tcolor,
                            "filter": null,
                            "flipX": false,
                            "flipY": false,
                            "height": 539,
                            "isEditable": true,
                            "left": 400,
                            "lockUniScaling": true,
                            "locked": false,
                            "minScaleLimit": 0.01,
                            "objectCaching": false,
                            "opacity": 1,
                            "originParams": {
                                "objectCaching": false,
                                "z": 1,
                                "price": 10,
                                "colors": [
                                    "#b33939"
                                ],
                                "removable": false,
                                "draggable": false,
                                "rotatable": false,
                                "resizable": false,
                                "copyable": false,
                                "zChangeable": false,
                                "boundingBox": "",
                                "boundingBoxMode": "inside",
                                "autoCenter": false,
                                "replace": "",
                                "replaceInAllViews": false,
                                "autoSelect": false,
                                "topped": false,
                                "colorPrices": {},
                                "colorLinkGroup": "base",
                                "patterns": [],
                                "sku": "",
                                "excludeFromExport": false,
                                "showInColorSelection": false,
                                "locked": false,
                                "uniScalingUnlockable": false,
                                "originX": "center",
                                "originY": "center",
                                "cornerSize": 24,
                                "fill": false,
                                "lockUniScaling": true,
                                "pattern": false,
                                "top": 300,
                                "left": 400,
                                "angle": 0,
                                "flipX": false,
                                "flipY": false,
                                "opacity": 1,
                                "scaleX": 1,
                                "scaleY": 1,
                                "uploadZone": false,
                                "filter": null,
                                "scaleMode": "fit",
                                "resizeToW": "0",
                                "resizeToH": "0",
                                "advancedEditing": false,
                                "uploadZoneMovable": false,
                                "uploadZoneRemovable": false,
                                "padding": 0,
                                "minScaleLimit": 0.01,
                                "customAdds": [],
                                "_isInitial": true,
                                "source": "/images/color_shirt/color/front/base.png",
                                "title": "Shirt",
                                "id": "1588100453424",
                                "cornerColor": "#f5f5f5",
                                "cornerIconColor": "#000000",
                                "selectable": false,
                                "lockRotation": true,
                                "hasRotatingPoint": false,
                                "lockScalingX": true,
                                "lockScalingY": true,
                                "lockMovementX": true,
                                "lockMovementY": true,
                                "hasControls": false,
                                "evented": false,
                                "lockScalingFlip": true,
                                "crossOrigin": ""
                            },
                            "originX": "center",
                            "originY": "center",
                            "padding": 0,
                            "patterns": [],
                            "price": 10,
                            "removable": false,
                            "replace": "",
                            "replaceInAllViews": false,
                            "resizable": false,
                            "resizeToH": "0",
                            "resizeToW": "0",
                            "rotatable": false,
                            "scaleMode": "fit",
                            "scaleX": 1,
                            "scaleY": 1,
                            "showInColorSelection": false,
                            "sku": "",
                            "top": 300,
                            "topped": false,
                            "uniScalingUnlockable": false,
                            "uploadZone": false,
                            "uploadZoneMovable": false,
                            "uploadZoneRemovable": false,
                            "width": 597,
                            "z": -1,
                            "zChangeable": false,
                            "topLeftX": 101.5,
                            "topLeftY": 30.5
                        },
                        "type": "image"
                    },
                    {
                        "title": "Image Title",
                        "source": img,
                        "parameters": {
                            "advancedEditing": true,
                            "angle": 0,
                            "autoCenter": false,
                            "autoSelect": false,
                            "boundingBox": false,
                            "boundingBoxMode": "inside",
                            "colorLinkGroup": "",
                            "colorPrices": {},
                            "colors": "",
                            "copyable": true,
                            "cornerSize": 24,
                            "draggable": true,
                            "evented": true,
                            "excludeFromExport": false,
                            "fill": false,
                            "filter": "none",
                            "flipX": false,
                            "flipY": false,
                            "height": 200,
                            "isCustom": true,
                            "isEditable": true,
                            "left": 400,
                            "lockUniScaling": true,
                            "locked": false,
                            "minScaleLimit": 0.01,
                            "objectCaching": false,
                            "opacity": 1,
                            "originParams": {
                                "objectCaching": false,
                                "z": 3,
                                "price": 4,
                                "colors": "",
                                "removable": true,
                                "draggable": true,
                                "rotatable": true,
                                "resizable": true,
                                "copyable": true,
                                "zChangeable": true,
                                "boundingBox": false,
                                "boundingBoxMode": "inside",
                                "autoCenter": true,
                                "replace": "",
                                "replaceInAllViews": false,
                                "autoSelect": false,
                                "topped": false,
                                "colorPrices": {},
                                "colorLinkGroup": "",
                                "patterns": [],
                                "sku": "",
                                "excludeFromExport": false,
                                "showInColorSelection": false,
                                "locked": false,
                                "uniScalingUnlockable": false,
                                "originX": "center",
                                "originY": "center",
                                "cornerSize": 24,
                                "fill": false,
                                "lockUniScaling": true,
                                "pattern": false,
                                "top": 0,
                                "left": 0,
                                "angle": 0,
                                "flipX": false,
                                "flipY": false,
                                "opacity": 1,
                                "scaleX": 1,
                                "scaleY": 1,
                                "uploadZone": false,
                                "filter": "none",
                                "scaleMode": "cover",
                                "resizeToW": "300",
                                "resizeToH": "300",
                                "advancedEditing": true,
                                "uploadZoneMovable": false,
                                "uploadZoneRemovable": false,
                                "padding": 0,
                                "minScaleLimit": 0.01,
                                "minW": 100,
                                "minH": 100,
                                "maxW": 10000,
                                "maxH": 10000,
                                "minDPI": 72,
                                "maxSize": 10,
                                "isCustom": true,
                                "_addToUZ": null,
                                "_isInitial": false,
                                "source": img,
                                "title": "1588180146.png",
                                "id": "1588180240318",
                                "cornerColor": "#f5f5f5",
                                "cornerIconColor": "#000000",
                                "selectable": false,
                                "lockRotation": true,
                                "hasRotatingPoint": false,
                                "lockScalingX": true,
                                "lockScalingY": true,
                                "lockMovementX": true,
                                "lockMovementY": true,
                                "hasControls": false,
                                "evented": false,
                                "lockScalingFlip": true,
                                "crossOrigin": ""
                            },
                            "originX": "center",
                            "originY": "center",
                            "padding": 0,
                            "patterns": [],
                            "price": 4,
                            "removable": true,
                            "replace": "",
                            "replaceInAllViews": false,
                            "resizable": true,
                            "resizeToH": "300",
                            "resizeToW": "300",
                            "rotatable": true,
                            "scaleMode": "cover",
                            "scaleX": 1.5,
                            "scaleY": 1.5,
                            "showInColorSelection": false,
                            "sku": "",
                            "top": 300,
                            "topped": false,
                            "uniScalingUnlockable": false,
                            "uploadZone": false,
                            "uploadZoneMovable": false,
                            "uploadZoneRemovable": false,
                            "width": 200,
                            "z": -1,
                            "zChangeable": true,
                            "topLeftX": 250,
                            "topLeftY": 150
                        },
                        "type": "image"
                    },
                    {
                        "title": "Shadow",
                        "source": "/images/color_shirt/Shadow4.png",
                        "parameters": {
                            "advancedEditing": false,
                            "angle": 0,
                            "autoCenter": false,
                            "autoSelect": false,
                            "boundingBox": false,
                            "boundingBoxMode": "inside",
                            "colorLinkGroup": false,
                            "colorPrices": {},
                            "colors": "",
                            "copyable": false,
                            "cornerSize": 24,
                            "draggable": false,
                            "evented": false,
                            "excludeFromExport": false,
                            "fill": false,
                            "filter": null,
                            "flipX": false,
                            "flipY": false,
                            "height": 539,
                            "left": 400,
                            "lockUniScaling": true,
                            "locked": true,
                            "minScaleLimit": 0.01,
                            "objectCaching": false,
                            "opacity": 1,
                            "originParams": {
                                "objectCaching": false,
                                "z": 4,
                                "price": 0,
                                "colors": "",
                                "removable": false,
                                "draggable": false,
                                "rotatable": false,
                                "resizable": false,
                                "copyable": false,
                                "zChangeable": false,
                                "boundingBox": false,
                                "boundingBoxMode": "inside",
                                "autoCenter": false,
                                "replace": "",
                                "replaceInAllViews": false,
                                "autoSelect": false,
                                "topped": true,
                                "colorPrices": {},
                                "colorLinkGroup": false,
                                "patterns": [],
                                "sku": "",
                                "excludeFromExport": false,
                                "showInColorSelection": false,
                                "locked": true,
                                "uniScalingUnlockable": false,
                                "originX": "center",
                                "originY": "center",
                                "cornerSize": 24,
                                "fill": false,
                                "lockUniScaling": true,
                                "pattern": false,
                                "top": 300,
                                "left": 400,
                                "angle": 0,
                                "flipX": false,
                                "flipY": false,
                                "opacity": 1,
                                "scaleX": 1,
                                "scaleY": 1,
                                "uploadZone": false,
                                "filter": null,
                                "scaleMode": "fit",
                                "resizeToW": "0",
                                "resizeToH": "0",
                                "advancedEditing": false,
                                "uploadZoneMovable": false,
                                "uploadZoneRemovable": false,
                                "padding": 0,
                                "minScaleLimit": 0.01,
                                "customAdds": [],
                                "_isInitial": true,
                                "source": "/images/color_shirt/Shadow4.png",
                                "title": "Shadow",
                                "id": "1588100453491",
                                "cornerColor": "#f5f5f5",
                                "cornerIconColor": "#000000",
                                "selectable": false,
                                "lockRotation": true,
                                "hasRotatingPoint": false,
                                "lockScalingX": true,
                                "lockScalingY": true,
                                "lockMovementX": true,
                                "lockMovementY": true,
                                "hasControls": false,
                                "evented": false,
                                "lockScalingFlip": true,
                                "crossOrigin": ""
                            },
                            "originX": "center",
                            "originY": "center",
                            "padding": 0,
                            "patterns": [],
                            "price": 0,
                            "removable": false,
                            "replace": "",
                            "replaceInAllViews": false,
                            "resizable": false,
                            "resizeToH": "0",
                            "resizeToW": "0",
                            "rotatable": false,
                            "scaleMode": "fit",
                            "scaleX": 1,
                            "scaleY": 1,
                            "showInColorSelection": false,
                            "sku": "",
                            "top": 300,
                            "topped": true,
                            "uniScalingUnlockable": false,
                            "uploadZone": false,
                            "uploadZoneMovable": false,
                            "uploadZoneRemovable": false,
                            "width": 596,
                            "z": -1,
                            "zChangeable": false,
                            "topLeftX": 102,
                            "topLeftY": 30.5
                        },
                        "type": "image"
                    }
                ],
                "options": {
                    "stageWidth": 800,
                    "stageHeight": 600,

                    "customImageParameters": {
                        "minW": 100,
                        "minH": 100,
                        "maxW": 10000,
                        "maxH": 10000,
                        "minDPI": 72,
                        "maxSize": 10,
                        "left": 0,
                        "top": 0,
                        "z": -1,
                        "minScaleLimit": 0.01,
                        "price": 4,
                        "replaceInAllViews": false,
                        "autoCenter": true,
                        "draggable": true,
                        "rotatable": true,
                        "resizable": true,
                        "zChangeable": true,
                        "autoSelect": false,
                        "topped": false,
                        "uniScalingUnlockable": false,
                        "boundingBoxMode": "inside",
                        "scaleMode": "cover",
                        "removable": true,
                        "resizeToW": "300",
                        "resizeToH": "300",
                        "advancedEditing": true,
                        "filter": "none"
                    },
                    "maxPrice": -1,
                    "optionalView": false,
                    "designCategories": [],
                    "printingBox": {},
                    "layouts": []
                },
            }
            $back = {
                "title": "Back",
                "thumbnail": "/images/color_shirt/color/back/base.png",
                "elements": [
                    {
                        "title": "Back Shadow",
                        "source": "/images/color_shirt/shadows2.png",
                        "parameters": {
                            "advancedEditing": false,
                            "angle": 0,
                            "autoCenter": false,
                            "autoSelect": false,
                            "boundingBox": "0",
                            "boundingBoxMode": "inside",
                            "colorLinkGroup": false,
                            "colorPrices": {},
                            "colors": "",
                            "copyable": false,
                            "cornerSize": 24,
                            "draggable": false,
                            "evented": false,
                            "excludeFromExport": false,
                            "fill": false,
                            "filter": false,
                            "flipX": false,
                            "flipY": false,
                            "height": 668,
                            "left": 400,
                            "lockUniScaling": true,
                            "locked": false,
                            "minScaleLimit": 0.01,
                            "objectCaching": false,
                            "opacity": 1,
                            "originParams": {
                                "objectCaching": false,
                                "z": 0,
                                "price": 0,
                                "colors": "",
                                "removable": false,
                                "draggable": false,
                                "rotatable": false,
                                "resizable": false,
                                "copyable": false,
                                "zChangeable": false,
                                "boundingBox": "0",
                                "boundingBoxMode": "inside",
                                "autoCenter": false,
                                "replace": "",
                                "replaceInAllViews": false,
                                "autoSelect": false,
                                "topped": false,
                                "colorPrices": {},
                                "colorLinkGroup": false,
                                "patterns": [],
                                "sku": "",
                                "excludeFromExport": false,
                                "showInColorSelection": false,
                                "locked": false,
                                "uniScalingUnlockable": false,
                                "originX": "center",
                                "originY": "center",
                                "cornerSize": 24,
                                "fill": false,
                                "lockUniScaling": true,
                                "pattern": false,
                                "top": 316,
                                "left": 400,
                                "angle": 0,
                                "flipX": false,
                                "flipY": false,
                                "opacity": 1,
                                "scaleX": 1,
                                "scaleY": 1,
                                "uploadZone": false,
                                "filter": false,
                                "scaleMode": "fit",
                                "resizeToW": "0",
                                "resizeToH": "0",
                                "advancedEditing": false,
                                "uploadZoneMovable": false,
                                "uploadZoneRemovable": false,
                                "padding": 0,
                                "minScaleLimit": 0.01,
                                "customAdds": [],
                                "_isInitial": true,
                                "source": "/images/color_shirt/shadows2.png",
                                "title": "Back Shadow",
                                "id": "1588100453520",
                                "cornerColor": "#f5f5f5",
                                "cornerIconColor": "#000000",
                                "selectable": false,
                                "lockRotation": true,
                                "hasRotatingPoint": false,
                                "lockScalingX": true,
                                "lockScalingY": true,
                                "lockMovementX": true,
                                "lockMovementY": true,
                                "hasControls": false,
                                "evented": false,
                                "lockScalingFlip": true,
                                "crossOrigin": ""
                            },
                            "originX": "center",
                            "originY": "center",
                            "padding": 0,
                            "patterns": [],
                            "price": 0,
                            "removable": false,
                            "replace": "",
                            "replaceInAllViews": false,
                            "resizable": false,
                            "resizeToH": "0",
                            "resizeToW": "0",
                            "rotatable": false,
                            "scaleMode": "fit",
                            "scaleX": 1,
                            "scaleY": 1,
                            "showInColorSelection": false,
                            "sku": "",
                            "top": 316,
                            "topped": false,
                            "uniScalingUnlockable": false,
                            "uploadZone": false,
                            "uploadZoneMovable": false,
                            "uploadZoneRemovable": false,
                            "width": 731,
                            "z": -1,
                            "zChangeable": false,
                            "topLeftX": 34.5,
                            "topLeftY": -18
                        },
                        "type": "image"
                    },
                    {
                        "title": "Shirt",
                        "source": "/images/color_shirt/color/back/base.png",
                        "parameters": {
                            "advancedEditing": false,
                            "angle": 0,
                            "autoCenter": false,
                            "autoSelect": false,
                            "boundingBox": "0",
                            "boundingBoxMode": "inside",
                            "colorLinkGroup": "base",
                            "colorPrices": {},
                            "colors": "",
                            "copyable": false,
                            "cornerSize": 24,
                            "draggable": false,
                            "evented": true,
                            "excludeFromExport": false,
                            "fill": $tcolor,
                            "filter": false,
                            "flipX": false,
                            "flipY": false,
                            "height": 543,
                            "isEditable": true,
                            "left": 400,
                            "lockUniScaling": true,
                            "locked": false,
                            "minScaleLimit": 0.01,
                            "objectCaching": false,
                            "opacity": 1,
                            "originParams": {
                                "objectCaching": false,
                                "z": 1,
                                "price": 0,
                                "colors": "",
                                "removable": false,
                                "draggable": false,
                                "rotatable": false,
                                "resizable": false,
                                "copyable": false,
                                "zChangeable": false,
                                "boundingBox": "0",
                                "boundingBoxMode": "inside",
                                "autoCenter": false,
                                "replace": "",
                                "replaceInAllViews": false,
                                "autoSelect": false,
                                "topped": false,
                                "colorPrices": {},
                                "colorLinkGroup": "base",
                                "patterns": [],
                                "sku": "",
                                "excludeFromExport": false,
                                "showInColorSelection": false,
                                "locked": false,
                                "uniScalingUnlockable": false,
                                "originX": "center",
                                "originY": "center",
                                "cornerSize": 24,
                                "fill": false,
                                "lockUniScaling": true,
                                "pattern": false,
                                "top": 300,
                                "left": 400,
                                "angle": 0,
                                "flipX": false,
                                "flipY": false,
                                "opacity": 1,
                                "scaleX": 1,
                                "scaleY": 1,
                                "uploadZone": false,
                                "filter": false,
                                "scaleMode": "fit",
                                "resizeToW": "0",
                                "resizeToH": "0",
                                "advancedEditing": false,
                                "uploadZoneMovable": false,
                                "uploadZoneRemovable": false,
                                "padding": 0,
                                "minScaleLimit": 0.01,
                                "customAdds": [],
                                "_isInitial": true,
                                "source": "/images/color_shirt/color/back/base.png",
                                "title": "Shirt",
                                "id": "1588100453544",
                                "cornerColor": "#f5f5f5",
                                "cornerIconColor": "#000000",
                                "selectable": false,
                                "lockRotation": true,
                                "hasRotatingPoint": false,
                                "lockScalingX": true,
                                "lockScalingY": true,
                                "lockMovementX": true,
                                "lockMovementY": true,
                                "hasControls": false,
                                "evented": false,
                                "lockScalingFlip": true,
                                "crossOrigin": ""
                            },
                            "originX": "center",
                            "originY": "center",
                            "padding": 0,
                            "patterns": [],
                            "price": 0,
                            "removable": false,
                            "replace": "",
                            "replaceInAllViews": false,
                            "resizable": false,
                            "resizeToH": "0",
                            "resizeToW": "0",
                            "rotatable": false,
                            "scaleMode": "fit",
                            "scaleX": 1,
                            "scaleY": 1,
                            "showInColorSelection": false,
                            "sku": "",
                            "top": 300,
                            "topped": false,
                            "uniScalingUnlockable": false,
                            "uploadZone": false,
                            "uploadZoneMovable": false,
                            "uploadZoneRemovable": false,
                            "width": 602,
                            "z": -1,
                            "zChangeable": false,
                            "topLeftX": 99,
                            "topLeftY": 28.5
                        },
                        "type": "image"
                    },
                    {
                        "title": "Shadow",
                        "source": "/images/color_shirt/over_shadow1.png",
                        "parameters": {
                            "advancedEditing": false,
                            "angle": 0,
                            "autoCenter": false,
                            "autoSelect": false,
                            "boundingBox": "0",
                            "boundingBoxMode": "inside",
                            "colorLinkGroup": false,
                            "colorPrices": {},
                            "colors": "",
                            "copyable": false,
                            "cornerSize": 24,
                            "draggable": false,
                            "evented": false,
                            "excludeFromExport": false,
                            "fill": false,
                            "filter": false,
                            "flipX": false,
                            "flipY": false,
                            "height": 543,
                            "left": 400,
                            "lockUniScaling": true,
                            "locked": false,
                            "minScaleLimit": 0.01,
                            "objectCaching": false,
                            "opacity": 1,
                            "originParams": {
                                "objectCaching": false,
                                "z": 2,
                                "price": 0,
                                "colors": "",
                                "removable": false,
                                "draggable": false,
                                "rotatable": false,
                                "resizable": false,
                                "copyable": false,
                                "zChangeable": false,
                                "boundingBox": "0",
                                "boundingBoxMode": "inside",
                                "autoCenter": false,
                                "replace": "",
                                "replaceInAllViews": false,
                                "autoSelect": false,
                                "topped": true,
                                "colorPrices": {},
                                "colorLinkGroup": false,
                                "patterns": [],
                                "sku": "",
                                "excludeFromExport": false,
                                "showInColorSelection": false,
                                "locked": false,
                                "uniScalingUnlockable": false,
                                "originX": "center",
                                "originY": "center",
                                "cornerSize": 24,
                                "fill": false,
                                "lockUniScaling": true,
                                "pattern": false,
                                "top": 300,
                                "left": 400,
                                "angle": 0,
                                "flipX": false,
                                "flipY": false,
                                "opacity": 1,
                                "scaleX": 1,
                                "scaleY": 1,
                                "uploadZone": false,
                                "filter": false,
                                "scaleMode": "fit",
                                "resizeToW": "0",
                                "resizeToH": "0",
                                "advancedEditing": false,
                                "uploadZoneMovable": false,
                                "uploadZoneRemovable": false,
                                "padding": 0,
                                "minScaleLimit": 0.01,
                                "customAdds": [],
                                "_isInitial": true,
                                "source": "/images/color_shirt/over_shadow1.png",
                                "title": "Shadow",
                                "id": "1588100453556",
                                "cornerColor": "#f5f5f5",
                                "cornerIconColor": "#000000",
                                "selectable": false,
                                "lockRotation": true,
                                "hasRotatingPoint": false,
                                "lockScalingX": true,
                                "lockScalingY": true,
                                "lockMovementX": true,
                                "lockMovementY": true,
                                "hasControls": false,
                                "evented": false,
                                "lockScalingFlip": true,
                                "crossOrigin": ""
                            },
                            "originX": "center",
                            "originY": "center",
                            "padding": 0,
                            "patterns": [],
                            "price": 0,
                            "removable": false,
                            "replace": "",
                            "replaceInAllViews": false,
                            "resizable": false,
                            "resizeToH": "0",
                            "resizeToW": "0",
                            "rotatable": false,
                            "scaleMode": "fit",
                            "scaleX": 1,
                            "scaleY": 1,
                            "showInColorSelection": false,
                            "sku": "",
                            "top": 300,
                            "topped": true,
                            "uniScalingUnlockable": false,
                            "uploadZone": false,
                            "uploadZoneMovable": false,
                            "uploadZoneRemovable": false,
                            "width": 602,
                            "z": -1,
                            "zChangeable": false,
                            "topLeftX": 99,
                            "topLeftY": 28.5
                        },
                        "type": "image"
                    }
                ],
                "options": {
                    "stageWidth": 800,
                    "stageHeight": 600,
                    "customAdds": {
                        "designs": true,
                        "uploads": true,
                        "texts": true,
                        "drawing": true
                    },
                    "customImageParameters": {
                        "minW": 100,
                        "minH": 100,
                        "maxW": 10000,
                        "maxH": 10000,
                        "minDPI": 72,
                        "maxSize": 10,
                        "left": 0,
                        "top": 0,
                        "z": -1,
                        "minScaleLimit": 0.01,
                        "price": 4,
                        "replaceInAllViews": false,
                        "autoCenter": true,
                        "draggable": true,
                        "rotatable": true,
                        "resizable": true,
                        "zChangeable": true,
                        "autoSelect": false,
                        "topped": false,
                        "uniScalingUnlockable": false,
                        "boundingBoxMode": "inside",
                        "scaleMode": "cover",
                        "removable": true,
                        "resizeToW": "300",
                        "resizeToH": "300",
                        "advancedEditing": true,
                        "filter": "none"
                    },
                    "customTextParameters": {
                        "left": 0,
                        "top": 0,
                        "z": -1,
                        "colors": "#000",
                        "price": 2,
                        "autoCenter": true,
                        "draggable": true,
                        "rotatable": true,
                        "resizable": true,
                        "zChangeable": true,
                        "autoSelect": true,
                        "topped": false,
                        "uniScalingUnlockable": false,
                        "curvable": true,
                        "curveSpacing": 10,
                        "curveRadius": 80,
                        "curveReverse": false,
                        "boundingBoxMode": "inside",
                        "fontSize": 30,
                        "minFontSize": 1,
                        "maxFontSize": 1000,
                        "widthFontSize": 0,
                        "maxLength": 0,
                        "maxLines": 0,
                        "textAlign": "left",
                        "removable": true
                    },
                    "maxPrice": -1,
                    "optionalView": false,
                    "designCategories": [],
                    "printingBox": {},
                    "layouts": []
                },
                "names_numbers": null,
                "mask": null,
                "locked": false
            }
            if (viewType == 'view'){
                $json = [[
                    $front
                ]];
            }else{
                $json = [[
                    $front,
                    $back
                ]];
            }

            return $json
        }

    </script>
@endsection
