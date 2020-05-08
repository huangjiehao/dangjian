<?php
$session = \Yii::$app->session;
$user_local = json_decode($session->get('user_local'), true);
$userId = $user_local['idStr'];
$userName = $user_local['name'];
$title="投票系统";
echo "<script>document.title = \"".$title."\" </script>";
?>
<link href="/content/css/uncommon/voted.css?v=20181126" rel="stylesheet" type="text/css"/>
<script src="/content/js/uncommon/voted.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function () {
        var h = window.location.href;
        var h1 = h.split('?')[1];
        var h2 = h.split('&')[2];
        var showType = h.split('=')[3];
        if (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) {
            if (h.toString().indexOf('voted_list') == -1) {
                window.location.href = "/voted/voted_list?" + h1;
            }
        } else {
            if (h.toString().indexOf('voted_dtls') == -1) {
                if(parseInt(showType) == 1){
                    window.location.href = "/voted/voted_dtls?" + h1;
                }else{
                    if (h.toString().indexOf('voted_list') == -1) {
                        window.location.href = "/voted/voted_list?" + h1;
                    }
                }
            }
        }
    })
</script>
<!-- 头部标题 -->
<div class="vote_tit">
    <p>先进党员评选投票活动</p>
</div>
<!-- 投票管理内容 -->
<input type="hidden" id="userName" name="userName" value="<?=$userName ?>"/>
<input type="hidden" id="dayNum" name="dayNum" value="<?php echo $resultData['dayNum']; ?>"/>
<input type="hidden" id="remainNum" name="remainNum" value="<?php echo $rstData['remainNum']; ?>"/>
<div id="voted">
    <div class="container">

        <!-- 头部、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、 -->
        <div class="common vote_top">
            <div class="dis_inline text-l">
                <span>参选人数：<s><?php echo sizeof($resultData['votedMemberList']); ?></s></span>
                <span>累积总投票数：<s><?php echo $voteerNum; ?></s></span>
            </div>
            <form role="search" class="navbar-form dis_inline text-c">
                <div class="form-group">
                    <input type="hidden" class="search_params" id="visitor" name="visitor" value="<?php echo $resultData['visitor']; ?>"/>
                    <input type="hidden" class="search_params" name="id" id="id" value="<?php if(isset($_GET['id'])){echo $_GET['id'];}else{echo '';}?>">
                    <input type="text" placeholder="请输入投票人名称" id="findName" class="form-control dis_inline search_params">
                    <button class="btn btn-danger" type="button" onclick="find()">搜索</button>
                </div>
            </form>
            <div class="dis_inline text-r personal fr" onclick="logout()">
                <span><i class="dis_inline"></i><?php echo $userName; ?></span>
            </div>

        </div>
        <!-- 中部、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、 -->
        <div class="common vote_mid">
            <div class="inside">
                <hgroup>
                    <h2>投票规则说明</h2>
                </hgroup>
                <div class="entry-content"><?php echo $resultData['content']; ?>
                   <!-- <p class="time">投票时间：<?php /*echo date("Y-m-d", $resultData['beginTime']); */?>
                        至<?php /*echo date("Y-m-d", $resultData['endTime']); */?></p>-->
                    <!--<p class="tips">广州机关委组织部</p>-->
                </div>
            </div>
        </div>
        <?php
        if (isset($resultData['canVote']) && $resultData['canVote'] == 0) {
            if (!empty($resultData['votedMemberList'])) {
                echo '<div style="background: #fff;padding-top:20px;">';
                foreach ($resultData['votedMemberList'] as $i => $val) {
                    echo '<div style="width: 80%;margin: 0 auto;">
                            <span style="vertical-align: top;font-size: 16px; ">' . $val['name'] . '</span>
                            <div style="width:calc(80% - 10px); display: inline-block;*display:inline; *zoom:1;margin-left: 10px;">
                                <div style="position: relative;height: 40px;">
                                    <div class="progress progress-striped active" style="margin-bottom: 30px;">';
                    $tickets = 0;//设变量
                    $tickets += $val['tickets'];
                    if ($resultData['voteCount'] == 0) {
                        echo '<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                             style="width:0%;"></div>
                                            <div class="progress-bar-p" style="left: 0%;top:20px;margin-top: 10px;">' . $val['tickets'] . '票</div>';
                    } else {
                        echo '<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                             style="width:' . (round((($tickets / $resultData['voteCount'] * 100)), 2)) . '%; "></div>
                                            <div class="progress-bar-p" style="left: ' . (round((($tickets / $resultData['voteCount'] * 100)), 2)) . '%; top:20px;margin-top: 10px;">' . $val['tickets'] . '票</div>';
                    }
                    echo '</div>
                                </div>
                            </div>
                        </div>';
                }
                echo '</div>';
            }
        }
        ?>

        <!-- 尾部、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、 remainNum-->
        <div class="common vote_bot" style="padding:8px 15px;">
            <div class="dis_inline wid"><h2>参选人员</h2></div>
            <div class="dis_inline wid">您剩余:<span><?php echo $resultData['dayNum']; ?></span>票</div>
            <!--<div class="dis_inline wid">您余剩:<?php /*echo $rstData['remainNum']; */?>票</div>-->
        </div>
        <div class="common vote_bot">
            <input type="hidden" name="votedMemberId" id="votedMemberId"/>
            <input type="hidden" name="remainNum" id="remainNum" value="<?php echo $rstData['remainNum']; ?>"/>
            <input type="hidden" name="idStr" id="idStr" value="<?=$_GET['id']?>"/>
            <div class="row">
                <?php
                if (!empty($resultData['votedMemberList'])) {
                    foreach ($resultData['votedMemberList'] as $data_k => $data_val) {
//                        \common\models\MyFunction::sun_p($data_val);DIE;
                        echo '<div class="col-sm-6 col-md-4 col-lg-3  edit" id="f' . $data_val['idStr'] . '">
                            <a class="thumbnail">';
                        echo '<div class="divimg"><img data-src="180x180" alt="100%x180" src="' . $data_val['img'] . '" data-holder-rendered="true" style="height: 180px; width: auto; margin: 0 auto; display: block;"></div>
                                <div class="caption">
                                 <input type="hidden" id="' . $data_val['idStr'] . '" class="findName" value="' . $data_val['name'] . '">
                                    <h5 class="gettickets">' . $data_val['name'] . ' （已得票数：<span>' . $data_val['tickets'] . '</span>）</h5>';
                                    /*<h5 class="subhead">' . $data_val['deptName'] . '</h5>*/
                                    if ( $resultData['dayNum']== 0) {
                                        echo '<div class="subhead-titie butt gray_bg" data-id="' . $resultData['idStr'] . '" data-mid="' . $data_val['idStr'] . '" onclick="vote(this)">已投票（剩余0票)</div>';
                                    }else{
                                        echo '<div class="subhead-titie butt" data-id="' . $resultData['idStr'] . '" data-mid="' . $data_val['idStr'] . '" onclick="vote(this)">投票（剩余<span>' . $resultData['dayNum'] . '</span>票)</div>';
                                    }
                                    echo '</div>
                            </a>
                        </div>';
                    }
                } else {
                    echo '暂无数据！！';
                }
                ?>

            </div>
        </div>

        <!-- 分页 -->

    </div>
</div>

<script type="text/javascript">
    $(function () {
        if (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) {
            $(".notices").hide();
            $(".personal").hide();
            $(".vote_mid").css("padding", "15px 5%");
            $(".vote_top .text-l span").css("padding-left", "1.5rem");
            $(".vote_tit").css({"height": "70px"});
            $(".vote_tit p").css("line-height", "70px");
        }
    })
</script>



