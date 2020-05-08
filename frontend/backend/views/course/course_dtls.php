<?php
use yii\helpers\Html;
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$pre_username = $user_msginfo['name'];
$pre_userId = $user_msginfo['idStr'];
?>

<link href="/content/css/course/course_dtls.css" rel="stylesheet" type="text/css"/>
<link href="/content/css/course/site.css" rel="stylesheet" type="text/css"/>
<link href="/content/css/course/siteDetail.css" rel="stylesheet" type="text/css"/>
<input id="pre_username" type="hidden" value="<?= html::encode($pre_username) ?>"/>
<div class="header">
    <div class="h-md-center">
        <div class="h-md-logo">
            <div class="logo_tit">
                <p>在线学习</p>
            </div>
        </div>
        <div class="h-md-info">
            <ul>
                <li><span class="h-nav-title">欢迎您：<?= html::encode($pre_username) ?></span></li>
                <li><span class="h-nav-title line">|</span></li>
                <li><a class="h-nav-title tit" href="/course/study_online?curTab=0#在线学习">学习中心</a></li>
                <li class="h-nav-align">
                    <a class="h-nav-title" href="/newpersonal/personal#党群服务">
                        <img src="/content/images/user-lg.png" width="36" height="36" alt="">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="bg-grey2 pt20 pb10">
    <div class="c_container1200">
        <!--
            上方提示位置
         -->
        <div class="mb15">
            <a href="" class="link16">全部课程</a>
            <span class="ml8 mr5 text-lightgrey">&gt;</span>
            <?php
            if(!empty($dtlsData)){
                echo '<a href="/course/course_list?coursetypeId='.$dtlsData['studyInfo']['channelBraId'].'#在线学习" class="link16">';
                echo $dtlsData['studyInfo']['channelBraName'];
                echo '</a>';
            }
            ?>

            <span class="ml8 mr5 text-lightgrey">&gt;</span>
            <span class="text-lightgrey d-in-block ellipsis width300 pr top5"><?php if (!empty($dtlsData)) {echo html::encode($dtlsData['studyInfo']['name']);}?></span>
        </div>
        <!--
            课程图片
         -->
        <div class="clearfix row">
            <div class="col-sm-10 pr">
                <a class="pr">
                    <div class="image-scale">
                        <img width="490px" height="275px" id="" name="" src="<?php if (!empty($dtlsData)) {echo json_decode($dtlsData['studyInfo']['crlmPrc'], true)[0]['url'];}?>">
                    </div>
                </a>
            </div>
            <!--
                右侧课程信息
             -->
            <div class="col-sm-14 ph10">
                <div id="div_docName" class="font-size-24 text-black clearfix pl10 max-width700 ellipsis"><?php if (!empty($dtlsData)) {echo html::encode($dtlsData['studyInfo']['name']);}?><small>(<?php if (!empty($dtlsData)) {echo $dtlsData['stuNum'];}?>人已学)</small></div>
                <div class="clearfix">
                    <div class="product-info">
                        <dl class="td-color">
                            <dt class="td-type">类型：</dt>
                            <dd id="type" class="">
                                <span class="font-size-20 text-midgreen"><?php if (!empty($dtlsData)) {echo \common\models\commonEnum::getCrlmPty(html::encode($dtlsData['studyInfo']['crlmPty']));}?></span>
                            </dd>
                        </dl>
                        <dl class="td-mode clearfix">
                            <dt class="td-type">分数：</dt>
                            <dd class="sellbagbox pull-left">
									<span class="font-size-20 ">
											<?php if (!empty($dtlsData)) {echo html::encode($dtlsData['studyInfo']['points']);}?>分
									</span>
                            </dd>
                        </dl>
                        <dl class="td-amount">
                            <dt class="td-type">时间：</dt>
                            <dd class="">
                                <span class=" text-lightdark" id="createTime"><?php if (!empty($dtlsData)) {echo date("Y-m-d", html::encode($dtlsData['studyInfo']['createTime']));}?></span>
                            </dd>
                        </dl>
                        <div class="pl10 ">
                            <a href="/course/personage_stu_add?<?php if (!empty($dtlsData)) {echo 'crlmPty='. html::encode($dtlsData['studyInfo']['crlmPty']) .'&courseId='. $courseId .'&courseName='. $courseName .'&idStr='. $dtlsData['studyResources'][0]['idStr'];}?>#在线学习" class="btnsquar btn-bg-blue width150  font-size-20 text-center text-white td-buy">开始学习</a>
                            <!-- <a href="" class="btnsquar btn-lightoranger ml20 width150 font-size-20 text-center text-white mr5 freeview">下载视频</a>  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-white pb40">
    <div class="c_container c_container1200 new_yxt">
        <div class="clearfix">
            <div class="border-l2 bg-white mt10">
                <ul class="nav courselist_nav font-size-14 text-grey">
                    <li class="" id="desc">
                        <a href="javaScript:void(0);" onclick="tabShow('course_xiang')">
                            <span class="font-size-18">课程介绍</span>
                        </a>
                    </li>
                    <li class="active" id="commentlist">
                        <a href="javaScript:void(0);" onclick="tabShow('course_ping')">
                            <span class="font-size-18">学习心得</span>
                        </a>
                    </li>
                    <li class="" id="vediolist">
                        <a href="javaScript:void(0);" onclick="tabShow('vedio_ping')">
                            <span class="font-size-18">视频列表</span>
                        </a>
                    </li>
                </ul>

                <div class="clearfix online_date">
                    <div class="pull-left border-l2r fmr1 width849">
                        <div class="tab-content ">
                            <!-- 课程项 -->
                            <div class="tab-pane mt20 mt15" id="course_xiang">
                                <!-- 课程说明 -->
                                <span class="font-size-16 text-lightdark indent">积分说明：</span>
                                <span class="lh25 font-size-16 text-lightdark indent">课程必须学习完并答对全部题目才能获得积分</span>
                                <!-- 课程介绍 -->
                                <br>
                                <span class="font-size-16 text-lightdark indent ">课程简介：</span>
                                <span class="lh25 font-size-16 text-lightdark indent"><?php if (!empty($dtlsData)) { echo html::encode($dtlsData['studyInfo']['remark']); } ?></span>
                                <br>
                            </div>

                            <!-- 评论 -->
                            <div class="tab-pane active ph10" id="course_ping">
                                <div class="width760">
                                    <div id="dvComment">
                                        <p class="title font-size-16 mt10">
                                            <span class="ico-line mr10"></span>所有评论（共<span id="totalShow"><?php if(!empty($commentData)) { echo html::encode($commentData['counts']); } ?></span>条）
                                        </p>
                                        <div class="comment_content mt20">
                                            <div class="mar_l">
                                                <input class="form-control mt10" id="commTitle" placeholder="心得标题（不填默认为课程名称）">
                                            </div>
                                            <!--
                                                提交心得
                                             -->
                                            <input type="hidden" id="courseId" value="<?php echo(isset($courseId) ? html::encode($courseId) : '') ?>">
                                            <input type="hidden" id="courseName" value="<?php echo(isset($courseName) ? html::encode($courseName) : '') ?>">
                                            <div class="row">
                                                <div class="col-sm-2 mt10">
                                                    <span><img width="50" height="50" class="img-circle" src="/content/images/default_header.png">
                                                    </span>
                                                </div>
                                                <div class="col-sm-22">
                                                    <textarea class="form-control mt10" cols="20" id="commentBody" placeholder="我来说两句..." rows="5"></textarea>
                                                </div>
                                            </div>
                                            <p class="clearfix">
                                                <!--                                                <span class="col-sm-2">&nbsp;</span> <span class="text-lightdark font-size-13 color4 lh30"> <span>还可以输入<span id="maxInput" class="font-bold">200</span>个字-->
                                                <!--													</span></span>-->
                                                <button class="pull-right lh22 btn-primary btn-sm font-size-14 mt10 ph25" onclick="saveComment()" id="fb">发表</button>
                                            </p>
                                        </div>
                                        <div class="comment_box">
                                            <ol class="comment_list" id="comment_list">
                                                <?php
                                                if (!empty($commentData)){
                                                    foreach ($commentData['listStudyComment'] as $data_key => $data_val) {
                                                        echo '<div>
                                                            <li>
                                                                <div class="avatar">
                                                                    <img src="/content/images/default_header.png" height="40" width="40">
                                                                </div>
                                                                <div class="inner">
                                                                    <p><span>'. html::encode($data_val['userName']) .'</span><br>
                                                                        <span class="commTitle">'. html::encode($data_val['name']) .'</span>
                                                                        <span class="time">'. date("Y-m-d", html::encode($data_val['createDate'])) .'</span>
                                                                    </p>
                                                                    <div class="meta">
                                                                        <span class="blue">'. html::encode($data_val['content']) .'</span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </div>';
                                                    }
                                                }
                                                ?>
                                                <div id="page" class="text-center"></div>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 视频列表 -->
                            <div class="tab-pane mt20 ph10" id="vedio_ping">
                                <div class="clearfix" id="vedioList">
                                    <?php
                                    if (!empty($dtlsData)) {
                                        foreach ($dtlsData['studyResources'] as $data_key => $data_val) {
                                            echo '<a id="'.$data_key.'" href="/course/video_player?idStr='. html::encode($data_val['idStr']) .'&courseId='. html::encode($dtlsData['studyInfo']['idStr']) .'#在线学习" class="btnsquar btn-bg-white font-size-15">'. ($data_key+1) .'.'. html::encode(substr($data_val['name'], 0, strrpos($data_val['name'], "."))) .'</a>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- 右侧，打算用来下载课程-->
                    <div class="pull-right border-l2l ph15 width350">
                        <ul class="catalogue-ul catalogue-change font-size-12"></ul>
                        <div>
                            <div class="border-l2b lh25"><div class="font-size-16 border-bottom-blue width75">相关课程</div></div>
                            <!--相关课程列表-->
                            <ul class="slide-list" id="showLessonUL">
                                <?php
                                if (!empty($courseListData)) {
                                    foreach ($courseListData['data']['listStudyInfo'] as $data_key => $data_val) {
                                        echo '
                                            <li class="font-size-13 mt20 clearfix" id="showLessonLI" >
                                                <a href="/course/course_dtls?idStr='. html::encode($data_val['idStr']) .'&courseName='. html::encode($data_val['name']) .'#在线学习" target="_blank">
                                                    <img src="'.json_decode($data_val['crlmPrc'], true)['0']['url'].'" class="pull-left" width="130" height="73">
                                                </a>
                                                <div class="pull-left ml12 max-width175">
                                                    <a href="/course/course_dtls?idStr='. html::encode($data_val['idStr']) .'&courseName='. html::encode($data_val['name']) .'#在线学习" target="_blank" class="link1 two-line">'. html::encode($data_val['name']).'</a>
                                                    <p class="text-lightgrey lh30"><br>
                                                        发布时间：'. date('Y-m-d', html::encode($data_val['createTime'])) .'
                                                    </p>
                                                </div>
                                            </li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>

                        <!--<div align="right">
                            <a id="changeLesson" href="javaScript:void(0);" onclick="changeLesson()" style="font-size: 16px;">换一组</a>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/content/js/course/course_dtls.js" type="text/javascript"></script>
<script src="/content/js/course/course.js" type="text/javascript"></script>