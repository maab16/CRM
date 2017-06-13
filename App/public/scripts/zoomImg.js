(function($){
    'use strict';
    $.fn.zoomImg=function(options){

        return this.each(function(){

            var $this = $(this);

            var defaultSettings = {
                zoomDivWidth: 400,
                zoomDivHeight: 400,
                zoomImgWidth : 800,
                zoomImgHeight: 800,
                mainImgWidth : "100%",
                mainImgHeight : "100%",
                zoomDivPosition: 'right',
                parentPosition : "relative",
                childPosition  : "absolute",
                offsetX: 20,
                offsetY: 0,
                zoomLengthOpacity: 0.5,
                zoomDivOpacity: 1,
                zoomLengthCursor : "move",
                zoomDivCursor : "default",
                zoomDivBgColor: '#fff',
                zoomLenthBg : "gray"
            };

            // Custom options
            var settings       = $.extend({}, defaultSettings, options);
            var $smallImg,
                $largeImg,
                $zoomDiv       = $(".zoom"),
                $zoomLenthDiv  = $(".zoom-length"),
                zoomDivLeft,
                zoomDivTop;

            $this.css({
                width : settings.mainImgWidth,
                height: settings.mainImgHeight,
                position: settings.parentPosition
            });

            if ($this.hasClass("small")) {

                $smallImg = $(".small");

            }else{

                $smallImg = $this.find("img:first");
            }

            $smallImg.css({
                width : settings.mainImgWidth,
                height: settings.mainImgHeight
            });

            if ($zoomDiv.hasClass("large")) {

                $largeImg = $(".large");
            }else{

                $largeImg = $zoomDiv.find("img:first");
            }

            $largeImg.css({
                width : settings.zoomImgWidth,
                height: settings.zoomImgHeight,
                position: settings.childPosition
            });

            switch(settings.zoomDivPosition){

                case 'top':
                    zoomDivLeft = 0;
                    zoomDivTop = -settings.height - settings.offsetY;
                    break;
                case 'right':
                    zoomDivLeft = $this.width() + settings.offsetX;
                    zoomDivTop = 0;
                    break;
                case 'bottom':
                    zoomDivLeft = 0;
                    zoomDivTop = $this.height() + settings.offsetY;
                    break;
                case 'left':
                    zoomDivLeft = -settings.zoomDivWidth - settings.offsetX;
                    zoomDivTop = 0;
                    break;
                // for magnify glass
                case 'overLap':
                    zoomDivLeft = 0;
                    zoomDivTop = $this.height()-$zoomDiv.outerHeight();
                    settings.zoomDivBorderRadius = "50%";
            }
            // Default ZOOM DIV style
            $zoomDiv.css({

                left: zoomDivLeft,
                top: zoomDivTop,
                width: settings.zoomDivWidth,
                height: settings.zoomDivHeight,
                position: settings.childPosition,
                zIndex: 9999,
                overflow: 'hidden',
                border:"1px solid #fff",
                borderRadius : settings.zoomDivBorderRadius
            });

            // Calculate proportions of lens div
            var VolProportionX      = $largeImg.width() / $smallImg.width();
            var VolProportionY      = $largeImg.height() / $smallImg.height();
            var zoomLengthWidth     = $zoomDiv.width() / VolProportionX ;
            var zoomLengthHeight    = $zoomDiv.height() / VolProportionY ;

            // For Magnify Glass Zoom Div Style
            if (settings.zoomDivPosition=="overLap") {

                $zoomDiv.css({
                    width: zoomLengthWidth,
                    height: zoomLengthHeight,
                    position: settings.childPosition,
                    zIndex: 9999,
                    opacity: settings.zoomDivOpacity,
                    cursor : settings.zoomDivCursor,
                    backgroundColor: settings.zoomLenthBg
                });
            }

            $zoomLenthDiv.css({
                width: zoomLengthWidth,
                height: zoomLengthHeight,
                position: settings.childPosition,
                zIndex: 9999,
                opacity: settings.zoomLengthOpacity,
                cursor : settings.zoomLengthCursor,
                backgroundColor: settings.zoomLenthBg
            });

            $this.mouseover(function() {

                if (settings.zoomDivPosition=="overLap") {
                    $zoomDiv.show();
                }else{
                    $zoomLenthDiv.show();
                    $zoomDiv.show();
                }
                      
            });

            $this.mousemove(function(e) {
                       
                // Calculate Display Length Horizontal
                var zoomX = $this.width() - $zoomLenthDiv.outerWidth();
                // Calculate Display Length Verticle
                var zoomY = $this.height() - $zoomLenthDiv.outerHeight();
                // Calculate Big Image Offset proportions
                var displayLargeImgX = ($largeImg.width() - $zoomDiv.width()) / zoomX;
                var displayLargeImgY = ($largeImg.height() - $zoomDiv.height()) / zoomY;
                
                // Calculate Display Length Div coordinates 
                    
                    var DistanceX = e.pageX - $this.offset().left - $zoomLenthDiv.width()/2;
                    
                    var DistanceY = e.pageY - $this.offset().top - $zoomLenthDiv.height()/2;

                    var viewX = filterDistance(DistanceX,zoomX);
                    var viewY = filterDistance(DistanceY,zoomY);
                    
                    if (settings.zoomDivPosition=="overLap") {

                        $zoomDiv.css({
                            left: viewX,
                            top: viewY
                        });
                    }

                    $zoomLenthDiv.css({
                        left: viewX,
                        top: viewY
                    });

                    // Calculate offsets of big images

                    $largeImg.css({
                        left: -viewX * displayLargeImgX,
                        top: -viewY * displayLargeImgY
                    });
            });

            $this.mouseleave(function() {
                $zoomLenthDiv.hide();
                $zoomDiv.hide();
            });

            function filterDistance(Distance,criticalD) {

                if (Distance<0) {

                    return 0;

                }else if (Distance >0 && Distance<=criticalD) {

                    return Distance;

                }else{

                    return criticalD;
                }

            }

                return this;
        });
    };
})(jQuery);