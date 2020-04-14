<template>
    <div>
        <nav>
            <div class="header_div px-2">
                <div class="d-flex justify-content-between align-items-center">
                    <router-link to="/" class="home_logo_div">
                        <img :src="logo_src" alt="logo"/>
                    </router-link>

                    <div class="header_icons_div">
                        <!-- Language_changer -->
                        <div class="locale-changer d-inline-block position-relative">
                            <select v-model="selectedLang" v-on:change="setLang()">
                                <option
                                    v-for="(lang, i) in langs"
                                    :key="`Lang${i}`"
                                    :value="lang">{{ lang }}
                                </option>
                            </select>
                        </div>

                        <div
                            class="header_icon d-inline-block position-relative"
                            id="header_account_icon"
                        >
                            <img src="/images/user.png" alt="account icon"/>

                            <div v-if="!this.$root.login" class="account_div">
                                <div class="account_div_inner">
                                    <router-link to="/login">{{$t("Login") }}</router-link>
                                </div>
                                <div class="account_div_inner">
                                    <router-link to="/register">{{$t("Register") }}
                                    </router-link>
                                </div>
                            </div>
                            <div v-if="this.$root.login" class="account_div">
                                <div v-if="this.$root.user.is_trader===1" class="account_div_inner">
                                    <a href="/dashboard" class="nav-link">{{$t('Dashboard')}}</a>
                                </div>
                                <div class="account_div_inner">
                                    <router-link to="/profile">{{$t('Profile')}}</router-link>
                                </div>
                                <div class="account_div_inner">
                                    <a href="#" @click.prevent="logout()">
                                        {{$t('Logout')}}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div
                            class="header_icon d-inline-block position-relative"
                            id="header_cart_icon"
                        >
                            <div>
                                <img
                                    src="/images/cart.png"
                                    alt="account icon"
                                />
                                <span class="cart_count">{{this.cartCounter}}</span>
                            </div>

                            <!-- Cart Box Component -->
                            <cartbox-component></cartbox-component>
                            <!-- ُEnd Cart Box Component -->
                        </div>
                        <div
                            class="header_icon search_icon_div d-inline-block"
                            data-toggle="modal"
                            data-target=".search-form"
                        >
                            <img src="/images/search.png" alt="search icon"/>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!--! search modal -->
        <div
            class="modal fade search-form"
            tabindex="-1"
            role="searchbox"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="input-group input-group-lg  flex-nowrap">
                        <input
                            id="search-component"
                            dir="auto"
                            type="search"
                            class="form-control text-uppercase"
                            :placeholder="$t('search')"
                            @keyup.enter="search"
                        />
                        <div class="input-group-append">
                            <span class="input-group-text" @click="search"
                            ><img
                                style="width:25px"
                                src="/images/search.png"
                                alt="search icon"
                            /></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--! end of search modal -->
        <div id="hidden-search-result" class="d-none"></div>
    </div>
</template>

<script>
    import ProductsComponent from "./ProductsComponent";
    import Cookies from 'js-cookie';

    export default {
        name: "locale-changer",
        data() {
            return {
                logo_src: "/images/w_logo.png",
                search_placeholder: "Search now",
                langs: ["AR", "EN"],
                selectedLang: this.$i18n.locale,
            };
        },
        methods: {
            logout: function () {
                let _this = this;
                axios.post('/api/v1/logout').then(function (response) {
                    _this.$root.user = null;
                });
            },
            setLang: function ()
            {
                this.$i18n.locale = this.selectedLang;
                Cookies.set('locale', this.selectedLang, { expires: 365 });
                document.getElementsByTagName("html")[0].lang = this.selectedLang.toLowerCase();
            },
            search: function () {
                let query = $('#search-component').val();
                let _this = this;
                axios.get('/api/v1/get-by-rand-id/' + query).then(function (response) {
                    let x = _this.$root.$children.filter(child => {
                        return (child.$options.name === "products-component");
                    });
                    x[0].products = response.data;
                    x[0].$mount();
                });
            }
        },
        computed: {
            cartCounter: function () {
                return Object.keys(this.$root.cart.items).length;
            }
        },
        mounted() {
        }
    };
</script>

<style lang="scss" scoped>
    .header_div {
        padding: 20px 0;
        z-index: 99999;

        .home_logo_div img {
            height: 60px;
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

        .header_icons_div {
            .header_icon {
                padding: 0px 10px;

                &:hover {
                    cursor: pointer;
                }

                img {
                    height: 30px;
                }

                .account_div {
                    width: 135px;
                    position: absolute;
                    padding: 10px 30px;
                    top: 40px;
                    left: 0px;
                    background: #fff;
                    box-shadow: 1px 5px 8px 0.5px rgba(0, 0, 0, 0.2);
                    display: none;
                    z-index: 2;

                    .account_div_inner {
                        a {
                            text-decoration: none;
                            color: #909090;
                            text-transform: uppercase;
                            line-height: 40px;

                            &:hover {
                                color: #40acf1;
                            }
                        }

                        .nav-link {
                            padding: 0 !important;
                        }
                    }
                }

                .cart_count {
                    position: absolute;
                    top: -8px;
                    right: 5px;
                    width: 20px;
                    height: 20px;
                    line-height: 20px;
                    text-align: center;
                    border-radius: 50%;
                    left: 10px;
                    font-size: 12px;
                    display: block;
                    background-color: #f50505;
                    color: #ffffff;
                    font-family: "Roboto", sans-serif;
                }
            }

            .search_icon_div {
                background-color: #000;
                padding: 13px 15px;
                border-radius: 50%;

                img {
                    position: relative;
                    bottom: 2px;
                    height: 20px;
                }

                &:hover {
                    img {
                        bottom: 0;
                    }
                }
            }
        }
    }

    .padding_x_25 {
        padding-left: 25px !important;
        padding-right: 25px !important;
    }

    .fixed_header {
        height: 100px;
        left: 0;
        margin: 0 auto;
        position: fixed;
        right: 0;
        top: 0;
        z-index: 3;
        animation-name: silde_to_top;
        animation-duration: 0.75s;
        animation-timing-function: ease-out;
        animation-iteration-count: 1;
        animation-direction: normal;
        animation-delay: 0;
        animation-play-state: running;
        animation-fill-mode: forwards;
    }

    @-webkit-keyframes silde_to_top {
        0% {
            top: -110px;
        }

        100% {
            top: 0px;
            z-index: 100;
            /* opacity: 0.5; */
        }
    }

    /*! search modal */
    .modal .modal-content,
    .modal .input-group,
    .modal .input-group input,
    .modal .input-group span {
        background: transparent;
        border: none;
        border-radius: 0 !important;
        box-shadow: none !important;
        outline: none !important;
    }

    .modal .input-group {
        padding: 8px 12px;
        border-bottom: 2px solid #3a5ea8;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal .input-group input {
        color: #fff;
    }

    .modal .input-group span {
        font-size: 2.2rem;
        color: #fff;
        cursor: pointer;
        transition: all 0.5s ease-in-out;
    }

    .input-group span:hover {
        transform: translateY(-10%);
    }

    /*! end of search modal */
</style>
