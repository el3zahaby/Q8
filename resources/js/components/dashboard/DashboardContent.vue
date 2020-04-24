<template>
    <div>
        <nav class="navbar navbar-expand-md">
            <div class="container">
                <a href="/" class="navbar-brand"><img class="img-fluid" :src="logo_src" alt="logo"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars fa-2x"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <router-link to="/dashboard" class="nav-link hover">{{$t('Dashboard')}}</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/dashboard/designs" class="nav-link hover">{{$t('Designs')}}</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/dashboard/profile" class="nav-link hover">{{$t('Profile')}}</router-link>
                        </li>

                    </ul>
                    <div class="header_icons_div">
                        <div class="locale-changer d-inline-block position-relative">
                            <select v-model="$i18n.locale">
                                <option
                                    v-for="(lang, i) in langs"
                                    :key="`Lang${i}`"
                                    :value="lang"
                                >{{ lang }}
                                </option
                                >
                            </select>
                        </div>
                    </div>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{$t('Welcome')}}, {{this.$root.user.first_name}}</a>
                        </li>

                        <li class="nav-item">
                            <a href="#" @click.prevent="logout" class="nav-link">{{$t('Logout')}} <i
                                class="fas fa-sign-out-alt"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section id="breadcrumb" class="pt-3">
            <div class="container">
                <ul class="breadcrumb">
                    <li class="active text-center">{{$t('Dashboard')}}</li>
                </ul>
            </div>
        </section>


        <section id="main">
            <div class="container">
                <div class="row mx-auto">
                    <div class="col-md-3">
                        <div class="list-group">
                            <router-link to="/dashboard"
                                         class="text-decoration-none list-group-item active main-color-bg">
                                <i class="fas fa-cog"></i> {{$t('Dashboard')}}
                            </router-link>

                            <router-link to="/dashboard/designs" class="text-decoration-none list-group-item">
                                <i class="fab fa-sketch"></i> {{$t('Designs')}}
                            </router-link>
                            <router-link to="/dashboard/profile" class="text-decoration-none list-group-item">
                                <i class="fas fa-user-alt"></i> {{$t('Profile')}}
                            </router-link>
                        </div>
                    </div>

                    <!-- Router View -->
                    <router-view></router-view>
                    <!-- End Router View -->

                </div>
            </div>
        </section>

        <footer-component>
            <a href="/terms_and_conditions" class="text-decoration-none">Privacy Policy</a>
        </footer-component>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                logo_src: "/images/w_logo.png",
                langs: ["AR", "EN"],
            };
        },
        props: [],
        mounted() {
        },
        methods: {
            logout() {
                this.$root.login = false;
                this.$router.replace('/');
                this.$router.go();

            }
        }
    };
</script>

<style lang="scss">

    /* Navbar */
    .navbar {
        min-height: 33px !important;
        margin-bottom: 0;
        border-radius: 0;
        background-color: #3a5ea8;
        border-color: #3257a3;
    }

    .navbar .navbar-brand {
        width: 50px;
    }

    .navbar-default .navbar-text {
        color: #ecf0f1;
    }

    .navbar .navbar-toggler {
        color: #fff;
        outline: none;
    }

    .navbar .navbar-nav > li.nav-item > a {
        color: #ecf0f1;
        font-size: 22px;
        text-align: center;
        position: relative;
    }

    .navbar .navbar-nav > li.nav-item > a.hover:after {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        width: 0%;
        content: '.';
        color: transparent;
        background: rgb(247, 247, 247);
        height: 1px;
        transition: width 0.6s;
    }

    .navbar .navbar-nav > li.nav-item > a.hover:hover:after {
        width: 100%;
    }

    .locale-changer select {
        background-color: #3a5ea8;
        color: white;
        width: 100px;
        border: none;
        font-size: 20px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
        -webkit-appearance: button;
        appearance: button;
        outline: none;
    }

    .locale-changer::before {
        content: "\f13a";
        font-family: FontAwesome;
        position: absolute;
        top: 0;
        right: 0;
        width: 35%;
        height: 100%;
        text-align: center;
        font-size: 28px;
        line-height: 45px;
        color: rgba(255, 255, 255, 0.5);
        background-color: rgba(255, 255, 255, 0.1);
        pointer-events: none;
    }

    .locale-changer:hover::before {
        color: rgba(255, 255, 255, 0.6);
        background-color: rgba(255, 255, 255, 0.2);
    }

    .locale-changer select option {
        padding: 30px;
        background-color: #3a5ea8;
    }


    /* Custom */
    .main-color-bg {
        background-color: #3a5ea8 !important;
        border-color: #3257a3 !important;
        color: #ffffff !important;
    }


    /* Breadcrumb */
    .breadcrumb {
        background: #cccccc;
        color: #333333;
    }

    .breadcrumb a {
        color: #333333;
    }

    .overview {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .overview-head {
        padding: 4px 14px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        color: #333;
        background-color: #f5f5f5;
        border-color: #ddd;
    }

    .box {
        text-align: center;
        min-height: 20px;
        padding: 19px;
        margin-bottom: 20px;
        background-color: #f5f5f5;
        border: 1px solid #e3e3e3;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
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


    .table-content table td.product-subtotal.product-subtotal {
        width: 120px;
    }

    .table-content table td.product-subtotal {
        width: 120px;
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
</style>
