<template>
    <div >
        <div class="login-register-area" style="padding: 130px 0;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a
                                    @click.prevent=""
                                    href="#"
                                    class="active text-decoration-none font-weight-bold"
                                >
                                    {{$t('my_order')}}
                                </a>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active">
                                    <table v-if="Object.keys(order).length" class="table table-striped table-bordered table-responsive">
                                        <thead>
                                        <th>Id</th>
                                        <th>orders</th>
                                        <th>total price</th>
                                        <th>order_status</th>
                                        <th>date</th>
                                        </thead>
                                        <tbody>
                                        <tr v-for="$item in order">

                                            <th> {{ $item.id }} </th>
                                            <td>
                                                <table class="mb-1 table-striped  table-bordered">
                                                    <thead>
                                                    <th>Design ID</th>
                                                    <th>design</th>
                                                    <th>tshirt</th>
                                                    <th>print</th>
                                                    <th>Count</th>
                                                    <th>total price</th>
                                                    </thead>
                                                    <tbody v-for="$cart in $item.items">
                                                    <td>{{ $cart.id }}</td>
                                                    <td>{{ $cart.options.product.design.name }} <img :src="$cart.options.product.design.img" :alt="$cart.options.product.design.name"></td>
                                                    <td>
                                                        <ul>
                                                            <li>Size: {{ ($cart.options.tsize.tsize.name) }}</li>
                                                            <li>Color: {{ ($cart.options.tcolor.name) }}</li>
                                                            <li>Price: {{ ($cart.options.tsize.price) }}</li>
                                                        </ul>
                                                    </td>
                                                    <td>

                                                        <div v-if="$cart.options.frontprint">
                                                        <strong>Front</strong>
                                                        <ul>
                                                            <li>Size: {{ ($cart.options.frontprint.dsize.width+ 'X' +$cart.options.frontprint.dsize.length) }}</li>
                                                            <li>Designer Price: {{ ($cart.options.frontprint.designer_price) }}</li>
                                                            <li>Print Price: {{ ($cart.options.frontprint.dsize.print_price) }}</li>
                                                            <li>Total: {{ ($cart.options.frontprint.total) }}</li>
                                                        </ul>
                                                        </div>
                                                        <div v-if="$cart.options.backprint">
                                                        <strong>Back</strong>
                                                        <ul>
                                                            <li>Size: {{ ($cart.options.backprint.dsize.width +'X'+$cart.options.backprint.dsize.length) }}</li>
                                                            <li>Designer Price: {{ ($cart.options.backprint.designer_price) }}</li>
                                                            <li>Print Price: {{ ($cart.options.backprint.dsize.print_price) }}</li>
                                                            <li>Total: {{ ($cart.options.backprint.total) }}</li>
                                                        </ul>
                                                        </div>
                                                    </td>
                                                    <td>{{ ($cart.qty) }}</td>
                                                    <td>{{ ($cart.price*$cart.qty) }}</td>
                                                    </tbody>
                                                </table>

                                            </td>
                                            <td>{{ $item.cart_total }}</td>
                                            <td><span class="badge badge-bg" :style="'background:'+  $item.status.color">{{ $item.status.status }}</span></td>
                                            <td>{{ $item.created_at }}</td>

                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="alert alert-danger" v-else-if="this.noOrderYet === true" ><h3 >No Orders Yet</h3></div>
                                    <div class="alert alert-danger" v-else><h3 ><i class="fa fa-spinner fa-spin"></i></h3></div>
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
        mounted() {
        },
        created() {
            this.fetchOrders()
        },
        data() {
            return {
                order: {},
                noOrderYet:false
            };
        },
        props: [],
        beforeMount() {
            if(Object.keys(this.$root.user).length == 0){
                this.$router.replace('/');
                this.$router.go();
            }
        },
        methods: {
            fetchOrders(page_url) {
                let _this = this;
                page_url = page_url || 'api/v1/myOrder';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        _this.order = res;
                        if (Object.keys(_this.order).length == 0){
                         _this.noOrderYet = true;
                        }
                        console.log(res)
                    })
                    .catch(err => console.log(err));
            }
        }
    };
</script>

