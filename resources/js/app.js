/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import VueRouter from "vue-router";
import VueInternationalization from 'vue-i18n';
import VueI18n from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';
import Cookies from 'js-cookie';


Vue.use(VueRouter);

Vue.use(VueInternationalization);

let cookiesLocal = Cookies.get('locale') || 'AR';
document.getElementsByTagName("html")[0].lang = cookiesLocal.toLowerCase();

const i18n = new VueInternationalization({
    locale: cookiesLocal,
    messages: Locale
});


Vue.use(VueI18n);

const routes = [
    {
        path: "/",
        component: require("./components/ProductsComponent.vue").default
    },
    {
        path: "/login",
        component: require("./components/LoginComponent.vue").default
    },
    {
        path: "/register",
        component: require("./components/RegisterComponent.vue").default
    },
    {
        path: "/register-as-designer",
        component: require("./components/RegisterAsDesignerComponent.vue").default
    },
    {
        path: "/product-details/:id",
        component: require("./components/ProductDetails.vue").default
    },
    {
        path: "/custom-design",
        component: require("./components/ProductDesigner.vue").default
    },
    {
        path: "/cart",
        component: require("./components/CartComponent.vue").default
    },
    {
        path: "/checkout",
        component: require("./components/CheckoutComponent.vue").default
    },
    {
        path: "/profile",
        component: require("./components/profileComponent.vue").default
    },
    {
        path: "/myOrder",
        component: require("./components/MyOrderComponent.vue").default
    },
    {
        path: "/dashboard",
        component: require("./components/dashboard/DashboardComponent.vue")
            .default
    },
    {
        path: "/dashboard/designs",
        component: require("./components/dashboard/DesignsComponent.vue")
            .default
    },
    {
        path: "/dashboard/profile",
        component: require("./components/dashboard/ProfileComponent.vue")
            .default
    },
    {
        path: "/dashboard/transactions",
        component: require("./components/dashboard/TransactionsComponent")
            .default
    },
    {
        path: "/success",
        component: require("./components/MyOrderComponent.vue").default
    },
    {
        path: "/:slug",
        component: require("./components/pages.vue").default
    },
    {
        path: "*",
        component: require("./components/NotFound").default
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/HeaderComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component(
    "products-component",
    require("./components/ProductsComponent.vue").default
);
Vue.component(
    "slideshow-component",
    require("./components/SlideshowComponent.vue").default
);
Vue.component(
    "header-component",
    require("./components/HeaderComponent.vue").default
);
Vue.component(
    "footer-component",
    require("./components/footerComponent.vue").default
);
Vue.component(
    "cartbox-component",
    require("./components/CartboxComponent.vue").default
);
Vue.component(
    "login-component",
    require("./components/LoginComponent.vue").default
);
Vue.component(
    "register-component",
    require("./components/RegisterComponent.vue").default
);
Vue.component(
    "register-as-designer",
    require("./components/RegisterAsDesignerComponent.vue").default
);
Vue.component(
    "product-details",
    require("./components/ProductDetails.vue").default
);
Vue.component(
    "product-designer",
    require("./components/ProductDesigner.vue").default
);
Vue.component(
    "cart-component",
    require("./components/CartComponent.vue").default
);
Vue.component(
    "checkout-component",
    require("./components/CheckoutComponent.vue").default
);
Vue.component(
    "profile-component",
    require("./components/profileComponent.vue").default
);
Vue.component(
    "myorder-component",
    require("./components/MyOrderComponent.vue").default
);
Vue.component(
    "dashboard-component",
    require("./components/dashboard/DashboardComponent.vue").default
);
Vue.component(
    "dashboard-content",
    require("./components/dashboard/DashboardContent.vue").default
);
Vue.component(
    "dashboard-designs",
    require("./components/dashboard/DesignsComponent.vue").default
);
Vue.component(
    "dashboard-profile",
    require("./components/dashboard/ProfileComponent.vue").default
);
Vue.component(
    "pages",
    require("./components/pages.vue").default
);
Vue.component(
    "not-found",
    require("./components/NotFound.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: "#app",
//     router
// });
//
Vue.filter('currency', function (price) {
     return price+"KWD";
});

const app = new Vue({
    el: "#app",
    data: {
        login: (Cookies.get('loggedIn') ? JSON.parse(Cookies.get('loggedIn')):true),
        user: (Cookies.get('user') ? JSON.parse(Cookies.get('user')) : []),
        models: [],
        cart: {
            items: [],
            total: 0
        },
        selectedLang: Cookies.get('locale') || 'AR',
        latestDesigns: [],
        allDesigns: [],
        default_tsize: null,
        default_frontprint: null,

    },
    methods: {
        logout: async function () {
            let _this = this;
            await axios.post('/api/v1/logout').then(function (response) {
                _this.login = false;
                Cookies.set('loggedIn', _this.login, { expires: 36521 });
                if (_this.login === false) {
                    _this.user = [];
                    Cookies.set('user', _this.user, { expires: 36521 });
                    _this.$router.push({path: '/'});
                }
            });
        },
        removeFromCart: function (id) {
            let _this = this; //
            axios.get(`/api/v1/delete-cart/${id}`).then(function (response) {
                _this.updateCart();
            });
        },
         updateUser: async function () {
            let _this = this;
            await axios.get("/api/user").then(async function (response) {
                 _this.user = response.data ? response.data : [];
                Cookies.set('user', _this.user, { expires: 36521 });
                Cookies.set('loggedIn', true, { expires: 36521 });
            });
        },
        updateCart: function () {
            let _this = this;
            axios.get("/api/v1/cart").then(function (response) {
                _this.cart.items = response.data;
            });
            axios.get("/api/v1/cart-total").then(function (response) {
                _this.cart.total = response.data ? response.data : 0;
            });
            console.log("Update Cart");
        },
        updateModels: function () {
            let _this = this;
            axios.get("/api/v1/design").then(function (response) {
                _this.models = response.data;
            });
        },
        fetchDesigns: function () {
            axios
                .get("/api/v1/designer-designs")
                .then(response => {
                    this.allDesigns = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        fetchlatestDesigns: function () {
            axios
                .get("/api/v1/designer-latest-designs")
                .then(response => {
                    this.latestDesigns = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        deleteDesign: function (id) {
            let _this = this;
            axios.get(`/api/v1/delete-design/${id}`).then(function (response) {
                _this.updateDesigns();
            });
        },
        updateDesigns: function () {
            let _this = this;
            axios
                .get("/api/v1/designer-latest-designs")
                .then(function (response) {
                    _this.latestDesigns = response.data;
                });
            axios.get("/api/v1/designer-designs").then(function (response) {
                _this.allDesigns = response.data;
            });

            return _this.allDesigns;
//            console.log("Update Designs",_this.allDesigns);
        },
    },
    watch: {
        $route (to, from){
            $('.alert-pay').hide("slow", function(){ $(this).remove(); })
        },
        login: function (val, oldVal) {
            if (oldVal) {
                let _this = this;
                // // axios.post("/logout").then(function (response) {
                // //     _this.user = [];
                // //     Cookies.set('loggedIn', false, { expires: 36521 });
                // // });
                // console.log("User Logout",oldVal);
            }else {
                this.login = true;
                Cookies.set('loggedIn', true, { expires: 36521 });
            }
            console.log("Login Changed");
        },
        user: function (val, oldVal) {
            // console.log(val !== null)
            if(val !== null ){
                if(Object.keys(val).length !== 0) {
                    this.login = true;
                    Cookies.set('loggedIn', true, { expires: 36521 });
                }else {
                    this.login = false;
                    Cookies.set('loggedIn', false, { expires: 36521 });
                }
            }else {
                this.login = false;
                Cookies.set('loggedIn', false, { expires: 36521 });
            }
            console.log("User Changed");
            console.log("User cache: ",Cookies.set('get'));
        }
    },
    async mounted() {
        let _res = await axios.get("/api/user");
        this.user = _res.data ? _res.data : [];

        this.updateUser();
        this.updateCart();
        this.updateModels();
        this.updateDesigns();
        this.fetchDesigns();
        this.fetchlatestDesigns();

        axios.get("api/v1/default-tsizeprice").then(response => {
            this.default_tsize = response.data.price;
        });
        axios.get("api/v1/default-printprice").then(response => {
            this.default_frontprint = response.data.print_price;
        });
    },
    i18n,
    router
});
