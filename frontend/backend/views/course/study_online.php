<?php
use yii\helpers\Html;
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['name'];
$userId = $user_msginfo['idStr'];
?>

<link href="/content/css/uncommon/study.css" rel="stylesheet">
<!--头部-->
<div class="header show-web hide-mobile">
    <div class="h-md-logo">
        <div class="wrapper clearfix">
            <h1>
                <img src="/content/images/online.png" height="40" title="在线学习">学习中心
            </h1>
            <div class="hd-fr">
                <div class="u-nav" id="J_User">
                    <a class="u-nav-hd" href="/newpersonal/personal#personal"> <img src="/content/images/user-lg.png" width="36" height="36" alt="">
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

<!-- 中间内容区域 -->
<div class="container">
    <div class="wrapper">
        <?php require(__DIR__ . '/../layouts/menu_course_left.php'); ?>
        <div class="course-fr plan">
            <div class="plan-hd">
                <div class="plan-info">
                    <h3>
                        我的积分
                    </h3>
                    <div class="plan-info-bd">
                        <p class="plan-info-desc">在线学习平台个人积分</p>
                        <div class="plan-info-proc">
                            <p class="plan-info-proc-hd">
                                必学：获取积分：<em id="score1"><?php echo html::encode($resultData['stuMust']);?></em>分&nbsp;&nbsp;&nbsp;&nbsp;
                                总分：<em id=""><?php echo html::encode($resultData['stuMustSum']);?></em>分
                            </p>
                            <div class="plan-info-proc-bd">
                                <p class="plan-info-proc-line">
                                    <em style="width: <?php echo html::encode(round($resultData['stuMust']/$resultData['stuMustSum']*100, 2));?>%;"></em>
                                </p>
                                <span class="plan-info-proc-txt">
                                    <?php if($resultData['stuMustSum'] != 0){
                                        echo html::encode(round($resultData['stuMust'] / $resultData['stuMustSum'] * 100, 2));echo '%';
                                    }else{
                                        echo '<em style="width:0%;"></em>';
                                    }?>
                                    <i class="arrow-left"></i>
                                </span>
                            </div>
                        </div>
                        <div class="plan-info-proc">
                            <p class="plan-info-proc-hd">
                                选学：获得积分：<em id="score2"><?php echo html::encode($resultData['stuChoice']);?></em>分&nbsp;&nbsp;&nbsp;&nbsp;
                                总分：<em id=""><?php echo $resultData['stuChoiceSum'];?></em>分
                            </p>
                            <div class="plan-info-proc-bd">
                                <p class="plan-info-proc-line">
                                    <?php if($resultData['stuChoiceSum'] != 0){
                                        echo '<em style="width: '.html::encode(round($resultData['stuChoice']/$resultData['stuChoiceSum']*100, 2)).'%;"></em>';
                                    }else{
                                        echo '<em style="width:0%;"></em>';
                                    }
                                    ?>
                                </p>
                                <span class="plan-info-proc-txt">
                                    <?php if($resultData['stuChoiceSum'] != 0) {
                                        echo html::encode(round($resultData['stuChoice'] / $resultData['stuChoiceSum'] * 100, 2));echo '%';
                                    }else{
                                        echo '0%';
                                    }
                                    ?>
                                    <i class="arrow-left"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--
                    小提示：用户有多少个必学课程需要学
                 -->
                <!--                <div class="plan-alert">-->
                <!--                    <span class="plan-alert-tip">小贴士 </span>-->
                <!--                    <p>您还有<span style="font-size: 17px;font-weight: bolder;">15</span>门必学课程，请抓紧学习，并持续关注新的学习任务。</p>-->
                <!--                </div>-->

            </div>
            <div class="plan-bd">
                <div class="tasks-hd">
                    <h4>最新的学习任务</h4>
                </div>
                <div class="tasks-bd">
                    <div class="task-list">
                        <!--
                            最新任务列表（只查询前三条）
                         -->
                        <?php
                        if (!empty($resultData)) {
                            foreach ($resultData['listStudyInfo'] as $data_key => $data_val) {
//                                    \common\models\MyFunction::sun_p($data_val);die;
                                echo '<div class="task-list-item"  onclick="window.open(\'/course/course_dtls?idStr='. html::encode($data_val['idStr']) .'&courseName='. html::encode($data_val['name']). '\')">
                                        <div class="mod-fl">
                                            <div class="mod-fl-pic">
                                                <a><img alt="" src="'. json_decode($data_val['crlmPrc'], true)[0]['url'] .'"></a>
                                            </div>
                                            <div class="mod-fl-info">
                                                <a class="list-item-title">'. html::encode($data_val['name']) .'</a>';
                                                if(strtotime ("now") - $data_val['createTime'] < 1209600){ //60*60*24*7*2 小于两周默认为新
                                                    echo '<span style="background: red;color: white;margin-left: 3px;padding: 2px;padding-left: 3px;">新</span>';
                                                }
                                                echo '<div class="list-item-desc major">
                                                    <span class="item-tag">'. \common\models\commonEnum::getCrlmPty($data_val['crlmPty']) .'</span>
                                                    <p style="width: 280px;margin-top: 40px;">
                                                        发布时间：'. date('Y年m月d日', html::encode($data_val['createTime'])) .'
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mod-fr" style="margin-top: 15px;">
                                            <div class="list-item-hour">
                                                <b>'. html::encode($data_val['points']) .'</b>
                                                <p>学分</p>
                                            </div>
                                        </div>
                                    </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- 暂无学习任务 -->
        <div class="notask" style="display: none; float: right; width: 760px;">
            <div class="notask-hd">
                <i class="ico-notask"></i>
                <h4>暂无学习任务</h4>
            </div>
        </div>
        <!--
            积分栏目
        -->
    </div>
</div>
<div style="display: none; position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; cursor: move; opacity: 0; background: rgb(255, 255, 255);"></div>

