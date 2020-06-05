<template>
    <div>
        <div class="content py-5">
            <div class="row p-3">
                <div class="col-md-6">
                    <div class="product-img d-flex justify-content-center">
                        <img
                            :src="'/storage/'+product.img"
                            alt="product img"
                            class="img-fluid"
                            style="max-height: 450px"
                        />
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class="productName">{{product.random_name}}</h3>
                    <span
                        class="productPrice font-weight-bold">{{priceDis(product.price,product.discount) | currency}}</span>
                    <p class="ProductDetails pt-3">
                        {{product.des}}
                    </p>
                    <div class="form-action">
                        <form class="form-group" @submit.prevent="addToCart(product)">
                            <div class="mb-2">
                                <label
                                    class="my-1 mr-2 font-weight-bold text-capitalize"
                                >print options* : </label
                                >
                                <div class="d-inline-block mx-2">
                                    <input class="printOpt" type="checkbox" id="front" value="front"
                                           v-model="printOptions">
                                    <label class="printOpt" for="front">Front</label>
                                </div>
                                <div class="d-inline-block mx-2">
                                    <input class="printOpt" type="checkbox" id="back" value="back"
                                           v-model="printOptions">
                                    <label class="printOpt" for="back">Back</label>
                                </div>
                            </div>
                            <div class="mb-2">

                                <div v-if="printOptions.includes('front')">
                                    <label
                                        class="my-1 mr-2 font-weight-bold text-capitalize"
                                        for="frontSizeInputFiled"
                                    >front size*</label
                                    >
                                    <select
                                        class="custom-select my-1 mr-sm-2"
                                        id="frontSizeInputFiled"
                                    >
                                        <option selected>- {{$t('Please_Select')}} -</option>
                                        <option value="1">XL</option>
                                        <option value="2">L</option>
                                        <option value="3">M</option>
                                        <option value="">S</option>
                                    </select>
                                </div>

                                <div v-if="printOptions.includes('back')">
                                    <label
                                        class="my-1 mr-2 font-weight-bold text-capitalize"
                                        for="backSizeInputFiled"
                                    >back size*</label
                                    >
                                    <select
                                        class="custom-select my-1 mr-sm-2"
                                        id="backSizeInputFiled"
                                    >
                                        <option selected>- {{$t('Please_Select')}} -</option>
                                        <option value="1">XL</option>
                                        <option value="2">L</option>
                                        <option value="3">M</option>
                                        <option value="">S</option>
                                    </select>
                                </div>

                            </div>
                            <div class="mb-2">
                                <label
                                    class="my-1 mr-2 font-weight-bold"
                                    for="sizeInput"
                                >T-Shirt Size*</label
                                >
                                <select
                                    class="custom-select my-1 mr-sm-2"
                                    id="sizeInput"
                                >
                                    <option selected>- {{$t('Please_Select')}} -</option>
                                    <option value="1">XL</option>
                                    <option value="2">L</option>
                                    <option value="3">M</option>
                                    <option value="">S</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label
                                    class="my-1 mr-2 font-weight-bold text-capitalize"
                                    for="colorInputFiled"
                                >T-Shirt Color*</label
                                >
                                <select
                                    class="custom-select my-1 mr-sm-2"
                                    id="colorInputFiled"
                                >
                                    <option selected>- {{$t('Please_Select')}} -</option>
                                    <option v-for="color in product.colors"
                                            v-bind:key="color.id"
                                            value="1">{{color.name}}
                                    </option>

                                </select>
                            </div>
                            <div class="form-row">
                                <div class="col-2">
                                    <input
                                        type="number"
                                        value="1"
                                        name="mount"
                                        min="1"
                                        style="background-color:#ffffff; border-radius: 5px"
                                    />
                                </div>
                                <div class="col-4">
                                    <router-link
                                        to="/custom-design"
                                        class="btn btn-primary"
                                        title=""
                                        style="outline: none; margin-top: 3px;"
                                    >
                                        Customize
                                    </router-link>
                                </div>
                                <div class="col-6">
                                    <button
                                        type="submit"
                                        class="btn btn-primary my-1"
                                        style="outline: none;"
                                    >
                                        <i class="fas fa-shopping-cart"></i> {{$t('Add_to_cart')}}
                                    </button>
                                </div>
                            </div>
                        </form>
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
                printOptions: [],
                product: {}
            };
        },
        props: [],

        methods: {
            addToCart: function (product) {
                let root = this.$root;
                axios.get(`/api/v1/add-to-cart/${product.id}`, {
                    id: product.id,
                }).then(function (response) {
                    root.updateCart();
                }).catch((error) => {
                    console.log(error);
                });
                console.log('Add To Cart');
            },
            priceDis: function (price, discount) {
                return price - (price * discount);
            }
        },
        mounted() {
            fetch('/api/v1/design/' + this.$route.params.id).then(res => res.json())
                .then(res => {
                    this.product = res;
                });
        }
    };
</script>

<style lang="scss">
    .productPrice {
        font-size: 25px;
        color: #3a5ea8;
    }

    .printOpt {
        width: auto;
        height: auto;
    }
</style>
