<template>
    <div class="col-md-9">
        <div class="overview">
            <div :class="'overview-head main-color-bg '+ $t('text-left')">
                <h3 class="text-capitalize">{{$t('Transactions')}}</h3>
            </div>
            <div class="overview-body p-3 mx-auto">
                <div :class="'tab-content '+ $t('text-left')" >

                    <DIV v-if="moneyReq.length > 0">
                        <input id="reqMoney" @change="reqM()" type="checkbox"  v-model="reqMoney" class="d-inline w-auto" >
                        <label for="reqMoney">طلب الاموال</label>
                        <div class="alert alert-info alert-dismissable" v-if="reqMoney">
                            <a class="panel-close close" style="cursor: pointer" data-dismiss="alert">×</a>
                            <i class="fa fa-coffee"></i>
                            تم تلقي طلب سحب الموال الخاص بك .. نرجو الإنتظار
                        </div>
                    </DIV>
                    <H3 v-else>
                        {{$t('no_pays')}}
                    </H3>
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
            reqMoney:this.$root.user.settings.reqMoney,

            moneyReq : [  ]
        }
    },
    methods:{
        reqM:function(){
            $.LoadingOverlay("show");
            let _this = this.$root;
            let __this = this;
            axios.post(`/api/v1/updateUser/`, {
                reqMoney: __this.reqMoney,
                noUpdate: true,
            }).then((response => {
                _this.updateUser();
                $.LoadingOverlay("hide");
            })).catch(function (error) {
                let response = error.response;
                __this.error = response ? error.response.data.message : error;
            });
        }
    },
    mounted() {
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
