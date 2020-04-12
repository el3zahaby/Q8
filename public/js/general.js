$(document).ready(function() {
    $("#header_account_icon").hover(
        function() {
            $(".account_div")
                .stop()
                .slideDown(100);
        },
        function() {
            $(".account_div")
                .stop()
                .slideUp(100);
        }
    );$("#header_cart_icon").hover(
        function() {
            $(".cart_div")
                .stop()
                .slideDown(100);
        },
        function() {
            $(".cart_div")
                .stop()
                .slideUp(100);
        }
    );

    var jssor_1_SlideshowTransitions = [
        {
            $Duration: 700,
            $Delay: 30,
            $Cols: 8,
            $Rows: 4,
            $Clip: 15,
            $SlideOut: true,
            $Formation: $JssorSlideshowFormations$.$FormationStraightStairs,
            $Assembly: 2049,
            $Easing: $Jease$.$OutQuad
        },
        {
            $Duration: 700,
            $Delay: 20,
            $Cols: 8,
            $Rows: 4,
            $Formation: $JssorSlideshowFormations$.$FormationStraightStairs,
            $Assembly: 2050,
            $Opacity: 2
        },
        {
            $Duration: 700,
            $Delay: 80,
            $Cols: 8,
            $Rows: 4,
            $Clip: 15,
            $SlideOut: true,
            $Easing: $Jease$.$OutQuad
        },
        {
            $Duration: 700,
            x: 0.2,
            y: -0.1,
            $Delay: 20,
            $Cols: 8,
            $Rows: 4,
            $Clip: 15,
            $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] },
            $Formation: $JssorSlideshowFormations$.$FormationStraightStairs,
            $Assembly: 260,
            $Easing: {
                $Left: $Jease$.$InWave,
                $Top: $Jease$.$InWave,
                $Clip: $Jease$.$OutQuad
            },
            $Round: { $Left: 1.3, $Top: 2.5 }
        },
        {
            $Duration: 700,
            $Delay: 50,
            $Cols: 10,
            $Rows: 5,
            $Opacity: 2,
            $Clip: 15,
            $Formation: $JssorSlideshowFormations$.$FormationRectangleCross,
            $Easing: { $Clip: $Jease$.$InSine }
        },
        {
            $Duration: 700,
            $Zoom: 11,
            $Easing: { $Zoom: $Jease$.$InOutExpo },
            $Opacity: 2,
            $Brother: {
                $Duration: 600,
                $Zoom: 1.5,
                $Easing: { $Zoom: $Jease$.$InOutExpo },
                $Opacity: 2,
                $Shift: -100
            }
        },
        {
            $Duration: 700,
            $Delay: 40,
            $Cols: 10,
            $Rows: 5,
            $Opacity: 2,
            $Clip: 15,
            $Easing: $Jease$.$InSine
        },
        {
            $Duration: 700,
            $Delay: 50,
            $Cols: 10,
            $Rows: 5,
            $Opacity: 2,
            $Clip: 15,
            $SlideOut: true,
            $Formation: $JssorSlideshowFormations$.$FormationRectangleCross,
            $Easing: $Jease$.$OutQuad
        }
    ];

    var jssor_1_options = {
        $Idle: 4000,
        $AutoPlay: 1,
        $SlideshowOptions: {
            $Class: $JssorSlideshowRunner$,
            $Transitions: jssor_1_SlideshowTransitions,
            $TransitionsOrder: 1
        },
        $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$
        },
        $BulletNavigatorOptions: {
            $Class: $JssorBulletNavigator$
        }
    };

    var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

    /*#region responsive code begin*/

    var MAX_WIDTH = 3000;

    function ScaleSlider() {
        var containerElement = jssor_1_slider.$Elmt.parentNode;
        var containerWidth = containerElement.clientWidth;

        if (containerWidth) {
            var expectedWidth = Math.min(
                MAX_WIDTH || containerWidth,
                containerWidth
            );

            jssor_1_slider.$ScaleWidth(expectedWidth);
        } else {
            window.setTimeout(ScaleSlider, 30);
        }
    }

    ScaleSlider();

    $(window).bind("load", ScaleSlider);
    $(window).bind("resize", ScaleSlider);
    $(window).bind("orientationchange", ScaleSlider);

    $(window).scroll(function() {
        var scrollPos = $(document).scrollTop();
        if (scrollPos > 110) {
            $(".header_div").addClass("main_bg_color");
            $(".header_div").addClass("fixed_header");
            $(".header_div").addClass("padding_x_25");
        }

        if (scrollPos < 5) {
            $(".header_div").removeClass("main_bg_color");
            $(".header_div").removeClass("fixed_header");
            $(".header_div").removeClass("padding_x_25");
        }
    });
});
