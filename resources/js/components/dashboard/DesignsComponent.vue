<template>
    <div class="col-md-9">
        <!-- Website Overview -->
        <div class="overview">
            <div class="overview-head main-color-bg d-flex justify-content-between">
                <h3 class="text-capitalize">{{$t('Designs')}}</h3>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
                    {{$t('Add_New_Design')}} <i class="fas fa-plus"></i>
                </button>
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
                        <tr v-for="design in this.$root.allDesigns" :key="design.id">
                            <td class="product-thumbnail">
                                <a href="#"><img class="img-fluid" :src="'/storage/'+design.img"
                                                 alt="product thumbnail"></a>
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

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form @submit.prevent="submit" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{$t('New_Design')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="custom-file">
                                <div class="form-group">
                                    <input
                                        style="background-color: transparent"
                                        type="text"
                                        name="designPrice"
                                        :placeholder="$t('Design_Price')"
                                        v-model="designPrice"
                                        required
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        style="background-color: transparent"
                                        type="text"
                                        name="designName"
                                        :placeholder="$t('Design_Name')"
                                        v-model="designName"
                                        required
                                    />
                                </div>
                                <div class="form-group position-relative pt-2">
                                    <input type="file" class="custom-file-input" id="customFile" @change="onFileChange"
                                           required>
                                    <label class="custom-file-label"
                                           for="customFile">{{$t('Choose_Design_img')}}</label>
                                </div>
                            </div>
                            <div class="img-prev pt-2">
                                <img class="img-fluid" v-if="imgDesignURL" :src="imgDesignURL" alt="Design Img"/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{$t('Close')}}
                            </button>
                            <button type="submit" class="btn btn-primary">{{$t('Add_Design')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                allDesigns: [],
                imgDesignURL: null,
                designPrice: null,
                designName: null,
                imagePath: null,
                image:null,
            };
        },
        props: [],
        methods: {
            submit() {
                let _root = this.$root;
                let _this = this;

                let fd = new FormData();

                fd.append('image', this.image);

                axios.post('/api/v1/upload-image', fd)
                    .then(resp => {
                        _this.imagePath = resp.data;
                        console.log(this.imagePath);
                        let data = {
                            price: this.designPrice,
                            name: this.designName,
                            img: this.imagePath
                        };

                        axios.post('/api/v1/add-to-design', data).then(function (response) {
                            _this.imgDesignURL = null;
                            _this.designPrice = null;
                            _this.designName = null;
                            _this.imagePath = null;
                            _root.updateDesigns();
                        });
                    });
            },
            onFileChange(e) {
                const file = e.target.files[0];
                this.image = file;
                this.imgDesignURL = URL.createObjectURL(file);
            },
            addDesign: function () {
                let _this = this.$root;
                axios.post('/api/v1/add-to-design', {
                    price: this.designPrice,
                    name: this.designName,
                    img: this.imgDesignURL
                }).then((response => {
                    this.imgDesignURL = null;
                    this.designPrice = null;
                    this.designName = null;
                    _this.updateDesigns();
                })).catch((error) => {
                    console.log(error);
                });
            },


        }
        ,
        mounted() {
            $(".custom-file-input").on("change", function () {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        },
        created() {
            // axios.get("/api/v1/designer-designs").then(response => {
            //     this.allDesigns = response.data;
            // }).catch(function (error) {
            //     console.log(error);
            // });
        }
    };
</script>

<style lang="scss" scoped>
</style>
