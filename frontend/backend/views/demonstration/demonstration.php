<?php
use yii\helpers\Html;
?>
<link href="/content/css/uncommon/artice.css" rel="stylesheet" type="text/css"/>
<link href="/content/css/development/development_index.css" rel="stylesheet" type="text/css">
<link href="/content/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<style>
    body{
        overflow-y: scroll;
    }
    .mail-h2 {
        background: #f1e0e0;
        color: #b6978c;
        font: normal 14px/30px 'microsoft yahei';
        text-align: center;
    }
    .wrapper_page{
        height:auto!important;
    }
    .ly_main{
        height: 100%!important;
    }
</style>
<div class="ly_main" style="height: 800px!important;">
    <div id="ly_dj_news">
        <form id="newsFormId" class="form_sumbit form-horizontal" role="form" enctype="multipart/form-data" method="post"
              action="/demonstration/demonstration_submit" >
            <h2 class="mail-h2">自评</h2>
            <div class="form-group">
                <label class="col-sm-3 control-label">觉醒觉悟方面：</label>
                <div class="col-sm-6" style="width: 50%">
                    <textarea rows="6" id="" name="content" class="form-control" ><?php if(!empty($editData)){echo html::encode($editData['title']); }?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"> 责任意识及工作作风方面情况：</label>
                <div class="col-sm-6" style="width: 50%">
                    <textarea rows="6" id="" name="content" class="form-control" ><?php if(!empty($editData)){echo html::encode($editData['title']); }?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"> 业务技能方面情况：</label>
                <div class="col-sm-6" style="width: 50%">
                    <textarea rows="6" id="" name="content" class="form-control" ><?php if(!empty($editData)){echo html::encode($editData['title']); }?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"> 上月存在不足：</label>
                <div class="col-sm-6" style="width: 50%">
                    <textarea rows="6" id="" name="content" class="form-control" ><?php if(!empty($editData)){echo html::encode($editData['title']); }?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"> 本月完善情况：</label>
                <div class="col-sm-6" style="width: 50%">
                    <textarea rows="6" id="" name="content" class="form-control" ><?php if(!empty($editData)){echo html::encode($editData['title']); }?></textarea>
                </div>
            </div>
            <div class="form-group" style="text-align: center">
                <button type="submit" class="btn submit_btn btn-primary btn-size-medium">提交</button>
            </div>
        </form>
    </div>
</div>
<script src="/content/js/jquery-2.0.3.min.js" type="text/javascript"></script>
<script src="/content/js/uncommon/init_wev8.js" type="text/javascript"></script>
<script type="text/javascript" src="/content/js/uncommon/page_add.js?v=2"></script>
<script type="text/javascript" src="/content/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/content/js/uploadfiles/upload.js"></script>
<script type="text/javascript" src="/content/js/bootstrapValidator.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('form').bootstrapValidator({
//        live: 'disabled',
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: '标题不能为空'
                        },
                    }
                },
                sendPhone: {
                    validators: {
                        notEmpty: {
                            message: '电话不能为空'
                        },
                        stringLength: {
                            min: 7,
                            max: 11,
                            message: '电话必须大于6位，长度必须小于12位'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: '只能填数字'
                        },
                    }
                },
                content: {
                    validators: {
                        notEmpty: {
                            message: '内容不能为空'
                        },
                    }
                },
                sendAddress: {
                    validators: {
                        notEmpty: {
                            message: '地址不能为空'
                        },
                    }
                },
            }
        });

    });
</script>
