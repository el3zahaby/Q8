<template>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" v-for="(slideshow,i) in slidesshow" :data-slide-to="i" :class="(i===0?'active':'')"></li>
        </ol>
        <div class="carousel-inner">
            <a :href="slideshow.url" v-for="(slideshow,i) in slidesshow" :key="'slider'+slideshow.id" :class="'carousel-item '+ (i===0?'active':'')">
                <img class="d-block w-100" :src="slideshow.img">
            </a>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                slidesshow: []
            };
        },
        mounted() {
            let _this = this;
            axios.get("api/v1/slider").then(response => {
                _this.slidesshow = response.data;
               console.log(_this.slidesshow)
            });
        }
    };
</script>

<style lang="scss" scoped>
    .jssorb053 .i {
        position: absolute;
        cursor: pointer;
    }

    .jssorb053 .i .b {
        fill: #fff;
        fill-opacity: 0.5;
    }

    .jssorb053 .i:hover .b {
        fill-opacity: 0.7;
    }

    .jssorb053 .iav .b {
        fill-opacity: 1;
    }

    .jssorb053 .i.idn {
        opacity: 0.3;
    }

    .jssora093 {
        display: block;
        position: absolute;
        cursor: pointer;
    }

    .jssora093 .c {
        fill: none;
        stroke: #fff;
        stroke-width: 400;
        stroke-miterlimit: 10;
    }

    .jssora093 .a {
        fill: none;
        stroke: #fff;
        stroke-width: 400;
        stroke-miterlimit: 10;
    }

    .jssora093:hover {
        opacity: 0.8;
    }

    .jssora093.jssora093dn {
        opacity: 0.6;
    }

    .jssora093.jssora093ds {
        opacity: 0.3;
        pointer-events: none;
    }
</style>
