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
                            <h4>{{$t('Sales_Price')}}</h4>
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
                            <th class="product-name">{{ $t('Design') }}</th>
                            <th class="product-name">{{ $t('Design_Name') }}</th>
                            <th class="product-name">{{ $t('Design_Rondom_ID') }}</th>
                            <th class="product-name">{{ $t('Design_Price') }}</th>
                            <!-- <th class="product-id">Design Id</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="design in allDesigns" :key="design.id" :id="'row-'+design.id">
                            <td class="product-thumbnail">
                                <a href="#"><img class="img-fluid" :src="design.img"
                                                 alt="product thumbnail"></a>
                            </td>
                            <td class="product-name">
                                <a href="#" class="text-decoration-none">{{ design.name_en }}</a>
                            </td>
                            <td class="product-name">
                                <a href="#" class="text-decoration-none">{{ design.id }}</a>
                            </td>
                            <td class="product-price">
                                <!-- <span class="amount">$</span> -->
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <th>{{$t('size')}}:</th>
                                    <th>{{$t('print_price')}}:</th>
                                    <th>{{$t('designer_price')}}:</th>
                                    <th>{{$t('total')}}:</th>
                                    </thead>
                                    <tbody>
                                    <tr v-for="ds in design.designer_price">
                                        <td>{{ ds.dsize.width }} x {{ ds.dsize.length }}</td>
                                        <td>{{ ds.dsize.print_price }}</td>
                                        <td>{{ ds.designer_price }}</td>
                                        <td>{{ ds.total }} </td>
                                    </tr>
                                    </tbody>
                                </table>
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
                myallDesigns: {},
                overviewContent: []
            };
        },
        props: [],
        mounted() {

            axios.get("/api/v1/designer-designs").then(response => {
                this.myallDesigns = response.data;
            }).catch(function (error) {
                console.log(error);
            });
            axios.get("api/v1/designer-statistic").then(response => {
                this.overviewContent = response.data;
                console.log(this.overviewContent)
            }).catch(function (error) {
                console.log(error);
            });
        },computed: {

            allDesigns:function () {
                // this.myallDesigns = this.$root.updateDesigns()
                return this.myallDesigns;
            }
        },
    };
</script>

<style lang="scss" scoped>
    ul{
        list-style: none;
        padding: 0px;
    }

</style>
