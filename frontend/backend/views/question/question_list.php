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
<style type="text/css">
    .tab-outline { padding:5px 0; }
</style>
<?php
echo '<div class="tab-content-item tab-study-unit ly_main">
            <div class="tab-outline">
                <ul>';
if(!empty($data['result'])){
    foreach ($data['result'] as $data_k => $data_val){
//                        \common\models\MyFunction::sun_p($data_val);DIE;
        echo '<li class="study-unit-head ">
                                    <div class="unitName clearfix trace_25" data-trace="intro_dgdy">
                                        <div class="fl">
                                            <span class="unitCount">问卷调查</span>
                                            <i class="unitNumTotal"></i>
                                            <span>';if(!empty($data_val['publishName'])){echo html::encode($data_val['publishName']);}echo '</span>';
        echo '</div>';
        if($data_val['during']==0){ //调查问卷
            echo '<span class="fr trace_4 noPayBtn">已参加</span>';
        }else{
            echo '<span class="fr trace_4 noPayBtn" onClick="return fullWindow(\'/question/question_add?publishIdStr=' . html::encode($data_val['idStr']) . '&publishName='.html::encode($data_val['publishName']).'&publishRemark='.html::encode($data_val['publishRemark']).'\')" >在线调查</span>';
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
        echo '</li>
                                     </ul>';
        echo '</li>';
    }//foreach
}
else{
    echo '<li><h3 style="text-align: center;padding-top: 40px">暂无发布的问卷</h3></li>';
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

