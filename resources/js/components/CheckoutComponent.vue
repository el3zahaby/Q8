<template>
    <div>
        <!-- checkout-area start -->
        <div class="checkout-area pt-130 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="coupon-accordion d-none">
                            <!-- ACCORDION START -->
                            <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                            <div id="checkout-login" class="coupon-content">
                                <div class="coupon-info">
                                    <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras
                                        sed est sit amet ipsum luctus.</p>
                                    <form action="#">
                                        <p class="form-row-first">
                                            <label>Username or email <span class="required">*</span></label>
                                            <input type="text" v-model="user.username"/>
                                        </p>
                                        <p class="form-row-last">
                                            <label>Password <span class="required">*</span></label>
                                            <input type="text" v-model="user.password"/>
                                        </p>
                                        <p class="form-row">
                                            <input type="submit" value="Login"/>
                                            <label>
                                                <input type="checkbox"/>
                                                Remember me
                                            </label>
                                        </p>
                                        <p class="lost-password">
                                            <a href="#">Lost your password?</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                            <!-- ACCORDION END -->
                            <!-- ACCORDION START -->
                            <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                            <div id="checkout_coupon" class="coupon-checkout-content">
                                <div class="coupon-info">
                                    <form @submit.prevent="discount">
                                        <p class="checkout-coupon">
                                            <input type="text" placeholder="Coupon code"/>
                                            <input type="submit" value="Apply Coupon"/>
                                        </p>
                                    </form>
                                </div>
                            </div>
                            <!-- ACCORDION END -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12">
                        <form action="#">
                            <div class="checkbox-form">
                                <h3>{{$t('Billing_Details')}}</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>{{$t('Full_Name')}} <span class="required">*</span></label>
                                            <input style="color:blue" type="text" v-model="clientInfo.fullName"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>{{$t('Address')}} <span class="required">*</span></label>
                                            <input style="color:blue" type="text" v-model="clientInfo.address"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>{{$t('Email')}} <span class="required">*</span></label>
                                            <input style="color:blue" type="email" v-model="clientInfo.email"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>{{$t('Phone_Number')}} <span class="required">*</span></label>
                                            <input style="color:blue" type="text" v-model="clientInfo.phone"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-md-5">
                                        <div class="checkout-form-list create-acc d-none">
                                            <input id="cbox" type="checkbox" v-model="clientInfo.createAccount"/>
                                            <label>Create an account?</label>
                                        </div>
                                    </div>
                                    <div id="cbox_info" class="col-md-12 checkout-form-list create-account d-none">
                                        <p>Create an account by entering the information below. If you are a returning
                                            customer please login at the top of the page.</p>
                                        <label>Account password <span class="required">*</span></label>
                                        <input type="password" v-model="clientInfo.pass"/>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="your-order">
                            <h3>{{$t('Your_order')}}</h3>
                            <div class="your-order-table table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product-name">{{$t('Products')}}</th>
                                        <th class="product-total">{{$t('total')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="cart_item" v-for="item in this.$root.cart.items" :key="item.id">
                                        <td class="product-name">
                                            {{ item.name }} <strong class="product-quantity"> × {{ item.qty }}</strong>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">${{item.subtotal+item.tax-item.discount}}</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>{{$t('sub_total')}}</th>
                                        <td><span class="amount">${{this.$root.cart.total['subtotal']}}</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>{{$t('order_total')}}</th>
                                        <td><strong><span
                                            class="amount">${{this.$root.cart.total['total']}}</span></strong>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method mt-40">
                                <div class="payment-accordion">
                                    <div class="panel-group" id="faq">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><a class="text-decoration-none">{{$t('Payment_Methods')}}</a>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <p class="text-capitalize font-weight-bold">{{$t('delivery')}}</p>
                                        </div>
                                    </div>
                                    <div class="order-button-payment">
                                        <input @click.prevent="addOrder" type="submit" :value="$t('Placeorder')"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout-area end -->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    username: '',
                    password: ''
                },
                clientInfo: {
                    fullName: this.$root.user.first_name + ' ' + this.$root.user.last_name,
                    email: this.$root.user.email,
                    phone: this.$root.user.phone,
                    address: this.$root.user.address,
                    createAccount: false,
                    pass: '',
                },
                discountCode: '',
                orderTotal: 0,
            };
        },
        props: [],
        methods: {
            addOrder: function () {
                let _this = this;
                axios.post('/api/v1/add-to-order', {
                    clientInfo: _this.clientInfo,
                }).then(function (response) {
                    _this.$router.push({path: '/'});
                    _this.$root.updateCart();
                });
            },
            discount: function () {
                if (this.discountCode) {
                    console.log('Discount Applied')
                }
            }
        },
        mounted() {
            /*--- showLogin toggle function ----*/
            $('#showlogin').on('click', function () {
                $('#checkout-login').slideToggle(900);
            });


            /*--- showCoupon toggle function ----*/
            $('#showcoupon').on('click', function () {
                $('#checkout_coupon').slideToggle(900);
            });

            /*--- showPassword toggle function ----*/
            $('#cbox').on('click', function () {
                $('#cbox_info').slideToggle(900);
            });


        }
    };
</script>

<style lang="scss" scoped>

    .pt-130 {
        padding-top: 130px;
    }

    .pb-100 {
        padding-bottom: 100px;
    }

    .coupon-accordion h3 {
        background-color: #f7f6f7;
        border-top: 3px solid #3a5ea8;
        color: #444;
        font-size: 14px;
        font-weight: 400;
        list-style: outside none none !important;
        margin: 0 0 25px !important;
        padding: 1em 2em 1em 3.5em !important;
        position: relative;
        width: auto;
    }

    .coupon-accordion h3::before {
        color: #000;
        content: "";
        display: inline-block;
        font-family: fontawesome;
        left: 1.5em;
        position: absolute;
        top: 1em;
    }

    .coupon-accordion span {
        cursor: pointer;
        color: #6f6f6f;
        transition: all .3s ease 0s;
    }

    .coupon-accordion span:hover,
    p.lost-password a:hover {
        color: #3a5ea8;
    }

    .coupon-content {
        border: 1px solid #e5e5e5;
        display: none;
        margin-bottom: 20px;
        padding: 20px;
    }

    .coupon-info p.coupon-text {
        margin-bottom: 15px
    }

    .coupon-info p {
        margin-bottom: 0
    }

    .coupon-info p.form-row-first {
    }

    .coupon-info p.form-row-first label,
    .coupon-info p.form-row-last label {
        display: block;
    }

    .coupon-info p.form-row-first label span.required,
    .coupon-info p.form-row-last label span.required {
        color: #333;
    }

    .coupon-info p.form-row-first input,
    .coupon-info p.form-row-last input {
        border: 1px solid #e5e5e5;
        height: 36px;
        margin: 0 0 14px;
        max-width: 100%;
        padding: 0 0 0 10px;
        width: 370px;
        background-color: transparent;
    }

    .coupon-info p.form-row-last {
    }

    .coupon-info p.form-row input[type="submit"]:hover,
    p.checkout-coupon input[type="submit"]:hover {
        background: #3a5ea8 none repeat scroll 0 0;
    }

    .coupon-info p.form-row input[type="checkbox"] {
        height: inherit;
        position: relative;
        top: 2px;
        width: inherit;
    }

    .form-row > label {
        margin-top: 7px;
    }

    p.lost-password {
        margin-top: 15px;
    }

    p.lost-password a {
        color: #6f6f6f;
    }

    p.checkout-coupon input[type="text"] {
        background-color: transparent;
        border: 1px solid #ddd;
        height: 36px;
        padding-left: 10px;
        width: 170px;
    }

    p.checkout-coupon input[type="submit"] {
        background: #333 none repeat scroll 0 0;
        border: medium none;
        border-radius: 0;
        color: #fff;
        cursor: pointer;
        height: 36px;
        margin-left: 6px;
        padding: 5px 18px;
        text-transform: uppercase;
        transition: all 0.3s ease 0s;
        width: inherit;
    }

    .coupon-checkout-content {
        margin-bottom: 30px;
        display: none;
    }

    .checkbox-form h3 {
        border-bottom: 1px solid #e5e5e5;
        color: #444;
        font-size: 25px;
        margin: 0 0 20px;
        padding-bottom: 10px;
        text-transform: uppercase;
        width: 100%;
    }

    .checkout-form-list label {
        color: #444;
        display: block;
        font-size: 14px;
        margin: 0 0 5px;
    }

    .checkout-form-list label span.required {
        color: #3a5ea8;
        font-size: 15px;
    }

    .checkout-form-list {
        margin-bottom: 30px;
    }

    .checkout-form-list label {
        color: #444;
    }

    .checkout-form-list input[type=text],
    .checkout-form-list input[type=password],
    .checkout-form-list input[type=email] {
        background: #fff none repeat scroll 0 0;
        border: 1px solid #e5e5e5;
        border-radius: 0;
        height: 42px;
        width: 100%;
        padding: 0 0 0 10px;
    }

    .checkout-form-list input[type="checkbox"] {
        display: inline-block;
        height: inherit;
        margin-right: 10px;
        position: relative;
        top: 2px;
        width: inherit;
    }

    .ship-different-title input {
        height: inherit;
        line-height: normal;
        margin: 4px 0 0;
        position: relative;
        top: 1px;
        width: 30px;
    }

    .create-acc label {
        color: #333;
        display: inline-block;
    }

    .create-account {
        display: none
    }

    .ship-different-title h3 label {
        display: inline-block;
        margin-right: 20px;
        font-size: 25px;
        color: #363636;
    }

    .order-notes textarea {
        background-color: transparent;
        border: 1px solid #ddd;
        height: 90px;
        padding: 15px;
        width: 100%;
    }

    #ship-box-info {
        display: none
    }

    .your-order {
        background: #f2f2f2 none repeat scroll 0 0;
        overflow: hidden;
        padding: 30px 40px 45px;
    }

    .your-order h3 {
        border-bottom: 1px solid #d8d8d8;
        color: #444;
        font-size: 25px;
        margin: 0 0 20px;
        padding-bottom: 10px;
        text-transform: uppercase;
        width: 100%;
    }

    .your-order-table table {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        width: 100%;
    }

    .your-order-table table th,
    .your-order-table table td {
        border-bottom: 1px solid #d8d8d8;
        border-right: medium none;
        font-size: 14px;
        padding: 15px 0;
        text-align: center;
    }

    .your-order-table table td .product-quantity {
        font-weight: 400;
    }

    .your-order-table table th {
        border-top: medium none;
        font-weight: normal;
        text-align: center;
        text-transform: uppercase;
        vertical-align: middle;
        white-space: nowrap;
        width: 250px;
    }

    .your-order-table table .shipping ul li input {
        position: relative;
        top: 2px;
    }

    .your-order-table table .shipping th {
        vertical-align: top;
    }

    .your-order-table table .order-total th {
        border-bottom: medium none;
        font-size: 18px;
    }

    .your-order-table table .order-total td {
        border-bottom: medium none;
    }

    .your-order-table table tr.cart_item:hover {
        background: #F9F9F9
    }

    .your-order-table table tr.order-total td span {
        color: #444;
        font-size: 20px;
        font-weight: 500;
    }

    .payment-accordion h3 {
        border-bottom: 0 none;
        margin-bottom: 10px;
        padding-bottom: 0;
    }

    .payment-accordion h3 a {
        color: #6f6f6f;
        font-size: 14px;
        padding-left: 25px;
        position: relative;
        text-transform: capitalize;
        text-decoration: none
    }

    .payment-content p {
        font-size: 13px;
    }

    .payment-accordion img {
        height: 60px;
        margin-left: 15px;
    }

    .order-button-payment input {
        background: #464646 none repeat scroll 0 0;
        border: 1px solid transparent;
        color: #fff;
        cursor: pointer;
        font-size: 14px;
        font-weight: 400;
        height: inherit;
        letter-spacing: 1px;
        margin: 20px 0 0;
        padding: 13px 20px 11px;
        text-transform: uppercase;
        transition: all 0.3s ease 0s;
        width: 100%;
    }

    .order-button-payment input:hover {
        background: #3a5ea8;
        border: 1px solid #3a5ea8;
        color: #fff;
    }

    .coupon-info p.form-row input[type="submit"] {
        background: #252525 none repeat scroll 0 0;
        border: medium none;
        border-radius: 0;
        box-shadow: none;
        color: #fff;
        display: inline-block;
        float: left;
        font-size: 14px;
        height: 40px;
        line-height: 40px;
        margin-right: 15px;
        padding: 0 25px;
        text-transform: uppercase;
        transition: all 0.3s ease 0s;
        width: inherit;
        cursor: pointer;
    }

    @media (max-width: 767px) {

        .pb-100 {
            padding-bottom: 50px;
        }

        .pt-130 {
            padding-top: 80px;
        }

    }
</style>
