<?php
namespace backend\controllers;
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['userName'];
$title="党建知识库";
echo "<script>document.title = \"".$title."\" </script>";
?>
<link href="/content/css/uncommon/answers.css?v=20181126" rel="stylesheet" type="text/css"/>
<script src="/content/js/uncommon/up.js" type="text/javascript"></script>
<script src="/content/js/uncommon/answer.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#ly_menu").hide();
    });
</script>
<style type="text/css">
    .one_btn{
        margin-top: -52px!important;
    }
    .two_btn{
        margin-top:0!important;
    }
    .dtls .padd{ vertical-align: middle;}
    .link span{ color:#e74d3d!important; font-weight: 700;}
    .answers_top{ background: #fff;}
    .bor_b { padding:5px 0;}
</style>
<!-- 头部标题 -->
<div class="answers_tit"  style="<?=isset($app)?($app!=0)?'display:none':'':''?>">
    <p>知识库问答</p>
</div>
<input type="hidden" class="search_params" name="topicType" id="topicType" value="<?php if(isset($_GET['topicType'])){echo $_GET['topicType'];}else{echo '';}?>"><!-- -->
<div id="answersd">
    <div class="container">
        <div class="uncommon answers_top tab"><!-- 手机端布局-->
            <div class="bor_b">
                <div class="dis_inline text-r fr_l">
                    <span class="notices">
                         <i class="fa fa-home"></i><a href="/answers/answers_list">首页</a>
                    </span>
                </div>
                <div class="fl_r personal">
                    <i class="dis_inline"></i>
                    <div class="dis_inline text-r" style="vertical-align: middle;">
                        <?php use common\models\commonEnum;
                        use common\models\MyFunction;
                        $session = \Yii::$app->session; ?>
                        <div><span><?php echo $userName; ?></span></div>
                        <div onclick="<?php if(isset($userName)){echo 'return logout();';}?>"><span class="font-out">退出登录</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 尾部、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、 -->
        <div class="common answers_bott container_col">
            <div class="row">
                <div class="col-sm-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <!--<li class="<?php /*if ($param['topicType'] == "30") {
                                echo 'active';
                            } */?>"><a data-toggle="tab" href="#tab-1"
                                     onclick="doType(this)" data-topic-type="30" aria-expanded="true">消息</a>
                            </li>-->
                           <!-- <li class="<?php /*if ($param['topicType'] == "20") {
                                echo 'active';
                            } */?>"><a data-toggle="tab" href="#tab-1"
                                     onclick="doType(this)" data-topic-type="20" aria-expanded="true">回答</a>
                            </li>-->
                            <li class="<?php if ($param['topicType'] == "40") {
                                echo 'active';
                            } ?>"><a data-toggle="tab" href="#tab-1"
                                     onclick="doType(this)" data-topic-type="40" aria-expanded="true">我的提问</a>
                            </li>
                            <li class="<?php if ($param['topicType'] == "1000") {
                                echo 'active';
                            } ?>"><a data-toggle="tab" href="#tab-1"
                                     onclick="doType(this)" data-topic-type="1000" aria-expanded="true">我的关注</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <ul class="attentionlist">
                                        <?php if (!empty($data['data']['answersNotificationList'])) {
//                                            MyFunction::sun_p($data['data']['answersNotificationList']);DIE;
                                            foreach ($data['data']['answersNotificationList'] as $data_i => $data_val) {
                                                echo '<li class="link" onclick="gotoDetails(\'' . $data_val['topicIdStr'] . '\',\'' . $data_val['idStr'] . '\',\'' . $data_val['url'] . '\',\'' . $data_val['level'] . '\')">
                                                 <p>' . $data_val['contents'] . ' </p>
                                                 <p>' . date("Y-m-d H:i", $data_val['createDate']) . ' </p>
                                                </li>';
                                            }
                                        }else if (!empty($data['data']['listAnswersTopic'])) {
//                                            MyFunction::sun_p($data['data']['listAnswersTopic']);DIE;
                                            foreach ($data['data']['listAnswersTopic'] as $data_i => $data_val) {
                                                echo '<li style="border-bottom: 0;" id="' . $data_val['idStr'] . '" name="" class="isDetails" data-topic-id="' . $data_val['idStr'] . '">';
                                                if (strlen($data_val['img']) > 0) {
                                                    echo '<img src="' . $data_val['img'] . '" style="height: 50px;width: 80px;">';
                                                }
                                                echo '<a id=' . $data_val['idStr'] . ' onclick="isDetails(\'' . $data_val['idStr'] . '\')" data-topic-id="' . $data_val['idStr'] . '" href="javascript:void(0);" class="dis_inline"><b class="tit">' . $data_val['title'] . '</b><b
                                                        class="tit_2">' . $data_val['contentsTitle'] . '</b>
                                                <b class="tit_3"><i class="fa fa-tags"></i>' . $data_val['topicKeyName'] . '</b></a>
                                            <span class="dis_inline tit_4">' . $data_val['ansNum'] . '个回答 | ' . date("Y-m-d H:i", $data_val['createDate']) . '发布</span>
                                        </li>';
                                                echo '<li style="padding:0;"><button class="aui-btn aui-btn-account one_btn" onclick="cancelAttention(this)" data-topic-id="' . $data_val['idStr'] . '">取消关注</button></li>';
                                            }
                                        } else if (!empty($data['data']['notifications'])) {
//                                            MyFunction::sun_p($data['data']['notifications']);DIE;
                                            foreach ($data['data']['notifications'] as $data_i => $data_val) {
                                                $typeName = commonEnum::getAnsType($data_val['answersTopic']['type']);
                                                echo '<li>';
                                                if(!empty($data_val['answersTopic']['img'])){
                                                    if (strlen($data_val['answersTopic']['img']) > 0) {
                                                        echo '<img src="' . $data_val['answersTopic']['img'] . '" style="height: 50px;width: 80px;">';
                                                    }
                                                }
                                                echo '<div id="' . $data_val['answersTopic']['idStr'] . '" name="' . $data_val['idStr'] . '" data-topic-id="' . $data_val['answersTopic']['idStr'] . '" class="isDetails">
                                                    <b class="tit">' . $data_val['answersTopic']['title'] . '</b>
                                                    <b class="tit_2">' .(!empty($data_val['answersTopic']['contentsTitle'])?$data_val['answersTopic']['contentsTitle']:''). '</b>
                                                    <b class="tit_3"><i class="fa fa-tags"></i>' .(!empty($data_val['answersTopic']['topicKeyName'])?$data_val['answersTopic']['topicKeyName']:''). '</b>
                                                </div>
                                                <span class="dis_inline tit_4">' . (!empty($data_val['answersTopic']['ansNum'])?$data_val['answersTopic']['ansNum']:'0') . '个回答 | ' . date("Y-m-d H:i", $data_val['answersTopic']['createDate']) . '发布</span>
                                                <button class="btn btn-outline btn-primary">'.$typeName.'</button>';
                                                echo '</li>';
                                            }
                                        }
                                        ?>
                                        <?php if(empty($data['data']['answersNotificationList'])&&empty($data['data']['listAnswersTopic'])&&empty($data['data']['notifications'])){
                                            echo '<div class="nodata">
                                                <p><img src="/content/images/nodata.png"></p><p>暂无数据</p>
                                            </div>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require(__DIR__ . '/../layouts/pageNumbers.php'); ?>
            </div>

        </div>
        <!-- 分页 -->
    </div>
</div>
