<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
<style>
.slider {
    margin: 2em auto;
    width: 960px;
    height:300px;
    overflow: hidden;
}

.slider-slides {
    width: 960px;
    height: 300px;
    position: relative;
    transition: left 400ms linear;
}

.slider-slides__item {
    float: left;
    width: 960px;
    height: 300px;
    position: relative;
    overflow: hidden;
}

.slider-slides__item img {
    position: absolute;
    top: 0;
    left: 0;
}

.slider-slides__item p {
    display:none;
    margin: 0;
    position: absolute;
    z-index: 100;
    bottom: -2em;
    left: 0;
    width: 100%;
    height: 2em;
    line-height: 2;
    text-align: center;
    background: rgba( 0, 0, 0, 0.6 );
    color: #fff;
    transition: bottom 500ms ease-in;
}
.slider-slides__item p.visible {
    bottom: 0;
}

.slider-nav {
    margin: 1em 0;
    text-align: center;
}

.slider-nav__item {
    width: 2em;
    height: 2em;
    border: 1px solid #ccc;
    text-align: center;
    text-decoration: none;
    color: #000;
    display: inline-block;
    line-height: 2;
    margin-right: 0.5em;
}

.slider-nav .slider-nav__item.active {
    border-color: #000;
}
</style>
</head>
<body>
    <div class="slider">
        <div class="slider-slides">
            <div class="slider-slides__item">
                <img src="http://lorempixel.com/960/300/sports" alt="">
                <p class="visible">Caption 1</p>
            </div>
            <div class="slider-slides__item">
                <img src="http://lorempixel.com/960/300/business" alt="">
                <p>Caption 2</p>
            </div>
            <div class="slider-slides__item">
                <img src="http://lorempixel.com/960/300/animals" alt="">
                <p>Caption 3</p>
            </div>
            <div class="slider-slides__item">
                <img src="http://lorempixel.com/960/300/food" alt="">
                <p>Caption 4</p>
            </div>
            <div class="slider-slides__item">
                <img src="http://lorempixel.com/960/300/nature" alt="">
                <p>Caption 5</p>
            </div>
        </div>
        <div class="slider-nav">
            <a class="slider-nav__item active" href="#" data-slide="0">1</a>
            <a class="slider-nav__item" href="#" data-slide="1">2</a>
            <a class="slider-nav__item" href="#" data-slide="2">3</a>
            <a class="slider-nav__item" href="#" data-slide="3">4</a>
            <a class="slider-nav__item" href="#" data-slide="4">5</a>
        </div>
        <div class="slider-controls">
            <div class="slider-controls__prev"><</div>
            <div class="slider-controls__next"><</div>
        </div>
    </div>
<script src="<?php echo $basePath; ?>/js/app.dist.js" type="text/javascript"></script>
<script>
function Slider( element ) {
    this.el = document.querySelector( element );
    this.init();
}

Slider.prototype = {
    init: function() {
        this.links = this.el.querySelectorAll( ".slider-nav .slider-nav__item" );
        this.wrapper = this.el.querySelector( ".slider-slides" );
        this.navigate();
    },
    navigate: function() {

        for( var i = 0; i < this.links.length; ++i ) {
            var link = this.links[i];
            this.slide( link );
        }
    },

    animate: function( slide ) {
        var parent = slide.parentNode;
        var caption = slide.querySelector( ".caption" );
        var captions = parent.querySelectorAll( ".caption" );
        for( var k = 0; k < captions.length; ++k ) {
            var cap = captions[k];
            if( cap !== caption ) {
                cap.classList.remove( "visible" );
            }
        }
        caption.classList.add( "visible" );
    },

    slide: function( element ) {
        var self = this;
        element.addEventListener( "click", function( e ) {
            e.preventDefault();
            var a = this;
            self.setCurrentLink( a );
            var index = parseInt( a.getAttribute( "data-slide" ), 10 ) + 1;
            var currentSlide = self.el.querySelector( ".slide:nth-child(" + index + ")" );

            self.wrapper.style.left = "-" + currentSlide.offsetLeft + "px";
            self.animate( currentSlide );

        }, false);
    },
    setCurrentLink: function( link ) {
        var parent = link.parentNode;
        var a = parent.querySelectorAll( "a" );

        link.className = "current";

        for( var j = 0; j < a.length; ++j ) {
            var cur = a[j];
            if( cur !== link ) {
                cur.className = "";
            }
        }
    }
};

document.addEventListener( "DOMContentLoaded", function() {
    var aSlider = new Slider( ".slider" );

});
</script>
</body>
</html>
