<?php
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['userName'];
$user_local = json_decode($session->get('user_local'), true);
$userId = $user_local['idStr'];

$title="党建知识库";
echo "<script>document.title = \"".$title."\" </script>";

?>
<link href="/content/css/uncommon/answers.css?v=20181126" rel="stylesheet" type="text/css"/>

<script src="/content/js/uncommon/up.js" type="text/javascript"></script>
<script type="text/javascript" src="/content/js/uploadfiles/upload.js"></script>
<script src="/content/js/uncommon/answer.js" type="text/javascript"></script>
<script src="/content/js/uncommon/init_wev8.js" type="text/javascript"></script>
<style>
    .list-group {
        text-decoration: none;
        cursor: pointer;
    }

    #ly_menu {
        display: none;
    }

</style>
<div class="modal fade" id="reply" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    回复内容
                </h4>
            </div>
            <div class="modal-body">
                <section class="aui-content">
                    <div class="aui-content-up">
                        <form action="" name="form1" method="post">
                            <div class="aui-form-group clear">
                                <div class="aui-form-input">
                                    <textarea class="aui-form-control" name="description" id="commentContents"
                                              minlength="5"
                                              placeholder="请输入您的回复内容..."></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="aui-btn-default">
                        <button class="aui-btn aui-btn-account" id="replyBt" onclick="reply(this)">回复</button>
                    </div>
                </section>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>

<!-- 头部标题 -->
<div class="answers_tit"  style="<?=isset($app)?($app!=0)?'display:none':'':''?>">
    <p>知识库</p>
</div>
<!-- 投票管理内容 -->
<div id="answersd">
    <div class="container">
        <!-- 头部、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、 -->
        <div class="common answers_top tab">
            <div class="dis_inline text-l">
                <span><a href="/answers/answers_list">首页</a></span>
            </div>
            <div class="dis_inline text-r">
                <span class="notices"><i class="fa fa-bell"></i><a href="/answers/answers_notif">消息(<em
                                style="color: red;"><?php echo $data['notificationNum']; ?></em>)</a></span>
            </div>
            <div class="dis_inline text-r personal">
                <span><i class="dis_inline"></i><?php echo $userName; ?></span>
                <span><a href="/answers/answers_login_out">退出</a></span>
            </div>
        </div>

        <!-- 中部、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、 -->
        <div class="common answers_middle">
            <input type="hidden" class="search_params" name="type" value="">
            <h3 style="color: #0a8cda;"><?php echo $data['answersTopic']['title']; ?></h3>
            <div id="contents" style="width: 100%;">
                <?php echo $data['answersTopic']['contents']; ?>
            </div>
            <br/><br/><br/>
            <!--<button class="aui-btn aui-btn-account" onclick="docAttention(this)"
                    data-topic-id="<?php /*echo $data['answersTopic']['idStr']; */?>"
            ><?php
/*                if ($data['isAttention'] == 1) {
                    echo '取消关注';
                } else if ($data['isAttention'] == 0) {
                    echo '点击关注';
                }
                */?></button>-->
            <?php
            if ($data['answersTopic']['type'] == 3) {
                echo ' <button class="aui-btn aui-btn-account" onclick="docAttention(this)"
                    data-topic-id="' . $data['answersTopic']['idStr'] . '">';
                if ($data['isAttention'] == 1) {
                    echo '取消关注';
                } else if ($data['isAttention'] == 0) {
                    echo '点击关注';
                }
                echo '</button>';
            }
            ?>
            <!--<input type="button" value="写答案">-->
            <br/>
            作者：<span><?php echo $data['answersTopic']['createUserName']; ?></span>
            <br/>
            关注人数： <span id="attentionNum"><?php echo $data['answersTopic']['ansNum']; ?></span>
            <br/>
            浏览次数： <?php echo $data['answersTopic']['readNum']; ?>
            <br/>
            共<?php echo sizeof($replyList); ?>个回答
            <br/>
            <!--<button class="aui-btn aui-btn-account"
                    data-toggle="modal"
                    data-topic-reply-id="0"
                    data-topic-user-name="<?php /*echo $data['answersTopic']['createUserName']; */ ?>"
                    data-topic-user-id="<?php /*echo $data['answersTopic']['createUserId']; */ ?>"
                    data-reply-user-name="<?php /*echo $data['answersTopic']['createUserName']; */ ?>"
                    data-reply-user-id="<?php /*echo $data['answersTopic']['createUserId']; */ ?>"
                    data-topic-id="<?php /*echo $data['answersTopic']['idStr']; */ ?>"
                    data-target="#reply"
                    onclick="showReplyFrom(this)">写答案
            </button>-->
        </div>
        <!-- 尾部、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、 -->
        <div class="common answers_bott container_col">
            <div class="row">
                <div class="col-sm-12">
                    <div class="tabs-container">
                        <div class="tab-content">
                            <div id="replyItem" class="tab-pane active">
                                <?php
                                if (!empty($data['answersTopicReplies'])) {
                                    foreach ($data['answersTopicReplies'] as $data_i => $data_val) {
                                        echo '<div class="panel-body">
                                    <div id="' . $data_val['idStr'] . '" class="col-sm-12 col-md-12 col-lg-12  dtls">
                                        <div class="allcontent">
                                            <div class="padd dis_inline">
                                                <a class="thumbnail col-sm-6 col-md-4 col-lg-3 no_fl dis_inline">
                                                    <div class="divimg"><img data-src="50x50" alt="60%60"
                                                                             src="/content/images/toux.jpg"
                                                                             data-holder-rendered="true"
                                                                             style="height: 60px; width: 60px; margin: 0 auto; display: block;">
                                                    </div>
                                                    <div class="caption">
                                                        <h6>' . $data_val['createUserName'] . '</h6>
                                                        <h6>' . $data_val['createOrgName'] . '</h6>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="inside dis_inline">
                                                <div class="entry-content">
                                                    <p>' . $data_val['commentContents'] . '</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    赞数：<span id="praise' . $data_val['idStr'] . '">' . $data_val['praiseNum'] . ' </span>
                                    <button class="aui-btn aui-btn-account" onclick="praise(\'' . $data_val['idStr'] . '\')"><img src="/content/images/zan.png" width="20" height="20"></button>
                                    <a id="showBt' . $data_val['idStr'] . '" onclick="commentItem(this)" data-id="' . $data_val['idStr'] . '" style=";text-decoration:none;cursor:pointer;font-size: 15px;color: red;"><input type="hidden" value="show"><b class="commentTitle">查看评论：</b></a><span style="text-decoration:none;cursor:pointer;font-size: 15px;color: red;">  <b> ' . $data_val['commentNum'] . '</b></span>
                                    发布于：' . date("Y-m-d H:i", $data_val['createDate']) . '
                                    <button class="aui-btn aui-btn-account" data-toggle="modal" data-reply-user-name="' . $data_val['createUserName'] . '" data-reply-user-id="' . $data_val['createUserId'] . '" data-topic-reply-id="' . $data_val['idStr'] . '" data-topic-user-name="' . $data['answersTopic']['createUserName'] . '" data-topic-user-id="' . $data['answersTopic']['createUserId'] . '" data-topic-id="' . $data['answersTopic']['idStr'] . '" data-target="#reply" onclick="showReplyFrom(this)" >回复</button>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <div data-page-num="1" class="commentItem" id="commentItem' . $data_val['idStr'] . '">
                                        <input type="hidden" class="pageNum" value="1">
                                    </div>
                                </div>';
                                    }
                                    /*if ($data['answersTopicReplieCounts'] > $topicReplylimit) {
                                        echo '<div class="list-group more-list"><a class="list-group-item active"><center><h4 class="list-group-item-heading">显示更多</h4></center></a></div>';
                                    }*/
                                } else {
                                    echo '<center><h3>空空如也，等着你来回复哦~~</h3></center>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="/content/plugins/ueditor/ueditor.config.js" type="text/javascript"></script>
    <script src="/content/plugins/ueditor/ueditor.all.min.js" type="text/javascript"></script>
    <script>
        UE.getEditor('content', {initialFrameWidth: 800, initialFrameHeight: 200})
        $(document).ready(function () {
            <?php
            if (isset($_GET['level'])) {
                if (isset($_GET['id'])) {
                    echo 'commentItem($(\'#showBt' . $_GET['moveId'] . '\'));';
                }
            }
            if (isset($_GET['moveId'])) {
                echo ' location.href = "#' . $_GET['moveId'] . '";';
            }
            ?>
        });
    </script>