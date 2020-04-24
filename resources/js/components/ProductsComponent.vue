<template>
    <div class="body_content_div py-5">

        <div class="most_sell_title text-center mb-4">
            <h2>{{ $t('MostSells')}}</h2>
        </div>
        <!-- Most Sells -->
        <div class="most_sell_content">
            <div class="row">
                <div
                    v-for="product in mostSells"
                    v-bind:key="product.id"
                    class="col-xl-3 col-lg-4 col-md-6">
                    <div class="t-shirt_data mb-2">
                        <span>ID : {{product.random_name}}</span>
                        <div class="t-shirt_image_div position-relative">

                            <product-designer :design="product" :type="'view-most'"></product-designer>

                            <ul
                                class="cart_ul_btn list-icon list-unstyled product_btn_div d-flex align-items-center text-center mb-0">
                                <li>
                                    <a
                                        href="#"
                                        data-id="hidden-denim-shirt"
                                        class="quickview_btn"
                                        title="Product Details"
                                        data-toggle="modal"
                                        :data-target="'#d'+product.id">
                                        <img src="/images/eye.png" alt=""/>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" @click.prevent="addToCart(product)" class="add-to-cart quickview_btn">
                                        <img
                                            src="images/add-cart.png"
                                            alt=""
                                        />
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div
                            class="t-shirt_inner_data d-flex justify-content-between align-items-center px-1 my-2">
                            <span class="t-shirt_name">{{ product.name }}</span>
                            <!-- <img
                                @click="product.favourite = !product.favourite"
                                v-if="product.favourite"
                                src="/images/like.png"
                                alt=""
                            />
                            <img
                                @click="product.favourite = !product.favourite"
                                v-else
                                src="/images/like_solid.png"
                                alt=""
                            /> -->
                        </div>
                        <div class="t-shirt_inner_price px-1 my-2">
                            <span
                                v-if="product.discount !== 0"
                                class="t-shirt_price_nosale d-none"
                            >{{ product.price | currency }}</span>
                            <span
                                v-if="product.discount === 0"
                                class="t-shirt_price_sale mx-3"
                            >{{priceDefault(product.price,product.discount) | currency }}</span
                            >
                            <span v-else class="t-shirt_price_sale mx-3"
                            >{{ priceDefault(product.price,product.discount) | currency }}</span
                            >
                        </div>
                        <div v-if="false" class="t-shirt_inner_review px-1 my-2">
                            <span
                                v-for="n in 5"
                                :key="n"
                                class="t-shirt_review_stars">
                                <i
                                    v-if="product.review === true"
                                    class="fas fa-star"
                                ></i>
                                <i v-else class="far fa-star"></i>
                            </span>
                            <span
                                v-if="product.review === false"
                                class="t-shirt_no_review_text my-5">No rating</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            v-for="product in mostSells"
            v-bind:key="product.id"
            class="modal fade"
            :id="'d'+product.id"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div
                class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                                <div
                                    class="product-img d-flex justify-content-center"
                                >
                                    <product-designer :design="product" :type="'popup'"
                                                      class="col-12"></product-designer>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="productName">{{product.name}}</h3>
                                <h5>ID: <span>{{product.random_name}}</span></h5>
                                <span
                                    class="productPrice">{{priceDefault(product.price,product.discount)|currency}}</span>
                                <p class="ProductDetails pt-3">
                                    {{product.des}}
                                </p>
                                <div class="form-action">
                                    <form method="post" class="form-group" @submit.prevent="addToCart(product)">
                                        <div class="mb-2">
                                            <label
                                                class="my-1 mr-2 font-weight-bold text-capitalize"
                                            >{{$t('print_options')}}* : </label
                                            >
                                            <div class="d-inline-block mx-2">
                                                <input class="printOpt" type="radio" :id="'front'+product.id"
                                                       value="front"
                                                       v-model="printOptions">
                                                <label class="printOpt"
                                                       :for="'front'+product.id">{{$t('Front')}}</label>
                                            </div>
                                            <div class="d-inline-block mx-2">
                                                <input class="printOpt" type="radio" :id="'back'+product.id"
                                                       value="back"
                                                       v-model="printOptions">
                                                <label class="printOpt" :for="'back'+product.id">{{$t('Back')}}</label>
                                            </div>
                                            <div class="d-inline-block mx-2">
                                                <input class="printOpt" type="radio" :id="'front_back'+product.id"
                                                       value="front_back"
                                                       v-model="printOptions">
                                                <label class="printOpt" :for="'front_back'+product.id">{{$t('Front_and_Back')}}</label>
                                            </div>
                                        </div>
                                        <div class="mb-2">

                                            <div v-if="printOptions.includes('front')">
                                                <label
                                                    class="my-1 mr-2 font-weight-bold text-capitalize"
                                                    :for="'frontSizeInputFiled'+product.id"
                                                >{{$t('front_size')}}*</label
                                                >
                                                <select
                                                    @click.prevent="frontprintPrice(frontprint)"
                                                    v-model="frontprint"
                                                    class="custom-select my-1 mr-sm-2"
                                                    :id="'frontSizeInputFiled'+product.id"
                                                >
                                                    <option :value="null" selected>- {{$t('Please_Select')}} -</option>
                                                    <option v-for="dsize in dsizes" :key="dsize.id" :value="dsize.id">
                                                        {{dsize.length}}<span> X </span>{{dsize.width}}
                                                    </option>
                                                </select>
                                            </div>

                                            <div v-if="printOptions.includes('back')">
                                                <label
                                                    class="my-1 mr-2 font-weight-bold text-capitalize"
                                                    :for="'backSizeInputFiled'+product.id"
                                                >{{$t('back_size')}}*</label
                                                >
                                                <select
                                                    @click.prevent="backprintPrice(backprint)"
                                                    v-model="backprint"
                                                    class="custom-select my-1 mr-sm-2"
                                                    :id="'backSizeInputFiled'+product.id"
                                                >
                                                    <option :value="null" selected>- {{$t('Please_Select')}} -</option>
                                                    <option v-for="dsize in dsizes" :key="dsize.id" :value="dsize.id">
                                                        {{dsize.length}}<span> X </span>{{dsize.width}}
                                                    </option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="mb-2">
                                            <label
                                                class="my-1 mr-2 font-weight-bold"
                                                :for="'colorInput'+product.id"
                                            >{{$t('TShirt_Color')}}*</label
                                            >
                                            <select
                                                v-model="tcolor"
                                                class="custom-select my-1 mr-sm-2"
                                                :id="'colorInput'+product.id"
                                            >
                                                <option :value="null" selected>- {{$t('Please_Select')}} -</option>
                                                <option v-for="color in tcolors" :key="color.id" :value="color.id">
                                                    {{color.name}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label
                                                class="my-1 mr-2 font-weight-bold"
                                                :for="'sizeInput'+product.id"
                                            >{{$t('TShirt_Size')}}*</label
                                            >
                                            <select
                                                @click.prevent="tsizePrice(tsize)"
                                                v-model="tsize"
                                                class="custom-select my-1 mr-sm-2"
                                                :id="'sizeInput'+product.id"
                                            >
                                                <option :value="null" selected>- {{$t('Please_Select')}} -</option>
                                                <option v-for="tsize in tsizes" :key="tsize.id" :value="tsize.id">
                                                    {{tsize.name}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-3">
                                                <input
                                                    v-model="count"
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
                                                    style="outline: none;"
                                                >
                                                    <i
                                                        class="fas fa-shopping-cart"
                                                    ></i>
                                                    {{$t('Add_to_cart')}}
                                                </button>

                                            </div>
                                            <h5 class="productPrice" style="margin-top:10px">{{$t('total')}} :
                                                <span class="productPrice">{{count*(tsizes_price+frontprintprice+backprintprice+priceDis(product.price,product.discount))|currency}}</span>
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

        <div class="most_sell_title text-center mb-4">
            <h2>{{ $t('Designs')}}</h2>
        </div>
        <!-- Products -->
        <div class="most_sell_content">
            <div class="row">
                <div
                    v-for="product in products"
                    v-bind:key="product.id"
                    class="col-xl-3 col-lg-4 col-md-6"
                >
                    <div class="t-shirt_data mb-2">
                        <span>ID : {{product.random_name}}</span>
                        <div class="t-shirt_image_div position-relative">

                            <product-designer :design="product" :type="'view'"></product-designer>

                            <ul
                                class="cart_ul_btn list-icon list-unstyled product_btn_div d-flex align-items-center text-center mb-0"
                            >
                                <li>
                                    <a
                                        href="#"
                                        data-id="hidden-denim-shirt"
                                        class="quickview_btn"
                                        title="Product Details"
                                        data-toggle="modal"
                                        :data-target="'#d'+product.id"
                                    >
                                        <img src="/images/eye.png" alt=""/>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" @click.prevent="addToCart(product)" class="add-to-cart quickview_btn">
                                        <img
                                            src="images/add-cart.png"
                                            alt=""
                                        />
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div
                            class="t-shirt_inner_data d-flex justify-content-between align-items-center px-1 my-2"
                        >
                            <span class="t-shirt_name">{{ product.name }}</span>
                            <!-- <img
                                @click="product.favourite = !product.favourite"
                                v-if="product.favourite"
                                src="/images/like.png"
                                alt=""
                            />
                            <img
                                @click="product.favourite = !product.favourite"
                                v-else
                                src="/images/like_solid.png"
                                alt=""
                            /> -->
                        </div>
                        <div class="t-shirt_inner_price px-1 my-2">
                            <span
                                v-if="product.discount !== 0"
                                class="t-shirt_price_nosale d-none"
                            >{{ product.price | currency }}</span>
                            <span
                                v-if="product.discount === 0"
                                class="t-shirt_price_sale mx-3"
                            >{{priceDefault(product.price,product.discount) | currency }}</span
                            >
                            <span v-else class="t-shirt_price_sale mx-3"
                            >{{ priceDefault(product.price,product.discount) | currency }}</span
                            >
                        </div>
                        <div v-if="false" class="t-shirt_inner_review px-1 my-2">
                            <span
                                v-for="n in 5"
                                :key="n"
                                class="t-shirt_review_stars"
                            >
                                <i
                                    v-if="product.review === true"
                                    class="fas fa-star"
                                ></i>
                                <i v-else class="far fa-star"></i>
                            </span>
                            <span
                                v-if="product.review === false"
                                class="t-shirt_no_review_text my-5"
                            >No rating</span
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="pagination.next_page_url !== null && products.length"
             class="mt-3 get-more d-flex justify-content-center">
            <span @click="fetchProducts(pagination.next_page_url)" style="cursor: pointer"
                  class="font-weight-bold text-capitalize">Load More <i class="fas fa-arrow-down"></i></span>
        </div>
        <div v-if=" pagination.next_page_url === null && products.length"
             class="mt-3 get-more d-flex justify-content-center">
            <span class="font-weight-bold text-capitalize text-muted">No More Data</span>
        </div>

        <div
            v-for="product in products"
            v-bind:key="product.id"
            class="modal fade"
            :id="'d'+product.id"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-lg"
                role="document"
            >
                <div class="modal-content bg-white">
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="content">
                        <div class="row p-3">
                            <div class="col-md-6 h-100">
                                <div
                                    class="product-img d-flex justify-content-center"
                                >
                                    <product-designer :design="product" :type="'popup'"
                                                      class="col-12"></product-designer>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="productName">{{product.name}}</h3>
                                <h5>ID: <span>{{product.random_name}}</span></h5>
                                <span
                                    class="productPrice">{{priceDefault(product.price,product.discount)|currency}}</span>
                                <p class="ProductDetails pt-3">
                                    {{product.des}}
                                </p>
                                <div class="form-action">
                                    <form method="post" class="form-group" @submit.prevent="addToCart(product)">
                                        <div class="mb-2">
                                            <label
                                                class="my-1 mr-2 font-weight-bold text-capitalize"
                                            >{{$t('print_options')}}* : </label
                                            >
                                            <div class="d-inline-block mx-2">
                                                <input class="printOpt" type="radio" :id="'front'+product.id"
                                                       value="front"
                                                       v-model="printOptions">
                                                <label class="printOpt"
                                                       :for="'front'+product.id">{{$t('Front')}}</label>
                                            </div>
                                            <div class="d-inline-block mx-2">
                                                <input class="printOpt" type="radio" :id="'back'+product.id"
                                                       value="back"
                                                       v-model="printOptions">
                                                <label class="printOpt" :for="'back'+product.id">{{$t('Back')}}</label>
                                            </div>
                                            <div class="d-inline-block mx-2">
                                                <input class="printOpt" type="radio" :id="'front_back'+product.id"
                                                       value="front_back"
                                                       v-model="printOptions">
                                                <label class="printOpt" :for="'front_back'+product.id">{{$t('Front_and_Back')}}</label>
                                            </div>
                                        </div>
                                        <div class="mb-2">

                                            <div v-if="printOptions.includes('front')">
                                                <label
                                                    class="my-1 mr-2 font-weight-bold text-capitalize"
                                                    :for="'frontSizeInputFiled'+product.id"
                                                >{{$t('front_size')}}*</label
                                                >
                                                <select
                                                    @click.prevent="frontprintPrice(frontprint)"
                                                    v-model="frontprint"
                                                    class="custom-select my-1 mr-sm-2"
                                                    :id="'frontSizeInputFiled'+product.id"
                                                >
                                                    <option :value="null" selected>- {{$t('Please_Select')}} -</option>
                                                    <option v-for="dsize in dsizes" :key="dsize.id" :value="dsize.id">
                                                        {{dsize.length}}<span> X </span>{{dsize.width}}
                                                    </option>
                                                </select>
                                            </div>

                                            <div v-if="printOptions.includes('back')">
                                                <label
                                                    class="my-1 mr-2 font-weight-bold text-capitalize"
                                                    :for="'backSizeInputFiled'+product.id"
                                                >{{$t('back_size')}}*</label
                                                >
                                                <select
                                                    @click.prevent="backprintPrice(backprint)"
                                                    v-model="backprint"
                                                    class="custom-select my-1 mr-sm-2"
                                                    :id="'backSizeInputFiled'+product.id"
                                                >
                                                    <option :value="null" selected>- {{$t('Please_Select')}} -</option>
                                                    <option v-for="dsize in dsizes" :key="dsize.id" :value="dsize.id">
                                                        {{dsize.length}}<span> X </span>{{dsize.width}}
                                                    </option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="mb-2">
                                            <label
                                                class="my-1 mr-2 font-weight-bold"
                                                :for="'colorInput'+product.id"
                                            >{{$t('TShirt_Color')}}*</label
                                            >
                                            <select
                                                v-model="tcolor"
                                                class="custom-select my-1 mr-sm-2"
                                                :id="'colorInput'+product.id"
                                            >
                                                <option :value="null" selected>- {{$t('Please_Select')}} -</option>
                                                <option v-for="color in tcolors" :key="color.id" :value="color.id">
                                                    {{color.name}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label
                                                class="my-1 mr-2 font-weight-bold"
                                                :for="'sizeInput'+product.id"
                                            >{{$t('TShirt_Size')}}*</label
                                            >
                                            <select
                                                @click.prevent="tsizePrice(tsize)"
                                                v-model="tsize"
                                                class="custom-select my-1 mr-sm-2"
                                                :id="'sizeInput'+product.id"
                                            >
                                                <option :value="null" selected>- {{$t('Please_Select')}} -</option>
                                                <option v-for="tsize in tsizes" :key="tsize.id" :value="tsize.id">
                                                    {{tsize.name}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-3">
                                                <input
                                                    v-model="count"
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
                                                    style="outline: none;"
                                                >
                                                    <i
                                                        class="fas fa-shopping-cart"
                                                    ></i>
                                                    {{$t('Add_to_cart')}}
                                                </button>

                                            </div>
                                            <h5 class="productPrice" style="margin-top:10px">{{$t('total')}} :
                                                <span class="productPrice">{{count*(tsizes_price+frontprintprice+backprintprice+priceDis(product.price,product.discount))|currency}}</span>
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
    </div>
</template>

<script>
    export default {
        data() {
            return {

                productColours: ['Black', 'White', 'Orange', 'Yellow'],
                products: [],
                mostSells: [],
                pagination: {},
                printOptions: "front",
                frontprint: null,
                backprint: null,
                tcolor: null,
                tsize: null,
                count: 1,
                tcolors: null,
                dsizes: null,
                tsizes: null,
                printprice: null,
                frontprintprice: 0,
                backprintprice: 0,
                tsizeprice: null,
                tsizes_price: 0,
                default_frontprint: null,
                default_tsize: null


            };
        },
        props: [],
        methods: {
            feachMostSells: function () {
                let _this = this;
                axios.get('/api/v1/most-sells').then(function (response) {
                    _this.mostSells = response.data;
                    console.log(response);
                })
            },
            addToCart: function (product) {
                let root = this.$root;
                axios.post(`api/v1/add-to-cart/${product.id}`, {
                    id: product.id,
                    frontprint: this.frontprint,
                    backprint: this.backprint,
                    tcolor: this.tcolor,
                    tsize: this.tsize,
                    count: this.count,
                }).then(function (response) {
                    root.updateCart();
                }).catch((error) => {
                    console.log(error);
                });
                console.log('Add To Cart');
            },
            frontprintPrice: function (dsize_id) {
                axios.get(`api/v1/dsize/${dsize_id}`).then(response => {
                    this.printprice = response.data;
                    this.frontprintprice = 0 | this.printprice.print_price
                });

            },
            backprintPrice: function (dsize_id) {
                axios.get(`api/v1/dsize/${dsize_id}`).then(response => {
                    this.printprice = response.data;
                    this.backprintprice = 0 | this.printprice.print_price
                });

            },
            tsizePrice: function (tsize_id) {
                axios.get(`api/v1/tsize/${tsize_id}`).then(response => {
                    this.tsizeprice = response.data;
                    this.tsizes_price = 0 | this.tsizeprice.price;
                    console.log(this.tsizeprice);
                });
            },
            fetchProducts(page_url) {
                let vm = this;
                page_url = page_url || 'api/v1/design';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.products = this.products.concat(res.data);
                        vm.makePagination(res.next_page_url);
                    })
                    .catch(err => console.log(err));
            },
            makePagination(next_page_url) {
                let pagination = {
                    next_page_url: next_page_url,
                };
                this.pagination = pagination;
            },
            priceDis: function (price, discount) {
                if (this.frontprintprice && this.tsizes_price > 0) {
                    return price - (price * discount)
                } else if (this.frontprintprice > 0) {
                    return price - (price * discount) + this.$root.default_tsize
                } else if (this.tsizes_price > 0) {
                    return price - (price * discount) + this.$root.default_frontprint
                } else {
                    return price - (price * discount) + this.$root.default_tsize + this.$root.default_frontprint;
                }
            },
            priceDefault: function (price, discount) {
                return price - (price * discount) + this.$root.default_tsize + this.$root.default_frontprint;
            }
        },
        created() {
            this.fetchProducts();
            this.feachMostSells();
        },
        mounted() {
            axios.get('api/v1/color').then(response => {
                this.tcolors = response.data;
            });
            axios.get('api/v1/dsize').then(response => {
                this.dsizes = response.data;
            });
            axios.get('api/v1/tsize').then(response => {
                this.tsizes = response.data;
            });
            axios.get("api/v1/default-tsizeprice").then(response => {
                this.default_tsize = response.data;
                this.tsize = response.data.id;
            });
            axios.get("api/v1/default-printprice").then(response => {
                this.default_frontprint = response.data;
                this.frontprint = response.data.id;
            });
            axios.get("api/v1/default-tcolor").then(response => {
                this.tcolor = response.data.id;
            });

        },
        computed: {},
        filters: {}
    };
</script>

<style lang="scss">
    .body_content_div {
        padding: 25px 15px;
    }

    .most_sell_title {
        color: #7a7a7a;
        font-family: "titles_font", sans-serif;
    }

    .t-shirt_data {
        border: 1px solid #eeeeee;
        padding: 10px;

        .t-shirt_image_div {
            .product-img {
                min-height: 250px;
                max-height: 260px;
                border-bottom: 1px solid #eeeeee;
            }
        }

    }

    .t-shirt_inner_data img {
        width: 16px;
        height: 16px;
        cursor: pointer;
    }


    .t-shirt_name {
        font-size: 22px;
    }

    .t-shirt_review_stars {
        color: gold;
        cursor: pointer;
    }

    .t-shirt_no_review_text {
        font-size: 18px;
        color: #999;
    }

    .t-shirt_price_sale,
    .t-shirt_price_nosale {
        font-size: 18px;
    }

    .t-shirt_price_nosale {
        text-decoration: line-through;
        color: #909090;
    }

    .product_btn_div {
        padding: 0;
        position: absolute;
        transform: translate(-50%);
        left: 50%;
        bottom: -10%;
        opacity: 0;
        visibility: hidden;
        transition: all 0.5s ease;
        background: #fff;
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.08);
        border-radius: 15px;
    }

    .t-shirt_image_div:hover .product_btn_div {
        opacity: 1;
        visibility: visible;
        bottom: 10px;
    }

    .product_btn_div li a,
    .product_btn_div li button {
        display: inline-block;
        padding: 10px 15px;
        width: 65px;
        height: 50px;
    }

    .add_to_cart_btn img {
        height: 23px;
    }

    .product_btn_div .add_to_cart_btn {
        background-color: transparent;
        border: 0;
    }

    .quickview_btn img {
        height: 25px;
    }

    .cart_ul_btn li:first-child {
        border-left: 1px solid #ccc;
    }

    /*    product modal*/

    .modal {
        .modal-content {
            .close {
                font-size: 2.4rem;
                line-height: 1.2;
                color: #122d65;
                position: absolute;
                top: -5px;
                right: 15px;
            }

            .productPrice {
                color: #227dc7;
                font-weight: bold;
                font-size: 24px;
            }
        }
    }

    #main-container {
        margin: 40px auto;
        width: 1200px;
        max-width: 100%;
    }

    .api-buttons > a {
        margin: 0 5px 0 0 !important;
        text-decoration: none !important;
    }

    .price {
        font-size: 24px !important;
        line-height: 26px !important;
    }
</style>
