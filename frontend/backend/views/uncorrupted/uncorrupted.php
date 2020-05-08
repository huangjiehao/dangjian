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
<div class="ly_main">
    <div id="ly_dj_news">
        <form id="newsFormId" class="form_sumbit form-horizontal" role="form" enctype="multipart/form-data" method="post"
              action="/uncorrupted/uncorrupted_submit" >
            <h2 class="mail-h2">举报内容信息</h2>
            <div class="form-group">
                <label class="col-sm-2 control-label">举报标题：</label>
                <div class="col-sm-6" style="width: 50%">
                    <input id="" name="title" class="form-control" value="<?php if(!empty($editData)){echo html::encode($editData['title']); }?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"> 举报内容：</label>
                <div class="col-sm-6" style="width: 50%">
                    <textarea id="" name="contents" class="form-control" ><?php if(!empty($editData)){echo html::encode($editData['title']); }?></textarea>
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

