<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/19
 * Time: 16:27
 */
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['name'];
$userId = $user_msginfo['idStr'];
?>
<link href="/content/css/uncommon/study.css" rel="stylesheet">
<script type="text/javascript" src="/content/js/uncommon/page_add.js?v=2"></script>
<style>
    .edui-editor.edui-default{width:100%!important;}
    .edui-default .edui-editor{ background: transparent!important; }
</style>
<!--头部-->
<input id="pre_username" type="hidden" value="<?=$userName ?>"/>
<div class="header">
    <div class="h-md-center">
        <div class="h-md-logo">
            <div class="logo_tit">
                <p>学习中心</p>
            </div>
        </div>
        <div class="h-md-info">
            <ul>
                <li><span class="h-nav-title">欢迎您：<?=$userName ?></span></li>
                <li><span class="h-nav-title line">|</span></li>
                <li><a class="h-nav-title tit" href="/course/course_list#在线学习">课程列表</a></li>
                <li class="h-nav-align">
                    <a class="h-nav-title" href="/newpersonal/personal#党群服务">
                        <img src="/content/images/user-lg.png" width="36" height="36" alt="">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="ng-scope" ng-app="userApp">
    <div class="wrapper">
        <?php require(__DIR__ . '/../layouts/menu_course_left.php'); ?>
        <form id="newsFormId" class="form_sumbit form-horizontal" role="form" enctype="multipart/form-data" method="post"
              action="/lesson/note_submit">
            <div class="mod-fr plan">
                <div class="tasks-hd hd">
                    <h4 class="task-hd-info ng-binding"><span class="ng-binding" id="totalLesson"><?php if (!empty($noteDtlsData)) {echo '修改笔记';}else{echo '新建笔记';}?></span></h4><br>
                </div>
                <div class="form-group">
                    <label class="col-sm-12 fs-14">标题：</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="请输入" name="tilte"
                               value="<?php if (!empty($noteDtlsData)) {
                                   echo $noteDtlsData['stuNote']['name'];
                               } ?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-12 fs-14">正文：</label>
                    <div class="col-sm-12">
                        <textarea id="content" class="" name="content"><?php if(!empty($noteDtlsData)){echo$noteDtlsData['stuNote']['content']; }?></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
            <input type="hidden" name="idStr" value="<?=(isset($_GET['idStr'])?$_GET['idStr']:'')?>">
            <input type="hidden" name="edit" value="<?=(isset($_GET['edit'])?$_GET['edit']:'')?>">
        </form>
    </div>
</div>
<!-- 新建课程笔记 -->

<script src="/content/plugins/ueditor/ueditor.config.js" type="text/javascript"></script>
<script src="/content/plugins/ueditor/ueditor.all.min.js" type="text/javascript"></script>
<script type="text/javascript">

    UE.getEditor('content',{initialFrameWidth:800,initialFrameHeight:200})
</script>
