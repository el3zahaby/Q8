<template>
    <div
        id="jssor_1"
        style="position:relative;margin:0 auto;top:0;left:0;width:980px;height:380px;overflow:hidden;visibility:hidden;background-color: #FFFFFF;"
    >
        <div
            data-u="slides"
            style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;"
        >
            <div v-for="slideshow in slidesshow" :key="slideshow.id">
                <a :href="slideshow.url">
                    <img data-u="image" :src="'storage/' + slideshow.img"/>
                </a>
            </div>
        </div>
        <!-- Bullet Navigator -->
        <div
            data-u="navigator"
            class="jssorb053"
            style="position:absolute;bottom:12px;right:12px;"
            data-autocenter="1"
            data-scale="0.5"
            data-scale-bottom="0.75"
        >
            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                <svg
                    viewBox="0 0 16000 16000"
                    style="position:absolute;top:0;left:0;width:100%;height:100%;"
                >
                    <path
                        class="b"
                        d="M11400,13800H4600c-1320,0-2400-1080-2400-2400V4600c0-1320,1080-2400,2400-2400h6800 c1320,0,2400,1080,2400,2400v6800C13800,12720,12720,13800,11400,13800z"
                    ></path>
                </svg>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div
            data-u="arrowleft"
            class="jssora093"
            style="width:50px;height:50px;top:0px;left:30px;"
            data-autocenter="2"
            data-scale="0.75"
            data-scale-left="0.75"
        >
            <svg
                viewBox="0 0 16000 16000"
                style="position:absolute;top:0;left:0;width:100%;height:100%;"
            >
                <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                <polyline
                    class="a"
                    points="7777.8,6080 5857.8,8000 7777.8,9920 "
                ></polyline>
                <line
                    class="a"
                    x1="10142.2"
                    y1="8000"
                    x2="5857.8"
                    y2="8000"
                ></line>
            </svg>
        </div>
        <div
            data-u="arrowright"
            class="jssora093"
            style="width:50px;height:50px;top:0px;right:30px;"
            data-autocenter="2"
            data-scale="0.75"
            data-scale-right="0.75"
        >
            <svg
                viewBox="0 0 16000 16000"
                style="position:absolute;top:0;left:0;width:100%;height:100%;"
            >
                <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                <polyline
                    class="a"
                    points="8222.2,6080 10142.2,8000 8222.2,9920 "
                ></polyline>
                <line
                    class="a"
                    x1="5857.8"
                    y1="8000"
                    x2="10142.2"
                    y2="8000"
                ></line>
            </svg>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                slidesshow: [{id: 1}, {id: 2}, {id: 3}]
            };
        },
        mounted() {
            let _this = this;
            axios.get("api/v1/slider").then(response => {
                _this.slidesshow = response.data;
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
