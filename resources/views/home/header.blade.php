<div>
    <nav>
        <div class="header_div px-2">
            <div class="d-flex justify-content-between align-items-center">
                <a href="/" class="home_logo_div">
                    <img :src="logo_src" alt="logo"/>
                </a>

                <div class="header_icons_div">
                    <!-- Language_changer -->
                    <div class="locale-changer d-inline-block position-relative">
                        <select v-model="selectedLang" onchange="setLang()">
                            <option  value="AR">AR</option>
                            <option  value="EN">EN</option>
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
