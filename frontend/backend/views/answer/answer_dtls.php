<?php
$session = \Yii::$app->session;
$user_local = json_decode($session->get('user_local'), true);
$userId = $user_local['idStr'];
$userName = $user_local['name'];
$orgName = $user_local['orgName'];

$title="智慧党建知识库问答";
echo "<script>document.title = \"".$title."\" </script>";
?>
<link href="/content/css/uncommon/module.css?v=20181126" rel="stylesheet" type="text/css"/>
<script src="/content/js/uncommon/up.js" type="text/javascript"></script>
<script src="/content/js/uncommon/answer.js" type="text/javascript"></script>
<script src="/content/js/uploadfiles/upload.single.js" type="text/javascript"></script>
<script src="/content/js/uploadfiles/upload.js" type="text/javascript"></script>

<input type="hidden" class="search_params" name="field" id="field" value="<?php if(isset($_GET['field'])){echo $_GET['field'];}else{echo '';}?>"><!-- -->
<input type="hidden" class="search_params" name="findName" value="<?php if(isset($_GET['findName'])){echo $_GET['findName'];}else{echo '';}?>"><!-- -->
<input type="hidden" class="search_params" name="topicKeyId" id="topicTypeId" value="<?php if(isset($_GET['topicKeyId'])){echo $_GET['topicKeyId'];}else{echo '';}?>"><!-- -->

<!-- pc端 -->
<div class="pc">
    <div class="container"><!-- 内容展示 -->
        <div class="common">
            <div class="news_top dtls">
                <div class="news_left">
                    <button class="bt" onclick="javascript:window.location.href='/answer/answer_notif?topicType=0'"><i class="message text-center"><img src="/content/img/notice.png"></i>消息(<?=$data['notificationNum']?>)</button>
                    <?php if ($data['isAtten'] == 0) {
                        echo '<button class="rel text-center bt" onclick="docAttention(this,0)" data-topic-id="' . $data['answersTopic']['idStr'] . '"><img src="/content/img/add_3.png"></i>点击关注</button>';
                    } else if ($data['isAtten'] == 1) {
                        echo '<button class="bt rel text-center cancel" onclick="docAttention(this,1)" data-topic-id="' . $data['answersTopic']['idStr'] . '"><img src="/content/img/cancel_3.png"></i>取消关注</button>';
                    }
                    ?>
                </div>
            </div>

            <?php
            echo '<div class="dis_inline answer_right">
                    <p class="tits">' . $data['answersTopic']['title'] . '</p>
                    <p class="content overwap">' . $data['answersTopic']['contents'] . '</p>
                    <p class="show_tit curtab" data-id="' . $data['answersTopic']['topicKeyIdStr'] . '"><i class=""><img src="/content/img/tab.png"/> </i>' . $data['answersTopic']['topicKeyName'] . '</p>';
            echo '</div>';
            echo '<div class="dis_inline answer_left">
                    <ul>
                        <li class="dis_inline"><p>关注人数</p><p>'.$data['answersTopic']['ansNum'].'</p></li>
                        <li class="dis_inline"><p>浏览次数</p><p>'.$data['answersTopic']['readNum'].'</p></li>
                    </ul>
                    <p>总共'.sizeof($replyList).'个回答</p>
                </div>';
            ?>
        </div>


        <?php
        if (!empty($data['answersTopicReplies'])) {
            echo ' 
            <div class="common min_h">
                <div class="news_top">
                    <div class="tab_list_answer dtls">
                    <div class="row">';
            foreach ($data['answersTopicReplies'] as $data_i => $data_val) {
                echo '<div class="col-sm-12 mar_bt">
                                    <div class="per_l">
                                        <img class="dis_inline hvr-rectangle-out" src="/content/images/tou.png">
                                        <ul class="per_b dis_inline">
                                            <li><span>' . $data_val['createUserName'] . '</span></li>
                                            <ul class="per_br">
                                                <li class="dis_inline zan" id="praise' . $data_val['idStr'] . '" onclick="praise(\'' . $data_val['idStr'] . '\')"><i class="dis_inline"></i><span>' . $data_val['praiseNum'] . '</span></li>
                                                <li class="dis_inline" style="color:#b0acac;">发布于' . date("Y-m-d H:i", $data_val['createDate']) . '</li>
                                            </ul>
                                        </ul>
                                       
                                    </div>
                                    <div class="per_mid">' . strip_tags($data_val['commentContents']) . '</div>
                                    
                                    <div data-page-num="1" class="commentItem" id="commentItem' . $data_val['idStr'] . '">
                                        <input type="hidden" class="pageNum" value="1">
                                    </div>
                                </div>';
            }
            echo '</div>
                    </div>

                </div>
            </div>';
        }
        ?>
    </div>
</div>
    <style type="text/css">
        .fl_r{ float: right; margin-right: 10px; }
        .n_top{ padding-bottom:15px; }
        .cur{ cursor: pointer;}
    </style>


