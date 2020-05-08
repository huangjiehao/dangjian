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
                    <form enctype="multipart/form-data" method="post" action="/answers/answers_add_topic"><!-- onsubmit="return doAddAnswersTopic()" -->
                        <div class="aui-content-up">
                            <div class="aui-modal-contentform-group clear">
                                <div class="aui-label-control">标题：<em>*</em></div>
                                <div class="aui-form-input">
                                    <input type="text" class="aui-form-control-two" name="title"
                                           required id="1" placeholder="请填写标题">
                                </div>
                            </div>
                            <!--<div class="aui-form-group clear">
                                <div class="aui-label-control">封面：<em>*</em></div>
                                <div class="upload-files-main" name="img" data-p-height="50"
                                     data-accept=".png,.jpg,.jpeg">
                                    <?php /*require(__DIR__ . '/../layouts/upload_files.php'); */?>
                                </div>
                            </div>-->
                            <div class="aui-form-group clear">
                                <div class="aui-label-control">类型：<em>*</em></div>
                                <select class="form-control aui-form-input" name="topicKeyId" required>
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
                            <button class="aui-btn aui-btn-account" type="submit">发布</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
<div class="answers_tit"  style="<?=isset($app)?($app!=0)?'display:none':'':''?>">
    <p>知识库</p>
</div>
<input type="hidden" class="search_params" name="field" id="field" value="<?php if(isset($_GET['field'])){echo $_GET['field'];}else{echo '';}?>"><!-- -->
<input type="hidden" class="search_params" name="findName" value="<?php if(isset($_GET['findName'])){echo $_GET['findName'];}else{echo '';}?>"><!-- -->
<input type="hidden" class="search_params" name="topicKeyId" id="topicTypeId" value="<?php if(isset($_GET['topicKeyId'])){echo $_GET['topicKeyId'];}else{echo '';}?>"><!-- -->
<div id="answersd">
    <div class="container">
        <?php if(isset($app)) {
            if ($app == 0) {
                echo '<div class="common answers_top tab pc"><!-- pc端布局-->
                <div class="dis_inline text-l">
                    <b style="font-size: 1.3rem; text-decoration: none;cursor: pointer;" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-question-circle" style="font-size: 1.5rem;margin-right: 0.5rem;"></i><a href="/answers/answers_notif?topicType=0">发布问题</a>
                    </b>
                </div>
                <form role="search" class="navbar-form dis_inline text-c">
                    <div class="form-group">
                        <input type="text" placeholder="请输入标题关键词" id="findName" value="'.(isset($_GET['findName'])?$_GET['findName']: '').'" class="form-control dis_inline search_params">
                        <button class="btn btn-primary" onclick="gotoTopicList()" type="button">搜索</button>
                    </div>
                </form>
                <div class="dis_inline text-r">
                    <span class="notices" style="font-size: 1.3rem;"><i class="fa fa-bell"></i><a href="/answers/answers_notif?topicType=0" style="font-size: 1.3rem;">消息<em style="color:red;font-weight:bold;font-style: normal;font-size: 1.3rem;">('.$allNum.')</em></a></span>
                </div>
                <div class="dis_inline personal" style="margin-top: 6px;">
                    <i class="dis_inline"></i>
                    <div class="dis_inline text-r" style="vertical-align: middle;">
                        <div><span style="padding:0;"><?php echo $userName; ?></span></div>
                        <div onclick="'.(isset($userName) ?'return logout();' : '').'"><span class="font-out" style="padding:0;">退出登录</span></div>
                    </div>
                </div>
            </div>';
            }
        }
                    ?>

        <?php if(isset($app)){
            if($app == 1){
                echo '<div class="common answers_top tab hand '.$app.'"><!-- 手机端布局-->
                    <div class="bor_b">
                        <div class="dis_inline text-r fr_l">
                            <span class="notices">
                                <b data-toggle="modal" data-target="#myModal"><i class="fa fa-question-circle"></i><a href="/answers/answers_notif?topicType=0">发布问题</a></b>
                                <i class="fa fa-bell"></i><a href="/answers/answers_notif?topicType=0">消息<em style="color:red;font-style: normal;">('.$allNum.')</em></a>
                            </span>
                        </div>
                        <div class="fl_r personal">
                            <i class="dis_inline"></i>
                            <div class="dis_inline text-r" style="vertical-align: middle;">
                                <div><span><?php echo $userName; ?></span></div>
                                <div onclick="'.(isset($userName) ?'return logout();' : '').'"><span class="font-out">退出登录</span></div>
                            </div>
                        </div>
                    </div>
                    <form role="search" class="navbar-form dis_inline text-c">
                        <div class="form-group">
                            <input type="text" placeholder="请输入标题关键词" id="findName" value="'.(isset($_GET['name']) ? $_GET['name'] : '').'" class="form-control dis_inline" style="">
                            <button class="btn btn-primary" onclick="gotoTopicList()" type="button">搜索</button>
                        </div>
                    </form>
                </div>';
            }
        }
        ?>
        <?php if(isset($app)) {
            if ($app == 0) {
                echo '<div class="common answers_middle pc"><!-- pc端布局-->
            <input type="hidden" class="search_params" name="type" value="">
            <ul class="tabHead" data-active-name="type">
                <li class="" onclick="doTopicType(this)"';
                if ($param['topicKeyId'] == 0) { echo ' style="background-color: #b61412;color:#fff;" ';}
                echo 'data-topic-type-id="0">全部
                </li>';
                if (!empty($kayData['listAnswersTopicKey'])) {
                    foreach ($kayData['listAnswersTopicKey'] as $data_i => $data_val) {
                        echo '<li onclick="doTopicType(this)" ';
                        if ($param['topicKeyId'] == $data_val['idStr']) {
                            echo ' style="background-color: #b61412;color:#fff;" ';
                        }
                        echo ' data-topic-type-id=' . $data_val['idStr'] . '>' . $data_val['name'] . '</li>';
                    }
                }
                echo '</ul>
        </div>';
            }
        }?>
        <?php if(isset($app)) {
            if ($app == 1) {
                echo '<div class="common answers_middle hand"><!-- 手机端布局-->
                    <input type="hidden" class="search_params" name="type" value="">
                    <div class="article_tags">
                        <ul class="tagcns">
                            <li class="item" data-topic-type-id="0" onclick="doTopicType(this)"';
                            if ($param['topicKeyId'] == 0) {
                                echo 'style ="background-color: #b61412;color:#fff;" ';
                            }
                            echo '>全部</li>';
                            if (!empty($kayData['listAnswersTopicKey'])) {
                                foreach ($kayData['listAnswersTopicKey'] as $data_i => $data_val) {
                                    echo '<li class="item" data-topic-type-id = "' . $data_val['idStr'] . '"  onclick = "doTopicType(this)" ';
                                    if ($param['topicKeyId'] == $data_val['idStr']) {
                                        echo ' style = "background-color: #b61412;color:#fff;" ';
                                    }
                                    echo '> ' . $data_val['name'] . ' </li> ';
                                }
                            }
                        echo '</ul>
                    </div>
                </div>';
            }
        }?>
        <div class="common answers_bott container_col">
            <div class="row">
                <div class="col-sm-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="<?php if ($param['field'] == "create_date") {
                                echo 'active';
                            } ?>"><a data-toggle="tab" href="#tab-1" data-field="create_date"
                                     onclick="doField(this)" aria-expanded="true">最新发布</a>
                            </li>
                           <!-- <li class="<?php /*if ($param['field'] == "ans_num") {
                                echo 'active';
                            } */?>"><a data-toggle="tab" href="#tab-2" data-field="ans_num" onclick="doField(this)"
                                     aria-expanded="false">热门推荐</a>
                            </li>-->
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <ul class="newslist">
                                        <?php
                                        if (!empty($data['data']['listAnswersTopic'])) {
                                            foreach ($data['data']['listAnswersTopic'] as $data_i => $data_val) {
//                                                \common\models\MyFunction::sun_p($data_val);DIE;
                                                echo '<li>';
                                                echo '<a href="/answers/answers_dtls?notif=1&id=' . $data_val['idStr'] . '" class="dis_inline"><b class="tit">' . $data_val['title'] . '</b><b class="tit_2">' . $data_val['contents'] . '</b></a>';
                                                /*if (strlen($data_val['img']) > 0) {
                                                    echo '<img src="' . $data_val['img'] . '" style="width: 120px; vertical-align: top;margin-right: 10px; "><b class="tit_2" style="width: calc(100% - 135px);">' . $data_val['contents'] . '</b>';
                                                }else{
                                                }*/
                                              echo '<b class="tit_3 curtab" data-id="' . $data_val['topicKeyIdStr'] . '" ><i class="fa fa-tags"></i>' . $data_val['topicKeyName'] . '</b>
                                            <span class="dis_inline tit_4">' . $data_val['ansNum'] . '个回答 | ' . date("Y-m-d H:i", $data_val['createDate']) . '发布</span>
                                        </li>';
                                            }
                                        }else{
                                            echo '<div class="nodata">
                                                <p><img src="/content/images/nodata.png"></p><p>暂无数据</p>
                                            </div>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <?php
                                    if (!empty($data['data']['listAnswersTopic'])) {
                                        foreach ($data['data']['listAnswersTopic'] as $data_i => $data_val) {
                                            echo '<li onclick="gotoDetails(\'' . $data_val['idStr'] . '\')">';
                                            echo '<img src="' . $data_val['img'] . '" style="width: 80px;">
                                                <a href="#" class="dis_inline"><b class="tit">' . $data_val['title'] . '</b><b class="tit_2">' . $data_val['contents'] . '</b>
                                                <b class="tit_3"><i class="fa fa-tags"></i>' . $data_val['topicKeyName'] . '</b></a>
                                            <span class="dis_inline tit_4">' . $data_val['ansNum'] . '个回答 | ' . date("Y-m-d H:i", $data_val['createDate']) . '发布</span>
                                        </li>';
                                        }
                                    }else{
                                        echo '<div class="nodata">
                                                <p><img src="/content/images/nodata.png"></p><p>暂无数据</p>
                                            </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php require(__DIR__ . '/../layouts/pageNumbers.php'); ?>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .box-footer{ text-align: center;}
    .pagination { vertical-align: middle; margin: 20px!important;}
    .li a img{
        display: inline-block;
        vertical-align: top!important;
    }
     .newslist li .tit_2{
         display: inline-block;
         white-space: inherit!important;
     }
    #edui1,#edui1_iframeholder{ width: 100%!important;}
    #ly_menu{ display: none;}

</style>
