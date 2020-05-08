<?php
use common\models\commonEnum;
$session = \Yii::$app->session;
$user_local = json_decode($session->get('user_local'), true);
$userId = $user_local['idStr'];
$userName = $user_local['name'];
$orgName = $user_local['orgName'];

$title="智慧党建知识库问答";
echo "<script>document.title = \"".$title."\" </script>";
?>
<link href="/content/css/uncommon/module_app.css?v=20181126" rel="stylesheet" type="text/css"/>
<script src="/content/js/uncommon/up.js" type="text/javascript"></script>
<script src="/content/js/uncommon/answer.js" type="text/javascript"></script>
<script src="/content/js/uploadfiles/upload.single.js" type="text/javascript"></script>
<script src="/content/js/uploadfiles/upload.js" type="text/javascript"></script>
<input type="hidden" class="search_params" name="topicType" id="topicType" value="<?php if(isset($_GET['topicType'])){echo $_GET['topicType'];}else{echo '';}?>"><!-- -->
<!-- _________________________________________________-->
<!-- 手机端 -->
<style>
    .tab_list_answer.nof li{
        margin: 0;
        border-bottom: 1px dotted #ddd;
    }
    .tab_list_answer p{ margin-bottom: 1em!important; padding:1em 0;}
    .tab_list_answer p button{ width: 90px;}
</style>
<div id="mar_bf">
    <div class="module_tit">
        <div class="container">
            <p>党建知识库消息</p>
        </div>
    </div>
    <div class="container"><!-- 内容展示 -->
        <div class="app_bg">
            <div class="aui-scrollView">
                <div class="aui-item-ofl b-line">
                    <ul class="tab-nav">
                        <li class="tab-nav-item <?php if ($param['topicType'] == "0") {
                            echo 'tab-active';
                        } ?>" onclick="doType(this)" data-topic-type="0"><a data-toggle="tab" href="#tab-1" aria-expanded="true">我的消息</a>
                        </li>
                        <li class="tab-nav-item <?php if ($param['topicType'] == "1") {//40
                            echo 'tab-active';
                        } ?>" onclick="doType(this)" data-topic-type="1"><a data-toggle="tab" href="#tab-1" aria-expanded="true">我的提问</a>
                        </li>
                        <li class="tab-nav-item <?php if ($param['topicType'] == "2") {//1000
                            echo 'tab-active';
                        } ?>" onclick="doType(this)" data-topic-type="2"><a data-toggle="tab" href="#tab-1" aria-expanded="true">我的关注</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="common con_pb">
            <div class="news_top">
                <ul class="tab_list_answer nof">
                    <?php if($_GET['topicType']==0){
                        if(isset($data['notifications'])){
                            if (!empty($data['notifications'])) {
                                foreach ($data['notifications'] as $data_i => $data_val) {
                                    echo '<li class="link" onclick="gotoDetails(\'' . $data_val['topicIdStr'] . '\',\'' . $data_val['idStr'] . '\',\'' . $data_val['url'] . '\',\'' . $data_val['level'] . '\')">
                                    <p style="margin: 0!important;">' . $data_val['contents'] . ' </p>
                                    ' . date("Y-m-d H:i", $data_val['createDate']) . '
                                </li>';
                                }
                            }
                        } else{
                            echo '<div class="nodata">
                                <p><img src="/content/images/nodata.png"></p><p>暂无数据</p>
                            </div>';
                        }
                    }else if(isset($data['listAnswersTopic'])&& $_GET['topicType']==1 || $_GET['topicType']==2) {
                        if(!empty($data['listAnswersTopic'])){
                            foreach ($data['listAnswersTopic'] as $data_i => $data_val) {
//                                    \common\models\MyFunction::sun_p($data_val);DIE;
                                $typeName = commonEnum::getAnsType($data_val['type']);
                                echo '<li id="' . $data_val['idStr'] . '" name="" class="isDetails" data-topic-id="' . $data_val['idStr'] . '">';
                                if (strlen($data_val['img']) > 0) {
                                    echo '<img src="' . $data_val['img'] . '" style="height: 50px;width: 80px;">';
                                }
                                echo '<a id=' . $data_val['idStr'] . ' onclick="isDetails(\'' . $data_val['idStr'] . '\')" data-topic-id="' . $data_val['idStr'] . '" href="javascript:void(0);" class="dis_inline">
                                    <b class="tit">' . $data_val['title'] . '</b>
                                    <b class="tit_3"><i><img src="/content/img/tab.png"/> </i>' . $data_val['topicKeyName'] . '</b>';
                                echo '</a>
                                            <span class="dis_inline tit_4">' . $data_val['ansNum'] . '个回答 | ' . date("Y-m-d H:i", $data_val['createDate']) . '发布</span>
                                        </li>';
                                if($_GET['topicType']==1){
                                    echo '<p style="text-align: center; background: #fff; margin: 0;"><button class="btt_show">'.$typeName.'</button></p>';
                                }
                                if($_GET['topicType']==2){
                                    echo '<p style="text-align: center; background: #fff; margin: 0;"><button class="btn btn-danger one_btn" onclick="cancelAttention(this)" data-topic-id="' . $data_val['idStr'] . '">取消关注</button></p>';
                                }

                            }
                        }else{
                            echo '<div class="nodata">
                                <p><img src="/content/images/nodata.png"></p><p>暂无数据</p>
                            </div>';
                        }

                    }
                    ?>
                </ul>

            </div>
            <?php require(__DIR__ . '/../layouts/pageNumbers.php'); ?>

        </div>
    </div>
</div>


<div class="footer">
    <ul class="personal">
        <li class="login">
            <img src="/content/img/tou.png"/>
            <div class="dis_inline">
                <?php if(!empty($userName)){
                    echo '<p>欢迎您</p>
                    <p>'.$userName.'</p>';
                }
                ?>
            </div>
        </li>
        <li class="line"><span onclick="javascript:window.location.href='/answer/answer_list'">返回列表</span>&nbsp;| &nbsp;<span onclick="return logout();">退出登录</span></li>
    </ul>
</div>

