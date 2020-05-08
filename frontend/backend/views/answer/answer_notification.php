<?php
use common\models\commonEnum;
$session = \Yii::$app->session;
$user_local = json_decode($session->get('user_local'), true);
$userId = $user_local['idStr'];
$userName = $user_local['name'];
$orgName = $user_local['orgName'];


$title="智慧党建知识库消息";
echo "<script>document.title = \"".$title."\" </script>";
?>
<link href="/content/css/uncommon/module.css?v=20181126" rel="stylesheet" type="text/css"/>
<script src="/content/js/uncommon/up.js" type="text/javascript"></script>
<script src="/content/js/uncommon/answer.js" type="text/javascript"></script>
<script src="/content/js/uploadfiles/upload.single.js" type="text/javascript"></script>
<script src="/content/js/uploadfiles/upload.js" type="text/javascript"></script>
<input type="hidden" class="search_params" name="topicType" id="topicType" value="<?php if(isset($_GET['topicType'])){echo $_GET['topicType'];}else{echo '';}?>"><!-- -->
<!-- pc端 -->
<div class="pc">
    <div class="container"><!-- 内容展示 -->
        <div class="common min_h">
            <div class="news_top">
                <ul id="tab" class="answer">
                    <li class="<?php if ($param['topicType'] == "0") {
                        echo 'active';
                    } ?>" onclick="doType(this)" data-topic-type="0"><a data-toggle="tab" href="#tab-1" aria-expanded="true">我的消息<?php ?></a>
                    </li>
                    <li class="<?php if ($param['topicType'] == "1") {//40
                        echo 'active';
                    } ?>" onclick="doType(this)" data-topic-type="1"><a data-toggle="tab" href="#tab-1" aria-expanded="true">我的提问</a>
                    </li>
                    <li class="<?php if ($param['topicType'] == "2") {//1000
                        echo 'active';
                    } ?>" onclick="doType(this)" data-topic-type="2"><a data-toggle="tab" href="#tab-1" aria-expanded="true">我的关注</a>
                    </li>
                    <ul class="personal fl_r" >
                        <?php if(!empty($userName)){
                            echo '<li>欢迎您，'.$userName.' <img src="/content/img/tou.png"/></li>
                        <li onclick="return logout();">
                            <i class="logout">
                            <img src="/content/img/close.png"></i>退出登录
                        </li>';
                        }
                        ?>
                        <li onclick="javascript:window.location.href='/answer/answer_list'"><i class="main"><img src="/content/img/back_main.png"></i>返回列表</li>
                    </ul>
                </ul>


                <div class="tab_list_answer">
                    <ul class="attentionlistdd">

                        <?php if($_GET['topicType']==0){
                            if(isset($data['notifications'])){
                                if (!empty($data['notifications'])) {
                                    foreach ($data['notifications'] as $data_i => $data_val) {
                                        echo '<li class="link" onclick="gotoDetails(\'' . $data_val['topicIdStr'] . '\',\'' . $data_val['idStr'] . '\',\'' . $data_val['url'] . '\',\'' . $data_val['level'] . '\')">
                                    <p>' . $data_val['contents'] . ' </p>
                                    <p>' . date("Y-m-d H:i", $data_val['createDate']) . ' </p>
                                </li>';
                                    }
                                }
                            }else{
                                echo '<div class="nodata">
                                <p><img src="/content/images/nodata.png"></p><p>暂无数据</p>
                            </div>';
                            }
                        }else if(isset($data['listAnswersTopic'])) {
                            if (!empty($data['listAnswersTopic'])) {
                                foreach ($data['listAnswersTopic'] as $data_i => $data_val) {
                                    $typeName = commonEnum::getAnsType($data_val['type']);
                                    echo '<li id="' . $data_val['idStr'] . '" name="" class="isDetails" data-topic-id="' . $data_val['idStr'] . '">';
                                    if (strlen($data_val['img']) > 0) {
                                        echo '<img src="' . $data_val['img'] . '" style="height: 50px;width: 80px;">';
                                    }
                                    echo '<a id=' . $data_val['idStr'] . ' onclick="isDetails(\'' . $data_val['idStr'] . '\')" data-topic-id="' . $data_val['idStr'] . '" href="javascript:void(0);" class="dis_inline"><b class="tit">' . $data_val['title'] . '</b><b
                                                        class="tit_2">' . $data_val['contentsTitle'] . '</b>
                                                <b class="tit_3"><i><img src="/content/img/tab.png"/> </i>' . $data_val['topicKeyName'] . '</b>';
                                    echo '</a>
                                            <span class="dis_inline tit_4">' . $data_val['ansNum'] . '个回答 | ' . date("Y-m-d H:i", $data_val['createDate']) . '发布</span>
                                        </li>';
                                    if ($_GET['topicType'] == 1) {
                                        echo '<button class="btt_show">' . $typeName . '</button>';
                                    }
                                    if ($_GET['topicType'] == 2) {
                                        echo '<button class="btn btn-danger one_btn" onclick="cancelAttention(this)" data-topic-id="' . $data_val['idStr'] . '">取消关注</button>';
                                    }

                                }
                            }else{
                                echo '<div class="nodata">
                                <p><img src="/content/images/nodata.png"></p><p>暂无数据</p>
                            </div>';
                            }

                        }
                        ?>
                        <?php require(__DIR__ . '/../layouts/pageNumbers.php'); ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div><!-- pc -->
<style type="text/css">
    .fl_r{ float: right; font-size: 12px!important; margin-bottom: 0; line-height: 42px; }
    .fl_r li{ font-size: 14px!important; }
    .personal li:hover{ border: 0!important;color: #333!important;}
</style>


