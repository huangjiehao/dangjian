// /*图文轮播*/
// jQuery.extend(jQuery.easing,{
//     easeInSine: function (x, t, b, c, d) {
//         return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
//     }
// });
// (function($){
//     $.fn.xslider=function(settings){
//         settings=$.extend({},$.fn.xslider.defaults,settings);
//         this.each(function(){
//             var scrollobj=settings.scrollobj || $(this).find("ul");
//             var maxlength=settings.maxlength || (settings.dir=="H" ? scrollobj.parent().width() : scrollobj.parent().height());//length of the wrapper visible;
//             var scrollunits=scrollobj.find("li");//units to move;
//             var unitlen=settings.unitlen || (settings.dir=="H" ? scrollunits.eq(0).outerWidth() : scrollunits.eq(0).outerHeight());
//             var unitdisplayed=settings.unitdisplayed;//units num displayed;
//             var nowlength=settings.nowlength || scrollunits.length*unitlen;//length of the scrollobj;
//             var offset=0;
//             var sn=0;
//             var movelength=unitlen*settings.movelength;
//             var moving=false;//moving now?;
//             var btnright=$(this).find("a.aright");
//             var btnleft=$(this).find("a.aleft");
//
//             if(settings.dir=="H"){
//                 scrollobj.css("left","0px");
//             }else{
//                 scrollobj.css("top","0px");
//             }
//             if(nowlength>maxlength){
//                 btnleft.addClass("agrayleft");
//                 btnright.removeClass("agrayright");
//                 offset=nowlength-maxlength;
//             }else{
//                 btnleft.addClass("agrayleft");
//                 btnright.addClass("agrayright");
//             }
//
//             btnleft.click(function(){
//                 if($(this).is("[class*='agrayleft']")){return false;}
//                 if(!moving){
//                     moving=true;
//                     sn-=movelength;
//                     if(sn>unitlen*unitdisplayed-maxlength){
//                         jQuery.fn.xslider.scroll(scrollobj,-sn,settings.dir,function(){moving=false;});
//                     }else{
//                         jQuery.fn.xslider.scroll(scrollobj,0,settings.dir,function(){moving=false;});
//                         sn=0;
//                         $(this).addClass("agrayleft");
//                     }
//                     btnright.removeClass("agrayright");
//                 }
//                 return false;
//             });
//             btnright.click(function(){
//                 if($(this).is("[class*='agrayright']")){return false;}
//                 if(!moving){
//                     moving=true;
//                     sn+=movelength;
//                     if(sn<offset-(unitlen*unitdisplayed-maxlength)){
//                         jQuery.fn.xslider.scroll(scrollobj,-sn,settings.dir,function(){moving=false;});
//                     }else{
//                         jQuery.fn.xslider.scroll(scrollobj,-offset,settings.dir,function(){moving=false;});//滚动到最后一个位置;
//                         sn=offset;
//                         $(this).addClass("agrayright");
//                     }
//                     btnleft.removeClass("agrayleft");
//                 }
//                 return false;
//             });
//
//             if(settings.autoscroll){
//                 jQuery.fn.xslider.autoscroll($(this),settings.autoscroll);
//             }
//
//         })
//     }
// })(jQuery);
// jQuery.fn.xslider.defaults = {
//     maxlength:0,
//     scrollobj:null,
//     unitlen:0,
//     nowlength:0,
//     dir:"H",
//     autoscroll:null
// };
// jQuery.fn.xslider.scroll=function(obj,w,dir,callback){
//     if(dir=="H"){
//         obj.animate({
//             left:w
//         },500,"easeInSine",callback);
//     }else{
//         obj.animate({
//             top:w
//         },500,"easeInSine",callback);
//     }
// }
// jQuery.fn.xslider.autoscroll=function(obj,time){
//     var  vane="right";
//     function autoscrolling(){
//         if(vane=="right"){
//             if(!obj.find("a.agrayright").length){
//                 obj.find("a.aright").trigger("click");
//             }else{
//                 vane="left";
//             }
//         }
//         if(vane=="left"){
//             if(!obj.find("a.agrayleft").length){
//                 obj.find("a.aleft").trigger("click");
//             }else{
//                 vane="right";
//             }
//         }
//     }
//     var scrollTimmer=setInterval(autoscrolling,time);
//     obj.hover(function(){
//         clearInterval(scrollTimmer);
//     },function(){
//         scrollTimmer=setInterval(autoscrolling,time);
//     });
// }
//
// /**/
// $(function () {
//
//     /*并排广告图 */
//     $(".lyg_adv").each(function() {
//         var n = $(this).find(".adv_showArtCount").val();
//         $(this).find(".adv").each(function(index){
//             $(this).css({"width": ( (( (1181) / n) - (n - (n-1))*10) )+"px"});
//         });
//     });
//
//     /*结束*/
//
//     $(".ly_star li").each(function (n) {
//         switch (n) {
//             case 1:
//                 $(this).css({"left": "0", "top": "49px"});
//                 break;
//             case 2:
//                 $(this).css({"left": "27px", "top": "20px"});
//                 break;
//             case 3:
//                 $(this).css({"left": "27px", "top": "76px"});
//                 break;
//             case 4:
//                 $(this).css({"left": "54px", "top": "49px"});
//                 break;
//             case 5:
//                 $(this).css({"left": "54px", "top": "103px"});
//                 break;
//             case 6:
//                 $(this).css({"left": "81px", "top": "75px"});
//                 break;
//             case 7:
//                 $(this).css({"left": "81px", "top": "129px"});
//                 break;
//             case 8:
//                 $(this).css({"left": "107px", "top": "103px"});
//                 break;
//             case 9:
//                 $(this).css({"left": "107px", "top": "156px"});
//                 break;
//             case 10:
//                 $(this).css({"left": "133px", "top": "130px"});
//                 break;
//             case 11:
//                 $(this).css({"left": "133px", "top": "182px"});
//                 break;
//             case 12:
//                 $(this).css({"left": "160px", "top": "103px"});
//                 break;
//             case 13:
//                 $(this).css({"left": "160px", "top": "157px"});
//                 break;
//             case 14:
//                 $(this).css({"left": "186px", "top": "76px"});
//                 break;
//             case 15:
//                 $(this).css({"left": "186px", "top": "130px"});
//                 break;
//             case 16:
//                 $(this).css({"left": "214px", "top": "49px"});
//                 break;
//             case 17:
//                 $(this).css({"left": "214px", "top": "103px"});
//                 break;
//             case 18:
//                 $(this).css({"left": "240px", "top": "21px"});
//                 break;
//             case 19:
//                 $(this).css({"left": "240px", "top": "76px"});
//                 break;
//             case 20:
//                 $(this).css({"left": "266px", "top": "49px"});
//                 break;
//             case 21:
//                 $(this).css({"left": "266px", "top": "103px"});
//                 break;
//             case 22:
//                 $(this).css({"left": "293px", "top": "76px"});
//                 break;
//             case 23:
//                 $(this).css({"left": "293px", "top": "130px"});
//                 break;
//             case 24:
//                 $(this).css({"left": "320px", "top": "103px"});
//                 break;
//             case 25:
//                 $(this).css({"left": "320px", "top": "156px"});
//                 break;
//             case 26:
//                 $(this).css({"left": "347px", "top": "130px"});
//                 break;
//             case 27:
//                 $(this).css({"left": "347px", "top": "182px"});
//                 break;
//             case 28:
//                 $(this).css({"left": "373px", "top": "103px"});
//                 break;
//             case 29:
//                 $(this).css({"left": "373px", "top": "156px"});
//                 break;
//             case 30:
//                 $(this).css({"left": "399px", "top": "76px"});
//                 break;
//             case 31:
//                 $(this).css({"left": "399px", "top": "130px"});
//                 break;
//             case 32:
//                 $(this).css({"left": "432px", "top": "41px"});
//                 break;
//             case 33:
//                 $(this).css({"left": "432px", "top": "109px"});
//                 break;
//             case 34:
//                 $(this).css({"left": "466px", "top": "11px"});
//                 break;
//             case 35:
//                 $(this).css({"left": "466px", "top": "66px"});
//                 break;
//             case 36:
//                 $(this).css({"left": "482px", "top": "105px"});
//                 break;
//             case 37:
//                 $(this).css({"left": "467px", "top": "141px"});
//                 break;
//             case 38:
//                 $(this).css({"left": "509px", "top": "0px"});
//                 break;
//             case 39:
//                 $(this).css({"left": "503px", "top": "40px"});
//                 break;
//             case 40:
//                 $(this).css({"left": "550px", "top": "11px"});
//                 break;
//             case 41:
//                 $(this).css({"left": "540px", "top": "66px"});
//                 break;
//             case 42:
//                 $(this).css({"left": "527px", "top": "107px"});
//                 break;
//             case 43:
//                 $(this).css({"left": "514px", "top": "151px"});
//                 break;
//             case 44:
//                 $(this).css({"left": "575px", "top": "47px"});
//                 break;
//             case 45:
//                 $(this).css({"left": "580px", "top": "89px"});
//                 break;
//             case 46:
//                 $(this).css({"left": "558px", "top": "129px"});
//                 break;
//             case 47:
//                 $(this).css({"left": "558px", "top": "129px"});
//                 break;
//             case 48:
//                 $(this).css({"left": "558px", "top": "129px"});
//                 break;
//         }
//
//         /*图片轮播*/
//     });
//
//     $(".ly_stars_info").css("display", "none");
//     $(".ly_stars_info").hide();
//     // 鼠标移入事件
//     $(".ly_star li").mouseenter(function () {
//         $(this).find(".ly_stars_info").toggle(300);
//         $(this).find(".ly_stars_info").css("display", "block");
//     });
//     // 鼠标移出事件
//     $(".ly_star li").mouseleave(function () {
//         $(this).find(".ly_stars_info").css("display", "none");
//     });
//     /*结束*/
//
//     /*地图*/
//     var str = $("#mygis").val();
//     var mygis = JSON.parse(str);
//     initMap(mygis);
//
// });
//
// var myIcon = null;
// var mapgis = null;
// var searchInfoWindow = null;
// function initMap(){
//     var str = $("#mygis").val();
//     var mygis = JSON.parse(str);
//
//     mapgis = new BMap.Map("allmap", {
//         minZoom : 5,
//         maxZoom : 19,
//         mapType: BMAP_PERSPECTIVE_MAP
//     }); // 创建Map实例
//     mapgis.setCurrentCity("广州市");
//     mapgis.centerAndZoom(new BMap.Point(113.280044, 23.139266), 18);
//      // mapgis.disableDragging();
//     mapgis.enableScrollWheelZoom(true);//开启鼠标滚轮缩放
//     // mapgis.disableScrollWheelZoom(true);
//     mapgis.addControl(new BMap.NavigationControl());
//     mapgis.addControl(new BMap.MapTypeControl({
//         mapTypes: [
//             BMAP_SATELLITE_MAP,//卫星
//             BMAP_HYBRID_MAP,//混合
//             BMAP_PERSPECTIVE_MAP//三维
//         ]
//     }));
//     //图标
//     // myIcon = new BMap.Icon("/content/images/tubiao.png", new BMap.Size(30,30));
//     myIcon = new BMap.Icon("/content/images/hongqi30px.gif", new BMap.Size(30, 30));
//     initMarker(mapgis,myIcon);
//
// }
// function initMarker(mapgis,myIcon){
//     var str = $("#mygis").val();
//     var mygis = JSON.parse(str);
//     var mymarker = null;
//     for (var k = 0; k < mygis.length; k++) {
//         var lat = mygis[k].lat;
//         var lon = mygis[k].lng;
//         mymarker = new BMap.Marker(new BMap.Point(lat, lon), {icon : myIcon}); // 创建marker对象
//         mymarker.gisInfo = mygis[k];
//         mapgis.addOverlay(mymarker);
//
//         mymarker.addEventListener("click",function(e){
//             var point = e.target;
//             openOrgInfoWindow(point,mapgis);
//         });//点击图标弹出
//
//     }
// }
// function openOrgInfoWindow(marker,mapgis){
//     var content = $("#windowInfo").html();
//     // var newsList = '';
//     // newsList ='<li><i class="fa fa-circle"></i><a href="#" target="_blank" style="padding-left: 10px;" title="'+marker.gisInfo.address+'">'+marker.gisInfo.address+'</a></li>';
//     var mapValue = {};
//     mapValue.fullName = marker.gisInfo.fullName;
//     mapValue.address = marker.gisInfo.address;
//     mapValue.idStr = marker.gisInfo.idStr;
//     mapValue.name = marker.gisInfo.name;
//
//     var html = replace(content,mapValue);
//     searchInfoWindow = new BMapLib.SearchInfoWindow(mapgis, html, {
//         title : marker.gisInfo.name, // 标题
//         width : 300, // 宽度
//         height : 120, // 高度
//         panel : "panel", // 检索结果面板
//         enableAutoPan : true, // 自动平移
//         searchTypes : []
//     });
//
//     searchInfoWindow.open(marker.marker||marker);
// }
// function replace(src,data){
//     for(var key in data){
//         var reg = new RegExp('\\#\\['+key+'\\]','g');
//         src = src.replace(reg,data[key]);
//     }
//     return src;
// }
//
// /* 退出登录 */
// function logout() {
//     swal({
//             title: "确定退出？",
//             type: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#DD6B55",
//             confirmButtonText: "确 定",
//             cancelButtonText: "取 消",
//             closeOnConfirm: false,
//             closeOnCancel: false
//         },
//         function (isConfirm) {
//             if (isConfirm) {
//                 window.location = '/account/login_out'
//             } else {
//                 swal.close();
//             }
//         });
// }
//
//
//
//
//
/*图文轮播*/
/*图文轮播*/
jQuery.extend(jQuery.easing,{
    easeInSine: function (x, t, b, c, d) {
        return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
    }
});
(function($){
    $.fn.xslider=function(settings){
        settings=$.extend({},$.fn.xslider.defaults,settings);
        this.each(function(){
            var scrollobj=settings.scrollobj || $(this).find("ul");
            var maxlength=settings.maxlength || (settings.dir=="H" ? scrollobj.parent().width() : scrollobj.parent().height());//length of the wrapper visible;
            var scrollunits=scrollobj.find("li");//units to move;
            var unitlen=settings.unitlen || (settings.dir=="H" ? scrollunits.eq(0).outerWidth() : scrollunits.eq(0).outerHeight());
            var unitdisplayed=settings.unitdisplayed;//units num displayed;
            var nowlength=settings.nowlength || scrollunits.length*unitlen;//length of the scrollobj;
            var offset=0;
            var sn=0;
            var movelength=unitlen*settings.movelength;
            var moving=false;//moving now?;
            var btnright=$(this).find("a.aright");
            var btnleft=$(this).find("a.aleft");

            if(settings.dir=="H"){
                scrollobj.css("left","0px");
            }else{
                scrollobj.css("top","0px");
            }
            if(nowlength>maxlength){
                btnleft.addClass("agrayleft");
                btnright.removeClass("agrayright");
                offset=nowlength-maxlength;
            }else{
                btnleft.addClass("agrayleft");
                btnright.addClass("agrayright");
            }

            btnleft.click(function(){
                if($(this).is("[class*='agrayleft']")){return false;}
                if(!moving){
                    moving=true;
                    sn-=movelength;
                    if(sn>unitlen*unitdisplayed-maxlength){
                        jQuery.fn.xslider.scroll(scrollobj,-sn,settings.dir,function(){moving=false;});
                    }else{
                        jQuery.fn.xslider.scroll(scrollobj,0,settings.dir,function(){moving=false;});
                        sn=0;
                        $(this).addClass("agrayleft");
                    }
                    btnright.removeClass("agrayright");
                }
                return false;
            });
            btnright.click(function(){
                if($(this).is("[class*='agrayright']")){return false;}
                if(!moving){
                    moving=true;
                    sn+=movelength;
                    if(sn<offset-(unitlen*unitdisplayed-maxlength)){
                        jQuery.fn.xslider.scroll(scrollobj,-sn,settings.dir,function(){moving=false;});
                    }else{
                        jQuery.fn.xslider.scroll(scrollobj,-offset,settings.dir,function(){moving=false;});//滚动到最后一个位置;
                        sn=offset;
                        $(this).addClass("agrayright");
                    }
                    btnleft.removeClass("agrayleft");
                }
                return false;
            });

            if(settings.autoscroll){
                jQuery.fn.xslider.autoscroll($(this),settings.autoscroll);
            }

        })
    }
})(jQuery);
jQuery.fn.xslider.defaults = {
    maxlength:0,
    scrollobj:null,
    unitlen:0,
    nowlength:0,
    dir:"H",
    autoscroll:null
};
jQuery.fn.xslider.scroll=function(obj,w,dir,callback){
    if(dir=="H"){
        obj.animate({
            left:w
        },500,"easeInSine",callback);
    }else{
        obj.animate({
            top:w
        },500,"easeInSine",callback);
    }
}
jQuery.fn.xslider.autoscroll=function(obj,time){
    var  vane="right";
    function autoscrolling(){
        if(vane=="right"){
            if(!obj.find("a.agrayright").length){
                obj.find("a.aright").trigger("click");
            }else{
                vane="left";
            }
        }
        if(vane=="left"){
            if(!obj.find("a.agrayleft").length){
                obj.find("a.aleft").trigger("click");
            }else{
                vane="right";
            }
        }
    }
    var scrollTimmer=setInterval(autoscrolling,time);
    obj.hover(function(){
        clearInterval(scrollTimmer);
    },function(){
        scrollTimmer=setInterval(autoscrolling,time);
    });
}

$(function () {
  /*  $(".list").each(function(index){
        if(Math.ceil((index+1)%3)==0){
            $(this).css("margin-right","0");
        }
    });
    $(".massges").each(function(index){
        if(Math.ceil((index+1)%2)==0){
            $(this).css("margin-right","0");
        }
    });
*/
    /*并排广告图 */
    $(".lyg_adv").each(function() {
        var n = $(this).find(".adv_showArtCount").val();
        $(this).find(".adv").each(function(index){
            $(this).css({"width": (( (1210/n - (n- (n-1))*10)) )+"px"});
        });
        $(this).find(".adv img").each(function(index){
            $(this).css({"width":(( (1210/n - (n- (n-1))*10)) )+"px"});
        });
    });

});

//点击跳转课程列表
function courseList(id,name) {
    window.location.href = "/course/course_dtls?idStr="+id+"&courseName="+name+"#在线学习";
}
