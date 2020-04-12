<template>
    <div>
        <div v-if="type==='view'||type==='view-most'" class="w-100" style="height: 200px">
            <img :id="'img-'+this.design.id+(type==='view'?'-view':type)"
                 class="position-absolute"
                 style="clip: rect(0px, auto, 200px, 0px);width: 200%;margin-left: -50%;"
                 src="">
        </div>

        <img v-else :id="'img-'+this.design.id+(type==='view'?'-view':type)" class="w-100 h-100" src="">

        <div id="main-container" class="px-3 d-none">
            <div :id="'clothing-designer-'+this.design.id+(type==='view'?'-view':type)"></div>
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
            let $yourDesigner = $("#clothing-designer-" + _this.design.id + (_this.type === 'view' ? '-view' : _this.type)),
                pluginOpts = {
                    mainBarModules: [],
                    productsJSON: getProductJson(_this.design), //see JSON folder for products sorted in categories
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

            //you can listen to events
            $yourDesigner.on('productCreate', async function () {
                yourDesigner.getProductDataURL(function (dataURL) {
                    $('#img-' + _this.design.id + (_this.type === 'view' ? '-view' : _this.type)).attr('src', dataURL);
                });
            });
        }
    };

    export function getProductJson(pdesign) {
        return [[
            {
                "title": "Shirt Front",
                "thumbnail": "images/yellow_shirt/front/preview.png",
                "elements": [

                    {
                        "type": "image",
                        "source": "images/yellow_shirt/front/base.png",
                        "title": "Base",
                        "parameters": {
                            "autoCenter": true,
                            "colors": "#d59211",
                            "price": 20,
                            "colorLinkGroup": "Base",
                            "fill": false
                        }
                    },
                    {
                        "type": "image",
                        "source": "images/yellow_shirt/front/shadows.png",
                        "title": "Shadow",
                        "parameters": {
                            "autoCenter": true,
                            "fill": false
                        }
                    },
                    {
                        "type": "image",
                        "source": "/storage/" + pdesign.img,
                        "title": "Image Title",
                        "parameters": {
                            "boundingBox": {
                                "x": 350,
                                "y": 160,
                                "width": 200,
                                "height": 200
                            },
                            "boundingBoxMode": "clipping",
                            "scaleMode": "fit",
                            "resizeToW": 200,
                            "resizeToH": 200,
                            "autoCenter": true
                        }
                    },
                    {
                        "type": "image",
                        "source": "images/yellow_shirt/front/body.png",
                        "title": "Hightlights",
                        "parameters": {
                            "left": 447,
                            "top": 108,
                            "fill": false
                        }
                    }
                ]
            },
            {
                "title": "Shirt Back",
                "thumbnail": "images/yellow_shirt/back/preview.png",
                "elements": [
                    {
                        "type": "image",
                        "source": "images/yellow_shirt/back/base.png",
                        "title": "Base",
                        "parameters": {
                            "autoCenter": true,
                            "colorLinkGroup": "Base",
                            "price": 20,
                            "fill": false
                        }
                    },
                    {
                        "type": "image",
                        "source": "images/yellow_shirt/back/body.png",
                        "title": "Hightlights",
                        "parameters": {
                            "left": 467,
                            "top": 90,
                            "fill": false
                        }
                    },
                    {
                        "type": "image",
                        "source": "images/yellow_shirt/back/shadows.png",
                        "title": "Shadow",
                        "parameters": {
                            "autoCenter": true,
                            "fill": false
                        }
                    }
                ]
            }
        ]];
    }
</script>

<style lang="scss" scoped>

</style>
