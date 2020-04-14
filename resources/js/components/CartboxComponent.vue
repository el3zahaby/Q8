<template>
    <div>
        <ul v-if="Object.keys(this.$root.cart.items).length" class="mini_cart_box cart_div pb-2"
            style="overflow-y:auto; height:250px;">
            <li v-for="product in this.$root.cart.items"
                :key="product.id"
                class="single_product_cart">
                <div class="cart_img">

                    <img style="height: 70px" :src="product.options.img" alt="product thumbnail"
                    />
                </div>
                <div class="cart_title">
                    <h5>
                        <a href="#" class="text-decoration-none">{{product.name}}</a>
                    </h5>
                    <span>qty {{product.qty}}</span>
                    <span>${{product.subtotal+product.tax-product.discount}}</span>
                </div>
                <div class="cart_delete">
                    <!--                    <a href="'api/v1/delete-cart/'+product.id"><i class="far fa-trash-alt"></i></a>-->
                    <a href="#" @click.prevent="$root.removeFromCart(product.rowId)"><i
                        class="far fa-trash-alt"></i></a>
                </div>
            </li>

            <li class="cart_space">
                <div class="cart_sub">
                    <h4>{{$t('total')}}</h4>
                </div>
                <div class="cart_price">
                    <h4>{{this.$root.cart.total['total']}}</h4>
                </div>
            </li>
            <li class="cart_btn_wrapper">
                <router-link to="/cart" class="cart_btn text-decoration-none">{{$t('view_cart')}}</router-link>
                <router-link to="/checkout" class="cart_btn text-decoration-none">{{$t('checkout')}}</router-link>
            </li>
        </ul>

        <p v-if="!Object.keys(this.$root.cart.items).length" class="mini_cart_box cart_div pb-2">
            Your cart is empty, Keep shopping
        </p>
    </div>
</template>

<script>
    export default {
        data() {
            return {};
        },
        props: ["active"],
        mounted() {
        }
    };
</script>

<style lang="scss" scoped>
    /*----------- 14. Mini cart box css here --------*/

    .mini_cart_box {
        display: none;
        background: #fff none repeat scroll 0 0;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        padding: 15px 15px 45px;
        position: absolute;
        right: 0;
        -webkit-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
        width: 285px;
        z-index: 9999;
    }

    .single_product_cart {
        border-bottom: 1px solid #f6f6f6;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 20px;
        padding-bottom: 20px;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .single_product_cart:last-child {
        border-bottom: 0px solid #f6f6f6;
        margin-bottom: 0px;
        padding-bottom: 0px;
    }

    .cart_delete {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-flex: 100;
        -ms-flex-positive: 100;
        flex-grow: 100;
        -webkit-box-pack: end;
        -ms-flex-pack: end;
        justify-content: flex-end;
    }

    .cart_title {
        padding-left: 20px;
        text-align: left;
    }

    .cart_title h5,
    .cart_title h6,
    .cart_title span {
        color: #070b21;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 6px;
        text-transform: capitalize;
    }

    .cart_title h5 a,
    .cart_title h6 a {
        color: #070b21;
    }

    .cart_delete > a {
        color: #777777;
        font-size: 18px;
    }

    .cart_delete > a:hover,
    .cart_title h5 a:hover,
    .cart_title h6 a:hover {
        color: #3a5ea8;
    }

    .cart_title > span {
        display: block;
        margin: 9px 0 0;
    }

    .cart-space {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .cart_sub > h4 {
        color: #070b21;
        font-size: 18px;
        letter-spacing: 0.5px;
        text-transform: capitalize;
    }

    .cart_price > h4 {
        color: #070b21;
        font-size: 18px;
        font-weight: bold;
        letter-spacing: 0.5px;
    }

    .cart_btn_wrapper {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .mini_cart_box li.cart_space {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .cart_btn {
        background: #151320 none repeat scroll 0 0;
        border-radius: 27px;
        color: #ffffff;
        display: inline-block;
        font-weight: bold;
        line-height: 1;
        padding: 13px 22px;
        text-transform: uppercase;
    }

    .cart_btn:hover {
        color: #fff;
        background: #3a5ea8;
    }

    .single_product_cart .cart_img {
        width: 85px;
    }
</style>
