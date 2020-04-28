<template>
    <div>
        <div v-if="type==='view'||type==='view-most'" class="w-100" style="height: 200px">
            <img :id="'img-'+this.design.design.id+(type==='view'?'-view':type)"
                 class="position-absolute"
                 style="clip: rect(0px, auto, 200px, 0px);width: 200%;margin-left: -50%;"
                 src="">
        </div>

        <img v-else :id="'img-'+this.design.design.id+(type==='view'?'-view':type)" class="w-100 h-100" src="">

        <div id="main-container" class="px-3 d-none">
            <div :id="'clothing-designer-'+this.design.design.id+(type==='view'?'-view':type)"></div>
            <br/>
        </div>
    </div>
</template>

<script>
    export default {
        ready() {
        },
        data() {
            return {};
        },
        props: ['type', 'design'],
        methods: {},
        mounted() {
            let _this = this;
            let design =_this.design.design;
            let $yourDesigner = $("#clothing-designer-" + design.id + (_this.type === 'view' ? '-view' : _this.type)),
                pluginOpts = {
                    mainBarModules: [],
                    productsJSON: getProductJson(design), //see JSON folder for products sorted in categories
                    customImageParameters: {

                    },
                    actions: {
                        top: [],
                        right: [],
                        bottom: [],
                        left: []
                    }
                },
                yourDesigner = new FancyProductDesigner(
                    $yourDesigner,
                    pluginOpts
                );
            // console.log( "#clothing-designer-" + design.id + (_this.type === 'view' ? '-view' : _this.type))
            //you can listen to events
            $yourDesigner.on('productCreate', async function () {
                yourDesigner.getProductDataURL(function (dataURL) {
                    $('#img-' + design.id + (_this.type === 'view' ? '-view' : _this.type)).attr('src', dataURL);
                });
            });
        }
    };

    export function getProductJson(pdesign,printOpt) {
        return [[

        ]];
    }
</script>

<style lang="scss" scoped>

</style>
