<template>
    <div class="col-md-9">
        <!-- Website Overview -->
        <div class="overview">
            <div class="overview-head main-color-bg">
                <h3>{{$t('Overview')}}</h3>
            </div>
            <div class="overview-body">
                <div class="row mx-auto p-3">
                    <div class="col-md-4">
                        <div class="box">
                            <h3> {{overviewContent[0]}}</h3>
                            <h4>{{$t('Designs_Number')}}</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <h3> {{overviewContent[1]}}</h3>
                            <h4>{{$t('Sales_Number')}}</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <h3> {{overviewContent[2]}}</h3>
                            <h4>${{$t('Sales_Price')}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="overview">
            <div class="overview-head">
                <h3 class="text-capitalize">{{$t('latest_Designs')}}</h3>
            </div>
            <div class="overview-body p-3">
                <div class="table-content table-responsive">
                    <table class="text-center">
                        <thead>
                        <tr>
                            <th class="product-name">{{$t('Design')}}</th>
                            <th class="product-name">{{$t('Design_Name')}}</th>
                            <th class="product-name">{{$t('Design_Rondom_ID')}}</th>
                            <th class="product-name">{{$t('Design_Price')}}</th>
                            <!-- <th class="product-id">Design Id</th> -->
                            <th class="product-subtotal">{{$t('delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="design in  this.$root.latestDesigns" :key="design.id">
                            <td class="product-thumbnail">
                                <a href="#"><img class="img-fluid" :src="'storage/'+design.img" alt="product thumbnail"></a>
                            </td>
                            <td class="product-name">
                                <a href="#" class="text-decoration-none">{{design.name}}</a>
                            </td>
                            <td class="product-name">
                                <a href="#" class="text-decoration-none">{{design.random_name}}</a>
                            </td>
                            <td class="product-price"><span class="amount">${{ design.price }}</span></td>
                            <!-- <td class="product-id">
                                {{design.id}}
                            </td> -->
                            <td class="product-cart-icon product-subtotal">
                                <a href="#" @click.prevent="$root.deleteDesign(design.id)"><i
                                    class="delete far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {

                overviewContent: []
            };
        },
        props: [],
        mounted() {
            axios.get("api/v1/designer-statistic").then(response => {
                this.overviewContent = response.data;
            }).catch(function (error) {
                console.log(error);
            });
        }
    };
</script>

<style lang="scss" scoped>
</style>
