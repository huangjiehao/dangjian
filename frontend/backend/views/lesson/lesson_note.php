<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/19
 * Time: 16:26
 */
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['name'];
$userId = $user_msginfo['idStr'];
?>
<!-- 所有学习笔记 -->
<link href="/content/css/uncommon/study.css" rel="stylesheet">
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
                    <a class="h-nav-title" href="/newpersonal/personal#党群服务" >
                        <img src="/content/images/user-lg.png" width="36" height="36" alt="">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="container ng-scope" ng-app="userApp">
    <div class="wrapper">
        <?php require(__DIR__ . '/../layouts/menu_course_left.php'); ?>
        <div class="mod-fr plan">
            <div class="plan-bd ng-scope" ng-controller="ListController">
                <div class="tasks-hd">

                    <h4 class="task-hd-info">全部&nbsp;<span ng-bind="model.totalCount" class="ng-binding"><?=((isset($noteData['data']['listStuNote'])&&!empty($noteData['data']['listStuNote']))?count($noteData['data']['listStuNote']):0)?></span>&nbsp;个笔记</h4>


                </div>

                <form id="dataForm">
                    <div class="tasks-bd">
                        <div class="dis-wrap">
                            <?php
                            if (!empty($noteData)) {
                                foreach ($noteData['data']['listStuNote'] as $data_key => $data_val) {
                                    echo '
                                <div class="dis-items" id="noteList">
                                <div id="tmpl" class="dis-item ng-scope" style="">
                                    <div class="dis-item-main ng-scope">
                                        <span class="dis-item-intro ng-binding">
                                            <a style="color:blue" target="_blank" href="">'. $data_val['name'] .'</a>
                                        </span><br>
                                        <span class="dis-item-intro ng-binding">'. $data_val['content'] .'</span>
                                        <div class="dis-item-extra">
                                            <ul class="item-extra-list">
                                                <li class="ng-binding">'. date('Y年m月d日', $data_val['createDate']) .'</li> 
                                                <a href="/lesson/lesson_new_note?edit=edit&idStr='. $data_val['idStr'] .'" target="_Blank">修改</a> &nbsp;&nbsp;&nbsp;
                                                <a href="/lesson/lesson_note_remove?idStr='.$data_val['idStr'].'">删除</a>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                                }
                            }
                            ?>

                        </div>
                    </div>
                </form>

                <div id="page"></div>
                <!--
                	暂无笔记
                 -->
                <p id="noFound" class="notfound ng-hide" style="display: none;">
                    <img alt="" src="notask.png" style="display: block;">
                    暂无笔记
                </p>

            </div>
        </div>
    </div>
</div>
