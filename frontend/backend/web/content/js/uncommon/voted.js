$(function () {
    var resultDataId = null;
    if(localStorage.getItem("curVoterId")=="undefined"||localStorage.getItem("curVoterId")==undefined||localStorage.getItem("curVoterId")==""){
        resultDataId = $("#resultDataId").val();
        localStorage.setItem("curVoterId",resultDataId);
    }else{
        resultDataId = localStorage.getItem("curVoterId");
        $("#resultDataId").val(localStorage.getItem("curVoterId"));
    }
    var url = window.location.href;
    if(resultDataId!=''||resultDataId!="undefined"||localStorage.getItem("curVoterId")==undefined){
        if(url.toString().indexOf('resultDataId') == -1){
            window.location.href = url+'&resultDataId='+resultDataId;
        }
    }

    $(".comlogin").click(function(){
        $(".login-wrap").show();
        $("#mask").show();
        $(".wel").text("推荐投票");
    });
});

function vote() {
    var voteArr = [];
    var sum = 0;
    $(".caption").each(function(i) {
        var id = $(this).data("id");
        var name = $(this).data("name");
        var tickets = $(this).data("ticket");
        $(this).find('input:checked').each(function (j) {
            var obj = {};
            obj.id = id;
            obj.name = name;
            obj.tickets = tickets;
            voteArr.push(obj);
        });
    });
    console.dir(JSON.stringify(voteArr));
    $("#checkedIds").val(JSON.stringify(voteArr));
    //判断是否选中的方法
    if (!is_check_user()) {
        return;
    }

    var voteId = $("#idStr").val();
    var visitor = $("#visitor").val();
    var voteMin = $("#voteMin").val();
    var voteMax = $("#voteMax").val();
    var resultDataId = "";
    var userId = $("#userId").val();
    if(userId == ""){
        if(visitor == 1){
            if(localStorage.getItem("curVoterId")==undefined){
                resultDataId = $("#resultDataId").val();
                resultDataId = localStorage.setItem("curVoterId",resultDataId);
            }else{
                resultDataId = localStorage.getItem("curVoterId");
            }
        }
    }else{
        resultDataId = userId;
    }

    if(voteArr.length>=voteMin && voteArr.length<=voteMax){
        swal({
                title: "确定投票？",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: "post",
                        url: "/voted/voted_submit",
                        data: {"voteId":voteId,"visitor":visitor,"beVotedMembers": voteArr,"resultDataId": resultDataId},// 你的formid
                        error: function (request) {
                            swal({
                                title: "连接失败！",
                                type: "warning",
                                confirmButtonText: "确定"
                            });
                        }, success: function (request) {
                            var status = JSON.parse(request)['status'];
                            if (status == '1000') {
                                swal({
                                    title: "投票成功! ",
                                    type: "success",
                                    confirmButtonText: "确定"
                                }, function (isConfirm) {
                                    if(isConfirm){
                                        swal.close();
                                        window.location.reload();
                                    }
                                });
                            } else {
                                var errorMsg = JSON.parse(request)['data']['errorMsg'];
                                swal({
                                    title: errorMsg,
                                    type: "error",
                                    confirmButtonText: "确定"
                                }, function (isConfirm) {
                                    swal.close();
                                });
                            }
                        }
                    });
                } else {
                    swal.close();
                }
            });
    }else{
        swal({
            title: "已超出投票范围",
            type: "warning",
            confirmButtonText: "确定",
        },
        function (isConfirm) {
            if (isConfirm) {
                swal.close();
            }
        });
    }
}

function is_check_user() {
    var checkedIds = JSON.parse($('#checkedIds').val());
    if (!checkedIds.length) {
        swal({
            title: "请选择",
            text: '请选择投票人',
            type: "warning",
        });
        return false;
    }
    return true;
}

function deleteItem(name){
    localStorage.removeItem(name);
}

function find() {
    $(".edit").css("display", "none");
    var name = $("#findName").val();
    var allName = $('.findName');
    var idStr = null;
    for (var i = 0; i < allName.length; i++) {
        var temp = $(allName[i]).val();
        if (temp.indexOf(name) != -1) {
            idStr = $(allName[i]).attr("id");
            $("#" + idStr + "").parents().css("display", "block");
            $("#" + idStr + "").css("display", "block");
            continue;
        }
    }
}