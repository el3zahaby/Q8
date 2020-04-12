<template>
    <footer id="footer" class="pt-5 m-0">
        <div class="container">
            <div class="sitemap">
                <div class="row">
                    <div class="col-lg-5 mb-3 text-left">
                        <router-link to="/" class="home_logo_div">
                            <img style="height: 80px" class="mb-3" :src="logo_src" alt="logo"/>
                        </router-link>
                        <p class="about">
                            {{about_us}}
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm">
                        <h4>{{$t('Helpful_Links')}}</h4>
                        <div class="row">
                            <div class="col helpful">
                                <ul class="list-unstyled">
                                    <li>
                                        <slot></slot>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm">
                        <h4>{{$t('Payment')}}</h4>
                        <label class="mb-2 d-block">{{$t('Accepted_Cards')}}</label>
                        <div class="icon-container">
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-amex"></i>
                            <i class="fab fa-cc-mastercard"></i>
                            <i class="fab fa-cc-discover"></i>
                        </div>
                    </div>
                </div>
            </div>
            <p class="copyright border-top pt-3">Copyright Q8-Tshirt, &copy; 2020</p>
        </div>
    </footer>
</template>

<script>
    export default {
        data() {
            return {
                logo_src: "/images/w_logo.png",
                about_us: about_us_desc
            }
        },
    }
</script>

<style scoped lang="scss">
    /* Footer */
    #footer {
        background: #000000;
        color: #ffffff;
        text-align: center;
        padding: 20px;
        margin-top: 30px;

        .icon-container {
            margin-bottom: 20px;
            padding: 7px 0;
            font-size: 30px;

            .fab {
                color: #f2f2f2;
            }
        }

        .helpful {
            ul {
                li {
                    font-size: 18px;
                }
            }
        }
    }

</style>
