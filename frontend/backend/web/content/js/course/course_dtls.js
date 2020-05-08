


function tabShow(value){
    if(value=="course_xiang"){
        //tab的转换
        $("#desc").addClass("active");
        $("#commentlist").removeClass("active");
        $("#vediolist").removeClass("active");
        $("#vedio_ping").css('display','none');

        //内容的显示和隐藏
        $("#course_xiang").attr("class","tab-pane active mt15");
        $("#course_ping").attr("class","tab-pane mt20 ph10");
        $("#vedio_ping").attr("class","tab-pane mt20 ph10");

    }else if(value=="course_ping"){
        //tab的转换
        $("#desc").removeClass("active");
        $("#commentlist").addClass("active");
        $("#vediolist").removeClass("active");
        $("#vedio_ping").css('display','none');

        //内容的显示和隐藏
        $("#course_xiang").attr("class","tab-pane mt20 mt15");
        $("#course_ping").attr("class","tab-pane active ph10");
        $("#vedio_ping").attr("class","tab-pane mt20 ph10");

        //用户心得分页
        // changePage();
    }else{

        //tab的转换
        $("#desc").removeClass("active");
        $("#commentlist").removeClass("active");
        $("#vediolist").addClass("active");
        $("#vedio_ping").css('display','block');

        //内容的显示和隐藏
        $("#course_xiang").attr("class","tab-pane mt20 mt15");
        $("#vedio_ping").attr("class","tab-pane active ph10");
        $("#course_ping").attr("class","tab-pane mt20 ph10");
    }
}

//评论AJAX提交
function saveComment() {
    var commTitle = $("#commTitle").val();
    var commentBody = $("#commentBody").val();
    var courseId = $("#courseId").val();
    var courseName = $("#courseName").val();
    var pre_username = $("#pre_username").val();
    var totalShow = $("#totalShow").text();

    /*获取当前时间*/
    var date = new Date();
    var seperator1 = "-";
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var strDate = date.getDate();
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    var currentdate = year + seperator1 + month + seperator1 + strDate;
    /*结束*/

    if (commTitle == null || commTitle == "") {
        commTitle = courseName;
    }
    if (commentBody == null || commentBody == "") {
        swal({
            title: "请输入评论内容！",
            type: "warning",
            confirmButtonText: "确 定"
        });
    }else {
        $.ajax({
            type: "post",
            url: "/course/course_comm_submit",
            dataType: 'json',
            data: {"commTitle": commTitle, "commentBody": commentBody, "courseId": courseId, "courseName":courseName},// 你的formid
            error: function (request) {
                swal({
                    title: "评论失败!",
                    type: "warning",
                    confirmButtonText: "确 定"
                });
            },
            success: function (data) {
                /*window.location.reload();//刷新当前页面. date("Y-m-d", $data_val['createDate'])*/
                swal({
                    title: "评论成功",
                    type: "success",
                    confirmButtonText: "确定"
                },
                function (isConfirm) {
                    if (isConfirm) {
                        var opt = '';
                        opt +='<li>'
                            +'<div class="avatar" style="margin-left: 5px;">'
                            +'<img src="/content/images/default_header.png" height="40" width="40">'
                            +'</div>'
                            +'<div class="inner" style="padding-left: 15px;">'
                            +'<p><span>'+pre_username+'</span><br>'
                            +'<span class="commTitle">'+commTitle+'</span>'
                            +'<span class="time" style="float: right;">'+(currentdate)+'</span>'
                            +'</p>'
                            +'<div class="meta">'
                            +'<span class="blue">'+commentBody+'</span>'
                            +'</div>'
                            +'</div>'
                            +'</li>';
                        $("#comment_list").prepend(opt);
                        $("#commTitle").val("");
                        $("#commentBody").val("");
                        $("#totalShow").text(parseInt(totalShow)+parseInt(1));
                        // $("#comment_list").find("li").last().remove();

                    }
                });

            }
        });
    }
}