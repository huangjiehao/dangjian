<?php
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['name'];
$userId = $user_msginfo['idStr'];
$userLevel = $user_msginfo['userLevel'];
use yii\helpers\Html;
?>
<link href="/content/css/uncommon/personal.css" rel="stylesheet" type="text/css"/>
<script src="/content/js/personal/pc.js" type="text/javascript"></script>
<script src="/content/js/personal/personal.js" type="text/javascript"></script>
<link href="/content/css/uncommon/exam.css" rel="stylesheet" type="text/css"/>
<?php
echo '<div class="tab-content-item tab-study-unit ly_main">
            <div class="tab-outline">
                <div class="lessonTypeItems">
                    <a class="trace_24 lessonTypeItem ';if($_GET['state']==0){echo 'lessonTypeItemActive';} echo'" href="/personal/exam_list?idStr='.html::encode($userId).'&state=0#grzx" data-lesson-type="0">未考</a>
                    <a class="trace_24 lessonTypeItem ';if($_GET['state']==1){echo 'lessonTypeItemActive';} echo'" href="/personal/exam_list?idStr='.html::encode($userId).'&state=1#grzx" data-lesson-type="1">已考</a>
                    <a class="trace_24 lessonTypeItem ';if($_GET['state']==2){echo 'lessonTypeItemActive';} echo'" href="/personal/exam_list?idStr='.html::encode($userId).'&state=2#grzx" data-lesson-type="2">重考</a>
                </div>
                <ul>';
if(!empty($rstData)){
    foreach ($rstData['result'] as $data_k => $data_val){
        if($data_val['state'] == $_GET['state']){
            echo '<li class="study-unit-head ">
                                    <div class="unitName clearfix trace_25" data-trace="intro_dgdy">
                                        <div class="fl">
                                            <span class="unitCount">试卷试题</span>
                                            <i class="unitNumTotal"></i>
                                            <span>';if(!empty($data_val['publishName'])){echo html::encode($data_val['publishName']);}echo '</span>
                                            <span class="freeUnitFlag">';if($data_val['state']==0){echo '未考';}else if($data_val['state']==1){echo '已考';}else{echo '重考';}echo'</span>';
                                            echo '</div>';
                                            if($_GET['state']==1){
                                                echo '<span class="fr trace_4 noPayBtn" onClick="return fullWindow(\'/personal/exam_dtls?state='.$_GET['state'].'&onlineExamScoreId='.html::encode($data_val['onlineExamScoreId']).'&publishIdStr=' . html::encode($data_val['publishIdStr']) . '&publishName='.html::encode($data_val['publishName']).'&publishRemark=&duration='.html::encode($data_val['duration']).'\')" >查看结果</span>';
                                            }else{
                                                if($_GET['state']!=1){
                                                    echo '<span class="fr trace_4 noPayBtn" onClick="return fullWindow(\'/personal/exam_question?state='.$_GET['state'].'&publishIdStr=' . html::encode($data_val['publishIdStr']) . '&publishName='.html::encode($data_val['publishName']).'&publishRemark='.html::encode($data_val['publishRemark']).'&duration='.html::encode($data_val['duration']).'\')" >在线考试</span>';
                                                }
                                            }
                                            echo '</div>';
                                            echo '<ul class="subList">
                                            <li class="clearfix lesson-item item" data-is-free="1">
                                                <a href="javascript:void(0);" target="_blank">
                                                    <div class="fl">
                                                        <i class="lessonIconActive"></i>
                                                        <span>开始时间</span>：<span>';if(!empty($data_val['beginTime'])){echo date("Y-m-d H:i:s", html::encode($data_val['beginTime']));}echo '</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0);" target="_blank">
                                                    <div class="fl">
                                                        <i class="lessonIconActive"></i>
                                                        <span>结束时间</span>：<span>';if(!empty($data_val['endTime'])){echo date("Y-m-d H:i:s", html::encode($data_val['endTime']));}echo '</span>
                                                    </div>
                                                </a>';
                                                if($_GET['state']!=1) {
                                                    echo '<a href="javascript:void(0);" target="_blank">
                                                        <div class="fl">
                                                            <i class="lessonIconActive"></i>
                                                            <span>重考次数</span>：<span>' . html::encode($data_val['reExamTimes']) . '</span>
                                                        </div>
                                                    </a>';
                                                }
                                                if($_GET['state']==1) {
                                                    echo '<a href="javascript:void(0);" target="_blank">
                                                        <div class="fl">
                                                            <i class="lessonIconActive"></i>
                                                            <span>得分</span>：<span>' . html::encode($data_val['score']) . '</span>
                                                        </div>
                                                    </a>';
                                                }
                                                echo '<a href="javascript:void(0);" target="_blank">
                                                    <div class="fl">
                                                        <i class="lessonIconActive"></i>
                                                        <span>考试时长</span>：<span>'. html::encode($data_val['duration']).'</span><span>分钟</span>
                                                    </div>';
                                                echo '</a>
                                            </li>
                                        </ul>';
                                    echo '</li>';
                                }

    }//foreach
}

echo '</ul>
            </div>';
echo '</div>
    </div >';
?>
<script>
    function fullWindow(url) {
        if (!url) {
            return;
        }
        var width = screen.availWidth;
        var height = screen.availHeight;
        yy(url, width, height);
    }
    function yy(url, width, height) {
        if (!url) {
            return;
        }
        var redirectUrl = url;
        var szFeatures = "top=" + ((screen.availHeight - height ) ) + ",";
        szFeatures += "left=" + ((screen.availWidth - width)) + ",";
        szFeatures += "width=" + width + ",";
        szFeatures += "height=" + (height - 70) + ",";
        szFeatures += "resizable=no,edge:Raised,titlebar=no,directories=no,";
        szFeatures += "status=yes,toolbar=no,location=no,";
        szFeatures += "menubar=no,";
        szFeatures += "scrollbars=yes,";
        szFeatures += "resizable=no";
        window.open(redirectUrl, "", szFeatures);
    }

</script>

