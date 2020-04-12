<template>
    <div>

        <div class="login-register-area" style="padding: 130px 0;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a
                                    @click.prevent=""
                                    href="#"
                                    class="active text-decoration-none font-weight-bold"
                                >
                                    {{$t('Login')}}
                                </a>
                                <router-link
                                    to="/register"
                                    class="text-decoration-none font-weight-bold"
                                >
                                    {{$t('Register')}}
                                </router-link>
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
                                            <form action="#" method="post">
                                                <input
                                                    v-model="user.username"
                                                    type="text"
                                                    name="user-name"
                                                    :placeholder="$t('Email')"
                                                />
                                                <input
                                                    v-model="user.password"
                                                    type="password"
                                                    name="user-password"
                                                    :placeholder="$t('Password')"
                                                />
                                                <div class="button-box">
                                                    <div
                                                        class="login-toggle-btn"
                                                    >
                                                        <input
                                                            type="checkbox" v-model="user.rememberMe"
                                                        />
                                                        <label
                                                        >{{$t('Remember_me')}}</label
                                                        >
                                                        <a href="#"
                                                        >{{$t('Forgot_Password')}}</a
                                                        >
                                                    </div>
                                                    <button
                                                        @click.prevent="login()"
                                                        type="submit"
                                                        class="btn-style cr-btn"
                                                    >
                                                        <span>{{$t('Login')}}</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="error" v-text="this.error" class="alert alert-danger mt-2" role="alert"></div>
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
                user: {
                    username: '',
                    password: '',
                    rememberMe: false,
                },
                error: null
            };
        },
        methods: {
            login() {
                let _this = this;
                let params = {
                    email: this.user.username,
                    password: this.user.password,
                    remember: this.user.rememberMe,
                };
                axios.post("api/v1/login", params).then(function (response) {
                    _this.$root.updateUser();
                    _this.$router.push({path: '/'});
                }).catch(function (error) {
                    let response = error.response;
                    _this.error = response ? error.response.data.message : error;
                });
            }
        },
        props: [],
        mounted() {
        }
    };
</script>


<style lang="scss">

    .login-form-container {
        background: transparent none repeat scroll 0 0;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);
        padding: 80px;
        text-align: left;
    }

    .login-text {
        margin-bottom: 30px;
        text-align: center;
    }

    .login-text h2 {
        color: #444;
        font-size: 30px;
        margin-bottom: 5px;
        text-transform: capitalize;
    }

    .login-text span {
        font-size: 15px;
    }

    .login-form-container input {
        background-color: #f7f7f7;
        border: medium none;
        color: #7d7d7d !important;
        font-size: 13px;
        font-weight: 500;
        height: 50px;
        padding: 0 15px;
        margin-bottom: 30px;
    }

    .login-form-container input::-moz-placeholder,
    .login-form-container input::-webkit-placeholder {
        color: #7d7d7d !important;
        opacity: 1;
    }

    .login-toggle-btn {
        padding: 10px 0 19px;
    }

    .login-form-container input[type="checkbox"] {
        height: 15px;
        margin: 0;
        position: relative;
        top: 1px;
        width: 17px;
    }

    .login-form-container label {
        color: #777;
        font-size: 15px;
        font-weight: 400;
    }

    .login-toggle-btn > a {
        color: #666;
        float: right;
        transition: all 0.3s ease 0s;
    }

    .login-toggle-btn > a:hover {
        color: #3a5ea8;
    }

    .login-register-tab-list {
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
    }

    .login-register-tab-list.nav a {
        color: #000;
        font-size: 25px;
        font-weight: 500;
        margin: 0 20px;
        text-transform: capitalize;
        transition: all 0.3s ease 0s;
        cursor: pointer;
    }

    .login-register-tab-list.nav a.active,
    .login-register-tab-list.nav a:hover {
        color: #3a5ea8;
    }

    .login-form button {
        border: medium none;
        cursor: pointer;
    }

    .designer-section {
        display: none;
    }
</style>
