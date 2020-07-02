<template>
    <div>
        <div v-if="type==='view'||type==='view-most'" class="w-100" style="height: 200px">
            <canvas :id="'img-'+this.design.id+(type==='view'?'-view':type)"
                 class="position-absolute w-100"
                    width="352" height="448"
                 style="clip: rect(0px, auto, 200px, 0px);width: 200%;display: block;"
                    :src="design.thump"></canvas>
        </div>

        <canvas v-else
                width="352" height="448"
                :id="'img-'+this.design.id+(type==='view'?'-view':type)" class="w-100 h-100" :src="design.thump"></canvas>

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
        props: ['type', 'design','ccolor','printOption'],
        methods: {},
        mounted() {
            let _this = this;
            let design =_this.design;


            let $tcolor = _this.ccolor? _this.ccolor.name: _get_color();


            $(document).ready(function () {
                getProductShirt(design.thump,'img-'+design.id+(_this.type==='view'?'-view':_this.type),$tcolor,_this.printOption)
            });

        }
    };

    export function _get_color() {
        // var colors = ['#0dd4ad', '#ff5050', '#ff80ff', '#ffff1b', '#00b3e6','#FFFFFF'];
        var colors = ['#ffffff'];
        return colors[Math.floor(Math.random() * colors.length)];
    }
    export function getProductShirt(img,id,color,printOpt) {

        let $tcolor = color;




        //--
        let canvas = document.getElementById(id);

        const getContext = () => canvas.getContext('2d');

        if (printOpt === 'front_back') {
            canvas.height = canvas.height * 2;
        }
        // It's better to use async image loading.
        const loadImage = url => {
            return new Promise((resolve, reject) => {
                const img = new Image();
                img.onload = () => resolve(img);
                img.onerror = () => reject(new Error(`load ${url} fail`));
                img.src = url;
            });
        };



        // Here, I created a function to draw image.
        const depict = options => {
            const ctx = getContext();




            // And this is the key to this solution
            // Always remember to make a copy of original object, then it just works :)
            const myOptions = Object.assign({}, options);
            return loadImage(myOptions.uri).then(img => {
                if (myOptions.name === 'draw'){
                    let maxSize = 160;
                    let ratio = Math.min(maxSize / img.width, maxSize / img.height);
                    let width = img.width * ratio,
                        height = img.height * ratio;
                    console.log(ratio, width, height);

                    ctx.drawImage(img,  myOptions.x, myOptions.y, width, height);
                    if (printOpt === 'front_back'){
                        let maxSize = 120;
                        let ratio = Math.min(maxSize / img.width, maxSize / img.height);
                        let width = img.width * ratio,
                            height = img.height * ratio;
                        ctx.drawImage(img,  115, 520, width, height);
                    }
                }else {
                    if (myOptions.name === printOpt) {
                        ctx.fillStyle = $tcolor;
                        ctx.fillRect(0, 0, canvas.width, canvas.height);
                        ctx.drawImage(img, myOptions.x, myOptions.y, canvas.width, canvas.height);
                    }
                    if (printOpt === 'front_back'){
                        if (myOptions.name === 'front') {
                            ctx.fillStyle = $tcolor;
                            ctx.fillRect(0, 0, canvas.width, canvas.height);
                            ctx.drawImage(img, myOptions.x, myOptions.y, canvas.width, canvas.height / 2);
                        }else {
                            ctx.drawImage(img, myOptions.x, canvas.height / 2, canvas.width, canvas.height / 2);
                        }

                    }
                }
            });

        };


        const imgs = [
            { uri: '/assets/images/shirt/front/shirt.png',name:'front', x: 0, y:  0, sw: canvas.width, sh: canvas.height },
            { uri: '/assets/images/shirt/back/shirt.png',name:'back', x: 0, y:  0, sw: canvas.width, sh: canvas.height  },
            { uri: img,name:'draw', x: 95, y: 90, sw: 0, sh: 0 }
        ];

        imgs.forEach(depict);
        ctx.fillStyle = $tcolor;
        ctx.fillRect(0, 0, canvas.width, canvas.height);
    }




</script>

<style lang="scss" scoped>

</style>
