

//提交题目判断答案是否完全正确
function submit_question() {
    var unfinish = "";
    var allRight = 1;
    var resourseId = $("#resId_question").val();
    var courseId = $('#courseId_video', window.parent.document).val();
    $(".question").each(function (i) {
        var pList = "";
        var answers = $(this).find('p').first().data('ask');
        $(this).find('input:checked').each(function (j) {
            pList += $(this).val();
        });
        if(pList == null || pList == "") {
            unfinish = 1;
        }
        if(answers != pList) {
            allRight = 0 ;
            $(this).find('p').first().css('color', '#FF0000')
        }else {
            $(this).find('p').first().css('color', '#388F00')
        }
    })
    if ( unfinish == 1) {
        swal({
            title: "请完成所有答题！",
            type: "warning",
            confirmButtonText: "确 定"
        });
    }
    if (allRight == 1) {
        $.ajax({
            type: "post",
            url: "/course/question_submit",
            dataType: 'json',
            data: {"resourseId": resourseId, "courseId": courseId},// 你的formid
            error: function (request) {
                alert("操作失败");
            }, success: function (data) {
                swal({
                    title: "提交成功！",
                    type: "warning",
                    confirmButtonText: "确 定"
                });
                $(".answer_show").show();
                $('#button').text("已提交");
            }
        });
    }
}
/*function submit_have() {
    var resourseId = $("#resId_question").val();

    var courseId = $('#courseId_video', window.parent.document).val();
    $('#button').text("已作答");
    $.ajax({
        type: "post",
        url: "/course/question_submit",
        dataType: 'json',
        data: {"resourseId": resourseId, "courseId": courseId},// 你的formid
        error: function (request) {
            alert("操作失败");
        }, success: function (data) {
            $(".answer_show").show();

        }
    });
}*/

$(document).ready(function() {
    // var isComplete = $("#isComplete").val();
    // if(isComplete == 1){
    //     submit_have();
    // }
    /*判断是否是第4个*/
    $(".row-fluid .span3").each(function(index){
        if(Math.ceil((index+1) % 4)==0){
            $(this).css("margin-right","0");
        }
    });
    //搜索功能
    var gh_input_search = $("#search_mini_form input#search,.gh-search-reset"),
        gh_search_reset = $("#gh-search-reset"),
        form_search = $(".form-search"),
        input_search= $("#search");
    $(gh_input_search).focus(function(){
        $(input_search).css("width","200px");
        $(gh_search_reset).css("display","inline-block");
    });
    $(gh_input_search).blur(function(){
        var this_val=$("#search_mini_form input#search").val();
        if(this_val.length>0 && this_val!="Search"){
            $(gh_search_reset).css("display","inline-block");
        }else{
            $(input_search).css("width","57px").attr("value","");
            $(gh_search_reset).css("display","none");
        }
    });


});
//点击跳转课程列表
function courseList(id,name) {
    window.location.href = "/bbs/post_dtls?idStr="+id+"&courseName="+name+"#党员论坛";
}
