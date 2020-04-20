<template>
    <div id="pageBody" class=" m-3 card">
        <div>
            <h1 class="card-header">{{ page.title }}</h1>
        </div>
        <div class="card-body">
            <img :src="page.image" v-if="page.image" class="border p-1 card-body shadow-lg d-block w-50 m-auto" onerror="this.src= '/images/no-image.png'" >
            <div v-html="page.body"></div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                page: {}
            };
        },
        props: [],

        mounted() {
            fetch('/api/v1/page/' + this.$route.params.slug).then(res => res.json())
                .then(res => {
                    this.page = res;
                    console.log(res)
                });
        }
    }
</script>

<style scoped>
img{
    max-width: 100%;
}
</style>
