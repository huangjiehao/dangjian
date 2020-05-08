$(function(){
    $(".ly_main").css("min-height",'550px');

    /*主菜单menu*/
    var url = window.location.hash;
    var urlName = url.toString().replace('#', '');
    var $currMenu = $('.ly_wrap li[hash="'+decodeURI(urlName)+'"]');
    $currMenu.addClass('lyg_current');

    $(".ly_detail p").click(function(){ //点击投票
        var cur_href = $(this).data("href");
        var left = ($(this).index())*100+'px';
        var cur_hash = $(this).data("hash");
        window.location.href=""+cur_href+""+left+""+cur_hash+"";
    });

    /*点击左侧tab*/
    $(".current_tab").click(function(){
    	$(this).removeClass("lyg_current");
    	$(this).addClass("lyg_current");
    });

    /*九宫格*/
    $('.artist_l li').each(function(index) {
        $(this).find('a').css('top', -$(this).height());
        $(this).hover(function() {
                $(this).find('a').animate({
                        'top': '0'
                    },
                    200)
            },
            function() {
                $(this).find('a').animate({
                        'top': $(this).height()
                    },
                    {
                        duration: 200,
                        complete: function() {
                            $(this).css('top', -$(this).parent('li').height())
                        }
                    })
            })
    });

    //搜索
    $('.search_params').keypress(function (e) {
        if (e.keyCode == 13) {
            $('.search_btn').click();
        }
    });
    $('.search_btn').click(function () {
        goToSearch();
    });
    /**
     * 搜索跳转/分页跳转
     */
    function goToSearch() {
        var arr = [];
        $('.search_params').each(function () {
            if ($(this).val() != '') {
                arr.push($(this).attr('name') + '=' + $(this).val());
            }
        });
        var param = '';
        if (arr.length > 0) {
            param = '?' + arr.join('&');
        }
        var url = window.location.href;
        if (url.indexOf('?')) {
            url = url.split('?')[0];
        }
        location.href = url + param;
    }

});

function openDialog(url,title,width,height,blankTab,maxiumnable){
	dialog = new window.top.Dialog();
	dialog.currentWindow = window;
	if(width){
		dialog.Width = width;
	}else{
		dialog.Width = 600;
	}
	if(height){
		dialog.Height = height;
	}else{
		dialog.Height = 260;
	}
	if(title){
		dialog.Title=title;
	}
	dialog.Drag = true;
	if(maxiumnable&&maxiumnable==true){
		dialog.maxiumnable=true;
	}
	if(blankTab==true){
		dialog.URL = "/proj/data/ProjectBlankTab.jsp?url="+url.replaceAll("&","%26",false) +"&title="+title;
	}else{
		dialog.URL = url;
	}
	//console.log("dialogurl:"+dialog.URL);
	dialog.show();
}

 /**
  * 分页按钮
  */
 $(document).on("click","#layoutPagination li a",function () {
     // window.parent.layoutLoading();
     //当前页数
     var this_id = $("#layoutPagination li.active").data('active-val');
     //总页数
     var submit_value = $("#hiddenindex").data('last-counts');

     //跳转至选中页数
     if ($(this).parent().hasClass('previous_page')) {
         if (this_id != 1) {
             $('.search_params[name="page"]').val(parseInt(this_id) - 1);
         } else {
             return false;
         }
     } else if ($(this).parent().hasClass('next_page')) {
         if (submit_value <= parseInt(this_id)) {
             return false;
         } else {
             $('.search_params[name="page"]').val(parseInt(this_id) + 1);
         }
     } else {
         $('.search_params[name="page"]').val($(this).data('id'));
     }
      goToSearch();
     return false;
 });
 //直接跳转到页数
$(document).on("keypress","#toPageNumber",function (event) {
 // $("#toPageNumber").keypress(function (event) {
     if (event.keyCode == 13) {
         if (parseFloat($("#toPageNumber").val()) > parseFloat($("#toPageNumber").attr("max")) || parseFloat($("#toPageNumber").val()) == 0 || parseFloat($("#toPageNumber").attr("max")) == "") {
             window.parent.layoutSwal({title: "请输入正确的页码", text: "输入的页面不能超出范围", type: 'warning'});
         } else {
             $('.search_params[name="page"]').val($(this).val());
             goToSearch();
         }
     }
 });
 /**
  * 搜索跳转/分页跳转
  */
 function goToSearch() {
     var arr = [];
     $('.search_params').each(function () {
         /*if ($(this).val() != '') {*/
             arr.push($(this).attr('name') + '=' + $(this).val());
         /*}*/
     });
     var param = '';
     if (arr.length > 0) {
         param = '?' + arr.join('&');
     }
     var url = window.location.href;
     if (url.indexOf('?')) {
         url = url.split('?')[0];
     }
     location.href = url + param;
     // window.location = url + param;
     // window.location.href = url + param;
     // document.getElementById("ifm_main_content").src = url + param;
     // location.replace("http://www.jb51.net");
 }

/*默认页面高度*/
/*window.onresize = function(){
    var mainHeight = $(window).height() - 296;
    var curHeight = $(".ly_main").height();
    if(curHeight > mainHeight){
        $(".ly_main").css("height",curHeight+"px");
    }else{
        $(".ly_main").css("height",mainHeight+"px");
    }
};
$(document).ready(function() {
    var mainHeight = $(window).height() - 296;
    var curHeight = $(".ly_main").height();
    if(curHeight > mainHeight){
        $(".ly_main").css("height",curHeight+"px");
    }else{
        $(".ly_main").css("height",mainHeight+"px");
    }
});*/

//屏蔽输入的特殊字符
var _arr=new Array();
_arr[0]=/[\`\~\!\@\#\$\%\^\&\*\￥\(\)\……\！\（）\——\+\\\]\}\{\'\;\:\"\/\.\,\。\，\、\>\<\s\|\=\-\?]/g;
_arr[1]=/[^\d]/g;
//屏蔽输入的特殊字符
function filtecharacter(obj, index) {
    obj.value = obj.value.replace(_arr[index], "");
}


