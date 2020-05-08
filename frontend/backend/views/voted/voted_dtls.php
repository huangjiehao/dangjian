<?php
$session = \Yii::$app->session;
$user_local = json_decode($session->get('user_local'), true);
$userId = $user_local['idStr'];
$userName = $user_local['name'];
$title="投票系统";
echo "<script>document.title = \"".$title."\" </script>";
?>
<link href="/content/plugins/bootstrap-select/bootstrap-select.min.css?v=20181126" rel="stylesheet" type="text/css"/>
<script src="/content/plugins/bootstrap-select/bootstrap-select.js" type="text/javascript"></script>
<link href="/content/css/uncommon/voted.css?v=20181126" rel="stylesheet" type="text/css"/>
<script src="/content/js/uncommon/voted.js" type="text/javascript"></script>


<script type="text/javascript">
    $(function () {
        var h = window.location.href;
        var h1 = h.split('?')[1];
        var h2 = h.split('&')[2];
        var showType = h.split('=')[3];
        if (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) {
            window.location.href = "/voted/voted_list?" + h1;
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
        <div class="common vote_top" style="overflow: visible;">
            <div class="dis_inline text-l">
                <span>参选人数：<s><?php echo sizeof($resultData['votedMemberList']); ?></s></span>
                <span>累积总投票数：<s><?php echo $voteerNum; ?></s></span>
            </div>
            <!--<form role="search" class="navbar-form dis_inline text-c">
                <div class="form-group">
                    <input type="hidden" class="search_params" id="visitor" name="visitor" value="<?php /*echo $resultData['visitor']; */?>"/>
                    <input type="hidden" class="search_params" name="id" id="id" value="<?php /*if(isset($_GET['id'])){echo $_GET['id'];}else{echo '';}*/?>">
                    <input type="text" placeholder="请输入投票人名称" id="findName" class="form-control dis_inline search_params">
                    <button class="btn btn-danger" type="button" onclick="find()">搜索</button>
                </div>
            </form>-->
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
                <div class="entry-content">
                    <div class="con"><?php echo $resultData['content']; ?></div>
                    <!--<p class="time">投票时间：<?php /*echo date("Y-m-d h:i", $resultData['beginTime']); */?>&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;<?php /*echo date("Y-m-d h:i", $resultData['endTime']); */?></p>-->
                    <!--<p class="tips">广州机关委组织部</p>-->
                </div>
            </div>
        </div>

        <!-- 尾部、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、 -->
        <div class="common vote_bot">
            <div class="dis_inline wid"><h2>参选人员</h2></div>
            <div class="dis_inline wid">您剩余:<span><?php echo $resultData['dayNum']; ?></span>票</div>
        </div>
        <div class="common vote_bot">
            <input type="hidden" name="votedMemberId" id="votedMemberId"/>
            <input type="hidden" name="remainNum" id="remainNum" value="<?php echo $rstData['remainNum']; ?>"/>
            <input type="hidden" name="idStr" id="idStr" value="<?=$_GET['id']?>"/>

            <div class="row">
                <?php
                if (!empty($resultData['votedMemberList'])) {
                    foreach ($resultData['votedMemberList'] as $data_k => $data_val) {
//                       \common\models\MyFunction::sun_p($rstData);die;
                        echo '<div class="col-sm-12 col-md-12 col-lg-12  dtls">
                     <div class="allcontent edit" id="f' . $data_val['idStr'] . '">
                         <input type="hidden" id="' . $data_val['idStr'] . '" class="findName" value="' . $data_val['name'] . '">
                         <div class="padd dis_inline">
                             <a class="thumbnail col-sm-6 col-md-4 col-lg-3 no_fl dis_inline" >';
                            if ($data_k < 10) {
                                echo '<i>0' . ($data_k + 1) . '</i>';
                            } else {
                                echo '<i>' . ($data_k + 1) . '</i>';
                            }
                            echo '<div class="divimg">
                                 <img data-src="180x180" alt="100%x180" src=' . $data_val['img'] . ' data-holder-rendered="true" style="height: 180px; width: auto; max-width: 180px; margin: 0 auto; display: block;"></div>
                                
                                 <div class="caption">
                                    <h5 class="gettickets">' . $data_val['name'] . ' （已得票数：<span>' . $data_val['tickets'] . '</span>）</h5>';
                                    if ( $resultData['dayNum']== 0) {//$data_val['tickets'] != 0 &&<span>' . $resultData['dayNum'] . '</span>
                                        echo '<div class="subhead-titie butt gray_bg" data-id="' . $resultData['idStr'] . '" data-mid="' . $data_val['idStr'] . '" onclick="vote(this)">已投票（剩余0票)</div>';
                                    }else{
                                        echo '<div class="subhead-titie butt" data-id="' . $resultData['idStr'] . '" data-mid="' . $data_val['idStr'] . '" onclick="vote(this)">投票（剩余<span>' . $resultData['dayNum'] . '</span>票)</div>';
                                    }
                                 echo '</div>
                             </a>
                         </div>
                         <div class="inside dis_inline">
                             <hgroup>
                                 <h2>' . $data_val['deptName'] . '</h2>
                             </hgroup>
                             <div class="entry-content">
                                 <p class="content">' . $data_val['watchword'] . '</p>
                             </div>
                         </div>
                     </div>
                 </div>';
                    }
                } else {
                    echo '<li style="font-size: 18px;">暂无数据！！！</li>';
                }
                ?>
            </div>
        </div>

        <!-- 分页 -->

    </div>
</div>

<script>
    $(function () {
        $('.select_picker').selectpicker({
            'selectedText': 'cat',
            /* 'actionsBox':true,*/
            'liveSearch': true,
            'noneSelectedText': '--请选择--'
        });
    });
</script>
<style>
    .col-sm-6 {
        margin: 0 !important;
    }
</style>
