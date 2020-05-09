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
                                <th class="product-name">{{ $t('Accepted') }}</th>
                                <!-- <th class="product-id">Design Id</th> -->
                                <th class="product-subtotal">{{ $t('delete') }}</th>
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
                                <!-- <td class="product-id">
                                {{ design.id }}
                            </td> -->
                            <td>
                                {{ design.accepting ?"YES":'NO'}}
                            </td>
                                <td class="product-cart-icon product-subtotal">
                                    <a href="#" @click.prevent="deleteDesign(design.id)"><i
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
                    <form @submit.prevent="submit" method="post" name="add_design">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ $t('New_Design') }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="alert alert-danger error " v-if="Object.keys(getErr).length">
                            <p v-for="(item,index) in getErr">{{index+": "+item}}</p>
                        </div>
                        <div class="modal-body">
                            <div class="btn-group mb-2" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-secondary EN_btn">EN</button>
                                <button type="button" class="btn btn-secondary AR_btn">AR</button>
                            </div>
                            <div class="custom-file">
                                <div class="form-group EN">
                                    <input style="background-color: transparent" type="text" name="name_en"
                                        :placeholder="$t('Design_Name')" v-model="designName" required />
                                </div>


                                <div class="form-group AR">
                                    <input style="background-color: transparent" class="name_ar" type="text" name="name_ar"
                                        :placeholder="$t('Design_Name_Ar')" v-model="designNameAr"  />
                                </div>



                                <div class="form-group EN">
                                    <textarea style="background-color: transparent" name="desc_en"
                                        :placeholder="$t('Design_Description')" v-model="designDesc"></textarea>
                                </div>


                                <div class="form-group AR">
                                    <textarea style="background-color: transparent" name="desc_ar"
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
                                                <input type="checkbox" v-on:change="makeRequired(size.id)" class="size_check"/>
                                            </div>
                                            <div class="col-3" > {{ size.width }} x {{ size.length }} </div>
                                            <div class="col-2" > {{ size.print_price }}</div>
                                            <div class="col-3" >
                                                <input type="number" max="9999999" class="form-control"  readonly v-bind:class="'size_'+size.id" min="1" name="dsize[]" v-model="sizesPrice[size.id]" />
                                            </div>
                                            <div class="col-2 text-center" v-bind:class=" 'total-'+size.id " >{{size.print_price + parseInt(sizesPrice[size.id] ? sizesPrice[size.id] :0)}}</div>
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
                                <img class="img-fluid" width="120" v-if="imgDesignURL" :src="imgDesignURL" alt="Design Img" />
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
                myallDesigns: [],
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
                errors : {},
            };
        },
        props: [],
        methods: {
            deleteDesign: function (id) {
                let _this = this;
                axios.get(`/api/v1/delete-design/${id}`).then(function (response) {
                    _this.myallDesigns = response.data
                    // console.log(_this.allDesigns)

                    _this.$root.updateDesigns();
                });
            },

            submit() {
                let _root = this.$root;
                let _this = this;
                console.log(this);
                // return ;
                this.validateForm();
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

                            _this.myallDesigns = response.data
                            console.log(_this.myallDesigns)
                            $('.modal').modal('toggle');
                        }).catch(err => {
                            console.log( JSON.stringify(err.response.data.errors));
                            _this.errors = err.response.data.errors;

                            $.each(_this.errors,function(key,value) {
                                // alert(key)
                                $('[name="' + key + '"]').addClass('invalid error').parent().show();
                                $('[name="' + key + '"]').after(
                                    "<small class='helper-text text-danger'>" + value +
                                    "</small>")
                            });
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
                    _root.updateDesigns();
                })).catch((error) => {
                    console.log(error);
                });
            },
            makeRequired(size_id) {

                if ($('.size_'+size_id).attr('required') != 'required') {
                    $('.size_'+size_id).attr('required', '');
                    $('.size_'+size_id).removeAttr('readonly');
                } else {
                    $('.size_'+size_id).val('');
                    $('.size_'+size_id).removeAttr('required');
                    $('.size_'+size_id).attr('readonly','');

                }
            },
            validateForm() {
                var x = $('.name_ar').val();
                // if (x == "" | x == null) {
                //     alert("Name must be filled out");
                //     return false;
                // }
            },


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
                this.myallDesigns = response.data;
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

        },computed: {
            getErr: function() {
                return this.errors;
            },
            allDesigns:function () {
                // this.myallDesigns = this.$root.updateDesigns()
                return this.myallDesigns;
            }
        },
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
    .invalid.error {
        border: 2px solid #ff003b !important;
    }
</style>
