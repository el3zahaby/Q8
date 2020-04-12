<template>
    <div class="error_section py-md-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="error_form">
                        <h1>404</h1>
                        <h2>Opps! PAGE NOT BE FOUND</h2>
                        <p>Sorry but the page you are looking for does not exist, have been<br> removed, name changed or
                            is temporarity unavailable.</p>

                        <router-link to="/" class="text-decoration-none">Back to home page</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .error_form {
        text-align: center;
    }

    .error_form h1 {
        font-size: 200px;
        font-weight: 900;
        color: #3a5ea8;
        letter-spacing: 10px;
        line-height: 1.1;
        margin: 0 0 30px;
    }

    .error_form h2 {
        color: #666666;
        font-size: 35px;
        text-transform: uppercase;
        font-weight: 700;
        line-height: 40px;
        margin-bottom: 25px;
    }

    .error_form p {
        font-size: 22px;
        font-weight: 300;
        line-height: 32px;
        color: #8c8c8c;
        margin-bottom: 30px;
    }

    .error_form a {
        color: #fff;
        display: inline-block;
        background: #3a5ea8;
        border-radius: 35px;
        font-size: 12px;
        font-weight: bold;
        height: 40px;
        line-height: 40px;
        padding: 0 30px;
        text-transform: uppercase;
        margin-top: 60px;
    }

    .error_form a:hover {
        background: #000;
    }

    @media (max-width: 767px) {
        .error_form h2 {
            font-size: 25px;
        }

        .error_form h1 {
            font-size: 150px;
            margin: 0 0 20px;
        }

        .error_form a {
            margin-top: 35px;
        }
    }
</style>
