<?php
$session = \Yii::$app->session;
$user_local = json_decode($session->get('user_local'), true);
$userId = $user_local['idStr'];
$userName = $user_local['name'];

$title="推荐投票";
echo "<script>document.title = \"".$title."\" </script>";

?>


<script src="/content/js/uncommon/up.js" type="text/javascript"></script>
<script src="/content/js/uncommon/voted.js" type="text/javascript"></script>
<script src="/content/js/uploadfiles/upload.single.js" type="text/javascript"></script>
<script src="/content/js/uploadfiles/upload.js" type="text/javascript"></script>
<link href="/content/css/uncommon/module.css?v=20181126" rel="stylesheet" type="text/css"/>
<!-- pc端 -->
<div class="pc">
    <input type="hidden" id="userName" name="userName" value="<?=$userName ?>"/>
    <input type="hidden" id="userId" name="userId" value="<?=$userId ?>"/>
    <input type="hidden" id="idStr" name="idStr" value="<?=$_GET['id'] ?>"/>
    <input type="hidden" id="visitor" name="visitor" value="<?=$_GET['visitor']; ?>"/>
    <input type="hidden" id="voteMin" name="voteMin" value="<?=$resultData['voteMin']; ?>"/>
    <input type="hidden" id="voteMax" name="voteMax" value="<?=$resultData['voteMax']; ?>"/>
    <input type="hidden" id="resultDataId" name="resultDataId" value="<?=$resultDataId; ?>"/>
    <input type="hidden" id="checkedIds" name="checkedIds" value=""/>

    <div class="container">
        <div class="module_top">
            <span class="img"></span>
            <ul class="personal" >
                <?php if(!empty($userName)){
                    echo '<li>欢迎您，'.$userName.' <img src="/content/img/tou.png"/></li>
                        <li onclick="return logout();">
                            <i class="logout">
                            <img src="/content/img/close.png"></i>退出登录
                        </li>';
                }
                ?>
                <li onclick="javascript:window.location.href='/vote/vote_list?voteSta=3'"><i class="main"><img src="/content/img/back_main.png"></i>返回列表</li>
            </ul>
        </div>
    </div>

    <div class="container"><!-- 内容展示 -->
        <div class="common">
            <div class="vote">
                <div class="vote_head">
                    <div class="headlog">
                        <img src="/content/img/vote_headlog.png">
                    </div>
                    <a style="font-size: 22px;color: red"><?php echo $resultData['title']; ?></a>
                    <ul class="vote_list">
                        <li style="border-right: 1px solid #d0cbcb">参选人数：<a style="color: red"><?php echo sizeof($resultData['votedMemberList']); ?></a></li>
                        <li style="width: 160px;">累积总投票数：<a class="ticketss" style="color: red"><?php echo $voteerNum; ?></a></li>
                        <li>可投票数：
                            <a style="color: red" class="wid">
                                <span><?=$resultData['voteMin']; ?>-<?=$resultData['voteMax']; ?>票</span>
                            </a>
                        </li>
                    </ul>
                    <input type="hidden" name="votedMemberId" id="votedMemberId"/>
                    <input type="hidden" name="idStr" id="idStr" value="<?=$_GET['id']?>"/>
                </div>
                <div class="rule">
                    <div class="rule_logo">
                        <img src="/content/img/vote_headrule.png">
                    </div>
                    <div class="rule_detail">
                        <ul>
                            <li><?php echo $resultData['content']; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="show_list">
                    <span class="tit">参选人员</span>
                    <div class=" vote_bot">
                        <input type="hidden" name="votedMemberId" id="votedMemberId"/>
                        <div class="row">
                            <?php
                            if (!empty($resultData['votedMemberList'])) {
                                foreach ($resultData['votedMemberList'] as $data_k => $data_val) {
//                                    \common\models\MyFunction::sun_p($data_val);DIE;
                                     echo '<div class="col-sm-6 col-md-4 col-lg-3  edit" id="f' . $data_val['idStr'] . '">';
                                     echo '<a class="thumbnail" >';
                                     if(isset($data_val['watchword'])) {
                                         echo '<p class="divimg" title="' . $data_val['watchword'] . '">';
                                     }else{
                                         echo '<p class="divimg" title="暂无数据">';
                                     }
                                        if($data_k<10){
                                            echo '<i>0'.($data_k+1).'</i>';
                                        }else{
                                            echo '<i>'.($data_k+1).'</i>';
                                        }
                                           /* <span class="ue" style="display: inline;">' . $data_val['name'] . '</span>';*/
                                    if(!empty($data_val['img'])){
                                        echo '<img data-src="180x180" alt="100%x180" width="100%" src="'.(isset(json_decode($data_val['img'],true)['url'])?json_decode($data_val['img'],true)['url']:$data_val['img']).'" data-holder-rendered="true" style=" margin: 0 auto; display: block;">';
                                    }else{
                                        echo '<img src="/content/images/un_user.jpg" width="100%">';
                                    }

                                    echo '</p>';
                                    if($resultData['isCan']==1){
                                        echo ' <ul class="progress_pro">
                                           <li class="pull-right12">'.$data_val['percentage'].'</li>
                                           <li class="progress progress-mini">
                                             <p style="width: '.$data_val['percentage'].';" class="progress-bar"></p>
                                             <p class="progress-bar-p" style="left: '.$data_val['percentage'].';top:8px;"><b>' . $data_val['tickets'] . '</b>票</p>
                                            </li>
                                        </ul>';
                                    }

                                    echo '<p class="caption" data-id="' . $data_val['idStr'] . '" data-name="' . $data_val['name'] . '" data-ticket="'.$data_val['tickets'].'"> 
                                        <input type="checkbox" class="magic-checkbox" name="vote' . ($data_k) . '" id="' . ($data_k) . '_vote_' . ($data_k + 1) . '_option_' . ($data_k + 1) . '" data-val="'.($data_k).'" ';
                                            if($data_val['canVote']==1){echo 'checked ';}
                                            if($resultData['isCan']==1){echo 'disabled';}
                                        echo '/>
                                        <label for="' . ($data_k) . '_vote_' . ($data_k + 1) . '_option_' . ($data_k + 1) . '">
                                            
                                     <input type="hidden" id="' . $data_val['idStr'] . '" class="findName" value="' . $data_val['name'] . '">
                                        <h5 class="gettickets">' . $data_val['name'] . ' </h5>';
                                        /*<h5 class="subhead">' . $data_val['deptName'] . '</h5>*/
                                    echo '</p>
                                    </a>
                                </div>';
                                }
                            } else {
                                echo '暂无数据！！';
                            }
                            ?>

                        </div>
                        <?php
                        if($resultData['isCan']==1){
                            echo '<div class="vote subhead-titie butt tou gray">已投票</div>';
                        }else{
                            echo '<div class="vote subhead-titie butt tou" onclick="vote(this)">投票</div>';
                        }
                        ?>

                        <div style="height: 50px;"></div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div><!-- pc -->
<div class="overfloat" id="gui_kai">
    <div class="guize_html">
  <span class="guize_html_nei">
    <h3><br>个人信息详情</h3>
    <p></p>
    </span>
        <div id="g_close" class="btn">关闭</div>
    </div>
</div>
<style type="text/css">
    .guize_html{position:fixed;top:25%;left:50%;margin-top:-80px;margin-left:-159px;width:318px;height:auto;border-radius:4px;background-color:#fff;color:#000;text-align:center;font-size:12px}
    .guize_html p{padding:0 10px;text-align:left;text-indent:2em}
    .guize_html_nei{width:318px;min-height:350px;overflow-y:auto;max-height:500px;height:350px;display:block;overflow-y:scroll}
    .btn{display:block;margin:10px auto;width:240px;height:40px;border-radius:4px;background-color:#3485ff;color:#fff;text-align:center;line-height:26px;cursor:pointer}
    .overfloat{position:fixed;top:0;left:0;z-index:9;display:none;width:100%;height:100%;background-color:rgba(1,1,1,.5)}
    #gui_kai{ display: none;}
</style>
<script type="text/javascript">
    $(document).on('click','.divimg',function () {
        var thumbnail = $(this)[0].attributes[1].value;
        $(".guize_html_nei p").text(thumbnail);
        $("#gui_kai").show();
    });

    $('#g_close').click(function(){
        $("#gui_kai").hide();
    });

</script>
