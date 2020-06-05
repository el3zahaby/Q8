<template>
    <div class="col-md-9">
        <div class="overview">
            <div :class="'overview-head main-color-bg '+ $t('text-left')">
                <h3 class="text-capitalize">{{$t('Transactions')}}</h3>
            </div>
            <div class="overview-body p-3 mx-auto">
                <div class="tab-content">
                    <div v-for="m in moneyReq" :key="m.id" >
                        <div v-if="m.status == 1" class="add rounded p-2 my-2">
                            <h6>{{$t('You have a new sell with')}} : {{ m.amount }}</h6>
                            <p>{{ m.created_at }}</p>
                        </div>
                        <div v-if="m.status == 0" class="remove rounded p-2">
                            <h6>{{$t('You have recieved')}} : {{ m.amount }} </h6>
                            <p>{{ m.created_at }}</p>
                        </div>
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
            moneyReq : [ 'fdslak' , 'fasd' ]
        }
    },mounted() {
        axios.get('/api/v1/designer-requests').then(res => {
            this.moneyReq = res.data;
        });
        console.log(this.moneyReq);
    }
}
</script>

<style scoped>

.add{
    background-color: #5c8;
}
.remove{
    background-color: #f65;
}

</style>