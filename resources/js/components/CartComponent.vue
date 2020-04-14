<template>
    <div>
        <div class="product-cart-area pt-120 pb-130">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-content table-responsive">
                            <table class="text-center">
                                <thead>
                                <tr>
                                    <th class="product-name">{{$t('Products')}}</th>
                                    <th class="product-price">{{$t('ProductsName')}}</th>
                                    <th class="product-name">{{$t('price')}}</th>
                                    <th class="product-price">{{$t('quantity')}}</th>
                                    <th class="product-quantity">{{$t('total')}}</th>
                                    <th class="product-subtotal">{{$t('delete')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="product in this.$root.cart.items" :key="product.id">
                                    <td class="product-thumbnail">
                                        <img class="img-fluid" :src="product.options.img"
                                             alt="product thumbnail">
                                    </td>
                                    <td class="product-name">

                                        {{ product.name }}

                                    </td>
                                    <td class="product-price"><span class="amount">${{ product.price }}</span></td>
                                    <td class="product-quantity">
                                        <div class="quantity-range">
                                            <input @change="updateQuantity(product)" class="input-text qty text"
                                                   type="number" step="1" min="1" v-model="product.qty" title="Qty"
                                                   size="4">
                                        </div>
                                    </td>
                                    <td class="product-subtotal">${{product.subtotal+product.tax-product.discount}}</td>
                                    <td @click="$root.removeFromCart(product.rowId)"
                                        class="product-cart-icon product-subtotal"><i
                                        class="delete far fa-trash-alt"></i></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="cart-shiping-update">
                            <div class="cart-shipping">
                                <router-link to="/" class="btn-style cr-btn text-decoration-none">
                                    <span>{{$t('continue_shopping')}}</span>
                                </router-link>
                            </div>
                            <div class="update-checkout-cart">
                                <div class="update-cart">
                                    <router-link to="/checkout" class="btn-style cr-btn text-decoration-none">
                                        <span>{{$t('checkout')}}</span>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 col-sm-6 invisible">
                        <div class="discount-code">
                            <h4>{{$t('code')}}</h4>
                            <div class="coupon ">
                                <form @submit.prevent="discount">
                                    <input type="text" v-model="discountCode">
                                    <input class="cart-submit" type="submit" :value="$t('enter')">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 col-sm-6 ">
                        <div class="shop-total">
                            <h3>{{$t('cart_total')}}</h3>
                            <ul class="list-unstyled">
                                <li>
                                    {{$t('sub_total')}}
                                    <span>{{this.$root.cart.total['subtotal']}}</span>
                                </li>
                                <li>
                                    {{$t('tax')}}
                                    <span>{{this.$root.cart.total['tax']}}</span>
                                </li>
                                <!--<li class="order-total">-->
                                <!--    {{$t('shipping')}}-->
                                <!--    <span>$0</span>-->
                                <!--</li>-->
                                <li>
                                    {{$t('order_total')}}
                                    <span>{{this.$root.cart.total['total']}}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="continue-shopping-btn text-center">
                            <router-link to="/checkout" class="text-decoration-none">{{$t('checkout')}}</router-link>
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
                discountCode: '',
            };
        },
        props: [],
        methods: {
            updateQuantity: function (product) {
                //Todo:Implement Update
                let root = this.$root;
                axios.get(`api/v1/update-cart/${product.rowId}/${product.qty}`).then(function (response) {
                    root.updateCart();
                });
            },
            deleteItem: function (product) {
                //Todo:Implement Delete
                console.log('Deleted');
            },
            discount: function () {
                if (this.discountCode) {
                    console.log('Discount Applied')
                }
            }
        },
    };
</script>

<style lang="scss">
    .pb-130 {
        padding-bottom: 130px;
    }

    .pt-120 {
        padding-top: 120px;
    }

    .table-content table {
        width: 100%;
    }

    .table-content table thead tr {
        border-bottom: 3px solid #e1e1e1;
    }

    .table-content table th {
        border-top: medium none;
        color: #353535;
        font-family: "Oswald", sans-serif;
        font-size: 18px;
        font-weight: 400;
        padding: 0 10px 12px;
        text-transform: capitalize;
    }

    .table-content table td {
        padding: 30px 10px 0;
    }

    .table-content table td input {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        background: #f7f7f7 none repeat scroll 0 0;
        border-color: currentcolor #ebebeb currentcolor currentcolor;
        border-image: none;
        border-radius: 0;
        border-style: none solid none none;
        border-width: medium 1px medium medium;
        color: #3f3f3f;
        font-size: 14px;
        font-weight: normal;
        height: 45px;
        padding: 0;
        text-align: center;
        width: 75px;
    }

    .table-content table td.product-subtotal {
        width: 120px;

        .delete {
            cursor: pointer;

            &:hover {
                color: #1b4b72;
                transition: color 100ms;
            }
        }
    }

    .table-content table td.product-name a {
        color: #444;
        display: block;
        font-size: 15px;
        margin-bottom: 0px;
        text-transform: capitalize;
    }

    .table-content table td.product-name > span {
        color: #444;
        letter-spacing: 1px;
    }

    .table-content table td.product-name a:hover {
        color: #555;
    }

    .table-content table td.product-name {
        width: 270px;
    }

    .table-content table td.product-thumbnail {
        width: 110px;
    }

    .table-content table td.product-remove i {
        color: #000;
        display: inline-block;
        font-size: 20px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        width: 40px;
    }

    .table-content table .product-price .amount,
    .table-content table td.product-subtotal {
        color: #444;
        font-size: 15px;
        font-weight: 400;
        letter-spacing: 1px;
    }

    .table-content table td.product-remove i:hover {
        color: #999;
    }

    .table-content table td.product-quantity {
        width: 180px;
    }

    .table-content table td.product-remove {
        width: 150px;
    }

    .table-content table td.product-price {
        width: 130px;
    }

    .update-checkout-cart {
        display: flex;
    }

    .update-cart {
        margin-left: 20px;
    }

    .update-cart:first-child {
        margin-left: 0px;
    }

    .cart-shipping .btn-style {
        padding: 18px 33px 17px;
    }

    .update-cart button {
        border: medium none;
    }

    .cart-shiping-update {
        border-bottom: 1px solid #ebebeb;
        display: flex;
        justify-content: space-between;
        margin-bottom: 69px;
        margin-top: 36px;
        overflow: hidden;
        padding-bottom: 57px;
    }


    .discount-code h4 {
        color: #333;
        font-size: 20px;
        margin-bottom: 24px;
        text-transform: capitalize;
    }

    .discount-code {
        background-color: #f7f7f7;
        display: block;
        margin-right: 30px;
        padding: 55px 70px;
    }

    .coupon input {
        background: #fff none repeat scroll 0 0;
        border: medium none;
        height: 56px;
        padding-left: 10px;
        padding-right: 88px;
    }

    .coupon input.cart-submit {
        background-color: #3a5ea8;
        color: #fff;
        cursor: pointer;
        line-height: 58px;
        padding: 0 30px;
        position: absolute;
        right: 0;
        text-transform: uppercase;
        top: 0;
        width: inherit;
        font-weight: 500;
    }

    .coupon input.cart-submit:hover {
        background-color: #000;
    }

    .coupon {
        position: relative;
    }

    .button-coupon {
        background-color: #3f3f3f;
        border: medium none;
        color: #fff;
        font-weight: 500;
        height: 56px;
        letter-spacing: 0.4px;
        padding: 0 28px;
        position: absolute;
        right: 0;
        text-transform: uppercase;
        transition: all .3s ease 0s;
    }

    .shop-total > h3 {
        background-color: #3a5ea8;
        color: #fff;
        font-size: 20px;
        margin: 0;
        padding: 23px 30px 22px;
        text-transform: capitalize;
    }

    .shop-total ul {
        padding: 37px 0 35px;
    }

    .shop-total ul li {
        color: #333;
        font-size: 16px;
        padding-bottom: 22px;
        text-transform: capitalize;
    }

    .shop-total ul li.order-total {
        border-bottom: 1px solid #ebebeb;
        margin-bottom: 18px;
        padding-bottom: 32px;
    }

    .shop-total ul li span {
        float: right;
    }

    .cart-btn > a,
    .continue-shopping-btn > a {
        background-color: #f7f7f7;
        color: #444;
        display: block;
        letter-spacing: 1px;
        padding: 23px 10px 22px;
        text-transform: uppercase;
    }

    .cart-btn > a:hover,
    .continue-shopping-btn > a:hover {
        background-color: #3a5ea8;
        color: #fff;
    }

    .button-coupon:hover {
        background-color: #666;
    }

    .product-cart-icon.product-subtotal > a {
        color: #333;
        font-size: 20px;
    }

    .product-cart-icon.product-subtotal > a:hover,
    .table-content table td.product-name a:hover {
        color: #3a5ea8;
    }


    @media (min-width: 768px) and (max-width: 991px) {

        .table-content table th {
            font-size: 15px;
        }
        .discount-code {
            margin-right: 10px;
            padding: 55px 20px;
        }


    }


    @media (max-width: 767px) {


        .table-content table td {
            padding: 30px 6px 0;
        }
        .cart-shiping-update {
            display: block;
        }
        .update-checkout-cart {
            margin-top: 10px;
        }
        .btn-style {
            padding: 13px 25px;
        }
        .discount-code {
            margin-right: 0;
            padding: 55px 15px;
            margin-bottom: 30px;
        }
        .coupon input.cart-submit {
            padding: 0 20px;
        }
        .pb-130 {
            padding-bottom: 80px;
        }

        .pt-120 {
            padding-top: 70px;
        }

    }
</style>
