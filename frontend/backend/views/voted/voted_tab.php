<?php
$session = \Yii::$app->session;
$user_local = json_decode($session->get('user_local'), true);
$userId = $user_local['idStr'];
$userName = $user_local['name'];
$title="投票系统";
echo "<script>document.title = \"".$title."\" </script>";
?>
<link href="/content/css/uncommon/voted.css?v=20181126" rel="stylesheet" type="text/css"/>
<script src="/content/js/uncommon/up.js" type="text/javascript"></script>
<script src="/content/js/uncommon/voted.js" type="text/javascript"></script>
<!-- 头部标题 -->
<div class="vote_tit">
    <p>推荐评选投票</p>
</div>
<!-- 投票管理内容 -->
<div id="voted">
    <div class="container">
        <!-- 头部、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、 -->
        <div class="common vote_top tab pc"><!-- pc端-->
            <div class="dis_inline text-l">
                <span class="dis_inline tits t_0"><s></s></span>
            </div>
            <form role="search" class="navbar-form dis_inline text-c">
                <div class="form-group">
                    <input type="hidden" class="search_params" id="voteSta" name="voteSta" value="<?php if(isset($_GET['voteSta'])){echo $_GET['voteSta'];}else{echo '';}?>">
                    <input type="text" placeholder="请输入关键词" id="title" name="title" class="form-control dis_inline search_params" value="<?php if(isset($_GET['title'])){echo $_GET['title'];}else{echo '';}?>">
                    <button class="btn btn-primary search_btn" type="button" >搜索</button>
                </div>
            </form>
            <?php if(!empty($userName)){
                echo '<div class="dis_inline text-r personal fr" onclick="logout()">
                    <span><i class="dis_inline"></i>'.$userName.'</span>
                </div>';
            }
            ?>

            <!--<input type="hidden" id="voteSta" value="<?PHP /*ECHO $_GET['voteSta'] */?>">-->
        </div>
<!--        <div class="common vote_top tab hand"><!-- 手机端-->
<!--            <input type="hidden" id="voteSta" value="--><?PHP //ECHO $_GET['voteSta'] ?><!--">-->
<!--            <form role="search" class="navbar-form dis_inline text-c">-->
<!--                <div class="form-group">-->
<!--                    <input type="text" placeholder="请输入关键词" id="title" class="form-control dis_inline" style="">-->
<!--                    <button class="btn btn-primary" type="button" onclick="findTitle()">搜索</button>-->
<!--                </div>-->
<!--            </form>-->
<!---->
<!--        </div>-->

        <!-- 中部、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、 -->
       <!-- <div class="common vote_middle pc">
            <input type="hidden" class="search_params" name="type" value="">
            <ul class="tabHead" data-active-name="type">
                <li data-active="3" class="item <?php /*if ($_GET['voteSta'] == 3) {
                    echo 'active';
                } */?>">推荐投票
                </li>
                <li data-active="0" class="<?php /*if ($_GET['voteSta'] == 0) {
                    echo 'active';
                } */?>">基层评议
                </li>
                <li data-active="1" class="<?php /*if ($_GET['voteSta'] == 1) {
                    echo 'active';
                } */?>">活动投票
                </li>
                <li data-active="2" class="<?php /*if ($_GET['voteSta'] == 2) {
                    echo 'active';
                } */?>">先进党员
                </li>
            </ul>
        </div>-->
        <!--<div class="common vote_middle hand">
            <input type="hidden" class="search_params" name="type" value="">
            <div class="article_tags">
                <ul class="tabHead tagcns"  data-active-name="type">
                    <li data-active="3" class="item" <?php /*if ($_GET['voteSta'] == 3) {
                        echo 'style="background-color: #b61412;color:#fff;" ';
                    } */?>>推荐投票
                    </li>
                    <li data-active="0" class="item" <?php /*if ($_GET['voteSta'] == 0) {
                        echo 'style="background-color: #b61412;color:#fff;" ';
                    } */?>>基层评议
                    </li>
                    <li data-active="1" class="item" <?php /*if ($_GET['voteSta'] == 1) {
                        echo 'style="background-color: #b61412;color:#fff;" ';
                    } */?>>活动投票
                    </li>
                    <li data-active="2" class="item" <?php /*if ($_GET['voteSta'] == 2) {
                        echo 'style="background-color: #b61412;color:#fff;" ';
                    } */?>>先进党员
                    </li>
                </ul>
            </div>
        </div>-->

        <!-- 尾部、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、 -->
        <div class="common vote_bott container_col">
            <div class="row">
                <div class="col-sm-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active" data-cur="1"><a data-toggle="tab" href="#tab-1" aria-expanded="true">最新投票</a>
                            </li>
                           <!-- <li class="" data-cur="3"><a data-toggle="tab" href="#tab-2" aria-expanded="false">已结束</a>
                            </li>
                            <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">结果公布</a>
                            </li>-->
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <ul class="newslist">
                                        <?php
                                        if (!empty($data['portalVoteList'])) {//<b class="tit_2">投票时间：' . date("Y-m-d", $data_val['createTime']) . ' - ' . date("Y-m-d", $data_val['endTime']) . '</b>
                                            foreach ($data['portalVoteList'] as $data_i => $data_val) {
//                                              \common\models\MyFunction::sun_p($data_val);DIE;
                                                if(!empty($userName)){
                                                    if( $data_val['visitor']==1){
                                                        echo '<li id="' . $data_val['idStr'] . '" onclick="return dtls(id,'.$data_val['visitor'].',' . $data_val['showType'] . ');">';
                                                    }else if($data_val['visitor']==0){
                                                        echo '<li id="' . $data_val['idStr'] . '" onclick="return dtls(id,'.$data_val['visitor'].',' . $data_val['showType'] . ');">';
                                                    }
                                                }else{
                                                    echo '<li id="' . $data_val['idStr'] . '" onclick="return dtls(id,'.$data_val['visitor'].',' . $data_val['showType'] . ');">';
                                                }


                                                echo '<b class="tit"><a>' . $data_val['title'] . '</a></b>
                                                   
                                                   <b class="tit_3"><i class="fa fa-tags"></i>' . \common\models\commonEnum::getAllVoteTypeId($data_val['voteType']) . '</b>
                                                   <span class="dis_inline tit_4">' . $data_val['readNum'] . '人阅读 (' . \common\models\commonEnum::getAllVoteVisitorId($data_val['visitor']) . ')</span>
                                                </li>';
                                            }
                                        } else {
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
                                    <ul class="newslist">
                                        <?php
                                        if (!empty($jsData['portalVoteList'])) {
                                            foreach ($jsData['portalVoteList'] as $data_i => $data_val) {
//                                              \common\models\MyFunction::sun_p($data_val);DIE;
                                                echo '<li id="' . $data_val['idStr'] . '" onclick="return dtls(id,'.$data_val['visitor'].',' . $data_val['showType'] . ');">';
                                                echo '<b class="tit"><a>' . $data_val['title'] . '</a></b>
                                                   <b class="tit_2">投票时间：' . date("Y-m-d", $data_val['createTime']) . ' - ' . date("Y-m-d", $data_val['endTime']) . '</b>
                                                   <b class="tit_3"><i class="fa fa-tags"></i>' . \common\models\commonEnum::getAllVoteTypeId($data_val['voteType']) . '</b>
                                                   <span class="dis_inline tit_4">' . $data_val['readNum'] . '人阅读</span>
                                                   <span class="dis_inline tit_4">' . \common\models\commonEnum::getAllVoteVisitorId($data_val['visitor']) . '</span>
                                                </li>';
                                            }
                                        } else {
                                            echo '<div class="nodata">
                                                <p><img src="/content/images/nodata.png"></p><p>暂无数据</p>
                                            </div>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div id="tab-3" class="tab-pane">
                                <div class="panel-body">
                                    <ul class="newslist">
                                        <?php
                                        if (!empty($data['portalVoteList'])) {
                                            foreach ($data['portalVoteList'] as $data_i => $data_val) {
//                                              \common\models\MyFunction::sun_p($data_val);DIE;
                                                echo '<li id="' . $data_val['idStr'] . '" onclick="return dtls(id,'.$data_val['visitor'].',' . $data_val['showType'] . ');">';
                                                echo '<b class="tit"><a>' . $data_val['title'] . '</a></b>
                                                   <b class="tit_2">投票时间：' . date("Y-m-d", $data_val['createTime']) . ' - ' . date("Y-m-d", $data_val['endTime']) . '</b>
                                                   <b class="tit_3"><i class="fa fa-tags"></i>' . \common\models\commonEnum::getAllVoteTypeId($data_val['voteType']) . '</b>
                                                   <span class="dis_inline tit_4">' . $data_val['readNum'] . '人阅读</span>
                                                </li>';
                                            }
                                        } else {
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

            </div>
        </div>
        <!-- 分页 -->

    </div>
</div>
<script>
    $(function () {
        $(".ly_min").css("display", "none");
        $("#ly_menu").css("display", "none");
        $("#ly_footer").css("display", "none");//去掉头部尾部
    });

    $(".tabHead li").click(function () {  //投票状态

        var arr = [];
        arr.push('voteSta=' + $(this).data("active"));
        var param = '';
        if (arr.length > 0) {
            param = '?' + arr.join('&');
        }
        var url = window.location.href;
        if (url.indexOf('?')) {
            url = url.split('?')[0];
        }
        location.href = url + param;
    });

    function dtls(id,visitor,showType) {
        if(showType==1){
            if(/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) {
                window.location.href = "/voted/voted_list?id="+id+"&visitor="+visitor+"&showType=0";
            } else {
                window.location.href = "/voted/voted_dtls?id="+id+"&visitor="+visitor+"&showType=1";
            }
        }else{
            if(/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) {
                window.location.href = "/voted/voted_list?id="+id+"&visitor="+visitor+"&showType=0";
            } else {
                window.location.href = "/voted/voted_list?id="+id+"&visitor="+visitor+"&showType=0";
            }
        }
    }

    function undtls(id,visitor,showType) {
        swal({
            title: "游客,请先退出登录！",
            type: "warning",
            confirmButtonText: "确定"
        });
    }

</script>