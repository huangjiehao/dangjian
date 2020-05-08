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
</style>
<div class="ly_main" style="height: auto;">
    <div id="ly_dj_news">
        <form id="newsFormId" class="form_sumbit form-horizontal" role="form" enctype="multipart/form-data" method="post"
              action="/wish/wish_submit">
            <h2 class="mail-h2"><?=($_GET['type']==0?'心愿信息':'心愿能力信息')?></h2>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?=($_GET['type']==0?'心愿标题':'能力标题')?>：</label>
                <div class="col-sm-6" style="width: 50%">
                    <input id="" name="title" class="form-control" value="<?php if(!empty($editData)){echo html::encode($editData['title']); }?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">联系方式：</label>
                <div class="col-sm-6" style="width: 50%">
                    <input id="" name="contact" class="form-control" value="<?php if(!empty($editData)){echo html::encode($editData['contact']); }?>">
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="col-sm-2 control-label">心愿类别：</label>
                <div class="col-sm-6" style="width: 50%">
                    <select id="" name="type" class="form-control" >
                        <option value="1" <?php /*if(!empty($editData)){echo ($editData['type']==1?'selected':''); }*/?> >咨询</option>
                        <option value="2" <?php /*if(!empty($editData)){echo ($editData['type']==2?'selected':''); }*/?> >求助</option>
                        <option value="3" <?php /*if(!empty($editData)){echo ($editData['type']==3?'selected':''); }*/?> >建议</option>
                        <option value="4" <?php /*if(!empty($editData)){echo ($editData['type']==4?'selected':''); }*/?> >投诉举报</option>
                        <option value="5" <?php /*if(!empty($editData)){echo ($editData['type']==5?'selected':''); }*/?> >其他</option>
                    </select>
                </div>
            </div>-->
            <div class="form-group">
                <label class="col-sm-2 control-label">是否匿名：</label>
                <div class="col-sm-6" style="width: 50%">
                    <select id="" name="anonymous" class="form-control" >
                        <option value="0" <?php if(!empty($editData)){echo ($editData['anonymous']==1?'selected':''); }?> >否</option>
                        <option value="1" <?php if(!empty($editData)){echo ($editData['anonymous']==2?'selected':''); }?> >是</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"> 内容：</label>
                <div class="col-sm-6" style="width: 50%">
                    <textarea id="" name="content" class="form-control" ><?php if(!empty($editData)){echo html::encode($editData['title']); }?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    图片：
                </label>
                <div class="col-sm-9" >
                    <div class="upload-files-main" name="picJson" data-p-height="50" data-accept=".png,.jpg,.jpeg" >
                        <!--<div class="files-data"><?/*=$editData['projEstb']['estbAtt'] */?></div>-->
                        <?php require(__DIR__ . '/../layouts/upload_files.php'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group" style="text-align: center">
                <input type="hidden" name="type" value="<?=$_GET['type']?>">
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
                contact: {
                    validators: {
                        notEmpty: {
                            message: '首页显示数量不能为空'
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
            }
        });

    });
</script>
