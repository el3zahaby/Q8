<template>

    <div id="pageBody" class="m-3 card" v-if="Object.keys(page).length">
            <div>
                <h1 class="card-header">{{ page.title }}</h1>
            </div>
            <div class="card-body">
                <img :src="page.image" v-if="page.image" class="border p-1 card-body shadow-lg d-block w-50 m-auto" onerror="this.src= '/images/no-image.png'" >
                <div v-html="page.body"></div>
            </div>
        </div>
    <div :class="'m-3 card ' + $t('text-left')" v-else>
        <div class="error_section py-md-5 py-4" v-if="err404">
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
        <h1 class="text-center" v-else><i class="fa fa-spinner fa-spin "></i></h1>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                page: {},
                err404: false,
            };
        },
        props: [],

        mounted() {
            fetch('/api/v1/page/' + this.$route.params.slug).then(res => res.json())
                .then(res => {
                    this.page = res;
                    console.log(res)
                }).catch(res=>{
                this.err404 = true
                });
        }
    }
</script>

<style scoped>
img{
    max-width: 100%;
}
</style>
