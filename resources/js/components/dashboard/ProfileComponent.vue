<template>
    <div class="col-md-9">
        <!-- Website Overview -->
        <div class="overview">
            <div class="overview-head main-color-bg">
                <h3 class="text-capitalize">{{$t('Profile')}}</h3>
            </div>
            <div class="overview-body p-3 mx-auto">
                <div class="tab-content">
                    <div class="tab-pane active">
                        <h3 class="mx-auto">{{$t('Personal_info')}}</h3>
                        <div class="login-form-container">
                            <div class="login-form">
                                <!-- <div class="alert alert-info alert-dismissable">
                                    <a class="panel-close close" style="cursor: pointer" data-dismiss="alert">×</a>
                                    <i class="fa fa-coffee"></i>
                                    This is an <strong>.alert</strong>. Use this to show important messages to the user.
                                </div> -->
                                <div v-if="error" v-text="this.error" class="alert alert-danger mt-2"
                                     role="alert"></div>
                                <form @submit.prevent="editProfile($root.user.id)" method="post">
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
                                        type="text"
                                        name="name"
                                        v-model="name"
                                        :placeholder="$t('Username')"
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
                                        type="password"
                                        name="password"
                                        v-model="password"
                                        :placeholder="$t('Password')"
                                    />
                                    <input
                                        style="color:blue"
                                        type="text"
                                        id="address"
                                        name="address"
                                        v-model="address"
                                        :placeholder="$t('Address')"
                                    />


                                    <input
                                        style="color:blue"
                                        type="text"
                                        name="age"
                                        v-model="age"
                                        :placeholder="$t('Age')"
                                    />
                                    <input
                                        style="color:blue"

                                        type="text"
                                        name="bank-name"
                                        v-model="BankName"
                                        :placeholder="$t('Bank_Name')"
                                    />
                                    <input
                                        style="color:blue"

                                        type="text"
                                        name="bank-IBAN"
                                        v-model="BankIBAN"
                                        :placeholder="$t('Bank_IBAN')"
                                    />
                                    <input
                                        style="color:blue"

                                        type="text"
                                        name="card-name"
                                        v-model="name_on_BankCard"
                                        :placeholder="$t('Your_Name_on_Bank_Card')"
                                    />

                                    <div class="button-box">
                                        <button
                                            type="submit"
                                            class="btn-style cr-btn"
                                        >
                                            <span>{{$t('Save_Changes')}}</span>
                                        </button>
                                        <button
                                            type="reset"
                                            class="btn-style cr-btn"
                                        >
                                            <span>{{$t('Cancel')}}</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="getAddressInfo">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import { mapMixin } from "../../map";

    export default {
        mixins: [mapMixin],
        data() {
            return {
                firstname: this.$root.user.first_name,
                lastname: this.$root.user.last_name,
                name: this.$root.user.name,
                email: this.$root.user.email,
                password: this.$root.user.password,
                phone: this.$root.user.phone,
                age: this.$root.user.age,
                BankName: this.$root.user.Bank_Name,
                BankIBAN: this.$root.user.IBAN_Bank,
                name_on_BankCard: this.$root.user.name_on_BankCard,
                error: null

            };
        },
        props: [],
        mounted() {
        },
        methods: {
            editProfile: function (id) {
                let _this = this.$root;
                axios.post(`/api/v1/updateUser/${id}`, {
                    firstname: this.firstname,
                    lastname: this.lastname,
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    phone: this.phone,
                    address: this.address,
                    latitude: this.latitude,
                    longitude: this.longitude,
                    age: this.age,
                    BankName: this.BankName,
                    BankIBAN: this.BankIBAN,
                    name_on_BankCard: this.name_on_BankCard,
                }).then((response => {
                    console.log(response);
                    _this.updateUser();
                    _this.$router.push({path: '/dashboard'});
                })).catch(function (error) {
                    let response = error.response;
                    _this.error = response ? error.response.data.message : error;
                });

            },

        }
    };
</script>

<style lang="scss">
</style>
