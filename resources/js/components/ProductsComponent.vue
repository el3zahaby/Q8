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
          v-bind:key="product.design.id"
          class="col-xl-3 col-lg-4 col-md-6"
        >
          <div class="t-shirt_data mb-2">
            <span>ID : {{product.design.id}}</span>
            <div class="t-shirt_image_div position-relative">
              <product-designer v-bind:design="product.design" :type="'view'"></product-designer>
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
                    :data-target="'#d'+product.design.id"
                  >
                    <img src="/images/eye.png" alt />
                  </a>
                </li>
                <li>
                  <a
                    href="#"
                    data-id="hidden-denim-shirt"
                    class="quickview_btn"
                    title="Product Details"
                    data-toggle="modal"
                    :data-target="'#d'+product.design.id"
                  >
                    <img src="images/add-cart.png" alt />
                  </a>
                </li>
              </ul>
            </div>
            <div
              class="t-shirt_inner_data d-flex justify-content-between align-items-center px-1 my-2"
            >
              <span class="t-shirt_name">{{ product.design.name }}</span>
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
              />-->
            </div>
            <div class="t-shirt_inner_price px-1 my-2">
              <span class="t-shirt_price_nosale" v-if="product.design.discount !== 0">
                {{ (product.design.designer_price[0]? product.design.designer_price[0].total : 0) }}
                <SMALL>KWD</SMALL>
              </span>
              <span class="t-shirt_price_sale">
                {{ priceDis((product.design.designer_price[0]? product.design.designer_price[0].total : 0),product.design.discount)}}
                <SMALL>KWD</SMALL>
              </span>
            </div>
            <div v-if="false" class="t-shirt_inner_review px-1 my-2">
              <span v-for="n in 5" :key="n" class="t-shirt_review_stars">
                <i v-if="product.review === true" class="fas fa-star"></i>
                <i v-else class="far fa-star"></i>
              </span>
              <span v-if="product.review === false" class="t-shirt_no_review_text my-5">No rating</span>
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
          v-for="product in getproducts"
          v-bind:key="product.design.id"
          class="col-xl-3 col-lg-4 col-md-6"
        >
          <div class="t-shirt_data mb-2">
            <span>ID : {{product.design.id}}</span>
            <div class="t-shirt_image_div position-relative">
              <product-designer v-bind:design="product.design" :type="'view'"></product-designer>
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
                    :data-target="'#d'+product.design.id"
                  >
                    <img src="/images/eye.png" alt />
                  </a>
                </li>
                <li>
                  <a
                    href="#"
                    data-id="hidden-denim-shirt"
                    class="quickview_btn"
                    title="Product Details"
                    data-toggle="modal"
                    :data-target="'#d'+product.design.id"
                  >
                    <img src="images/add-cart.png" alt />
                  </a>
                </li>
              </ul>
            </div>
            <div
              class="t-shirt_inner_data d-flex justify-content-between align-items-center px-1 my-2"
            >
              <span class="t-shirt_name">{{ product.design.name }}</span>
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
              />-->
            </div>
            <div class="t-shirt_inner_price px-1 my-2">
              <span class="t-shirt_price_nosale" v-if="product.design.discount !== 0">
                {{ (product.design.designer_price[0]? product.design.designer_price[0].total : 0) }}
                <small>KWD</small>
              </span>
              <span class="t-shirt_price_sale">
                {{ priceDis((product.design.designer_price[0]? product.design.designer_price[0].total : 0),product.design.discount)}}
                <small>KWD</small>
              </span>
            </div>
            <div v-if="false" class="t-shirt_inner_review px-1 my-2">
              <span v-for="n in 5" :key="n" class="t-shirt_review_stars">
                <i v-if="product.review === true" class="fas fa-star"></i>
                <i v-else class="far fa-star"></i>
              </span>
              <span v-if="product.review === false" class="t-shirt_no_review_text my-5">No rating</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      v-if="pagination.next_page_url !== null && products.length"
      class="mt-3 get-more d-flex justify-content-center"
    >
      <span
        @click="fetchProducts(pagination.next_page_url)"
        style="cursor: pointer"
        class="font-weight-bold text-capitalize"
      >
        Load More
        <i class="fas fa-arrow-down"></i>
      </span>
    </div>
    <div
      v-if="pagination.next_page_url === null && products.length"
      class="mt-3 get-more d-flex justify-content-center"
    >
      <span class="font-weight-bold text-capitalize text-muted">No More Data</span>
    </div>
    <div
      v-for="product in products"
      v-bind:key="product.id"
      class="modal fade"
      :id="'d'+product.design.id"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myExtraLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-white">
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            style="z-index:2;"
          >
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="content">
            <div class="row p-3">
              <div class="col-md-6 h-100">
                <div class="product-img d-flex justify-content-center">
                  <product-designer
                    :design="product.design"
                    v-bind:key="tcolor.name"
                    :type="'popup'"
                    v-bind:ccolor="tcolor"
                    class="col-12"
                  ></product-designer>
                </div>
              </div>
              <div :class="'col-md-6 '+ $t('text-left')" style="z-index:1;">
                <h3 class="productName">{{product.design.name}}</h3>
                <h5>
                  ID:
                  <span>{{product.design.id}}</span>
                </h5>
                
				<span
                          class="productPrice"
                        >{{(count* priceDis(tsizes_price+frontprintprice+backprintprice,product.design.discount) +'KWD')}}</span>
                <p class="ProductDetails pt-3">{{product.design.desc }}</p>
                <div class="form-action">
                  <form method="post" class="form-group" @submit.prevent="addToCart(product)">
                    <div class="mb-2">
                      <label
                        class="my-1 mr-2 font-weight-bold text-capitalize"
                      >{{$t('print_options')}}* :</label>
                      <div class="d-inline-block mx-2">
                        <input
                          class="printOpt"
                          type="radio"
                          :id="'front'+product.id"
                          value="front"
                          @click="printOpt(printOptions)"
                          v-model="printOptions"
                        />
                        <label class="printOpt" :for="'front'+product.design.id">{{$t('Front')}}</label>
                      </div>
                      <div class="d-inline-block mx-2">
                        <input
                          class="printOpt"
                          type="radio"
                          :id="'back'+product.id"
                          value="back"
                          @click="printOpt(printOptions)"
                          v-model="printOptions"
                        />
                        <label class="printOpt" :for="'back'+product.design.id">{{$t('Back')}}</label>
                      </div>
                      <div class="d-inline-block mx-2">
                        <input
                          class="printOpt"
                          type="radio"
                          :id="'front_back'+product.design.id"
                          value="front_back"
                          @click="printOpt(printOptions)"
                          v-model="printOptions"
                        />
                        <label
                          class="printOpt"
                          :for="'front_back'+product.design.id"
                        >{{$t('Front_and_Back')}}</label>
                      </div>
                    </div>
                    <div class="mb-2">
                      <div v-if="printOptions.includes('front')">
                        <label
                          class="my-1 mr-2 font-weight-bold text-capitalize"
                          :for="'frontSizeInputFiled'+product.design.id"
                        >{{$t('front_size')}}*</label>
                        <select
                          @click.prevent="frontprintPrice(frontprint)"
                          v-model="frontprint"
                          class="custom-select my-1 mr-sm-2"
                          :id="'frontSizeInputFiled'+product.design.id"
                        >
                          <option :value="0" selected>- {{$t('Please_Select')}} -</option>
                          <!--                                                    <option v-for="dsize in getUnique(product.design.dsizes,'id')" :value="dsize">-->
                          <!--                                                        {{dsize.length}}<span> X </span>{{dsize.width}}-->
                          <!--                                                    </option>-->
                          <option v-for="item in (product.design.designer_price)" :value="item">
                            {{item.dsize.length}}
                            <span>X</span>
                            {{item.dsize.width}}
                          </option>
                        </select>
                      </div>

                      <div v-if="printOptions.includes('back')">
                        <label
                          class="my-1 mr-2 font-weight-bold text-capitalize"
                          :for="'backSizeInputFiled'+product.id"
                        >{{$t('back_size')}}*</label>
                        <select
                          @click.prevent="backprintPrice(backprint)"
                          v-model="backprint"
                          class="custom-select my-1 mr-sm-2"
                          :id="'backSizeInputFiled'+product.id"
                        >
                          <option :value="0" selected>- {{$t('Please_Select')}} -</option>
                          <option v-for="item in (product.design.designer_price)" :value="item">
                            {{item.dsize.length}}
                            <span>X</span>
                            {{item.dsize.width}}
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="mb-2">
                      <label
                        class="my-1 mr-2 font-weight-bold"
                        :for="'colorInput'+product.design.id"
                      >{{$t('TShirt_Color')}}*</label>
                      <select
                        v-model="tcolor"
                        class="custom-select my-1 mr-sm-2"
                        :id="'colorInput'+product.design.id"
                      >
                        <option :value="null" selected>- {{$t('Please_Select')}} -</option>

                        <option
                          v-for="tshirt in getUniqueInObject(product.tshirts,'id','color')"
                          :value="tshirt.color"
                        >{{ tshirt.color.name}}</option>
                      </select>
                    </div>
                    <div class="mb-2">
                      <label
                        class="my-1 mr-2 font-weight-bold"
                        :for="'sizeInput'+product.design.id"
                      >{{$t('TShirt_Size')}}*</label>
                      <select
                        @click.prevent="tsizePrice(tsize)"
                        v-model="tsize"
                        class="custom-select my-1 mr-sm-2"
                        :id="'sizeInput'+product.design.id"
                      >
                        <option :value="0" selected>- {{$t('Please_Select')}} -</option>
                        <option
                          v-for="tshirt in getUniqueInObject(product.tshirts,'id','tsize')"
                          :value="tshirt"
                        >{{tshirt.tsize.name}}</option>
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
                        <button type="submit" class="btn btn-primary my-1" style="outline: none;">
                          <i class="fas fa-shopping-cart"></i>
                          {{$t('Add_to_cart')}}
                        </button>
                      </div>
                      <h5 class="productPrice" style="margin-top:10px">
                        {{$t('total')}} :
                        <span
                          class="productPrice"
                        >{{(count* priceDis(tsizes_price+frontprintprice+backprintprice,product.design.discount) +'KWD')}}</span>
                        <small class="text-muted" v-if="product.design.discount > 0">
                          <s>{{(count* (tsizes_price+frontprintprice+backprintprice) +'KWD')}}</s>
                        </small>
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
                frontprint: 0,
                backprint: 0,
                tcolor: '',
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
                    console.log(_this.mostSells)
                })
            },
            addToCart: function (product) {
                let root = this.$root;
                axios.post(`api/v1/add-to-cart/${product.id}`, {
                    id: product.design.id,
                    product: product,
                    frontprint: this.frontprint,
                    backprint: this.backprint,
                    tcolor: this.tcolor,
                    tsize: this.tsize,
                    count: this.count,
                }).then(function (response) {
                    root.updateCart();
                    $('.modal').modal('hide');

                }).catch((error) => {
                    console.log(error);
                });
                console.log('Add To Cart');
            },
            printOpt:function (opt) {
                this.printOptions = opt;
                this.frontprint = 0;
                this.backprint = 0;
                this.backprintprice = 0;
                this.frontprintprice = 0;
            },
            tsizePrice: function (tshirt) {
                console.log(tshirt)
                this.tsizes_price = tshirt.price | 0;
                this.tsizeprice = tshirt.price | 0;
                // console.log(this.tsizes_price);
            },
            frontprintPrice: function (dsize) {
                this.frontprint = dsize;
                this.frontprintprice = 0 | dsize.total
            },
            backprintPrice: function (dsize) {
                this.backprint = dsize;
                this.backprintprice = 0 | dsize.total
            },
            fetchProducts(page_url) {
                let vm = this;
                page_url = page_url || 'api/v1/design';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.products = this.products.concat(res.data);
                        console.log(this.products)
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
                if (price === 0 ) return 0;
                if ((price - discount) < 0) return 0;
                return price - discount;
            },
            priceDefault: function (price, discount) {
                return price - (price * discount) + this.$root.default_tsize + this.$root.default_frontprint;
            },
            getUnique : function (arr, comp) {
                return arr
                    .map(e => e[comp])

                    // store the keys of the unique objects
                    .map((e, i, final) => final.indexOf(e) === i && i)

          // store the keys of the unique objects
          .map((e, i, final) => final.indexOf(e) === i && i)

          // eliminate the dead keys & store unique objects
          .filter(e => arr[e])
          .map(e => arr[e])
      );
    },
    getUniqueInObject: function(arr, comp, objectName) {
      return _.uniqBy(arr, function(p) {
        return p[objectName][comp];
      });
    }
  },
  created() {
    this.fetchProducts();
    this.feachMostSells();
  },
  mounted() {
    axios.get("api/v1/color").then(response => {
      this.tcolors = response.data;
    });
    // axios.get('api/v1/dsize').then(response => {
    //     this.dsizes = response.data;
    // });
    axios.get("api/v1/tsize").then(response => {
      this.tsizes = response.data;
    });

    axios.get("api/v1/default-printprice").then(response => {
      this.default_frontprint = response.data;
      this.frontprint = response.data.id;
    });
    axios.get("api/v1/default-tcolor").then(response => {
      this.tcolor = response.data.id;
    });

    /*
                let vm = this;
                page_url = page_url || 'api/v1/design';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.products = this.products.concat(res.data);
                        vm.makePagination(res.next_page_url);
                    })
                    .catch(err => console.log(err));

                    */
  },
  computed: {
    getproducts: function() {
      return this.products;
    }
  },
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
                margin-top: 13px;
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
        display: inline-block;

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
                z-index: 999999999 !important;
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
  display: inline-block;
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
