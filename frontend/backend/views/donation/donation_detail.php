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
        height: auto!important;
    }
    .table thead tr th{
        text-align: left!important;
    }
    .table tbody tr td{
        text-align: left!important;
    }
</style>
<div class="ly_main" style="height: auto;">
    <div id="ly_dj_news">
        <form id="newsFormId" class="form_sumbit form-horizontal" role="form" enctype="multipart/form-data" method="post"
              action="/donation/donationreport_submit">
            <h2 class="mail-h2">捐献救助</h2>
            <div class="form-group">
                <label class="col-sm-3 control-label">爱心捐献标题：</label>
                <div class="col-sm-6">
                    <?php echo html::encode($detailData['actionsTitle'])?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">发布开始日期：</label>
                <div class="col-sm-6">
                    <?php echo date("Y-m-d", html::encode($detailData['publishBeginTime']))?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">发布结束日期：</label>
                <div class="col-sm-6">
                    <input type="hidden" name="publishEndTime" value="<?=html::encode($detailData['publishEndTime'])?>">
                    <?php echo date("Y-m-d", html::encode($detailData['publishEndTime']))?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">活动开始日期：</label>
                <div class="col-sm-6">
                    <?php echo date("Y-m-d", html::encode($detailData['actionsBeginTime']))?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">活动结束日期：</label>
                <div class="col-sm-6">
                    <?php echo date("Y-m-d", html::encode($detailData['actionsEndTime']))?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">联系人 ：</label>
                <div class="col-sm-6">
                    <?php echo html::encode($detailData['linkmanName'])?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">联系电话 ：</label>
                <div class="col-sm-6">
                    <?php echo html::encode($detailData['linkmanPhone'])?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">地点 ：</label>
                <div class="col-sm-6">
                    <?php echo html::encode($detailData['actionsAddr'])?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">内容：</label>
                <div class="col-sm-6">
                    <?php echo html::encode($detailData['contentsText'])?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">注意事项：</label>
                <div class="col-sm-6">
                    <?php echo html::encode($detailData['attention'])?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">上传图片：</label>
                <div class="col-sm-6" style="width: 50%">
                    <?php
                    if(!empty(html::encode($detailData['contentsPicJson']))){
                        echo '<table class="table table-hover" >
                            <thead>
                                <tr>
                                    <th>文件名</th>
                                    <th class="fileth">操作</th>
                                </tr>
                            </thead>
                            <tbody>';
                        foreach (json_decode($detailData['contentsPicJson']) as $el =>$attVal){
                            echo '<tr>
                                     <td>'.html::encode($attVal->name).'</td>
                                     <td><a target="_blank" href="'.html::encode($attVal->url).'" class="btn btn-primary">下载</a></td>
                                 </tr>';
                        }
                        echo '</tbody>
                        </table>';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">上传视频：</label>
                <div class="col-sm-6" style="width: 50%">
                    <?php
                    if(!empty($detailData['contentsVideoJson'])){
                        echo '<table class="table table-hover" >
                                <thead>
                                    <tr>
                                        <th>文件名</th>
                                        <th class="fileth">操作</th>
                                    </tr>
                                </thead>
                                <tbody>';
                        foreach (json_decode($detailData['contentsVideoJson']) as $el =>$attVal){
                            echo '<tr>
                                       <td>'.html::encode($attVal->name).'</td>
                                       <td><a target="_blank" href="'.html::encode($attVal->url).'" class="btn btn-primary">下载</a></td>
                                    </tr>';
                        }
                        echo '</tbody>
                        </table>';
                    }
                    ?>
                </div>
            </div>
            <input type="hidden" id="postType" name="postType" value="">
            <input type="hidden" name="donationId" value="<?=(isset($_GET['idStr'])?$_GET['idStr']:'')?>">
            <div class="form-group" style="text-align: center">
                <?php
                if(html::encode($detailData['enterState'])!='0'){
                    echo '<button type="submit" class="btn submit_btn btn-primary btn-size-medium">报名</button>';
                }else{
                    echo '<button type="submit" class="btn submit_btn btn-primary btn-size-medium" onclick="cancelSign()">取消报名</button>';
                }
                ?>
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
<script type="text/javascript" src="/content/js/pageScript/donation.js"></script>
<script>

</script>
<style>
    .form-group div{
        padding-top: 7px;
    }
</style>