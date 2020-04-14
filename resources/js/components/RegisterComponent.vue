<template>
    <div>

        <div class="login-register-area" style="padding: 130px 0;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <router-link
                                    to="/login"
                                    class="text-decoration-none font-weight-bold"
                                >
                                    {{$t('Login')}}
                                </router-link>

                                <a
                                    @click.prevent=""
                                    href="#"
                                    class="active text-decoration-none font-weight-bold"
                                >
                                    {{$t('Register')}}
                                </a>
                                <router-link
                                    to="/register-as-designer"
                                    class="text-decoration-none font-weight-bold"
                                >
                                    {{$t('Register_as_Designer')}}
                                </router-link>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-form">
                                            <form @submit.prevent="register" method="post">
                                                <input style="color:blue"
                                                       required
                                                       type="text"
                                                       name="firstname"
                                                       v-model="firstname"
                                                       :placeholder="$t('First_Name')"
                                                />
                                                <input
                                                    style="color:blue"
                                                    required
                                                    type="text"
                                                    name="lastname"
                                                    v-model="lastname"
                                                    :placeholder="$t('Last_Name')"
                                                />
                                                <input
                                                    style="color:blue"
                                                    required
                                                    type="email"
                                                    name="user-email"
                                                    v-model="email"
                                                    :placeholder="$t('Email')"
                                                />

                                                <input
                                                    style="color:blue"
                                                    type="text"
                                                    name="phone"
                                                    v-model="phone"
                                                    :placeholder="$t('Phone_Number')"
                                                />
                                                <input
                                                    style="color:blue"
                                                    required
                                                    type="password"
                                                    name="password"
                                                    v-model="password"
                                                    :placeholder="$t('Password')"
                                                />
                                                <input
                                                    style="color:blue"
                                                    type="text"
                                                    name="address"
                                                    v-model="address"
                                                    id="address"
                                                    :placeholder="$t('Address')"
                                                    readonly
                                                />
                                                <input
                                                    style="color:blue"
                                                    type="text"
                                                    name="age"
                                                    v-model="age"
                                                    :placeholder="$t('Age')"
                                                />

                                                <div class="button-box">
                                                    <button
                                                        type="submit"
                                                        class="btn-style cr-btn"
                                                    >
                                                        <span>{{$t('Register')}}</span>
                                                    </button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            v-if="error"
                            v-text="this.error"
                            class="alert alert-danger mt-2"
                            role="alert">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Choose Your Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="map" style="height: 360px; width: 100%"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="getAddressInfo">Save
                            changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapMixin } from "../map";

    export default {
        mixins: [mapMixin],
        data() {
            return {
                firstname: null,
                lastname: null,
                email: null,
                password: null,
                phone: null,
                age: null,
                asDesigner:false,
                error: null
            };
        },
        props: [],
        methods: {
            register: function () {
                let _this = this.$root;
                axios.post('/api/v1/createUser', {
                    firstname: this.firstname,
                    lastname: this.lastname,
                    email: this.email,
                    password: this.password,
                    phone: this.phone,
                    address: this.address,
                    latitude: this.latitude,
                    longitude: this.longitude,
                    age: this.age,

                }).then((response => {
                    _this.updateUser();
                    _this.$router.push({path: '/login'});
                })).catch(function (error) {
                    let response = error.response;
                    _this.error = response ? error.response.data.message : error;
                });

            }
        },
    };
</script>

