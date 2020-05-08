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
              action="/wish/wishelper_submit">
            <h2 class="mail-h2"><?php echo ($_GET['type']==1||$_GET['type']==2)?'心愿能力':'心愿信息'; ?></h2>
            <input type="hidden" name="userWishId" value="<?php if(!empty($data)){echo html::encode($data['idStr']); }?>">
            <div class="form-group">
                <label class="col-sm-2 control-label">心愿标题：</label>
                <div class="col-sm-6" style="width: 50%">
                    <?php if(!empty($data)){echo html::encode($data['title']); }?>
                    <input name="userWishTitle" type="hidden" value="<?php if(!empty($data)){echo html::encode($data['title']); }?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">联系方式：</label>
                <div class="col-sm-6" style="width: 50%">
                    <?php if(!empty($data)){echo html::encode($data['contact']); }?>
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
            <?php
            if($_GET['type']==0||$_GET['type']==3){
                echo '
                <div class="form-group">
                    <label class="col-sm-2 control-label">是否匿名：</label>
                    <div class="col-sm-6" style="width: 50%">';
                if(!empty($data)){echo ($data['anonymous']==1?'否':'是'); }
                echo'</div>
                </div>
                ';
            }
            ?>

            <div class="form-group">
                <label class="col-sm-2 control-label"> 内容：</label>
                <div class="col-sm-6" style="width: 50%">
                    <?php if(!empty($data)){echo html::encode($data['content']); }?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    图片：
                </label>
                <div class="col-sm-9" >
                    <?php
                    if(!empty($data['picJson'])){
                        foreach (json_decode($data['picJson'])as $num =>$val){
                            if($val!=null&&$val!=''){
                                echo ' <img  src="'.$val->url.'" style="width:90%">';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
            if($_GET['type']==0||$_GET['type']==3){
                if(!empty($data)&&$data['wishState']==1){
                    echo ' <div class="form-group" style="text-align: center">
                            <button type="submit" class="btn submit_btn btn-primary btn-size-medium">领取</button>
                        </div>';
                }
            }

            ?>
        </form>
    </div>
</div>
<script src="/content/js/jquery-2.0.3.min.js" type="text/javascript"></script>
<script src="/content/js/uncommon/init_wev8.js" type="text/javascript"></script>
<script type="text/javascript" src="/content/js/uncommon/page_add.js?v=2"></script>
<script type="text/javascript" src="/content/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/content/js/uploadfiles/upload.js"></script>
<script type="text/javascript" src="/content/js/bootstrapValidator.min.js"></script>
<script>

</script>
<style>
    .form-group div{
        padding-top: 7px;
    }
</style>