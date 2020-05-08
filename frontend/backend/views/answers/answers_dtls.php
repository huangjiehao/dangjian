<?php
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['userName'];
$user_local = json_decode($session->get('user_local'), true);
$userId = $user_local['idStr'];

$title="党建知识库";
echo "<script>document.title = \"".$title."\" </script>";
?>
<head>
    <script type="text/javascript">
        $(function () {
            $(".ly_min").css("display", "none");
            $("#ly_menu").css("display", "none");
            $("#ly_footer").css("display", "none");//去掉头部尾部
        });
    </script>
</head>

<link href="/content/css/uncommon/newanswer.css?v=20181126" rel="stylesheet" type="text/css"/>
<script src="/content/js/uncommon/answer.js" type="text/javascript"></script>
<script src="/content/js/uploadfiles/upload.single.js" type="text/javascript"></script>

<input type="hidden" class="search_params" name="field" id="field" value="<?php if(isset($_GET['field'])){echo $_GET['field'];}else{echo '';}?>"><!-- -->
<input type="hidden" class="search_params" name="findName" value="<?php if(isset($_GET['findName'])){echo $_GET['findName'];}else{echo '';}?>"><!-- -->
<input type="hidden" class="search_params" name="topicKeyId" id="topicTypeId" value="<?php if(isset($_GET['topicKeyId'])){echo $_GET['topicKeyId'];}else{echo '';}?>"><!-- -->
<!-- 头部标题 -->
<div class="answer_tit" style="<?=isset($app)?($app!=0)?'display:none':'':''?>">
    <p>党建知识库问答</p>
</div>
<!-- 头部、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、 -->
    <div class="uncommon answer_top tab pc" style="border-bottom:2px solid #ddd;<?=isset($app)?($app!=0)?'display:none':'':''?>"><!--pc端展示 -->
        <div class="top">
            <div class="dis_inline text-l unhand" style="<?=isset($app)?($app==1)?'display:none':'':''?>">
                <span class="dis_inline tits t_0"><s></s></span>
               <!-- <a href="/answers/answers_list"><span class="dis_inline tits t_1"><s></s></span></a>-->
            </div>
            <?php if(!empty($userName)){
                echo '<div class="dis_inline personal fr" style="margin-left: 0.7rem;">
                    <i class="dis_inline"></i>
                    <div class="dis_inline text-r" style="vertical-align: middle;">
                        <div><span style="padding:0;">'.$userName.'</span></div>
                        <div onclick="return logout();"><span class="font-out" style="padding:0;">退出登录</span></div>
                    </div>
                </div>';
            } ?>

            <div class="dis_inline notice text-r fr">
                <a href="/answers/answers_notif?topicType=0"><span class="notices"><i class="fa fa-bell"></i>消息<em style="color:red;font-style: normal;">(<?php if(isset($data['isAttention'])){echo $data['isAttention']+$data['notificationNum'];}?>)</em></span></a>
            </div>
            <div class="dis_inline notice text-r fr">
                <b style="font-size: 1.3rem; text-decoration: none;cursor: pointer;">
                    <i class="fa fa-home" style="font-size: 1.5rem;margin-right: 0.5rem;"></i><a href="/answers/answers_list">首页</a>
                </b>
            </div>
            <input type="hidden" id="answerSta" value="">
        </div>
    </div>

    <div class="uncommon answers_top tab hand" style="<?=isset($app)?($app==0)?'display:none':'':''?>"><!-- 手机端布局-->
        <div class="bor_b">
            <div class="dis_inline text-r fr_l">
                <span class="notices">
                     <i class="fa fa-home"></i><a href="/answers/answers_list">首页</a>
                    <a href="/answers/answers_notif?topicType=0"><span class="notices"><i class="fa fa-bell"></i>消息<em style="color:red;font-style: normal;">(<?php echo $data['notificationNum'];?>)</em></span></a>
                </span>
            </div>
            <?php if(!empty($userName)){
                echo '<div class="fl_r personal">
                    <i class="dis_inline"></i>
                    <div class="dis_inline text-r" style="vertical-align: middle;">
                        <div><span>'.$userName.'</span></div>
                        <div onclick="return logout();"><span class="font-out">退出登录</span></div>
                    </div>
                </div>';
            } ?>

        </div>
        <form role="search" class="navbar-form dis_inline text-c">
            <div class="form-group">
                <input type="text" placeholder="请输入标题关键词" id="findName" value="<?= isset($_GET['name']) ? $_GET['name'] : '' ?>" class="form-control dis_inline" style="">
                <button class="btn btn-primary" onclick="gotoTopicList()" type="button">搜索</button>
            </div>
        </form>
    </div>

<!-- 内容展示区 -->
<div class="uncommon">
    <div class="top">
        <?php if(isset($app)) {
            if ($app == 1) {
                echo '<div class="dis_inline answer_handleft">
                    <ul>
                        <li class="dis_inline"><p>关注人数：' . $data['answersTopic']['ansNum'] . '</p></li>
                        <li class="dis_inline"><p>浏览次数：' . $data['answersTopic']['readNum'] . '</p></li>
                        <li class="dis_inline"><p>总共：' . sizeof($replyList) . '个回答</p></li>
                    </ul>
                </div>';
                echo '<div class="text-hand hand">';
                if ($data['isAtten'] == 0) {
                    echo '<button class="btn btn-primary" onclick="docAttention(this,0)" data-topic-id="' . $data['answersTopic']['idStr'] . '">点击关注</button>';
                } else if ($data['isAtten'] == 1) {
                    echo '<button class="btn btn-danger" onclick="docAttention(this,1)" data-topic-id="' . $data['answersTopic']['idStr'] . '">取消关注</button>';
                }
                echo '</div>';
            }
        }?>
        <?php if(isset($app)) {
            if ($app == 0) {
                echo '<div class="dis_inline answer_right">
                <p class="tits">' . $data['answersTopic']['title'] . '</p>
                <p class="content overwap">' . $data['answersTopic']['contents'] . '</p>
                <p class="show_tit curtab" data-id="' . $data['answersTopic']['topicKeyIdStr'] . '"><i class="fa fa-tags"></i>' . $data['answersTopic']['topicKeyName'] . '</p>';
                if ($data['isAtten'] == 0) {
                    echo '<button class="btn btn-primary pc" onclick="docAttention(this,0)" data-topic-id="' . $data['answersTopic']['idStr'] . '">点击关注</button>';
                } else if ($data['isAtten'] == 1) {
                    echo '<button class="btn btn-danger pc" onclick="docAttention(this,1)" data-topic-id="' . $data['answersTopic']['idStr'] . '">取消关注</button>';
                }
                echo '</div>';
                echo '<div class="dis_inline answer_left">
                    <ul>
                        <li class="dis_inline"><p>关注人数</p><p>'.$data['answersTopic']['ansNum'].'</p></li>
                        <li class="dis_inline"><p>浏览次数</p><p>'.$data['answersTopic']['readNum'].'</p></li>
                    </ul>
                    <p>总共'.sizeof($replyList).'个回答</p>
                </div>';
            }
        }?>
    </div>
</div>


<!-- 知识管理内容 -->
<div id="answer">
    <div class="container">
        <!-- 中部、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、 -->
                <?php
                if (!empty($data['answersTopicReplies'])) {
//                    \common\models\MyFunction::sun_p($data['answersTopicReplies']);DIE;
                    echo ' <div class="common">
                        <div class="row">';
                            foreach ($data['answersTopicReplies'] as $data_i => $data_val) {
                                echo '<div class="col-sm-12 mar_bt">
                                            <div class="per_l dis_inline">
                                                <img class="dis_inline hvr-rectangle-out" src="/content/images/tou.png">
                                                <ul class="per_b dis_inline">
                                                    <li><span>' . $data_val['createUserName'] . '</span></li>
                                                    <li><span>' . $data_val['createOrgName'] . '</span></li>
                                                </ul>
                                            </div>
                                            <div class="per_mid">' . $data_val['commentContents'] . '</div>
                                            <ul class="per_br">
                                                <li class="dis_inline zan" id="praise' . $data_val['idStr'] . '" onclick="praise(\'' . $data_val['idStr'] . '\')"><i class="dis_inline"></i><span>' . $data_val['praiseNum'] . '</span></li>
                                               <!-- <li class="dis_inline"><i class="fa fa-angle-up"></i>展开</li>-->
                                                <li class="dis_inline tu tu_0" onclick="commentItem(this)" data-id="' . $data_val['idStr'] . '">
                                                    <input type="hidden" value="show">  
                                                    <!--<i></i>
                                                    <b class="commentTitle">展开</b>
                                                    <span>' . $data_val['commentNum'] . '</span><span style="margin-right: 15px;">条</span>-->
                                                </li>
                                               <!-- <li class="dis_inline tu tu_1"><i></i>分享</li>
                                                <li class="dis_inline tu tu_2"><i></i>收藏</li>-->
                                               <!-- <li class="hand"><br/></li>-->
                                                <li class="dis_inline" >发布于' . date("Y-m-d H:i", $data_val['createDate']) . '</li>
                                            </ul>
                                            <div data-page-num="1" class="commentItem" id="commentItem' . $data_val['idStr'] . '">
                                                <input type="hidden" class="pageNum" value="1">
                                            </div>
                                        </div>';
                            }
                        echo '</div>
                    </div>';
                }
                ?>
            </div>
        </div>
        <!-- 分页 -->

    </div>
</div>

<script type="text/javascript">
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
    $(function () {
        if(/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) { //
            $(".answer_tit").hide();
        }
    })
</script>
