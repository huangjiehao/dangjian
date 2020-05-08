<?php
$session = \Yii::$app->session;
$user_local = json_decode($session->get('user_local'), true);
$userId = $user_local['idStr'];
$userName = $user_local['name'];

$title="推荐投票";
echo "<script>document.title = \"".$title."\" </script>";

?>

<link href="/content/css/uncommon/module.css?v=20181126" rel="stylesheet" type="text/css"/>
<script src="/content/js/uncommon/up.js" type="text/javascript"></script>
<script src="/content/js/uncommon/voted.js" type="text/javascript"></script>
<script src="/content/js/uploadfiles/upload.single.js" type="text/javascript"></script>
<script src="/content/js/uploadfiles/upload.js" type="text/javascript"></script>
<style type="text/css">
    .magic-radio + label::before, .magic-checkbox + label::before {
        right: 7px!important;
        left: auto;
        background: #fff;
        top:-32px;
    }
    .magic-checkbox + label:after{
        right: 14px!important;
        left: auto;
        top:-30px;
    }
</style>
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
        <div class="module_top common">
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
                        <li style="border-right: 1px solid #d0cbcb">累积总投票数：<a class="ticketss" style="color: red"><?php echo $voteerNum; ?></a></li>
                        <li >可投票数：
                            <a style="color: red" class="wid">
                                <span><?=$resultData['voteMin']; ?>-<?=$resultData['voteMax']; ?>票</span>
                            </a>
                        </li>
                    </ul>
                    <input type="hidden" name="votedMemberId" id="votedMemberId"/>
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
                    <div class="show">

                    <?php
                    if (!empty($resultData['votedMemberList'])) {
                        foreach ($resultData['votedMemberList'] as $data_k => $data_val) {
                            echo'
                            <div class="row people edit" id="f' . $data_val['idStr'] . '">
                                <input type="hidden" id="' . $data_val['idStr'] . '" class="findName" value="' . $data_val['name'] . '">
                                <div class="personal_headpic dis_inline">';
                                    if ($data_k < 10) {
                                    echo '<i>0' . ($data_k + 1) . '</i>';
                                    } else {
                                        echo '<i>' . ($data_k + 1) . '</i>';
                                    }
                                    if(!empty($data_val['img'])){
                                        echo '<img src="'.(isset(json_decode($data_val['img'],true)['url'])?json_decode($data_val['img'],true)['url']:$data_val['img']).'" width="100%">';
                                    }else{
                                        echo '<img src="/content/images/un_user.jpg" width="100%">';
                                    }

                                    echo '<p class="caption" data-id="' . $data_val['idStr'] . '" data-name="' . $data_val['name'] . '" data-ticket="'.$data_val['tickets'].'"> 
                                        <input type="checkbox" class="magic-checkbox" name="vote' . ($data_k) . '" id="' . ($data_k) . '_vote_' . ($data_k + 1) . '_option_' . ($data_k + 1) . '" data-val="'.($data_k).'" 
                                        ';if($data_val['canVote']==1){echo 'checked ';}
                                        if($resultData['isCan']==1){echo 'disabled';}
                                        echo '/>
                                         <label for="' . ($data_k) . '_vote_' . ($data_k + 1) . '_option_' . ($data_k + 1) . '">
                                            <input type="hidden" id="' . $data_val['idStr'] . '" class="findName" value="' . $data_val['name'] . '">';
                                    echo '</p>';
                                echo '</div>
                                <div class="personal_dtls dis_inline">
                                    <div class="row name">' . $data_val['name'] . '</div>';
                                    if(isset($data_val['watchword'])){
                                        echo '<div class="row info">' .  $data_val['watchword'] . '</div>';
                                    }
                                    if($resultData['isCan']==1){
                                        echo ' <ul class="progress_pro">
                                           <li class="pull-right12">'.$data_val['percentage'].'</li>
                                           <li class="progress progress-mini">
                                             <p style="width: '.$data_val['percentage'].';" class="progress-bar"></p>
                                             <p class="progress-bar-p" style="left: '.$data_val['percentage'].';top:8px;"><b>' . $data_val['tickets'] . '</b>票</p>
                                            </li>
                                        </ul>';
                                    }

                                   /* echo '<div class="row">
                                        <div class="vote_num dis_inline" data-id="'.($data_val['idStr']).'">
                                            <a>' . $data_val['tickets'] . '</a>&nbsp;票&nbsp;&nbsp;
                                        </div>';
                                        echo'</div>';*/
                                echo '</div>
                            </div>';
                        }
                    }
                    ?>
                    <?php
                    if($resultData['isCan']==1){
                        echo '<div class="vote subhead-titie butt tou gray">已投票</div>';
                    }else{
                        echo '<div class="vote subhead-titie butt tou" onclick="vote(this)">投票</div>';
                    }
                    ?>

                    <div style="height: 50px;"></div>
                    </div>


                    <?php
/*                    if(!empty($userName)){
                        echo '<div style="text-align: left;">
                        <span class="tit">用户信息统计</span>
                        <div>
                            <ul class="stat-list">';
                            if (!empty($resultData['votedMemberList'])) {
                                foreach ($resultData['votedMemberList'] as $data_k => $data_val) {
                                    echo '<li class="col-sm-6 fl_none">
                                            <small>' . $data_val['name'] . '</small>
                                            <div class="stat-percent">'.$data_val['tickets'].'票<i class=""></i>
                                            </div>
                                            <div class="progress progress-mini">
                                                <div style="width: '.$data_val['percentage'].';" class="progress-bar"></div>
                                            </div>
                                        </li>';
                                }
                            }
                            echo '</ul>
                            </div>
                        </div>';
                    }
                    */?>


                </div>
            </div>
        </div>

    </div>
</div><!-- pc -->