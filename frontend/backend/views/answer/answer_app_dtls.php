<?php
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
<input type="hidden" class="search_params" name="field" id="field" value="<?php if(isset($_GET['field'])){echo $_GET['field'];}else{echo '';}?>"><!-- -->
<input type="hidden" class="search_params" name="findName" value="<?php if(isset($_GET['findName'])){echo $_GET['findName'];}else{echo '';}?>"><!-- -->
<input type="hidden" class="search_params" name="topicKeyId" id="topicTypeId" value="<?php if(isset($_GET['topicKeyId'])){echo $_GET['topicKeyId'];}else{echo '';}?>"><!-- -->
<!-- _________________________________________________-->
<!-- 手机端 -->
<div id="mar_bf">
    <div class="module_tit">
        <div class="container">
            <p>党建知识库问答</p>
            <?php if ($data['isAtten'] == 0) {
                echo '<img onclick="docAttention(this,0)" data-topic-id="' . $data['answersTopic']['idStr'] . '" class="t1" src="/content/img/add_1.png" />';
            }else{
                echo '<img onclick="docAttention(this,1)" data-topic-id="' . $data['answersTopic']['idStr'] . '" class="t1" src="/content/img/cancel_1.png" />';
            }?>
            <div class="t2" onclick="javascript:window.location.href='/answer/answer_notif?topicType=0'">
                <img src="/content/img/news.png"/>
                <span><?=$data['notificationNum']?></span>
            </div>
        </div>
    </div>
    <div class="container"><!-- 内容展示 -->
        <div class="common">
            <!--<div class="news_top dtls">
                <div class="news_left">
                    <?php /*if ($data['isAtten'] == 0) {
                        echo '<button class="rel text-center" onclick="docAttention(this,0)" data-topic-id="' . $data['answersTopic']['idStr'] . '"><img src="/content/img/add.png"></i>点击关注</button>';
                    } else if ($data['isAtten'] == 1) {
                        echo '<button class="rel text-center" onclick="docAttention(this,1)" data-topic-id="' . $data['answersTopic']['idStr'] . '"><img src="/content/img/add.png"></i>取消关注</button>';
                    }
                    */?>
                </div>
            </div>-->

            <?php
            echo '<div class="dis_inline answer_left">
                    <ul>
                        <li class="dis_inline"><p>关注人数</p><p>'.$data['answersTopic']['ansNum'].'</p></li>
                        <li class="dis_inline"><p>浏览次数</p><p>'.$data['answersTopic']['readNum'].'</p></li>
                        <li class="dis_inline"><p>总回答数</p><p>'.sizeof($replyList).'</p></li>
                    </ul>
                 
                </div>';
            echo '<div class="answer_right app">
                    <p class="tits">' . $data['answersTopic']['title'] . '</p>
                    <p class="content overwap">' . $data['answersTopic']['contents'] . '</p>
                    <p class="show_tit curtab" data-id="' . $data['answersTopic']['topicKeyIdStr'] . '"><i class=""><img src="/content/img/tab_1.png"> </i>' . $data['answersTopic']['topicKeyName'] . '</p>';
            echo '</div>';
            ?>
        </div>
        <div class="common con_pb">
            <div class="news_top">
                <div class="tab_list_answer dtls">
                    <?php
                    if (!empty($data['answersTopicReplies'])) {
                        echo ' 
                        <div class="row">';
                        foreach ($data['answersTopicReplies'] as $data_i => $data_val) {
                            echo '<div class="col-sm-12 mar_bt app_dtls">
                                    <div class="per_l dis_inline">
                                        <img class="dis_inline hvr-rectangle-out" src="/content/images/tou.png">
                                        <ul class="per_b dis_inline">
                                            <li><span>' . $data_val['createUserName'] . '</span></li>
                                            <li><span>' . $data_val['createOrgName'] . '</span></li>
                                        </ul>
                                    </div>
                                    <div class="per_mid">' . strip_tags($data_val['commentContents']) . '</div>
                                    <ul class="per_br">
                                        <li class="dis_inline zan" id="praise' . $data_val['idStr'] . '" onclick="praise(\'' . $data_val['idStr'] . '\')"><i class="dis_inline"></i><span>' . $data_val['praiseNum'] . '</span></li>
                                        <li class="dis_inline" >发布于' . date("Y-m-d H:i", $data_val['createDate']) . '</li>
                                    </ul>
                                    <div data-page-num="1" class="commentItem" id="commentItem' . $data_val['idStr'] . '">
                                        <input type="hidden" class="pageNum" value="1">
                                    </div>
                                </div>';
                        }
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

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

