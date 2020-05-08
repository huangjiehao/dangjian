/*我的学习*/
$(function(){
    $(".mm1 li").each(function(index){
        if(Math.ceil((index+1)%5)==0){
            $(this).css("margin-right","0");
        }
    });
    $(".per_r li").each(function(index){
        if(Math.ceil((index+1)%3)==0){
            $(this).css("margin-right","0");
        }
    });
    $(".mm2 li").each(function(index){
        if(Math.ceil((index+1)%5)==0){
            $(this).css("margin-right","0");
        }
    });
    $('#container li').each(function(){
        var learnMust = $(this);
        learnMust.hover(function(){
                learnMust.find('.learnMust').show().stop(true).animate({color:'#000',background:'#0a80e9'}, 1000);
            });
           /* function () {
                learnMust.find('.learnMust').hide().stop(true).animate({color:'#000',background:'#000'}, 1000);
            });*/
    });
});

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