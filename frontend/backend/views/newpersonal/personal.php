<?php
use yii\helpers\Html;
use common\models\MyFunction;
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['name'];
$loginName = $user_msginfo['loginName'];
$pwd = $session->get('pwd');
$userId = $user_msginfo['idStr'];
$roleid=$user_msginfo['userRoleIds'];
$userLevel = $user_msginfo['userLevel'];
$userOrgName = $user_msginfo['orgName'];
$userOrgType = $user_msginfo['orgType'];
$userOrgType = $user_msginfo['orgType'];
$hasPrivilege = $session->get('hasPrivilege');
$img = $user_msginfo['img'];
$userType=$user_msginfo['userType'];
if ($hasPrivilege == 1) {
    $user_privilege_tree = $session->get('user_privilege_tree-font');
}
//$backurl='http://'.MyFunction::get_sld_name() .'.'. HTTP_DOMAIN  ;
$backurl='http://'.HTTP_DOMAIN  ;
?>
<!--<textarea id="privilegeTree"style="display: none">--=json_encode($user_privilege_tree)<!--</textarea>-->
<input type="hidden" id="HTTP_DOMAIN" value="<?php echo HTTP_BACKEND ?>">
<!--<input type="hidden" id="userid" value="--><?//= html::encode($userId) ?><!--">-->
<!--<input type="hidden" id="roleid" value="--><?//= $roleid ?><!--">-->
<!--<input type="hidden" id="userType" value="--><?//= $userType ?><!--">-->
<link href="/content/css/uncommon/newpersonal.css" rel="stylesheet">
<script src="/content/js/uncommon/newpersonal.js" type="text/javascript"></script>
<script src="/content/js/jquery-easing.1.3.js" type="text/javascript"></script>
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title" id="myModalLabel" style="text-align:center;">生日贺卡</h2>
            </div>
            <div class="modal-body"><!--全屏滚动-->
                <?php
                if(!empty($birthdayData)){
                    echo '<input type="hidden" id="infoTitle" value="'.$birthdayData['infoTitle'].'"/>';
                    echo '<p>'.$birthdayData['infoContent'].'</p>
                        <p>'.$birthdayData['birthdayCard']['cardName'].'</p>
                        <p style="overflow: hidden;">';
                    if(!empty($birthdayData['birthdayCard']['cardImgJson'])) {
                        foreach (json_decode($birthdayData['birthdayCard']['cardImgJson']) as $pic_k => $pic_val) {
                            echo '<img alt="'.$birthdayData['infoTitle'].'" src="' .$pic_val->url. '"/>';
                        }
                    }
                    echo '</p>';
                }
                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="btn" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- 结束触发模态框 -->
<div id="main">

    <!-- 个人详情 -->
    <div id="personal">
        <div class="per_l dis_inline">
            <img onClick="window.open('/user/user_add?edit=1&id=<?=html::encode($userId) ?>')" src="<?php  if(isset($img)&&!empty($img)){
                if(isset(json_decode($img)->url)){
                    echo json_decode($img)->url; //获取json接口返回的数据，取出url地址
                }else{
                    echo $img;
                }
            }else{
                echo '/content/images/tou_default.png';
            }?>" width="122" height="122"/>
            <!--<img class="dis_inline hvr-rectangle-out" src="/content/images/personal.png"> text-c per_btn dis_inline per-btn-out-->
            <?php if (!empty($resultData['infoData'])) {
                echo '<ul class="dis_inline">
                    <li><span style="font-size: 22px!important;">' . $user_msginfo['name'] . '</span><span>个人积分：' . $resultData['infoData']['personalPoint'] . '</span></li>
                    <li><span>' . $userOrgName . '</span><span>' . $userOrgType . '</span></li>
                    <li class="btn btn-info" onclick="window.location.href=\'/user/user_update_pwd\'" style="margin-left: 25px;">修改密码</li> 
                     <li class="btn btn-warning" onclick="logout();">退出</li>
                </ul>';
            }
            ?>
        </div>
        <div class="per_r dis_inline">
            <ul>
                <li class="green"
                    onclick="window.open('<?php echo $backurl ?>/account/index?p=274133131290873891&first=280482130524508165&second=280484236425826588&fontend=1&loginName=<?= $loginName ?>&pwd=<?= html::encode($pwd) ?>')">
                    <i class="fl"></i>
                    <p class="fr"><span class="text-r dsblock">待办事项</span><span
                                class="text-r dsblock txt"><?php if(isset($resultData['arngmtData'])){echo $resultData['arngmtData']['disdoneCount'];}  ?></span></p>
                </li>
                <!--                <li class="red">-->
                <!--                    <i class="fl"></i>-->
                <!--                    <p class="fr"><span class="text-r dsblock">在办事项</span><span class="text-r dsblock txt">3</span></p>-->
                <!--                </li>-->
                <li class="gray"
                    onclick="window.open('<?php echo $backurl ?>/account/index?p=274133131290873891&first=280482130524508165&second=280517675451551749&fontend=1&loginName=<?= $loginName ?>&pwd=<?= html::encode($pwd) ?>&isConfirm=1')">
                    <i class="fl"></i>
                    <p class="fr"><span class="text-r dsblock">已办事项</span><span
                                class="text-r dsblock txt"><?php if(isset($resultData['arngmtData'])){echo $resultData['arngmtData']['hasdoneCount'];}  ?></span></p>
                </li>
            </ul>
        </div>
    </div>

    <!-- 工作区 -->
    <div class="work workspace">
            <?php
            if (isset($user_privilege_tree)) {
                echo '<div class="work_green dis_inline">
                        <div class="wenzi"><p class="shuli">工作区</p></div>
                    </div><ul id="privilegeList" class="greenUl dis_inline">';
            } ?>

            <?php
            if (isset($user_privilege_tree)) {
                foreach ($user_privilege_tree as $i => $item) {
                    echo '
                    <li data-id="' . $item['id'] . '" 
                        data-parent-id="' . $item['parentId'] . '" 
                        data-root-id="' . $item['rootId'] . '" 
                        data-url="' . $item['url'] . '" >
                        <p class="' . $item['frontClassName'] . '"><i></i></p>
                        <p>' . $item['name'] . '</p>
                    </li>
                    ';
                }
            } ?>
            <!--<li class="no-click volunteer" onClick="window.open('https://www.gdzyz.cn/')">
                <p class="work_i hvr-rectangle-out volunteer-icon"><i class=""></i></p>
                <p>I志愿</p>
            </li>
            <li class="no-click centerParty" onClick="window.open('https://zhtj.youth.cn/zhtj/login/init.do')">
                <p class="work_i hvr-rectangle-out centerparty-icon"><i class=""></i></p>
                <p>团中央</p>
            </li>-->
<!--            <li class="no-click">-->
<!--                <p class="work_i more"><i class="more"></i></p>-->
<!--                <p>更多+</p>-->
<!--            </li>-->
        </ul>
    </div>

    <!-- 档案区 -->
    <div class="work workFilePlace">
        <div class="work_og dis_inline">
            <div class="wenzi"><p class="shuli">档案袋</p></div>
        </div>
        <ul class="ogUl dis_inline">
            <li onclick="openFullWindow('<?php echo $backurl ?>/activity/activity_log?userId=<?= $userId ?>')">
                <p class="work_i hvr-rectangle-out og log"><i class=""></i></p>
                <p>三会一课记录</p>
            </li>
            <li onclick="openFullWindow('<?php echo $backurl ?>/org/user_dues_rec_list?userId=<?= $userId ?>')" >
                <p class="work_i hvr-rectangle-out og moneylog"><i class=""></i></p>
                <p>党费缴纳记录</p>
            </li>
            <li onclick="openFullWindow('<?php echo $backurl ?>/exam/maker_score_per?userId=<?= $userId ?>')">
                <p class="work_i hvr-rectangle-out og kaohe"><i class=""></i></p>
                <p>考试记录</p>
            </li>
<!--            <li>-->
<!--                <p class="work_i more"><i class="more"></i></p>-->
<!--                <p>更多+</p>-->
<!--            </li>-->
        </ul>
    </div>

    <!-- 工具箱 -->
    <div class="work">
        <div class="work_pur dis_inline">
            <div class="wenzi"><p class="shuli">工具箱</p></div>
        </div>
        <ul class="purUl dis_inline">
<!--            <li class="toolplace">-->
<!--                <p class="work_i hvr-rectangle-out pur dangfei"><i class=""></i></p>-->
<!--                <p>交纳党费</p>-->
<!--            </li>-->
<!--            <li class="toolplace" onClick="window.open('/mailbox/mailbox#党群服务')">-->
<!--                <p class="work_i hvr-rectangle-out pur mailbox-icon"><i class=""></i></p>-->
<!--                <p>书记信箱</p>-->
<!--            </li>-->
             <li onClick="window.open('/personal/message_box#grzx')">
                 <p class="work_i hvr-rectangle-out pur boxMes"><i class=""></i></p>
                 <p>留言箱</p>
             </li>
            <li onClick="window.open('/development/personal_development?idStr=<?=html::encode($userId) ?>#党群服务')">
                <p class="work_i hvr-rectangle-out pur developapply-icon"><i class=""></i></p>
                <p>入党申请</p>
            </li>
            <li onClick="window.open('/personal/exam_list?idStr=<?=html::encode($userId) ?>&state=0#党群服务')">
                <p class="work_i hvr-rectangle-out pur kaoshi"><i class=""></i></p>
                <p>考试系统</p>
            </li>
            <li onClick="window.open('/question/question_list?idStr=<?/*=html::encode($userId) */?>&state=0#问卷调查')">
                <p class="work_i hvr-rectangle-out pur diaocha"><i class=""></i></p>
                <p>问卷调查</p>
            </li>
            <!--  <li>
                  <p class="work_i hvr-rectangle-out pur xinde"><i class=""></i></p>
                  <p>学习心得</p>
              </li>-->
            <!--  <li class="toolplace" onClick="window.open('/personal/personal_mid#党群服务')">
                  <p class="work_i hvr-rectangle-out pur integral-icon"><i class=""></i></p>
                  <p>党员积分管理卡</p>
              </li>-->
            <li onclick="window.open('/personal/personal_mid?idStr=#党群服务')">
                <p class="work_i hvr-rectangle-out pur integral-icon"><i class=""></i></p>
                <p>党员积分管理卡</p>
            </li>

            <!-- <li onClick="window.open('/vote/vote_list?voteSta=0')">
                  <p class="work_i hvr-rectangle-out pur vote"><i class=""></i></p>
                  <p>投票管理</p>
              </li>-->

            <li onClick="window.open('/vote/vote_list?voteSta=3#党群服务')">
                <p class="work_i hvr-rectangle-out pur vote"><i class="vote"></i></p>
                <p>投票管理</p>
            </li>
            <li onClick="window.open('/answer/answer_list#党群服务')">
                <p class="work_i hvr-rectangle-out pur knowledge"><i class=""></i></p>
                <p>知识库</p>
            </li>

            <!--            <li onClick="window.open('/uncorrupted/uncorrupted')">-->
            <!--                <p class="work_i hvr-rectangle-out pur mailbox-icon"><i class=""></i></p>-->
            <!--                <p>廉洁举报</p>-->
            <!--            </li>-->
            <li onClick="window.open('/onlineanswer/onlineanswer#党群服务')">
                <p class="work_i hvr-rectangle-out pur mailbox-icon"><i class=""></i></p>
                <p>在线答疑</p>
            </li>

                <li onClick="window.open('/wish/wish_list?type=0#grzx')">
                    <p class="work_i hvr-rectangle-out pur integral-icon"><i class=""></i></p>
                    <p>微心愿</p>
                </li>
                <li onClick="window.open('/wish/wish_fw?type=0#grzx')">
                    <p class="work_i hvr-rectangle-out pur integral-icon"><i class=""></i></p>
                    <p>党群服务</p>
                </li>
<!--            <li onClick="window.open('/rescue/rescue_list?type=0')">-->
<!--                <p class="work_i hvr-rectangle-out pur integral-icon"><i class=""></i></p>-->
<!--                <p>申请救助</p>-->
<!--            </li>-->
            <li onClick="window.open('/donation/donation_list')">
                <p class="work_i hvr-rectangle-out pur integral-icon"><i class=""></i></p>
                <p>爱心捐献</p>
            </li>
            <!--<li onClick="window.open('/vote/vote_rst')">
                <p class="work_i hvr-rectangle-out pur integral-icon"><i class=""></i></p>
                <p>投票结果</p>
            </li>

            <li onClick="window.open('/info/info')">
                <p class="work_i hvr-rectangle-out pur integral-icon"><i class=""></i></p>
                <p>信息展示</p>
            </li>-->
<!--            <li onClick="window.open('/demonstration/demonstration')">-->
<!--                <p class="work_i hvr-rectangle-out pur integral-icon"><i class=""></i></p>-->
<!--                <p>个人示范岗自评</p>-->
<!--            </li>-->
<!--            <li>-->
<!--                <p class="work_i more"><i class="more"></i></p>-->
<!--                <p>更多+</p>-->
<!--            </li>-->
        </ul>
    </div>

    <!-- 我的积分 -->
    <div id="integral">
        <div class="mar_l_r">
            <!-- <p>我的积分</p>-->
            <div class="int un_pa">
                <p class="tit">在线学习平台个人积分</p>
                <div class="int_l un_pa_r">
                    <?php if (!empty($resultData['infoData']['personalScoreResult'])) {
//                        \common\models\MyFunction::sun_p($resultData['infoData']['personalScoreResult']);DIE;
                        echo '<p><span>选修</span><span>已获积分：' . $resultData['infoData']['personalScoreResult']['stuChoice'] . '分</span>
                        <span>总分：' . $resultData['infoData']['personalScoreResult']['stuChoiceSum'] . '分</span>';
                        if ($resultData['infoData']['personalScoreResult']['stuChoiceSum'] != 0) { //判断选修总分是否为0
                            echo '<span>当前总进度：' . (round((($resultData['infoData']['personalScoreResult']['stuChoice'] / $resultData['infoData']['personalScoreResult']['stuChoiceSum'] * 100)), 2)) . '%</span></p>';
                        } else {
                            echo '<span>当前总进度：0%</span></p>';
                        }
                        if ($resultData['infoData']['personalScoreResult']['stuChoiceSum'] != 0) { //判断选修总分是否为0
                            echo '<div style="position: relative;">
                                <div class="progress progress-striped active">
                                    <div style="width: ' . (round((($resultData['infoData']['personalScoreResult']['stuChoice'] / $resultData['infoData']['personalScoreResult']['stuChoiceSum'] * 100)), 2)) . '%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="75" role="progressbar" class="progress-bar progress-bar-danger">
                                        <p class="progress-bar-p" style="left: ' . (round((($resultData['infoData']['personalScoreResult']['stuChoice'] / $resultData['infoData']['personalScoreResult']['stuChoiceSum'] * 100)), 2)) . '%;top:32px;">' . $resultData['infoData']['personalScoreResult']['stuChoice'] . '分</p>
                                    </div>
                                </div>
                            </div>';
                        } else {
                            echo '<div style="position: relative;">
                                <div class="progress progress-striped active">
                                    <div style="width: 0%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="75" role="progressbar" class="progress-bar progress-bar-danger">
                                        <p class="progress-bar-p" style="left:0%;top:32px;">' . $resultData['infoData']['personalScoreResult']['stuChoice'] . '分</p>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                    ?>

                </div>
                <div class="int_r un_pa_r m_b">
                    <?php if (!empty($resultData['infoData']['personalScoreResult'])) {
                        echo '<p><span>必修</span><span>已获积分：' . $resultData['infoData']['personalScoreResult']['stuMust'] . '分</span><span>总分：' . $resultData['infoData']['personalScoreResult']['stuMustSum'] . '分</span>';
                        if ($resultData['infoData']['personalScoreResult']['stuMustSum'] != 0) { //判断必修总分是否为0
                            echo '<span>当前总进度：' . (round((($resultData['infoData']['personalScoreResult']['stuMust'] / $resultData['infoData']['personalScoreResult']['stuMustSum'] * 100)), 2)) . '%</span></p>';
                        } else {
                            echo '<span>当前总进度：0%</span></p>';
                        }
                        if ($resultData['infoData']['personalScoreResult']['stuMustSum'] != 0) { //判断必修总分是否为0
                            echo '<div style="position: relative;">
                                <div class="progress progress-striped active">
                                    <div style="width: ' . (round((($resultData['infoData']['personalScoreResult']['stuMust'] / $resultData['infoData']['personalScoreResult']['stuMustSum'] * 100)), 2)) . '%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="75" role="progressbar" class="progress-bar progress-bar-danger">
                                        <p class="progress-bar-p" style="left: ' . (round((($resultData['infoData']['personalScoreResult']['stuMust'] / $resultData['infoData']['personalScoreResult']['stuMustSum'] * 100)), 2)) . '%;top:32px;">' .$resultData['infoData']['personalScoreResult']['stuMust'] . '分</p>
                                    </div>
                                </div>
                            </div>';
                        } else {
                            echo '<div style="position: relative;">
                                <div class="progress progress-striped active">
                                    <div style="width: 0%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="75" role="progressbar" class="progress-bar progress-bar-danger">
                                        <p class="progress-bar-p" style="left:0%;top:32px;">' . $resultData['infoData']['personalScoreResult']['stuMust'] . '分</p>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- 我的学习任务 -->
            <div id="task">
                <p class="mytask">我的学习任务</p>
                <div class="line1">
                    <div class="line2 theme" style="width: 120px;"></div>
                </div>
                <ul id="container" class="clearfix mm1">
                    <?php if ($resultData['infoData']['personalClassResult']['listStudyInfo']) {
                        foreach ($resultData['infoData']['personalClassResult']['listStudyInfo'] as $data_k => $data_val) {
                            $crlmPrc = $data_val['crlmPrc'];
                            $crlmPrcArr = json_decode($crlmPrc, true);
                            $crlmPrcUrl = $crlmPrcArr[0]['url'];
                            echo '<li onClick="window.open(\'/course/course_dtls?idStr=' . html::encode($data_val['idStr']) . '&courseName=' . html::encode($data_val['name']) . '#在线学习\')">
                                <!--<img class="img" src="/content/images/huodong1.png">-->
                                <img src="';
                            if (!empty($crlmPrcUrl)) {
                                echo $crlmPrcUrl;
                            } else {
                                echo '/content/images/default.png';
                            }
                            echo '" width="210" height="150" style="margin-bottom:40px;" alt="' . html::encode($data_val['name']) . '" />
                                <div class="learnMust">
                                    <span>' . \common\models\commonEnum::getCrlmPty($data_val['crlmPty']) . '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span>' . date("Y-m-d", html::encode($data_val['createTime'])) . '发布</span>
                                </div>
                                <p>
                                    <span>' . html::encode($data_val['name']) . '</span>
                                    <i></i>
                                </p>
                            </li>';
                        }
                    }
                    ?>
                </ul>
            </div>

            <!-- 推荐学习 -->
            <!-- <div id="learns">
                 <p class="mytask">推荐学习</p>
                 <div class="line1">
                     <div class="line2 theme" style="width: 80px;"></div>
                 </div>
                 <ul id="container" class="clearfix mm2">
                     <li>
                         <img class="img" src="/content/images/huodong1.png">
                         <div class="learnMust"><span>选学</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>2018-03-22发布</span>
                         </div>
                         <p>
                             <span>行业前景好</span>
                             <a target="_blank" href="#"></a>
                             <i></i>
                         </p>
                     </li>
                     <li>
                         <img class="img" src="/content/images/huodong1.png">
                         <div class="learnMust"><span>选学</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>2018-03-22发布</span>
                         </div>
                         <p>
                             <span>人才需求大</span>
                             <a target="_blank" href="#"></a>
                             <i></i>
                         </p>
                     </li>
                     <li>
                         <img class="img" src="/content/images/huodong1.png">
                         <div class="learnMust"><span>必学</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>2018-03-22发布</span>
                         </div>
                         <p>
                             <span>就业薪水高</span>
                             <a target="_blank" href="#"></a>
                             <i></i>
                         </p>
                     </li>
                     <li>
                         <img class="img" src="/content/images/huodong1.png">
                         <div class="learnMust"><span>必学</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>2018-03-22发布</span>
                         </div>
                         <p>
                             <span>发展潜力大</span>
                             <a target="_blank" href="#"></a>
                             <i></i>
                         </p>
                     </li>
                     <li>
                         <img class="img" src="/content/images/huodong1.png">
                         <div class="learnMust"><span>必学</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>2018-03-22发布</span>
                         </div>
                         <p>
                             <span>IT行业分析</span>
                             <a target="_blank" href="#"></a>
                             <i></i>
                         </p>
                     </li>
                 </ul>
             </div>-->

            <div style="height:8px;"></div>
        </div>
    </div>

</div>

<script>
    $("#container li").each(function () {
        $(this).on('mouseenter', function (e) {
            var e = e || window.event;
            var angle = direct(e, this)
            mouseEvent(angle, this, 'in')
        })
        $(this).on('mouseleave', function (e) {
            var e = e || window.event;
            var angle = direct(e, this)
            mouseEvent(angle, this, 'off')
        })
    });
    function direct(e, o) {
        var w = o.offsetWidth;
        var h = o.offsetHeight;
        var top = o.offsetTop;                    //包含滚动条滚动的部分
        var left = o.offsetLeft;
        var scrollTOP = document.body.scrollTop || document.documentElement.scrollTop;
        var scrollLeft = document.body.scrollLeft || document.documentElement.scrollLeft;
        var offTop = top - scrollTOP;
        var offLeft = left - scrollLeft;
        //console.log(offTop+";"+offLeft)
        // e.pageX|| e.clientX;
        //pageX 是从页面0 0 点开始  clientX是当前可视区域0 0开始  即当有滚动条时clientX  小于  pageX
        //ie678不识别pageX
        //PageY=clientY+scrollTop-clientTop;(只讨论Y轴,X轴同理,下同) 页面上的位置=可视区域位置+页面滚动条切去高度-自身border高度
        var ex = (e.pageX - scrollLeft) || e.clientX;
        var ey = (e.pageY - scrollTOP) || e.clientY;
        var x = (ex - offLeft - w / 2) * (w > h ? (h / w) : 1);
        var y = (ey - offTop - h / 2) * (h > w ? (w / h) : 1);

        var angle = (Math.round((Math.atan2(y, x) * (180 / Math.PI) + 180) / 90) + 3) % 4 //atan2返回的是弧度 atan2(y,x)
        var directName = ["上", "右", "下", "左"];
        return directName[angle];  //返回方向  0 1 2 3对应 上 右 下 左
    }
    function mouseEvent(angle, o, d) { //方向  元素  鼠标进入/离开
        var w = o.offsetWidth;
        var h = o.offsetHeight;

        if (d == 'in') {
            switch (angle) {
                case '上':
                    $(o).find("p").css({left: 0, top: -h + "px"}).stop(true).animate({left: 0, top: 0}, 300)
                    setTimeout(function () {
                        $(o).find("p a").css({left: '50%', top: -h + "px"}).stop(true).animate({
                            left: '50%',
                            top: '20px'
                        }, 300)
                    }, 200)
                    break;
                case '右':
                    $(o).find("p").css({left: w + "px", top: 0}).stop(true).animate({left: 0, top: 0}, 300)
                    setTimeout(function () {
                        $(o).find("p a").css({left: w + "px", top: '20px'}).stop(true).animate({
                            left: '50%',
                            top: '20px'
                        }, 300)
                    }, 200)
                    break;
                case '下':
                    $(o).find("p").css({left: 0, top: h + "px"}).stop(true).animate({left: 0, top: 0}, 300)
                    setTimeout(function () {
                        $(o).find("p a").css({left: '50%', top: h + "px"}).stop(true).animate({
                            left: '50%',
                            top: '20px'
                        }, 300)
                    }, 200)
                    break;
                case '左':
                    $(o).find("p").css({left: -w + "px", top: 0}).stop(true).animate({left: 0, top: 0}, 300)
                    setTimeout(function () {
                        $(o).find("p a").css({left: -w + "px", top: '20px'}).stop(true).animate({
                            left: '50%',
                            top: '20px'
                        }, 300)
                    }, 200)
                    break;
            }
        } else if (d == 'off') {
            switch (angle) {
                case '上':
                    $(o).find("p a").stop(true).animate({left: '50%', top: -h + "px"}, 300)
                    setTimeout(function () {
                        $(o).find("p").stop(true).animate({left: 0, top: -h + "px"}, 300)
                    }, 200)
                    break;
                case '右':
                    $(o).find("p a").stop(true).animate({left: w + "px", top: '20px'}, 300)
                    setTimeout(function () {
                        $(o).find("p").stop(true).animate({left: w + "px", top: 0}, 300)
                    }, 200)
                    break;
                case '下':
                    $(o).find("p a").stop(true).animate({left: '50%', top: h + "px"}, 300)
                    setTimeout(function () {
                        $(o).find("p").stop(true).animate({left: 0, top: h + "px"}, 300)
                    }, 200)
                    break;
                case '左':
                    $(o).find("p a").stop(true).animate({left: -w + "px", top: '20px'}, 300)
                    setTimeout(function () {
                        $(o).find("p").stop(true).animate({left: -w + "px", top: 0}, 300)
                    }, 200)
                    break;
            }
        }
    }
    $(function () {
        if($("#infoTitle").length > 0 ){
            $('#myModal').modal({keyboard: true});
            $("#myModal").modal({backdrop: "static", keyboard: false}); // 标记：已经向该访客弹出过消息。30天之内不要再弹
        }
        $('#privilegeList li').not('.no-click').click(function () {
            var backHttp = '<?= $backurl ?>';
            var rootId = $(this).data('parent-id');
            var firstId = $(this).data('id');
            var loginName = '<?= $loginName ?>';
            var pwd = '<?= html::encode($pwd) ?>';
            window.open(backHttp + '/account/index?p=' + rootId + '&first=' + firstId + '&fontend=1&loginName=' + loginName + '&pwd=' + pwd + '&isConfirm=1');
        });
        var roleid = $("#roleid").val();
        if(roleid=='301624945803399715'||roleid==''){
            $('.workspace').css('display','none');
        }
        var userType=$('#userType').val();
        if(userType!='4000'){
            $('.workFilePlace').css('display','none');
            $('.toolplace').css('display','none');
        }
    })
</script>

