<?php
$session = \Yii::$app->session;
$user_local = json_decode($session->get('user_local'), true);
$userId = $user_local['idStr'];
$userName = $user_local['name'];
$orgName = $user_local['orgName'];
$title="智慧党建知识库问答";
echo "<script>document.title = \"".$title."\" </script>";
?>
<style type="text/css">
    .previous_page a:first-child{ padding:0;}
</style>
<link href="/content/css/uncommon/module_app.css?v=20181126" rel="stylesheet" type="text/css"/>
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
<!-- _________________________________________________-->
<!-- 手机端 -->
<div id="mar_bf">
    <div class="module_tit">
        <p>党建知识库</p>
<!--        <a class="t3" href="https://www.gzsjgdj.gov.cn/list.html?c=zlk"><img src="/content/img/app_anss.png" /></a>-->
        <img data-toggle="modal" data-target="#myModal" class="t1" src="/content/img/app_add.png" />
        <div class="t2" onclick="javascript:window.location.href='/answer/answer_notif?topicType=0'">
            <img src="/content/img/news.png"/>
            <span><?=$data['data']['notificationNum']?></span>
        </div>
    </div>
    <div class="app_bg">
        <div class="search-float">
            <input id="findName" placeholder=" 请输入标题关键词" class="input-text search_params" placeholder="请输入搜索关键字..." value="<?php if(isset($_GET['findName'])){echo $_GET['findName'];}else{echo '';}?>" type="text">
            <button onclick="gotoTopicList()" id="_fix_btn" name="" class="btn">
                <i class="iconfont icon-sousuo"></i>搜索
            </button>
        </div>
        <div class="aui-scrollView">
            <div class="aui-item-ofl b-line">
                <ul class="tab-nav">
                    <?php
                    if($param['topicKeyId'] == 0){
                        echo '<li onclick="doTopicType(this)" class="tab-nav-item tab-active" data-topic-type-id="0"><a href="javascript:;">全部</a></li>';
                    }else{
                        echo '<li onclick="doTopicType(this)" class="tab-nav-item" data-topic-type-id="0"><a href="javascript:;">全部</a></li>';
                    }
                    if (!empty($kayData['listAnswersTopicKey'])) {
                        foreach ($kayData['listAnswersTopicKey'] as $data_i => $data_val) {
                            if ($param['topicKeyId'] == $data_val['idStr']) {
                                echo '<li onclick="doTopicType(this)" class="tab-nav-item tab-active" ><a href="javascript:;">' . $data_val['name'] . '</a></li>';
                            }else{
                                echo '<li onclick="doTopicType(this)" class="tab-nav-item" data-topic-type-id=' . $data_val['idStr'] . '><a href="javascript:;">' . $data_val['name'] . '</a></li>';
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="container app">
        <div class="common con_pb">
            <ul class="tab_list">
                <?php
                if (!empty($data['data']['listAnswersTopic'])) {
                    foreach ($data['data']['listAnswersTopic'] as $data_i => $data_val) {
                        echo '<li onclick="window.open(\'/answer/answer_dtls?notif=1&id=' . $data_val['idStr'] . '\')">
                            <p class="tit">' . $data_val['title'] . ' </p>
                            <p class="content tr_hidden">
                                 ' . $data_val['contents'] . '
                            </p>
                            <p class="tab t1 curtab" data-id="' . $data_val['topicKeyIdStr'] . '"><span class="tit"> ' . $data_val['topicKeyName'] . '</span></p>
                            <p class="tab t2">' . $data_val['ansNum'] . '个回答</a> | <a>' . date("Y-m-d H:i", $data_val['createDate']) . '发布</p>
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
        <li class="line"><span onclick="javascript:window.location.href='/account/login'">个人空间</span>&nbsp;| &nbsp;<span onclick="return logout();">退出登录</span></li>
    </ul>
</div>

