$(function() {//九宫格
    /*判断是否是第4个*/
    $(".span3").each(function(index){
        if(Math.ceil((index+1)%3)==0){
            $(this).css("margin-right","0");
        }
    });
    //菜单开始
    $('.lm_con li').each(function(){
        var thisSpan = $(this)
        thisSpan.hover(function(){
                thisSpan.find('span').show().stop(true).animate({opacity: 1.0,color:'#0a80e9'}, 200);
                thisSpan.find('a').stop(true).animate({color:'#0a80e9'}, 300);
            },
            function () {
                thisSpan.find('span').hide().stop(true).animate({opacity: 0,color:'#666666'}, 200);
                thisSpan.find('a').stop(true).animate({color:'#666666'}, 300);
            });
    });

    $('.lm_con li a').hover(function(){
        $(this).find('.direction').stop(true,true).animate({'width':'26px'},300);
        $(this).find('div').stop(true,true).animate({'width':'138px','padding-left':'3px'},300);
    },function(){
        $(this).find('.direction').stop(true,true).animate({'width':'0px'},300);
        $(this).find('div').stop(true,true).animate({'padding-left':'0px'},300);
    })
    /*关闭提醒信息*/
    $(".note__close").click(function(){
        $(this).parent().fadeOut(500, function(){
            $(this).remove();
        });
    });
    //结束
});

/*
留言箱提交成功提示
*/
$(document).on(".submit_btn","click",function () {
    var smallText = $(this).parent().find("small").length;
    if(smallText !=1){
        swal({
            title: "提交成功！",
            type: "success",
            confirmButtonText: "确 定"
        }, function (isConfirm) {
            if (isConfirm) {
                swal.close();
            }
        });
    }
})
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
