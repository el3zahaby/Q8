<template>
    <div class="col-md-9">
        <!-- Website Overview -->
        <div class="overview">
            <div class="overview-head main-color-bg d-flex justify-content-between">
                <h3 class="text-capitalize">{{ $t('Designs') }}</h3>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
                    {{ $t('Add_New_Design') }} <i class="fas fa-plus"></i>
                </button>
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
                                <th class="product-subtotal">{{ $t('delete') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="design in allDesigns" :key="design.id">
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
                                    <!-- {{ design }} -->
                                    <ul >
                                        <!-- <li v-for="size in design.dsizes" >{{ size.width }} x {{size.length}} => </li> -->
                                        <li v-for="index in design.dsizes.length " >
                                            {{ design.dsizes[index-1].width }} x {{ design.dsizes[index-1].length }} => {{ design.design_sizes[index-1].designer_price + design.dsizes[index-1].print_price }}
                                        </li>
                                    </ul>
                                    </td>
                                <!-- <td class="product-id">
                                {{ design.id }}
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
                            <h5 class="modal-title" id="exampleModalLabel">{{ $t('New_Design') }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-secondary EN_btn">EN</button>
                            <button type="button" class="btn btn-secondary AR_btn">AR</button>
                        </div>
                        <div class="modal-body">
                            <div class="custom-file">
                                <div class="form-group">
                                    <input style="background-color: transparent" type="text" name="designPrice"
                                        :placeholder="$t('Design_Price')" v-model="designPrice" required />
                                </div>
                                <div class="form-group EN">
                                    <input style="background-color: transparent" type="text" name="designName"
                                        :placeholder="$t('Design_Name')" v-model="designName" required />
                                </div>


                                <div class="form-group AR">
                                    <input style="background-color: transparent" type="text" name="designNameAr"
                                        :placeholder="$t('Design_Name_Ar')" v-model="designNameAr" required />
                                </div>

                                

                                <div class="form-group EN">
                                    <textarea style="background-color: transparent" name="designDesc"
                                        :placeholder="$t('Design_Description')" v-model="designDesc"></textarea>
                                </div>


                                <div class="form-group AR">
                                    <textarea style="background-color: transparent" name="designDescAr"
                                        :placeholder="$t('Design_Description_Ar')" v-model="designDescAr"></textarea>
                                </div>

                                <div class="form-group" >
                                    <p>Choose Sizes :</p>
                                    <hr>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-2">check :</div>
                                            <div class="col-3">size :</div>
                                            <div class="col-2">print price :</div>
                                            <div class="col-3">price :</div>
                                            <div class="col-2 text-center">total :</div>
                                            <div class="col-12"><hr></div>
                                        </div>
                                        <div class="row" v-for="size in allSizes" :key="size.id" >
                                            <div class="col-2" >
                                                <input type="checkbox" v-on:change="makeRequired(size.id)" />
                                            </div>
                                            <div class="col-3" > {{ size.width }} x {{ size.length }} </div>
                                            <div class="col-2" > {{ size.print_price }}</div>
                                            <div class="col-3" >
                                                <input type="number" class="form-control" v-bind:class="'size_'+size.id" min="0" v-model="sizesPrice[size.id]" />
                                            </div>
                                            <div class="col-2 text-center">{{size.print_price}}</div>
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group position-relative pt-2">
                                    <input type="file" class="custom-file-input" id="customFile" @change="onFileChange"
                                        required>
                                    <label class="custom-file-label"
                                        for="customFile">{{ $t('Choose_Design_img') }}</label>
                                </div>
                            </div>
                            <div class="img-prev pt-2">
                                <img class="img-fluid" v-if="imgDesignURL" :src="imgDesignURL" alt="Design Img" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ $t('Close') }}
                            </button>
                            <button type="submit"
                                class="btn btn-primary">{{ $t('Add_Design') }}</button>
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
                allSizes: [],
                sizesPrice: [],
                imgDesignURL: null,
                designPrice: null,
                designName: null,
                designDesc: null,
                imagePath: null,
                image: null,
                test: null,
                designNameAr: null,
                designDescAr: null,
            };
        },
        props: [],
        methods: {
            submit() {
                let _root = this.$root;
                let _this = this;
                console.log(this);
                // return ;
                let fd = new FormData();

                fd.append('image', this.image);

                axios.post('/api/v1/upload-image', fd)
                    .then(resp => {
                        _this.imagePath = resp.data;
                        console.log(this.imagePath);
                        let data = {
                            price: this.designPrice,
                            name_en: this.designName,
                            name_ar: this.designNameAr,
                            desc_ar: this.designDescAr,
                            desc_en: this.designDesc,
                            img: this.imagePath,
                            dsizes : this.sizesPrice,
                        };

                        axios.post('/api/v1/add-to-design', data).then(function (response) {
                            _this.imgDesignURL = null;
                            _this.designPrice = null;
                            _this.designName = null;
                            _this.designDesc = null;
                            _this.imagePath = null;
                            _root.updateDesigns();

                            $('.modal').modal('toggle');
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
            makeRequired(size_id) {
                // console.log(".size_"+size_id);
                // console.log($('.size_'+size_id).attr('required'));

                if($('.size_'+size_id).attr('required') == 'required')
                {
                    $('.size_'+size_id).removeAttr('required');
                }else{
                    $('.size_'+size_id).attr('required','required');
                }
            }


        },
        mounted() {
            $(".custom-file-input").on("change", function () {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            $(".AR").css('display','none');

            $(".EN_btn").on('click',function(){
                $(".AR").css('display','none');
                $(".EN").css('display','block');
            })
            $(".AR_btn").on('click',function(){
                $(".EN").css('display','none');
                $(".AR").css('display','block');
            })

        },
        created() {
            axios.get("/api/v1/designer-designs").then(response => {
                this.allDesigns = response.data;
            }).catch(function (error) {
                console.log(error);
            });

            axios.get("/api/v1/dsizes")
            .then(res => {
                // console.log("after allsizes => " + this.allSizes);
                this.allSizes = res.data ;
                // console.log("before allsizes => " + this.allSizes[0].length);
            })
            .catch(err => console.log(err));

            
        }
    };

</script>

<style lang="scss" scoped>
    .modal .row > *
    {
        margin: 0px;
        padding: 0px;
    }
    @media (min-width: 576px) {
        .modal-dialog
        {
            max-width: 800px;
        }
    }
    ul{
        list-style: none;
        padding: 0px;
    }
</style>
