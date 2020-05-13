<template>
    <div class="col-md-9">
        <div class="overview">
            <div :class="'overview-head main-color-bg '+ $t('text-left')">
                <h3 class="text-capitalize">{{$t('Transactions')}}</h3>
            </div>
            <div class="overview-body p-3 mx-auto">
                <div class="tab-content">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {

    },
    mounted() {

    },
    methods: {

    },
    created: function(){
        console.log('test');
    }
}
</script>

<style scoped>

</style>