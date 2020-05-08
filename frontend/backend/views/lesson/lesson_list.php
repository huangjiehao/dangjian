<?php
use yii\helpers\Html;
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['name'];
$userId = $user_msginfo['idStr'];
?>
<link href="/content/css/uncommon/study.css" rel="stylesheet">
<script>
   /* $(function(){//查询全部(进行中)
        var type = "";
        type!="" ? changePage("1",type) : changePage("1","");
    });*/

    /*改变状态*/
    function showParent(json){
        $("#parent").val(json.docType);
        $("#myLesson li").each(function(){
            $(this).removeClass("active");
        });
        $("#"+json.id).addClass("active");
        $("#child1").addClass("active");
        $("#child2").removeClass("active");
        //获取分页
        /*changePage("1",json.docType);*/
    }
</script>
<!--头部-->
<div class="header show-web hide-mobile">
    <div class="h-md-logo">
        <div class="wrapper clearfix">
            <h1>
                <img src="/content/images/logo_online.png" height="40" title="学习中心">学习中心
            </h1>
            <div class="hd-fr">
                <div class="u-nav" id="J_User">
                    <a class="u-nav-hd" href="/newpersonal/personal#grzx"> <img src="/content/images/user-lg.png" width="36" height="36" alt="">
                    </a>

                </div>
                <ul class="h-nav">
                    <li>
                        <span class="h-nav-title">欢迎您：<?=html::encode($userName) ?></span>
                    </li>
                    <li>
                        <span class="h-nav-title" style="color: #d2d2d3;margin-left: 5px;">|</span>
                    </li>
                    <li>
                        <a href="/course/course_list#在线学习" class="h-nav-title" style="margin-left: 5px;">课程列表</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container ng-scope" ng-app="userApp">
    <div class="wrapper">
        <?php require(__DIR__ . '/../layouts/menu_course_left.php'); ?>
        <div class="mod-fr plan">
            <div class="course-mod ng-scope" ng-controller="ListController">
                <div class="tasks-hd hd">
                    <h4 class="task-hd-info ng-binding">
                        全部&nbsp;<span class="ng-binding" id="totalLesson"><?php if(!empty($courseData)) {echo html::encode(sizeof($courseData['data']['listStudyInfo']));}?></span>&nbsp;个课程
                    </h4>

                </div>
                <!--课程列表-->
                <div class="course-mod-bd clearfix">
                    <div class="course-list ng-scope" id="lessonList">
                        <?php
                        if(!empty($courseData)) {
                            foreach ($courseData['data']['listStudyInfo'] as $data_key => $data_val) {
                                echo '<div class="course-item" onClick="window.open(\'/course/course_dtls?idStr='. html::encode($data_val['idStr']) .'&courseName='. html::encode($data_val['name']).'\')">
                                        <a href="/course/course_dtls?idStr='. html::encode($data_val['idStr']) .'&courseName='. html::encode($data_val['name']).'" class="course-item-hd" target="_blank"> 
                                            <img src="'. json_decode($data_val['crlmPrc'], true)[0]['url'] .'" width="153" height="100">
                                        </a>
                                        <div class="course-item-bd">
                                            <h3><a href="/course/course_dtls?idStr='. html::encode($data_val['idStr']) .'&courseName='. html::encode($data_val['name']).'" target="_blank" class="ng-binding" style="margin-top: 10px;">'. html::encode($data_val['name']) .'</a></h3>
                                            <div class="course-item-rate clearfix">
                                            </div>
                                            <p class="course-item-info" style="margin-top: 10px;">
                                                    <em class="ng-binding" style="color: rgb(227, 62, 43);">'. \common\models\commonEnum::getCrlmPty($data_val['crlmPty']) .'</em><span>-------</span>
                                                    <em class="ng-binding">'. html::encode($data_val['points']) .'</em>学分(已学<b style="color: #e54a38">'. html::encode($data_val['myPoints']) .'</b>分)
                                                </p>
                                        </div>
                                    </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <p id="notFound" class="notfound" style="display: none;">暂无课程 </p>
                <div id="page" style="text-align: center; display: block;"></div>
            </div>
        </div>
    </div>
</div>

