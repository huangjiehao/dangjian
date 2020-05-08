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

    $('#submitBtn').click(function () {//登录数据提交
        $.ajax({
            url: '/account/login_submit',
            type: 'post',
            data: $('#loginForm').serializeArray(),
            success: function (result) {
                console.dir(result);
                if (result == 2) {
                    swal({
                        title: "登录失败",
                        text: "用户名或密码错误，请重试",
                        type: "error",
                        confirmButtonText: "确定"
                    }, function (isConfirm) {
                        if (isConfirm) {
                            swal.close();
                        }
                    });
                } else {
                    swal({
                        title: "登录成功",
                        type: "success",
                        confirmButtonText: "确定"
                    }, function (isConfirm) {
                        if (isConfirm) {
                            window.location.reload();
                        }
                    });
                }
            }, error: function (error) {
                console.dir(error);
            }
        });
        return false;
    });

    /*地图*/
    var str = $("#mygis").val();
    if(str != undefined){
        var mygis = JSON.parse(str);
        initMap(mygis);
    }

});
//党建要闻轮播图
$(function(){
    var _listUl = $(".rated-left-list");
    // console.log(_listUl);
    var _nav = $(".rated-left-img-btn li");
    var _listLen = _nav.length;
    var _listWidth = 380;
    _listUl.css({width:_listWidth*_listLen+"px"});

    var _speed = 500;
    var _wait = 4000;
    var _sue = 0;

    var scrollTab = function(sue){
        _listUl.stop().animate({left:(-_listWidth*sue)+"px"},_speed,'easeInOutQuad');
        _nav.removeClass("hover").eq(sue).addClass("hover");
    }

    var scrollTabRun = setInterval(function(){
        _sue++;
        if(_sue == _listLen){_sue = 0;};
        scrollTab(_sue);
    },_wait+_speed);

    _nav.hover(function(){
        _sue = $(this).index();
        scrollTab(_sue);
    });

});

//党建聚焦轮播图
$(function(){
    $(".cz_list").each(function(){
        var _listUl = $(this);
        var _nav = $(this).next().find("li");
        var _listLen = _nav.length;
        var _listWidth = 1180;
        _listUl.css({width:_listWidth*_listLen+"px"});

        var _speed = 500;
        var _wait = 4000;
        var _sue = 0;

        var scrollTab = function(sue){
            _listUl.stop().animate({left:(-_listWidth*sue)+"px"},_speed,'easeInOutQuad');
            _nav.removeClass("hover").eq(sue).addClass("hover");
        };

        var scrollTabRun = setInterval(function(){
            _sue++;
            if(_sue == _listLen){_sue = 0;};
            scrollTab(_sue);
        },_wait+_speed);

        _nav.hover(function(){
            _sue = $(this).index();
            scrollTab(_sue);
        });
    });

})

//点击跳转课程列表
function courseList(id,name) {
    window.location.href = "/course/course_dtls?idStr="+id+"&courseName="+name+"#在线学习";
}

/**
 * 地图展示
 */
var myIcon = null;
var mapgis = null;
var searchInfoWindow = null;
function initMap(){
    var str = $("#mygis").val();
    var mygis = JSON.parse(str);

    mapgis = new BMap.Map("allmap", {
        minZoom : 5,
        maxZoom : 19,
        mapType:  BMAP_NORMAL_MAP
    }); // 创建Map实例
    /*var str = $("#mygis").val();
    var mygisval = JSON.parse(str);
    for (var k = 0; k < mygisval.length; k++) {
        if(k==0){
            mapgis.centerAndZoom(new BMap.Point(mygisval[k].lat, mygisval[k].lng), 18); //BMap.Point(113.280044, 23.139266), 18
        }
    }*/
    var lat = $("#lat").val();
    var lng = $("#lng").val();
    mapgis.centerAndZoom(new BMap.Point(lat, lng), 13); //BMap.Point(113.280044, 23.139266), 18
    // mapgis.disableDragging();
    mapgis.enableScrollWheelZoom(true);//开启鼠标滚轮缩放
    mapgis.disableScrollWheelZoom(true);
    mapgis.addControl(new BMap.NavigationControl());
    mapgis.addControl(new BMap.MapTypeControl({
        mapTypes: [
            BMAP_NORMAL_MAP
        ]
    }));
    //图标
    // myIcon = new BMap.Icon("/content/images/tubiao.png", new BMap.Size(30,30));
    myIcon = new BMap.Icon("/content/images/hongqi30px.png", new BMap.Size(30, 30));
    initMarker(mapgis,myIcon);

}
function initMarker(mapgis,myIcon){
    var str = $("#mygis").val();
    var mygis = JSON.parse(str);
    var mymarker = null;
    for (var k = 0; k < mygis.length; k++) {
        var lat = mygis[k].lat;
        var lon = mygis[k].lng;
        mymarker = new BMap.Marker(new BMap.Point(lat, lon), {icon : myIcon}); // 创建marker对象
        mymarker.gisInfo = mygis[k];
        mapgis.addOverlay(mymarker);

        mymarker.addEventListener("click",function(e){
            var point = e.target;
            openOrgInfoWindow(point,mapgis);
        });//点击图标弹出

    }
}
function openOrgInfoWindow(marker,mapgis){
    var content = $("#windowInfo").html();
    // var newsList = '';
    // newsList ='<li><i class="fa fa-circle"></i><a href="#" target="_blank" style="padding-left: 10px;" title="'+marker.gisInfo.address+'">'+marker.gisInfo.address+'</a></li>';
    var mapValue = {};
    mapValue.fullName = marker.gisInfo.fullName;
    mapValue.address = marker.gisInfo.address;
    mapValue.idStr = marker.gisInfo.idStr;
    mapValue.name = marker.gisInfo.name;

    var html = replace(content,mapValue);
    searchInfoWindow = new BMapLib.SearchInfoWindow(mapgis, html, {
        title : marker.gisInfo.name, // 标题
        width : 300, // 宽度
        height : 120, // 高度
        panel : "panel", // 检索结果面板
        enableAutoPan : true, // 自动平移
        searchTypes : []
    });

    searchInfoWindow.open(marker.marker||marker);
}
function replace(src,data){
    for(var key in data){
        var reg = new RegExp('\\#\\['+key+'\\]','g');
        src = src.replace(reg,data[key]);
    }
    return src;
}

/* 退出登录 */
function logout() {
    swal({
            title: "确定退出？",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "确 定",
            cancelButtonText: "取 消",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                window.location = '/account/login_out'
            } else {
                swal.close();
            }
        });
}

/*登录js*/
$(function(){
    $('#username').keypress(function (e) {
        if (e.keyCode == 13) {
            if ($('#username').val() == '') {
                $('#username').focus();
            } else {
                $('#submitBtn').click();
            }
        }
    });
    $('#password').keypress(function (e) {
        if (e.keyCode == 13) {
            if ($('#password').val() == '') {
                $('#password').focus();
            } else {
                $('#submitBtn').click();
            }
        }
    });

    $(".form-tab li").on("click",function(){
        var index = $(this).index();
        $(this).addClass("cur").siblings().removeClass("cur");
        $(".form-con>div").hide().eq(index).show();
        if(index == 0){
            $(".form-foot").hide();
        }else{
            $(".form-foot").show();
        }
        $(".form-error").hide();
    });
    $(".weixin-login .help-a").hover(
        function(){
            $(".wx-img-box,.wx-image").stop();
            $(this).parents(".weixin-login").find(".wx-img-box").animate({"marginLeft":"15px"},300,function(){
                $(this).parents(".weixin-login").find(".wx-image").animate({"opacity":1},300);
            });
        },
        function(){
            $(".wx-img-box,.wx-image").stop();
            $(this).parents(".weixin-login").find(".wx-image").stop().animate({"opacity":0},300,function(){
                $(this).parents(".weixin-login").find(".wx-img-box").animate({"marginLeft":"110px"},300);
            });
        }
    );


});
$('.jia_foot_open').click(function(){
    $('.footnone').slideToggle();
    $(this).find('i').toggleClass('footnow');
});
$('.backLogin').click(function(){
    $('.login-normal').show();
    $('.loginV2').show();
    $('.shortLogin').hide();
    $('.form-error').hide();
});
//开启错误提示
function showError(error){
    $(".form-error").find("label").html(error);
    $(".form-error").show();
}
