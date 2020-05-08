<?php
$session = \Yii::$app->session;
$user_local = json_decode($session->get('user_local'), true);
$userId = $user_local['idStr'];
$userName = $user_local['name'];

$title="推荐投票";
echo "<script>document.title = \"".$title."\" </script>";
?>

<link href="/content/css/uncommon/module.css?v=20181126" rel="stylesheet" type="text/css"/>
<script src="/content/js/uncommon/voted.js" type="text/javascript"></script>
<script src="/content/js/uncommon/answer.js" type="text/javascript"></script>
<script src="/content/js/uploadfiles/upload.single.js" type="text/javascript"></script>
<script src="/content/js/uploadfiles/upload.js" type="text/javascript"></script>
<style type="text/css">
    .pc .news_top{
        padding:3em 2em 2em 2em;
    }
    .page-box{
        padding-bottom:20px;
    }
    .tab_list_answer{
        position: relative;
    }
    .pc .news_right{
        float: none;
        position: absolute;
        right: 0;
        top:-12px;
    }
    #mask{
        z-index: 98;
    }
    .login-wrap{
        z-index: 99;
    }
    .pagination{ vertical-align: middle; }
</style>
<!-- pc端 -->
<div class="pc">
    <div class="container"><!-- 内容展示 -->
        <div class="common min_h">
            <div class="news_top">
                <div class="tab_list_answer">
                    <span class="newest">最新投票</span>
                    <div class="news_right">
                        <input type="hidden" class="search_params" id="voteSta" name="voteSta" value="<?php if(isset($_GET['voteSta'])){echo $_GET['voteSta'];}else{echo '';}?>">
                        <input class="search_params" placeholder=" 请输入标题关键词" id="title" name="title" value="<?=isset($_GET['title'])?$_GET['title']: ''?>"/>
                        <button class="bts search_btn">搜索</button>
                    </div>
                    <input type="hidden" value="" id="url"/>
                    <ul class="tab_list tabHead" data-active-name="type">
                        <?php
                        if (!empty($data['portalVoteList'])) {
                            foreach ($data['portalVoteList'] as $data_i => $data_val) {
                                    if(empty($userName)&&$data_val['visitor']==0){
                                        if($data_val['showType'] == 1){
                                            echo '<li  name="/vote/vote_dtls?id='.$data_val['idStr'].'&visitor='.$data_val['visitor'].'&voteSta=3" class="voteLogin">';
                                        }else{
                                            echo '<li  name="/vote/vote_r_dtls?id='.$data_val['idStr'].'&visitor='.$data_val['visitor'].'&voteSta=3" class="voteLogin">';
                                        }
                                    }else{
                                        if($data_val['showType'] == 1) {
                                            echo '<li onclick="window.open(\'/vote/vote_dtls?id=' . $data_val['idStr'] . '&visitor=' . $data_val['visitor'] . '&voteSta=3\')">';
                                        }else{
                                            echo '<li onclick="window.open(\'/vote/vote_r_dtls?id=' . $data_val['idStr'] . '&visitor=' . $data_val['visitor'] . '&voteSta=3\')">';
                                        }
                                    }
                                    echo '<div class="tab_list_c" >
                                        <p class="tit">' . $data_val['title'] . '</p>
                                        <p class="content">
                                            ' . strip_tags($data_val['content']) . '
                                        </p>
                                    </div>
                                    <p>
                                    <p class="tab" ><i><img src="/content/img/tab.png"></i> ' . \common\models\commonEnum::getAllVoteTypeId($data_val['voteType']) . '</p>
                                    <p class="info"><a>' . $data_val['readNum'] . '人阅读 (' . \common\models\commonEnum::getAllVoteVisitorId($data_val['visitor']) . ')</a></p>
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
                </div>
            </div>
            <?php require(__DIR__ . '/../layouts/pageNumbers.php'); ?>
        </div>
    </div>

</div><!-- pc -->

<script type="text/javascript">
    $(document).on("click",".voteLogin",function () { //投票模块
        var url = $(this).context.attributes.name.value;
        window.location.href = url;
    });
</script>





