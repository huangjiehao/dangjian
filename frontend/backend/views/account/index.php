<?php
use common\models\MyFunction;
use yii\helpers\Html;

$platformInfo = MyFunction::init_platform();//存入客户端session，避免频繁从服务端读取
//MyFunction::sun_p($platformInfo);DIE;
$sldName = isset($platformInfo['sldName'])?$platformInfo['sldName']:null;

$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['name'];
$orgName = $user_msginfo['orgName'];
$userId = $user_msginfo['idStr'];
$userOrgType = $user_msginfo['orgType'];
$userJoinTime = $user_msginfo['joinTime'];
//MyFunction::sun_p($user_msginfo);DIE;
$userOutTime = $user_msginfo['outTime'];
$img = $user_msginfo['img'];
$cookies = \Yii::$app->request->cookies;
$password = $cookies->getValue('password');
?>
<link rel="stylesheet" href="/content/css/uncommon/new_index.css" type="text/css">

<!-- 地图相关文件 -->
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=FMYkGaEksPC6FfaDMG8aXIdWhx51GAL8"></script>
<script type="text/javascript"
        src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css"/>
<script src="/content/js/uncommon/newindex2.js" type="text/javascript"></script>
<script src="/content/js/jquery-easing.1.3.js" type="text/javascript"></script>

<div class="content">
    <input type="hidden" id="lat" value="<?php if(isset($platformInfo['lat'])&&!empty($platformInfo['lat'])){echo html::encode($platformInfo['lat']);}else{echo 0;}  ?>"/>
    <input type="hidden" id="lng" value="<?php if(isset($platformInfo['lng'])&&!empty($platformInfo['lng'])){echo html::encode($platformInfo['lng']);}else{echo 0;}  ?>"/>
    <div class="main-content ly_items">
        <!--内容开始-->
        <!--<div class="headline">
            <div class="headline-top">
                <img src="/content/images/headline.png" alt="" style="position:absolute; top:-5px; left:-5px;">
                <h4 class="headline-tit">客响党支部七月份主题党日——“颂党恩 筑沃梦”</h4>
            </div>
            <ul class="headline-bottom">
                <li><a href="">[“不忘初心，客户为本”大反思大讨论活动]</a></li>
                <li><a href="">[《沃的五张照片》 在省直演讲比赛决赛展现通信风华]</a></li>
                <li><a href="">[海珠区销售公司党支部开展“文明联通人”活动]</a></li>
            </ul>
        </div>-->
        <!--党建要闻-->
        <!--        <div class="top-rated ">-->
        <?php if (!empty($resultData['picData'])) {
            $i = 0;
            $b = 0;
            $c1000 = 0;
            if (!empty($resultData['picData']['result'])) {
                foreach ($resultData['picData']['result'] as $data_k => $data_val) {
                    if ($data_val['showType'] == '1100') {
                        //党建要闻
                        $b = $b + 1;
                        if ($b == 1) {
                            echo '  <div class="top-rated">
                                  <div class="top-rated-left" style="width: 100%">
                                    <div class="org-map-tit">
                                        <h5 class="ly_tits" data-id="' . $data_val['idStr'] . '" >' . html::encode($data_val['name']) . '</h5>
                                    <span class="more" onClick="window.open(\'/branch/branch?channelId=' . html::encode($data_val['idStr']) . '&curtab=' . $data_val['name'] . '#' . $data_val['name'] . '\')">更多 +</span>
                                </div><!--org-map-tit-->';
                            if (!empty($data_val['showArtJson'])) {
                                echo '<div class="top-rated-left-content">
                                            <div class="top-rated-left-img">
                                                <ul class="rated-left-list">';
                                                foreach (json_decode($data_val['showArtJson']) as $lbb_k => $lbb_val) {
                                                    $crlmPrcArr = json_decode($lbb_val->pic, true);
                                                    if ( $lbb_k >=6){break;}
                                                    if (!empty($crlmPrcArr)) {
                                                        foreach ($crlmPrcArr as $pic_k => $pic_val) {
                                                            echo ' <li class="rated-left-list-item">
                                                                <a href="/news/news?channelId=' . $lbb_val->id . '#网站首页" target="_blank" title="' . $lbb_val->title . '">
                                                                    <img src="' . $pic_val['url'] . '" alt="" style=" width:380px">
                                                                    <span class="mask"><em>' . html::encode($lbb_val->title) . '</em></span>
                                                                </a>
                                                            </li>';
                                                        }
                                                    }else{
                                                        echo ' <li class="rated-left-list-item">
                                                            <a href="/news/news?channelId=' . $lbb_val->id . '#网站首页" target="_blank" title="' . html::encode($lbb_val->title) . '">';
                                                                if($sldName == 'kpqx'){
                                                                    echo '<img src="/content/images/kpqx_logo_1.png" alt="">';
                                                                }else if($sldName=='pylyj'){
                                                                    echo '<img src="/content/images/pylyj_default.png" alt="">';
                                                                }else if($sldName=='mjnhyczj'){
                                                                    echo '<img src="/content/images/mjnhyczj_dibu.png" alt="">';
                                                                }else{
                                                                    echo '<img src="/content/images/default.png" alt="">';
                                                                }
                                                                echo '<span class="mask"><em>' . html::encode($lbb_val->title) . '</em></span>
                                                            </a>
                                                        </li>';
                                                    }
                                                }  //轮播图循环结束
                                                echo '</ul> <!--rated-left-list-->
                                            <ul class="rated-left-img-btn">';
                                                foreach (json_decode($data_val['showArtJson']) as $lbb_k => $lbb_val) {
                                                    if ($lbb_k == 0) {
                                                        echo '<li class="hover"></li>';
                                                    }
                                                    else if($lbb_k >= 6){
                                                        break;
                                                    }
                                                    else{
                                                        echo '<li class=""></li>';
                                                    }
                                                }
                                                echo'  </ul> <!--rated-left-img-btn-->
                                              </div>'; //top-rated-left-img  <!--轮播结束-->

                                            //右侧新闻列表
                                            echo ' <ul class="top-rated-left-list">';
                                            foreach (json_decode($data_val['showArtJson']) as $lbb_k => $lbb_val) {
                                                if($lbb_k>=6)break;
                                                echo '<li>
                                                    <a href="/news/news?channelId=' . $lbb_val->id . '#index" target="_blank" title="' . $lbb_val->title . '">' . html::encode($lbb_val->title) . '</a>
                                                </li>';
                                            }
                                            echo '</ul> <!--top-rated-left-list-->
                                        </div>'; //top-rated-left-content
                                echo '</div> '; //top-rated-left
                            }
                            if (!empty($userName) && 1==2) {
                                if($userJoinTime==0){
                                    echo '<input type="hidden" id="join" value="0"/>';
                                }else{
                                    echo '<input type="hidden" id="join" value="' . date("Y", $userJoinTime) . '"/>';
                                }
                                if($userOutTime==0){
                                    echo '<input type="hidden" id="out" value="0"/>';
                                }else{
                                    echo '<input type="hidden" id="out" value="' . date("Y", $userOutTime) . '"/>';
                                }
                                echo '<div class="dis_inline massgesGRZX">
                                    <ul class="dis_inline massgesGRZX_l">
                                        <li class="per_tou"><img src="';
                                if(isset($img)&&!empty($img)){
                                    if(isset(json_decode($img)->url)){
                                        echo json_decode($img)->url; //获取json接口返回的数据，取出url地址
                                    }else{
                                        echo $img;
                                    }
                                }else{
                                    echo '/content/images/tou_default.png';
                                }
                                echo '" width="80" height="80"/></li>
                                        <ul class="massgesGRZX_lper-name">
                                        <li class="text-c per_color">' . html::encode($userName) . '</li>
                                        <li class="text-c per_color">' . html::encode($orgName) . '</li>
                                        <li class="text-c per_color">' . html::encode($userOrgType) . '</li>
                                        <li class="text-c per_fen fs-16" style="display: none">';
                                if (!empty($courseData)) {
                                    echo $courseData['personalPoint'];
                                }
                                echo '</li>
                                        </ul>
                                        <li class="text-c fs-16 per_m" style="display: none">个人积分</li>
                                        <ul style="text-align: center;" class="massgesGRZX_lper-btn">
                                            <li class="dis_inline" onclick="window.open(\'/newpersonal/personal?curtab=grzx#党群服务\')"><button class="btn btn-info ">党群服务</button></li>
                                            <li class="dis_inline" onclick="logout();"><button class="btn btn-warning">退出</button></li>
                                        </ul>
                                        <!--<ul style="text-align: center;" class="massgesGRZX_lper-btn">
                                            <li class="text-c per_btn dis_inline" onclick="window.open(\'/newpersonal/personal?curtab=grzx#grzx\')">党群服务</li>
                                            <li class="text-c per_btn dis_inline per-btn-out" onclick="logout();">退出</li>
                                        </ul>-->
                                    </ul>
                                    <ul class="dis_inline massgesGRZX_r">
                                        <ul class="massgesGRZX_rtop">
                                           
                                            <li class="fs-16 per_m">入党时间：';if($userJoinTime!=0){echo date("Y-m-d", html::encode($userJoinTime));}else{echo 0;} echo '</li>
                                            <li class="fs-16 per_m" style="margin-left: 30px;">党龄：<span>';
                                            if($userJoinTime == 0 && $userOutTime == 0){
                                                /*if($userOutTime == 0){
                                                    echo (date('Y') - date('Y',$userJoinTime));
                                                }else{
                                                    echo (date('Y',$userOutTime) - date('Y',$userJoinTime));
                                                }*/
                                                echo 0;
                                            }else{
                                                if($userOutTime == 0){
                                                    echo (date('Y') - date('Y',$userJoinTime));
                                                }else{
                                                    echo (date('Y',$userOutTime) - date('Y',$userJoinTime));
                                                }
                                            }

                                            echo '</span>年</li>
                                        </ul>
                                        <div class="massgesGRZX_rbottom"> 
                                        <li class="fs-16 per_m ">学习进度</li>';
                                echo '<div class="col-363 pull-right  meddile_one middel_yellow" id = "jifen" >';
                                if (!empty($courseData['personalScoreResult'])) {
                                    echo '<span class="span">
                                                    <span class="fs-14">选修 </span>
                                                    <span class="pull-right12">总分：' . html::encode($courseData['personalScoreResult']['stuChoiceSum']) . '分</span>
                                           </span>';
                                    if ($courseData['personalScoreResult']['stuChoiceSum'] != 0) { //判断选修总分是否为0
                                        echo '<div style="position: relative;height: 20px;width: 70%;">
                                                    <div class="progress" style="margin-bottom: 30px;">
                                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: ' . (round((($courseData['personalScoreResult']['stuChoice'] / $courseData['personalScoreResult']['stuChoiceSum'] * 100)), 2)) . '%;"></div>
                                                        <p class="progress-bar-p" style="left: ' . html::encode(round((($courseData['personalScoreResult']['stuChoice'] / $courseData['personalScoreResult']['stuChoiceSum'] * 100)), 2)) . '%;top:16px">' . html::encode($courseData['personalScoreResult']['stuChoice']) . '分</p>
                                                     </div>
                                               </div>
                                                <span class="baifenbi baifenbi1">' . html::encode(round((($courseData['personalScoreResult']['stuChoice'] / $courseData['personalScoreResult']['stuChoiceSum'] * 100)), 2)) . '%</span>';

                                    } else {
                                        echo '<div style="position: relative;height: 20px;width: 70%;">
                                                    <div class="progress" style="margin-bottom: 30px;">
                                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                        <p class="progress-bar-p" style="left:0%;top:16px">' . html::encode($courseData['personalScoreResult']['stuChoice']) . '分</p>
                                                     </div>
                                               </div>
                                                <span class="baifenbi baifenbi1">0%</span>';
                                    }
                                    echo '<span class="span">
                                                <span class="fs-14">必修 </span>
                                                <span class="pull-right12">总分：' . html::encode($courseData['personalScoreResult']['stuMustSum']) . '分</span>
                                           </span>';

                                    if ($courseData['personalScoreResult']['stuMustSum'] != 0) { //判断必修总分是否为0
                                        echo '<div style="position: relative;height: 20px;width: 70%;">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: ' . html::encode(round((($courseData['personalScoreResult']['stuMust'] / $courseData['personalScoreResult']['stuMustSum'] * 100)), 2)) . '%;">
                                                        </div>
                                                        <p  class="progress-bar-p" style="left: ' . (round((($courseData['personalScoreResult']['stuMust'] / $courseData['personalScoreResult']['stuMustSum'] * 100)), 2)) . '%;top:16px;">' . html::encode($courseData['personalScoreResult']['stuMust']) . '分</p>
                                                    </div>
                                                </div>
                                                <span class="baifenbi baifenbi2">' . html::encode((round((($courseData['personalScoreResult']['stuMust'] / $courseData['personalScoreResult']['stuMustSum'] * 100)), 2))) . '%</span>';
                                    } else {
                                        echo '<div style="position: relative;height: 30px;width: 70%;">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 0%;">
                                                        </div>
                                                        <p  class="progress-bar-p" style="left: 0%;top:16px;">' . html::encode($courseData['personalScoreResult']['stuMust']) . '分</p>
                                                    </div>
                                                </div>
                                                <span class="baifenbi baifenbi2">0%</span>';
                                    }
                                }
                                echo '</div >
                                     </div>';
                                echo '</ul>
                            </div>';
                            }
                            else if(2==3){
                                echo '<div class="top-rated-login">
                                            <h5 class="tit">个人登录中心</h5>
                                            <form class="form-horizontal" id="loginForm"  method="post">
                                                <div class="top-rated-input">
                                                    <span class="glyphicon glyphicon-user input-icon"></span>
                                                    <input autocomplete="off" type="text" id="username" name="username" placeholder="请输入用户名" style="width: 90%" class="top-rated-login-input">
                                                </div>
                                                <div class="top-rated-input">
                                                    <span class="glyphicon glyphicon-lock input-icon"></span>
                                                    <input autocomplete="off" type="password" id="password"  name="password"  value="' . $password . '"  placeholder="请输入密码" style="width: 90%" class="top-rated-login-input">
                                                </div>
                                                <button type="button" id="submitBtn"  class="btn btn-default top-rated-login-btn">登录</button>
                                            </form>
                                            <div class="top-rated-bottom">
                                                <p>使用合作账号登录：</p>
                                                <ul class="login-short clearfix">
                                                    <li class="user"><a href="http://gz.gd.unicom.local/open/oauth2/auth/?response_type=code&client_id=gzdj_2018&redirect_uri=http://gzlt.gzdangjian.com/redirect/redirect#grzx" target="_blank"></a></li>
                                                    <li class="qq"><a a href="javascript:;" ></a></li>
                                                    <li class="sina"><a href="javascript:;" ></a></li>
                                                    <li class="weixin"><a href="javascript:;" ></a></li>
                                                </ul>
                                            </div>
                                        </div>';
                            }
                            echo'</div>  <!--top-rated--> ';
                        }
                    }
                    else if ($data_val['showType'] == '1200') {
                        //党建聚焦
                        if (!empty($data_val['showArtJson'])) {
                            echo '<div class="focus ly_items">
                                        <div class="focus-tit">
                                            <div class="org-map-tit">
                                                <h5 class="ly_tits" data-id="' . html::encode($data_val['idStr']) . '" onClick="window.open(\'/branch/branch?channelId=' . html::encode($data_val['idStr']) . '&curtab=index#index\')">' . html::encode($data_val['name']) . '</h5>
                                                <span class="more" onClick="window.open(\'/branch/branch?channelId=' . html::encode($data_val['idStr']) . '&curtab=' . html::encode($data_val['name']) . '#' . html::encode($data_val['name']) . '\')">更多 +</span>
                                            </div>
                                        </div>';
                            echo '<div class="cz_shop">
                                    <ul class="cz_list">';
                            foreach (json_decode($data_val['showArtJson']) as $lbb_k => $lbb_val) {
                                $crlmPrcArr = json_decode($lbb_val->pic, true);
                                if (!empty($crlmPrcArr)) {
                                    foreach ($crlmPrcArr as $pic_k => $pic_val) {
//                                        \common\models\MyFunction::sun_p($lbb_val);die;
                                        echo '<li onClick="window.open(\'/news/news?channelId=' . $lbb_val->id . '#index\')">
                                                    <p class="cz_over">
                                                    <img src="' . $pic_val['url'] . '"  alt="" >
                                                    </p>
                                                    <p class="cz_list_tit">' . $lbb_val->title . '</p>
                                                </li>';
                                    }
                                }else{
                                    echo '<li onClick="window.open(\'/news/news?channelId=' . $lbb_val->id . '#index\')">
                                        <p class="cz_over">';
                                    if($sldName == 'kpqx'){
                                        echo '<img src="/content/images/kpqx_logo.png" alt="">';
                                    }else if($sldName=='pylyj'){
                                        echo '<img src="/content/images/pylyj_default.png" alt="">';
                                    }else if($sldName=='mjnhyczj'){
                                        echo '<img src="/content/images/mjnhyczj_dibu.png" alt="">';
                                    }else{
                                        echo '<img src="/content/images/def.png" alt="">';
                                    }
                                        /*<img src="'.(($sldName == 'kpqx')?'/content/images/kpqx_logo.png':'/content/images/def.png').'"  alt="" >*/
                                        echo '</p>
                                        <p class="cz_list_tit">' . $lbb_val->title . '</p>
                                    </li>';
                                }
                            }
                            echo '</ul><!--cz_list-->';
                            $tab = sizeof(json_decode($data_val['showArtJson']));
                            $count = round($tab/4);
                            echo '<ul class="cz_btn" data-id="'.$count.'">';
                            if($count == 0 && $tab!=0) {
                                echo '<li class="hover"></li>';
                            }
                            for($i=0;$i<$count;$i++){
                                if($i==0){
                                    echo '<li class="hover"></li>';
                                }else{
                                    echo '<li class=""></li>';
                                }
                            }
                            echo '</ul>
                                    </div>  <!--cz_shop-->
                               </div> '; //focus ly_items
                        }
                    }
                    else if ($data_val['showType'] == '1000') {
                        //其他模块
                        $c1000=++$c1000;
                        if (!empty($data_val['showArtJson'])) {
                            echo '<div class="slogan-items ' . ($c1000 % 3 != 0 ? 'massges_mr_l' : '') . '">';
                            echo '  <div class="slogan-item">
                                <div class="slogan-item-tit">
                                <i class="ico pre"></i>';
//                            \common\models\MyFunction::sun_p($data_val);
                            echo '<span>'.html::encode($data_val['name']).'</span>';
                            echo '<b data-id="' . html::encode($data_val['idStr']) . '" onClick="window.open(\'/branch/branch?channelId=' . html::encode($data_val['idStr']) . '&curtab=index#index\')">更多 +</b>
                                    </div> <!--slogan-item-tit-->
                                    <ul>';
                            foreach (json_decode($data_val['showArtJson']) as $tit_k => $tit_val) {
                                echo '<li>
                                                <a class="one_hidden dis_inline" href="/news/news?channelId=' . $tit_val->id . '#index" target="_blank" title="' . $tit_val->title . '">' . $tit_val->title . '</a>
                                            </li> ';
                            }
                            echo '</ul>
                                </div> ';
                            echo '  </div>'; //slogan-items
                        }

                    }
                    else if ($data_val['showType'] == '1300') {
                        //专栏
                        if (!empty($data_val['showArtJson'])) {
                            foreach (json_decode($data_val['showArtJson']) as $zt_k => $zt_val) {
                                if ($zt_k == 0) {
                                    $crlmPrcArr = json_decode($zt_val->pic, true);
                                    if (!empty($crlmPrcArr)) {
//                                    \common\models\MyFunction::sun_p($crlmPrcArr);die;
                                        echo '<div class="lyg_adv">
                                            <input class="adv_showArtCount" type="hidden" value="' . html::encode($data_val['showArtCount']) . '"/>
                                            <ul><!-- 并排广告图 -->';
                                    }
                                }
                            }
                            foreach (json_decode($data_val['showArtJson']) as $zt_k => $zt_val) {
                                $crlmPrcArr = json_decode($zt_val->pic, true);
                                if (!empty($crlmPrcArr)) {
                                    foreach ($crlmPrcArr as $pic_k => $pic_val) {
//                                    \common\models\MyFunction::sun_p($pic_val);DIE;
                                        if($zt_k == 0){
                                            if (isset($pic_val['seturl'])) {
//                                                \common\models\MyFunction::sun_p($pic_val['seturl']);
                                                echo '<li class="dis_inline curpter adv hvr-rectangle-out" onClick="window.open(\'' . $pic_val['seturl'] . '?voteSta=0&channelId=' . $pic_val['id'] . '#index\')">
                                                    <a><img alt="' . $pic_val['name'] . '" src="' . $pic_val['url'] . '"/></a>
                                                </li>';
                                            } else {
                                                echo '<li class="dis_inline curpter adv hvr-rectangle-out">
                                                    <a><img alt="' . $pic_val['name'] . '" src="' . $pic_val['url'] . '"/></a>
                                                </li>';
                                            }
                                        }else{
                                            if (isset($pic_val['seturl'])) {
                                                echo '<li class="dis_inline curpter adv hvr-rectangle-out" style="margin-left:10px;" onClick="window.open(\'' . $pic_val['seturl'] . '?voteSta=0&channelId=' . $pic_val['id'] . '#index\')">
                                                    <a><img alt="' . $pic_val['name'] . '" src="' . $pic_val['url'] . '"/></a>
                                                </li>';
                                            } else {
                                                echo '<li class="dis_inline curpter adv hvr-rectangle-out" style="margin-left:10px;">
                                                    <a><img alt="' . $pic_val['name'] . '" src="' . $pic_val['url'] . '"/></a>
                                                </li>';
                                            }
                                        }

                                    }
                                }
                            }
                            foreach (json_decode($data_val['showArtJson']) as $zt_k => $zt_val) {
                                if ($zt_k == 0) {
                                    $crlmPrcArr = json_decode($zt_val->pic, true);
                                    if (!empty($crlmPrcArr)) {
                                        echo '</ul></div><!-- 结束 -->';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        ?>
        <!--内容结束-->
    </div>

<!--    <div class="learning">-->
<!--        --><?php //if (!empty($courseData)) {
//            echo '  <div class="course mar_b">
//                <div class="ly_items course_tit"><h5>学习园地</h5></div>
//            </div>';
////            \common\models\MyFunction::sun_p($courseData);die;
//            echo '<div class="ly_items vip-item bor">
//                 <div class="item-list clearfix">';
//            if (!empty($userName)) {
//                if (!empty($courseData['personalClassResult']['listStudyInfo'])) {
//                    foreach ($courseData['personalClassResult']['listStudyInfo'] as $data_k => $data_val) {
//                        $crlmPrc = $data_val['crlmPrc'];
//                        if (!empty($crlmPrc)) {
//                            if (count(json_decode($crlmPrc, true)) > 0) {
//                                $crlmPrcArr = json_decode($crlmPrc, true);
//                                $crlmPrcUrl = $crlmPrcArr[0]['url'];
//                            }
//                        }
//                        if ($data_k < 3) {
//                            echo '<div class="list fl ' . ($data_k % 3 == 0 ? 'list_mr_l' : '') . '" id="' . html::encode($data_val['idStr']) . '" name="' . html::encode($data_val['name']) . '" onclick="return courseList(id,name);">
//                                <div class="img">
//                                <a class="hvr-rectangle-out">
//                                <img src="';
//                                if (!empty($crlmPrcUrl)) {
//                                    echo $crlmPrcUrl;
//                                } else {
//                                    echo '/content/images/default1.png';
//                                }
//                                echo '"></a></div>
//                                    <div class="item-txt">
//                                        <p class="p1"><a href="javascript:void(0);" title="' . html::encode($data_val['name']) . '">' . html::encode($data_val['name']) . '</a></p>
//                                        <p class="p2">' . date("Y-m-d", html::encode($data_val['createTime'])) . '发布</p>
//                                        <a class="more">' . \common\models\commonEnum::getCrlmPty(html::encode($data_val['crlmPty'])) . '</a>
//                                    </div>
//                                </div>';
//                        }
//                    }
//                }
//            } else {
//                if (!empty($courseData['listStudyInfo'])) {
//                    foreach ($courseData['listStudyInfo'] as $data_k => $data_val) {
//                        $crlmPrc = $data_val['crlmPrc'];
//                        if (!empty($crlmPrc)) {
//                            if (count(json_decode($crlmPrc, true)) > 0) {
//                                $crlmPrcArr = json_decode($crlmPrc, true);
//                                $crlmPrcUrl = $crlmPrcArr[0]['url'];
//                            }
//                        }
//                        if ($data_k < 3) {
//                            echo '<div class="list fl ' . ($data_k % 3 == 0 ? 'list_mr_l' : '') . '" id="' . html::encode($data_val['idStr']) . '" name="' . html::encode($data_val['name']) . '" onclick="return courseList(id,name);">
//                                <div class="img"><a class="hvr-rectangle-out"><img src="';
//
//                            if (!empty($crlmPrcUrl)) {
//                                echo $crlmPrcUrl;
//                            } else {
//                                echo '/content/images/default1.png';
//                            }
//                            echo '"></a></div>
//                                <div class="item-txt">
//                                    <p class="p1"><a href="javascript:void(0);" title="' . html::encode($data_val['name']) . '">' . html::encode($data_val['name']) . '</a></p>
//                                    <p class="p2">' . date("Y-m-d", html::encode($data_val['createTime'])) . '发布</p>
//                                    <a class="more">' . \common\models\commonEnum::getCrlmPty(html::encode($data_val['crlmPty'])) . '</a>
//                                </div>
//                            </div>';
//                        }
//                    }
//                }
//            }
//            echo '</div></div>';//vip-item bor
//
//        }
//        ?>
<!--    </div>-->

<!--    <div class="org-map ly_items">-->
<!--        --><?php
//
//        if(MyFunction::get_sld_name()!='kpqx'){
//            if (!empty($resultData['starData'])) {//地图组织架构
//                echo '<div class="bor mar_b">
//                        <textarea style="display: none;" id="mygis">' . html::encode(json_encode($resultData['starData']['listOrg'])) . '</textarea>
//                        <div class="org-map-tit">
//                            <h5 class="ly_tits">党组织地图</h5>
//                            <span class="more" onClick="window.open(\'/map/map#首页\')">查看全景 +</span>
//                        </div>
//                        <div class="org_mr"><div id="allmap"></div></div>
//                    </div>
//                    <!-- 地图-->
//                    <div id="windowInfo" style="display: none;">
//                        <div class="mapInfo">
//                            <span>全称：<span style="font-weight: bold">#[fullName]</span></span><br>
//                            <span>地址：<span style="font-weight: bold">#[address]</span></span>
//                        </div>
//                    </div>';
//
//            }
//             if (!empty($resultData['starData'])) {//党48个组织架构
//                echo '<div class="org_mr"><ul class="org-map-list">';
//                foreach ($resultData['starData']['listOrg'] as $data_k => $data_val) {
//                    if ($data_k % 5 == 0) {
//                        echo '<li class="float-shadow" onClick="window.open(\'/par_branch/par_branch?idStr=' . html::encode($data_val['idStr']) . '#index\')" style="margin-left:0;">' . html::encode($data_val['name']) . '</li>';
//                    } else {
//                        echo '<li class="float-shadow" onClick="window.open(\'/par_branch/par_branch?idStr=' . html::encode($data_val['idStr']) . '#index\')" >' . html::encode($data_val['name']) . '</li>';
//                    }
//                }
//                echo '</ul></div>';
//
//            }
//        }
//        ?>
<!--    </div>-->

<!--红色资源地图-->
    <div class="org-map ly_items">
        <?php

        if(MyFunction::get_sld_name()!='kpqx'){
            if (!empty($resultData['mapData'])) {//地图组织架构
//                echo json_encode($resultData['mapData']);die;
                echo '<div class="bor mar_b">
                        <textarea style="display: none;" id="mygis">' . html::encode(json_encode($resultData['mapData']['listMapInformation'])) . '</textarea>
                        <div class="org-map-tit">
                            <h5 class="ly_tits">红色资源地图</h5>
                            <span class="more" onClick="window.open(\'/map/map_resource#首页\')">查看全景 +</span>
                        </div>
                        <div class="org_mr"><div id="allmap"></div></div>
                    </div>
                    <!-- 地图-->
                    <div id="windowInfo" style="display: none;">
                        <div class="mapInfo">
                            <span>全称：<span style="font-weight: bold">#[name]</span></span><br>
                            <span>地址：<span style="font-weight: bold">#[address]</span></span>
                        </div>
                    </div>';

            }
//            if (!empty($resultData['mapData'])) {//党48个组织架构
//                echo '<div class="org_mr"><ul class="org-map-list">';
//                foreach ($resultData['mapData']['listMapInformation'] as $data_k => $data_val) {
//                    if ($data_k % 5 == 0) {
//                        echo '<li class="float-shadow" onClick="window.open(\'/par_branch/par_branch?idStr=' . html::encode($data_val['idStr']) . '#index\')" style="margin-left:0;">' . html::encode($data_val['name']) . '</li>';
//                    } else {
//                        echo '<li class="float-shadow" onClick="window.open(\'/par_branch/par_branch?idStr=' . html::encode($data_val['idStr']) . '#index\')" >' . html::encode($data_val['name']) . '</li>';
//                    }
//                }
//                echo '</ul></div>';
//
//            }
        }
        ?>
    </div>
</div>
