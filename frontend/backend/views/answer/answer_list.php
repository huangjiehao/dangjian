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
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    发布问题
                </h4>
            </div>
            <div class="modal-body">
                <section class="aui-content">
                    <form enctype="multipart/form-data" method="post"><!-- onsubmit="return doAddAnswersTopic()"  action="/answers/answers_add_topic" -->
                        <div class="aui-content-up">
                            <div class="aui-modal-contentform-group clear">
                                <div class="aui-label-control">标题：<em>*</em></div>
                                <div class="aui-form-input">
                                    <input type="text" class="aui-form-control-two" name="title"
                                           required id="title" placeholder="请填写标题">
                                </div>
                            </div>
                            <div class="aui-form-group clear">
                                <div class="aui-label-control">类型：<em>*</em></div>
                                <select class="form-control aui-form-input" id="topicKeyId" name="topicKeyId" required>
                                    <?php
                                    if (!empty($kayData['listAnswersTopicKey'])) {
                                        foreach ($kayData['listAnswersTopicKey'] as $data_i => $data_val) {
                                            echo '<option value="' . $data_val['idStr'] . '" >' . $data_val['name'] . '</option>';
                                        }
                                    }else{
                                        echo '<option value="" >请先添加类型</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="aui-form-group clear">
                                <div class="aui-label-control">内容：</div>
                                <div class="aui-form-input">
                                    <textarea id="content" class="form-control" style="width: 100%;height:100px;" name="contents"></textarea>
                                </div>
                            </div>
                            <!-- <input id="contentsTitle" type="hidden" value="" name="contents">-->
                        </div>
                        <div class="aui-btn-default">
                            <button class="btn btn-primary question" type="button">发布</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>

<input type="hidden" class="search_params" name="field" id="field" value="<?php if(isset($_GET['field'])){echo $_GET['field'];}else{echo '';}?>"><!-- -->
<input type="hidden" class="search_params" name="findName" value="<?php if(isset($_GET['findName'])){echo $_GET['findName'];}else{echo '';}?>"><!-- -->
<input type="hidden" class="search_params" name="topicKeyId" id="topicTypeId" value="<?php if(isset($_GET['topicKeyId'])){echo $_GET['topicKeyId'];}else{echo '';}?>"><!-- -->
<!-- pc端 -->
<div class="pc">
    <div class="container"><!-- 内容展示 -->

        <div class="common min_h">
            <div class="news_top" style="height: 56px;">
                <div class="news_left">
                    <button class="bt" onclick="javascript:window.location.href='/answer/answer_notif?topicType=0'"><i class="message text-center"><img src="/content/img/notice.png"></i> 消息 (<?=$data['data']['notificationNum']?>)</button>
                    <button class="bt" data-toggle="modal" data-target="#myModal"><i class="rel text-center"><img src="/content/img/add.png"></i>发布问题</button>
                </div>
                <div class="news_right">
                    <input class="search_params" placeholder=" 请输入标题关键词" id="findName" name="findName" value="<?=isset($_GET['findName'])?$_GET['findName']: ''?>"/>
                    <button class="bts search_btn" onclick="gotoTopicList()">搜索</button>
                </div>
            </div>
            <div class="news_top">
                <ul id="tab" class="answer nav">
                    <?php
                    if($param['topicKeyId'] == 0){
                        echo '<li onclick="doTopicType(this)" class="active" data-topic-type-id="0">全部</li>';
                    }else{
                        echo '<li onclick="doTopicType(this)" class="" data-topic-type-id="0">全部</li>';
                    }
                    if (!empty($kayData['listAnswersTopicKey'])) {
                        foreach ($kayData['listAnswersTopicKey'] as $data_i => $data_val) {
                            if ($param['topicKeyId'] == $data_val['idStr']) {
                                echo '<li onclick="doTopicType(this)" class="active" >' . $data_val['name'] . '</li>';
                            }else{
                                echo '<li onclick="doTopicType(this)" class="" data-topic-type-id=' . $data_val['idStr'] . '>' . $data_val['name'] . '</li>';
                            }
                        }
                    }
                    ?>
                </ul>

                <div class="tab_list_answer">
                    <span class="newest">最新发布</span>
                    <ul class="tab_list tabHead" data-active-name="type">
                        <?php
                        if (!empty($data['data']['listAnswersTopic'])) {
                            foreach ($data['data']['listAnswersTopic'] as $data_i => $data_val) {//<p class="content">' . $data_val['contents'] . '</p>
                                echo '<li>
                                    <div class="tab_list_c" onclick="window.open(\'/answer/answer_dtls?notif=1&id=' . $data_val['idStr'] . '\')">
                                        <p class="tit">' . $data_val['title'] . '</p>
                                       
                                    </div>
                                    <p>
                                    <p class="tab curtab" data-id="' . $data_val['topicKeyIdStr'] . '"><i><img src="/content/img/tab.png"></i> ' . $data_val['topicKeyName'] . '</p>
                                    <p class="info"><a>' . $data_val['ansNum'] . '个回答</a> | <a>' . date("Y-m-d H:i", $data_val['createDate']) . '发布</a></p>
                                    </p>
                                </li>';
                            }
                        }else{
                            echo '<div class="nodata">
                                <p><img src="/content/images/nodata.png"></p><p>暂无数据</p>
                            </div>';
                        }
                        ?>
                    </ul>
                    <?php require(__DIR__ . '/../layouts/pageNumbers.php'); ?>
                </div>

            </div>

        </div>
    </div>
</div><!-- pc -->
<style>
    .news_top{ padding:20px 2rem!important;}
</style>


