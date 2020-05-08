function showReplyFrom(obj) {
    $("#replyBt").attr("data-topic-id", $(obj).attr("data-topic-id"));
    $("#replyBt").attr("data-topic-user-name", $(obj).attr("data-topic-user-name"));
    $("#replyBt").attr("data-topic-user-id", $(obj).attr("data-topic-user-id"));
    $("#replyBt").attr("data-topic-reply-id", $(obj).attr("data-topic-reply-id"));
    $("#replyBt").attr("data-reply-user-name", $(obj).attr("data-reply-user-name"));
    $("#replyBt").attr("data-reply-user-id", $(obj).attr("data-reply-user-id"));
    $("#myModalLabel").html("回复 @<span style='color: #0a8cd2;'>" + $(obj).attr("data-reply-user-name") + "</span>");
}

/*function gotoDetails(notif,id) {
    //确认消息为已读
    // var notif = $(obj).data("id");
  /!*  $.ajax({
        dataType: "json",
        type: "post",
        url: "/answers/answers_read",
        data: {"notif": notif},
        error: function (request) {
            swal({
                title: "连接失败！",
                type: "warning",
                confirmButtonText: "确定"
            });
        }, success: function (request) {
            if (request.status == '1000') {
                swal({
                    title: request.data.message,
                    type: "success",
                    confirmButtonText: "确定"
                }, function (isConfirm) {
                    reload();
                });
            } else {
                swal({
                    title: request.msg,
                    type: "warning",
                    confirmButtonText: "确定"
                });
            }
        }
    });*!/

    window.location.href="/answers/answers_dtls?id=" + id+"notif=" + notif;;
}*/

/*function isDetails(id,notif) {
    window.location.href="/answers/answers_dtls?id="+id+"&notif="+notif;
}*/

function gotoDetails(id, notif, moveId, level) {
    var url = "/answer/answer_dtls?1=1&notif=" + notif;
    if (level > 1) {
        href(getUrl(url, new Array("id", "moveId", "level"), new Array(id, moveId, level)));
    } else {
        href(getUrl(url, new Array("id", "moveId"), new Array(id, moveId)));
    }
}

function doTopicType(obj) {
    var topicTypeId = $(obj).data("topic-type-id");
    $("#topicTypeId").val(topicTypeId);
    gotoTopicList();
}

function doField(obj) {
    var field = $(obj).data("field");
    $("#field").val(field);
    gotoTopicList();
}

function getUrl(url, params, vals) {
    for (var i = 0; i < params.length; i++) {
        if (isNotEmpty(vals[i])) {
            url = url + "&" + params[i] + "=" + vals[i];
        }
    }
    return url;
}

function isNotEmpty(val) {
    if (val == null) {
        return false;
    }
    if (val.length == 0) {
        return false;
    }
    if (val.length == undefined) {
        return false;
    }
    return true;
}

function href(url) {
    window.location.href = url;
}

function gotoTopicList() {
    var topicTypeId = $("#topicTypeId").val();
    var field = $("#field").val();
    var findname = $("#findName").val();
    // var url = "/answers/answers_list?1=1";
    var url = "/answer/answer_list?1=1";
    href(getUrl(url, new Array("topicKeyId", "findName", "field"), new Array(topicTypeId, findname, field)));
}

function doType(obj) {
    var topicType = $(obj).data("topic-type");
    gotoTopicNotification(topicType);
}

function gotoTopicNotification(topicType) {
    href("/answer/answer_notif?topicType=" + topicType);
}


function docAttention(obj, num) { //点击关注
    var topicId = $(obj).data("topic-id");
    $.ajax({
        dataType: "json",
        type: "post",
        url: "/answers/answers_attention",
        data: {"topicId": topicId},
        error: function (request) {
            swal({
                title: "连接失败！",
                type: "warning",
                confirmButtonText: "确定"
            });
        }, success: function (request) {
            if (request.status == '1000') {
                swal({
                    title: request.data.message,
                    type: "success",
                    confirmButtonText: "确定"
                }, function (isConfirm) {
                    window.location.href = "/answer/answer_dtls?id=" + topicId;
                    // isDetails(topicId);
                });
            } else {
                swal({
                    title: request.msg,
                    type: "error",
                    confirmButtonText: "确定"
                }, function (isConfirm) {
                    swal.close();
                });
            }
        }
    });
    return false;
}

function cancelAttention(obj, num) { //取消关注
    var topicId = $(obj).data("topic-id");
    $.ajax({
        dataType: "json",
        type: "post",
        url: "/answers/answers_attention",
        data: {"topicId": topicId},
        error: function (request) {
            swal({
                title: "连接失败！",
                type: "warning",
                confirmButtonText: "确定"
            });
        }, success: function (request) {
            if (request.status == '1000') {
                swal({
                    title: request.data.message,
                    type: "success",
                    confirmButtonText: "确定"
                }, function (isConfirm) {
                    if (isConfirm) {
                        reload();
                    }
                });
            } else {
                swal({
                    title: request.msg,
                    type: "warning",
                    confirmButtonText: "确定"
                }, function (isConfirm) {
                    if (isConfirm) {
                        reload();
                    }
                });
            }
        }
    });
    return false;
}

/*function doRead(obj) {

}*/

/*function getContentTxt() {
    var arr = [];
    arr.push(UE.getEditor('content').getContentTxt());
    var str = arr.join("\n");
    str = str.substring(0, 50) + "...";
    return str;
}*/

function doAddAnswersTopic() {
    /* var contentsTitle = getContentTxt();
     $("#contentsTitle").val(contentsTitle);
     var  filesresult =JSON.parse($(".upload-files-result").val()).url;
     $(".upload-files-result").val(filesresult);
     return true;*/

}

function praise(idStr) {
    $.ajax({
        dataType: "json",
        type: "post",
        url: "/answers/answers_praise",
        data: {"id": idStr},
        error: function (request) {
            swal({
                title: "连接失败！",
                type: "warning",
                confirmButtonText: "确定"
            });
        }, success: function (request) {
            if (request.status == '1000') {
                var praiseNum = $("#praise" + idStr).find("span").text();
                $("#praise" + idStr).find("span").text(praiseNum - 1 + 2);
                swal({
                    title: "点赞成功！",
                    type: "success",
                    confirmButtonText: "确定"
                }, function (isConfirm) {
                    swal.close();
                });
                /* var zan = $("#praise" + idStr).find("span").text();
                 $("#praise" + idStr).find("span").text(parseInt(zan)+1);*/
                // $.message('点赞成功！');
            } else {
                swal({
                    title: "不能重复点赞！",
                    type: "warning",
                    confirmButtonText: "确定"
                }, function (isConfirm) {
                    swal.close();
                });
            }
        }
    });
    return false;
}

function reload() {
    window.location.reload();
}

function commentItem(obj) {
    var id = $(obj).data("id");
    var display = $(obj).find("input");
    if ($(display).val() == "show") {
        $(display).val("hide");
        $(obj).find(".commentTitle").text("隐藏");
        showCommentItem(id);
    } else {
        $(display).val("show");
        var itemList = $("#commentItem" + id).find(".list-group");
        var pageNow = $("#commentItem" + id).find(".pageNum");
        $(pageNow).val(1);
        $(itemList).remove();
        $(obj).find(".commentTitle").text("展开");
    }
}


/*function showCommentItem(id) {
    var pageNow = $("#commentItem" + id).find(".pageNum")
    var moreList = $("#commentItem" + id).find(".more-list");
    if (moreList != null) {
        $(moreList).remove();
    }
    var pageIndex = $(pageNow).val();
    var limitCounts = 5;
    $.ajax({
        dataType: "json",
        type: "post",
        url: "/answers/answers_reply_list",
        data: {
            "pageNumber": pageIndex,
            "limitCounts": limitCounts,
            "id": id
        },
        error: function (request) {
            var itemStr = "<div class=\"list-group\">\n" +
                "    <a onclick='reload()' class=\"list-group-item\">\n" +
                "        <center><h4 class=\"list-group-item-heading\">加载失败，请刷新页面。</h4></center>\n" +
                "    </a>\n" +
                "</div>";
            $("#commentItem" + id).html(itemStr);
        }, success: function (request) {
            if (request.status == '1000') {
                var data = request.data;
                var replyList = data.listAnswersTopicReply;
                if (replyList.length == 0) {
                    var itemStr = "<input type=\"hidden\" class=\"pageNum\" value=\"1\"><div class=\"list-group\">" +
                        "    <a  class=\"list-group-item\">" +
                        "        <center><h4 class=\"list-group-item-heading\">空空如也，等着你来回复哦~~</h4></center>" +
                        "    </a>" +
                        "</div>";
                    // $("#commentItem" + id).html(itemStr);
                    $("#commentItem" + id).html(itemStr);
                    return;
                }
                for (var i = 0; i < replyList.length; i++) {
                    var time = timestampToTime(replyList[i].createDateStr);
                    var itemTitleStr = itemTitleStr = replyList[i].createUserName + " <span style='color: #0a8cd2;'>回复</span> @" + replyList[i].replyUserName;
                    //var uid = $("#userId").val();
                    if (replyList[i].replyUserIdStr == replyList[i].createUserIdStr) {
                        itemTitleStr = replyList[i].createUserName;
                    }
                    var itemStr = "<div class=\"list-group\" data-toggle=\"modal\" \n" +
                        "data-topic-reply-id=\"" + /!*replyList[i].idStr*!/id + "\" " +
                        "data-topic-user-name=\"" + replyList[i].topicCreateUserName + "\" " +
                        "data-topic-user-id=\"" + replyList[i].topicCreateUserIdStr + "\" " +
                        "data-reply-user-name=\"" + replyList[i].createUserName + "\" " +
                        "data-reply-user-id=\"" + replyList[i].createUserIdStr + "\" " +
                        "data-topic-id=\"" + replyList[i].topicIdStr + "\" " +
                        "data-target=\"#reply\" " +
                        "onclick=\"showReplyFrom(this)\" >" +
                        "<a class=\"list-group-item\">\n" +
                        "<h4 class=\"list-group-item-heading\">" + itemTitleStr + "</h4>\n" +
                        "<p class=\"list-group-item-text\">" + replyList[i].commentContents + "</p>\n" +
                        "<p style='text-align: right;' class=\"list-group-item-text\">回复日期：" + time + "</p>\n" +
                        "</a>\n" +
                        "</div>";
                    $("#commentItem" + id).append(itemStr);
                }
                var counts = data.counts;
                if (counts > limitCounts) {
                    if ((pageIndex * limitCounts) < counts) {
                        var idStr = "'" + id + "'";
                        var itemStr = "<div onclick=showCommentItem(" + idStr + ") class=\"list-group more-list\">" +
                            "    <a  class=\"list-group-item active\">\n" +
                            "        <center><h4 class=\"list-group-item-heading\">显示更多</h4></center>" +
                            "    </a>" +
                            "</div>";
                        $("#commentItem" + id).append(itemStr);
                        $(pageNow).val((pageIndex - 1 + 2));
                    }
                }
            } else {
                var itemStr = "<div class=\"list-group\">" +
                    "    <a  onclick='reload()'  class=\"list-group-item\">" +
                    "        <center><h4 class=\"list-group-item-heading\">加载失败，请刷新页面。</h4></center>" +
                    "    </a>" +
                    "</div>";
                $("#commentItem" + id).html(itemStr);
            }
        }
    });
}*/

function timestampToTime(timestamp) {
    var date = new Date(timestamp * 1000);
    Y = date.getFullYear() + '-';
    M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
    D = date.getDate() + ' ';
    h = date.getHours() + ':';
    m = date.getMinutes();
    return Y + M + D + h + m;
}

function reply(obj) {
    var topicId = $(obj).data('topic-id');
    var topicCreateUserName = $(obj).data('topic-user-name');
    var topicCreateUserId = $(obj).data('topic-user-id');
    var replyPid = $(obj).data('topic-reply-id');
    var replyUserId = $(obj).data('reply-user-id');
    var replyUserName = $(obj).data('reply-user-name');
    var commentContents = $("#commentContents").val();
    $.ajax({
        dataType: "json",
        type: "post",
        url: "/answers/answers_reply",
        data: {
            "topicId": topicId,
            "topicCreateUserName": topicCreateUserName,
            "topicCreateUserId": topicCreateUserId,
            "replyPid": replyPid,
            "commentContents": commentContents,
            "replyUserId": replyUserId,
            "replyUserName": replyUserName
        },
        error: function (request) {
            swal({
                title: "连接失败！",
                type: "warning",
                confirmButtonText: "确定"
            });
        }, success: function (request) {
            if (request.status == '1000') {
                swal({
                    title: "回复成功！",
                    type: "success",
                    confirmButtonText: "确定"
                }, function (isConfirm) {
                    if (isConfirm) {
                        reload();
                    }
                });
            } else {
                swal({
                    title: "回复失败！",
                    type: "warning",
                    confirmButtonText: "确定"
                });
            }
        }
    });
}

$(function () {
    /**
     * 发布问题
     */
    $(document).on("click", ".question", function () {
        var title = $("#title").val();
        var topicKeyId = $("#topicKeyId").val();
        var contents = $("#content").val();
        if (title == "") {
            swal({
                title: "标题不能为空！",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确认"
            });
        }
        if (topicKeyId == "") {
            swal({
                title: "类型不能为空！",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确认"
            });
        }
        if (title != "" && topicKeyId != "") {
            swal({
                title: "确定发布？",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确认",
                cancelButtonText: "取消",
                closeOnConfirm: true,
                closeOnCancel: true,
                allowOutsideClick :false
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "/answers/answers_add_topic",
                        type: "post",
                        data: {"title": title, "topicKeyId": topicKeyId, "contents": contents},
                        error: function (request) {
                            // console.dir(request);
                            swal({
                                title: "连接失败！",
                                type: "warning",
                                confirmButtonText: "确定"
                            });
                            return false;
                        }, success: function (request) {
                            if(request == 1){
                                setTimeout(function(){
                                    swal({
                                        title: "发布成功",
                                        text: "请等待审核！",
                                        type: "success",
                                        confirmButtonText: "确定",
                                        showConfirmButton:true,
                                        allowOutsideClick :false
                                    },function (isConfirm) {
                                        if(isConfirm){
                                            window.location.reload();
                                        }
                                    });
                                },100);

                            }else{
                                setTimeout(function(){
                                    swal({
                                        title: "发布失败！",
                                        type: "warning",
                                        confirmButtonText: "确定",
                                        showConfirmButton:true,
                                        allowOutsideClick :false
                                    },function (isConfirm) {
                                        if(isConfirm){
                                            window.location.reload();
                                        }
                                    });
                                },100);

                            }

                        }
                    });
                }
                // return false;

            });
            return false;
        }


    });

    /**
     * 获取location的参数值
     */
    // function getSearchByKey(key) {
    //     var s = location.search;
    //     if (s !== undefined && s != null && s !== '') {
    //         s = s.toString().split('?')[1];
    //         if (s.indexOf('#') != -1) {
    //             s = s.split('#')[0];
    //         }
    //         var sarr = s.split('&');
    //         for (var i in sarr) {
    //             var item = sarr[i];
    //
    //             if (item.indexOf('=') === -1) {
    //                 continue;
    //             }
    //             if (item.split('=')[0] === key) {
    //                 return item.split('=')[1];
    //             }
    //         }
    //     }
    //     return '';
    // }

    $(".changeoverwap").hide();
    $(".unoverwap").click(function () {
        $(this).parent().find(".content").removeClass("overwap");
        $(this).hide();
        $(".changeoverwap").show();
    });
    $(".changeoverwap").click(function () {
        $(this).parent().find(".content").addClass("overwap");
        $(this).hide();
        $(".unoverwap").show();
    });

    $(".curtab").click(function () {
        var id = $(this).data("id");
        var arr = [];
        arr.push('topicKeyId=' + id);
        var param = '';
        if (arr.length > 0) {
            param = '?' + arr.join('&');
        }
        /*var url = window.location.href;
        if (url.indexOf('?')) {
            url = url.split('?')[0];
        }*/
        // location.href = '/answers/answers_list' + param;
        location.href = '/answer/answer_list' + param;
    });
    $(".isDetails").click(function () {
        var id = $(this).context.attributes.id.nodeValue;
        var notif = $(this).context.attributes.name.nodeValue;
        window.location.href = "/answer/answer_dtls?id=" + id + "&notif=" + notif;
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