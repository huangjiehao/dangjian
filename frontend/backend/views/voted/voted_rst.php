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
<!-- 头部标题 -->
<div class="vote_tit">
    <p>推荐评选投票</p>
</div>

<!-- 投票管理内容 -->
<div id="voted">
    <div class="container">
        <!-- 头部、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、 -->
        <div class="common vote_top" style="overflow: visible;">
            <div class="dis_inline text-l">
               <!-- <span>参选人数：<s><?php /*echo $voteAllNum; */?></s></span>
                <span>累积总投票数：<s><?php /*echo $voteerNum; */?></s></span>-->
            </div>
            <form role="search" class="navbar-form dis_inline text-c">
                <div class="form-group">
                    <!--<input type="text" placeholder="请输入投票人名称" id="findName" class="form-control dis_inline" style="">
                    <button class="btn btn-primary" type="button" onclick="find()">搜索</button>-->
                    <select id="findName" name="sign"  class="form-control select_picker dis_inline">
                        <?php
                        if (!empty($resultData['votedMemberList'])) {
                            foreach ($resultData['votedMemberList'] as $data_k => $data_val) {
                                echo '<option value="' . $data_val['name'] . '">' . $data_val['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <button class="btn btn-primary" type="button" onclick="find()">搜索</button>
                </div>
            </form>
            <div class="dis_inline text-r">
                <span class="notices"><i class="fa fa-bell"></i>消息</span>
            </div>
            <div class="dis_inline text-r personal" onclick = "logout()">
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
                </div>
            </div>
        </div>

        <!-- 尾部、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、 -->

        <div class="common vote_bot">
            <h2>参选人员</h2>
            <input type="hidden" name="votedMemberId" id="votedMemberId"/>
            <input type="hidden" name="remainNum" id="remainNum" value="<?php echo $rstData['remainNum']; ?>"/>
            <div class="row">
                <?php
                if (!empty($resultData['votedMemberList'])) {
                    foreach ($resultData['votedMemberList'] as $data_k => $data_val) {
//                       \common\models\MyFunction::sun_p($resultData);die;
                        echo '<div class="col-sm-12 col-md-12 col-lg-12  dtls" id="f'.$data_val['idStr'].'">
                     <div class="allcontent">
                         <div class="padd dis_inline">
                             <a class="thumbnail col-sm-6 col-md-4 col-lg-3 no_fl dis_inline" >';
                        if($data_k<10){
                            echo '<i>0' . ($data_k+1) . '</i>';
                        }else{
                            echo '<i>' . ($data_k+1) . '</i>';
                        }
                        echo '<div class="divimg"><img data-src="180x180" alt="100%x180" src=' . $data_val['img'] . ' data-holder-rendered="true" style="height: 180px; width: auto; max-width: 180px; margin: 0 auto; display: block;"></div>
                                 <div class="caption">
                                    <input type="hidden" id="'.$data_val['idStr'].'" class="findName" value="'.$data_val['name'].'">
                                     <h5>' . $data_val['name'] . '</h5>';
                        if ($data_val['canVote'] == 0) { // 不能投票
                            echo '<div class="subhead-titie butt gray_bg" >已投票</div>';
                        } else if ($resultData['canVote'] == 1) { //可投票
                            echo '<div class="subhead-titie butt" data-id="' . $resultData['idStr'] . '" data-mid="' . $data_val['idStr'] . '" onclick="vote(this)">投票（剩余'.$rstData['remainNum'].'票)</div>';
                        }
                        /* <div class="subhead-titie butt" onclick="vote()"> 投票</div>*/
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
    $(function(){
        $('.select_picker').selectpicker({
            'selectedText': 'cat',
            /* 'actionsBox':true,*/
            'liveSearch': true,
            'noneSelectedText': '--请选择--'
        });
    });
</script>
