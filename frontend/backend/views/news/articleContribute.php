<?php

use common\models\MyFunction;
use yii\helpers\Html;

?>
<link rel="stylesheet" href="/content/js/myTree/my.tree.css">
<link rel="stylesheet" href="/content/select2/css/select2.min.css">
<script type="text/javascript" src="/content/plugins/laydate/laydate.js"></script>
<!--<input type="hidden" id="HTTP_HOSTS" value="--><?php //echo HTTP_HOSTS ?><!--">-->
<style>
    .box-footer {
        z-index: 999;
    }

    .content-header {
        z-index: 1000;
    }

    .select-tree-option {
        z-index: 1000;
    }

    .hidesub {
        display: none;
    }

    .topfif {
        top: 50px !important;
    }
    #main{
        width:1200px;
        margin: 0 auto;
        overflow: hidden;
    }
    .content-wrapper{
        margin: 20px 0;
        background: #fff;
    }
</style>

<div id="main">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="container un_dif">
            <section class="content-header">
                <h3>
                    <?php if (isset($_GET['edit']) && ($_GET['edit'] == "edit")) {
                        echo '编辑';
                    } else {
                        echo '征文';
                    } ?>投稿
                </h3>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12 un_float">
                        <div class="box box-primary">
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form id="newsFormId" class="form_sumbit form-horizontal" role="form"
                                  enctype="multipart/form-data" method="post"
                                  action="/channel/news_submit" onsubmit="return appendNesSign()">
                                <div class="box-body">
                                    <div id="channeldiv" class="form-group">
                                        <label class="col-sm-2 control-label">投稿栏目：</label>
                                        <div class="col-sm-6" style="width: 50%">
                                            <input id="selectParent" type="text" class="select-tree form-control"
                                               data-other-param="lftVal,rgtVal"
                                               placeholder="--请选择--"
                                               data-tree-data="parentData" data-name="channelId" name="channelName"
                                               data-val="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">征文标题：</label>
                                        <div class="col-sm-6" style="width: 50%">
                                        <textarea class="form-control" placeholder="请输入"
                                                  name="title"><?php if (!empty($editData)) {
                                                echo $editData['title'];
                                            } else if (!empty($notifyData)) {
                                                echo Html::encode($notifyData['title']);
                                            } ?></textarea>
                                            <!--                                        <input type="text" class="form-control" placeholder="请输入" name="title"-->
                                            <!--                                               value="-->
                                            <?php //if (!empty($editData)) {echo $editData['title']; }else if (!empty($notifyData)){
                                            //                                                   echo Html::encode($notifyData['title']);
                                            //                                               } ?><!--">-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">征文素材：</label>
                                        <div class="col-sm-8">
                                            <div class="upload-files-main" name="smallPic" data-p-height="50"
                                                 data-accept=".png,.jpg,.jpeg,.JPG" data-max-count="3">
                                                <!--<div class="files-data"><? /*=$editData['projEstb']['estbAtt'] */ ?></div>-->
                                                <?php require(__DIR__ . '/../layouts/upload_files.php'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">正文：</label>
                                        <div class="col-sm-6" style="width: 50%">
                                        <textarea id="content" class="" name="content"><?php if (!empty($editData)) {
                                                echo $editData['details']['content'];
                                            } else if (!empty($notifyData)) {
                                                echo $notifyData['content'];
                                            } ?></textarea>
                                            <input id="summary" name="summary" type="hidden" class="form-control"/>
                                            <input id="editor" name="editor" class="form-control"
                                                   style="display: none;"/>
                                        </div>
                                    </div>


                                </div>
                                <input type="hidden" name="relArticleId" class="relArticleId"
                                       value="<?php if (!empty($editData['relArticleId'])) {
                                           echo $editData['relArticleId'];
                                       } ?>">
                                <input type="hidden" id="notifyData" value="<?php if (!empty($notifyData)) {
                                    echo 1;
                                } else {
                                    echo 2;
                                } ?>">
                                <input type="hidden" name="detailsId" value="<?php if (!empty($editData)) {
                                    echo $editData['detailsId'];
                                } ?>">
                                <input type="hidden" name="artSta" value="<?php if (!empty($editData)) {
                                    echo $editData['artSta'];
                                } ?>">
                                <input type="hidden" id="pic" value=""/>
                                <input type="hidden" id="sendType" name="sendType">
                                <input type="hidden" id="signJson" name="signJson">
                                <input type="hidden" name="edit" id="edit" class="edit"
                                       value="<?php echo(isset($_GET['edit']) ? $_GET['edit'] : '') ?>">
                                <input type="hidden" name="idStr"
                                       value="<?php echo(isset($_GET['idStr']) ? $_GET['idStr'] : '') ?>">
                                <!-- /.box-body -->
                                <div class="box-footer">

                                    <?php
                                    if (empty($notifyData)) {
                                        if (!empty($editData)) {
                                            if ($editData['artSta'] == 0) {
                                                echo '<button type="submit" class="btn submit_btn btn-primary btn-size-medium">保存草稿</button>';
                                            } else {
                                                echo '<button type="submit" class="btn submit_btn btn-primary btn-size-medium">保存草稿</button>';
                                                echo '<button type="submit" class="btn submit_btn btn-success btn-size-medium">提交审批</button>';
                                            }
                                        } else {
                                            echo '<button type="submit" class="btn submit_btn btn-primary btn-size-medium">保存草稿</button>';
                                        }
                                    }
                                    ?>
                                    <?php
                                    if (empty($editData) || (!empty($editData) && $editData['artSta'] == 0)) {
                                        echo ' <button type="submit" class="btn btn-success" onclick="approvalNewstosubmit()">提交审批</button>';
                                    }
                                    ?>

                                    <a type="button" class="btn btn-danger btn-size-medium"
                                       href="javascript:window.opener=null;window.open('','_self');window.close();">关闭</a>

                                </div>
                        </div>
                        </form>
                    </div>
                    <!-- /.col (RIGHT) -->
                </div>
                <!-- /.row -->
            </section>
        </div>
        <!-- /.content -->
        <div id="parentData" data-param="lftVal,rgtVal,id" class="hide"></div>
        <div id="subparentData" class="hide"></div>
    </div>
</div>
<script src="/content/plugins/ueditor/ueditor.config.js" type="text/javascript"></script>
<script src="/content/plugins/ueditor/ueditor.all.min.js" type="text/javascript"></script>
<script src="/content/js/pageScript/channel.js" type="text/javascript"></script>
<script src="/content/select2/js/select2.min.js" type="text/javascript"></script>
<script src="/js/uploadfiles/upload.js" type="text/javascript"></script>
<script type="text/javascript">
    UE.getEditor('content', {initialFrameWidth: 800, initialFrameHeight: 200, autoHeightEnabled: false});
    UE.getEditor('content').addListener('beforefullscreenchange', function (event, isFullScreen) {
        if (isFullScreen) {
            $('.edui-editor').addClass('topfif');
        } else {
            $('.edui-editor').removeClass('topfif');
        }
//        alert(isFullScreen?'全屏':'默认')
    })
    var ue = UE.getEditor('content');
    ue.addListener("blur", function () {
        var arr = [];
        arr.push(UE.getEditor('content').hasContents());
        if (arr != 'true') {
            $("#editor").val("");
            $("form").bootstrapValidator("addField", "editor", {validators: {notEmpty: {message: '内容不能为空！'},}});
        } else {
            $("#editor").val("true");
            $("form").bootstrapValidator('removeField', 'editor');
            $("form").bootstrapValidator("addField", "editor", {});
        }

    });
    $(document).ready(function () {
        $('.form_sumbit').bootstrapValidator({
//        live: 'disabled',
            message: 'This value is not valid',
            excluded: [":disabled"],
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                channelName: {
                    validators: {
                        notEmpty: {
                            message: '上级频道不能为空或者不能选择有下级频道'
                        },
                    }
                },
                title: {
                    validators: {
                        notEmpty: {
                            message: '标题不能为空'
                        },
                        stringLength: {
                            min: 1,
                            max: 100,
                            message: '标题小于100个字'
                        },
                    }
                },
                editor: {
                    validators: {
                        notEmpty: {
                            message: '内容不能为空！'
                        },
                    }
                },

            }
        });

        $(".upload-files-submit-btn").click(function () {
            $("#pic").val(1);
            $(".btn").removeAttr("disabled");
        });

    });


    function appendNesSign() {
        if ($(".upload-files-result").val() != '' && $(".upload-files-result").val() != undefined) {
            var fileResult = JSON.parse($(".upload-files-result").val());//stringify
            var url = $("#url").val();
            fileResult[0].seturl = url;
            $(".upload-files-result").val(JSON.stringify(fileResult));
            $("#picInfo").val('');
        }
        if ($(".upload-files-result").val() != '' && $("#edit").val() == 'edit') {
            if ($("#picInfo").val() != '' && $("#picInfo").val() != undefined) {
                var fileResult = JSON.parse($("#picInfo").val());//stringify
                var url = $("#url").val();
                fileResult[0].seturl = url;
                $("#picInfo").val(JSON.stringify(fileResult));
            }
        }
        if ($(".upload-files-result").val() == '' && $("#edit").val() == 'edit') {
            if ($("#picInfo").val() != '' && $("#picInfo").val() != undefined) {
                var fileResult = JSON.parse($("#picInfo").val());//stringify
                var url = $("#url").val();
                fileResult[0].seturl = url;
                $("#picInfo").val(JSON.stringify(fileResult));
            }
        }

        getContentTxt();//富文本编辑器获取存文本

        //点击提交判断是否图片有选择，但未提交
        var uploadFilesBox = $(".upload-files-box").find(".upload-files-item").length;
        var pic = $("#pic").val();
        if (uploadFilesBox >= 2 && pic == "") {
            swal({
                title: "请点击上传文件",
                type: "warning",
                confirmButtonText: "确定"
            }, function (isConfirm) {
                if (isConfirm) {
                    $(".layout_loading").css("display", "none");
                    return true;
                }
            });
            return false;
        }

        // var signArr=$("#sign").val();
        // if(signArr!=""&&signArr!=null&&signArr!=undefined){
        //     if(signArr.length>0){
        //         var len=signArr.length;
        //         var signStr="";
        //         for (var i=0;i<len;i++){
        //             signStr+=signArr[i];
        //             if(i+1<len){
        //                 signStr+=',';
        //             }
        //         }
        //     }
        //     $("#signJson").val(signStr);
        // }
        var channid = $("input[name='channelId']").val();
        $('.link').each(function () {
            if ($(this).data("id") == channid) {
                if ($(this).data("child-node-count") != '0') {
                    $("form").data("bootstrapValidator").updateStatus("channelName", "INVALID", null);
                    /*  $("form").bootstrapValidator("addField", "channelName", {
                          validators: {
                              notSameAndContinuity : {
                                  message: '该频道有下属频道，不能选择'
                              },
                          }
                      });*/
                } else {
                    $("form").data("bootstrapValidator").updateStatus("channelName", "VALID", null);
                }
            }
        })
        var arrReady = [];
        arrReady.push(UE.getEditor('content').hasContents());
        if (arrReady != 'true') {
            $("#editor").val("");
            $("form").bootstrapValidator("addField", "editor", {validators: {notEmpty: {message: '内容不能为空！'},}});
        } else {
            $("#editor").val("true");
            $("form").bootstrapValidator('removeField', 'editor');
            $("form").bootstrapValidator("addField", "editor", {});
        }
        return true;
    }

    function getContentTxt() {//富文本编辑器获取存文本1
        var arr = [];
        arr.push(UE.getEditor('content').getContentTxt());
        var str = arr.join("\n");
        $("#summary").val(str.substring(0, 250));
    }

</script>
