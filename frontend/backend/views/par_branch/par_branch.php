<?php
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['name'];
$orgName = $user_msginfo['orgName'];
$userId = $user_msginfo['idStr'];
$userOrgType = $user_msginfo['orgType'];
$userJoinTime = $user_msginfo['joinTime'];
$userOutTime = $user_msginfo['outTime'];
$img = $user_msginfo['img'];
$cookies = \Yii::$app->request->cookies;
$password = $cookies->getValue('password');
use yii\helpers\Html;
?>

<link rel="stylesheet" href="/content/css/uncommon/new_index.css" type="text/css">
<link rel="stylesheet" href="/content/css/uncommon/par_branch.css" type="text/css">
<script src="/content/js/uncommon/par_branch.js" type="text/javascript"></script>
<script src="/content/js/jquery-easing.1.3.js" type="text/javascript"></script>
<div class="content">
    <div class="main-content ly_items">
        <?php if (!empty($resultData['picData'])) {
            $i = 0;
            $b = 0;
            $c1000 = 0;
//            \common\models\MyFunction::sun_p($resultData['picData']);die;
            if (!empty($resultData['picData']['result'])) {
//                \common\models\MyFunction::sun_p($resultData['picData']['result']);die;
                foreach ($resultData['picData']['result'] as $data_k => $data_val) {
                    if ($data_val['showType'] == 1100) {
//                        \common\models\MyFunction::sun_p($data_val['showType']);
                        $b = $b + 1;
                        if ($b == 1) {
                            //党建要闻
                            if(isset($data_val['showArtJson'])){
                                if (!empty($data_val['showArtJson'])) {
                                    echo '<div class="top-rated ">
                                              <div class="top-rated-left">
                                                    <div class="org-map-tit">
                                                        <h5 class="ly_tits" data-id="' . html::encode($data_val['idStr']) . '" >' . html::encode($data_val['name']) . '</h5>
                                                        <span class="more" onClick="window.open(\'/branch/branch?channelId=' . html::encode($data_val['idStr']) . '&tab=exist&curtab=' . html::encode($data_val['name']) . '#' . html::encode($data_val['name']) . '\')">更多 +</span>
                                                    </div><!--org-map-tit-->';
                                    echo '<div class="top-rated-left-content">
                                                <div class="top-rated-left-img">
                                                    <ul class="rated-left-list">';
//                                                        print_r($data_val);
                                    foreach (json_decode($data_val['showArtJson']) as $lbb_k => $lbb_val) {
                                        $crlmPrcArr = json_decode($lbb_val->pic, true);
                                        if ($lbb_k >= 6) {
                                            break;
                                        }
                                        if (!empty($crlmPrcArr)) {
                                            foreach ($crlmPrcArr as $pic_k => $pic_val) {
                                                echo ' <li class="rated-left-list-item">
                                                                        <a href="/news/news?channelId=' . $lbb_val->id . '#index" target="_blank" title="' . $lbb_val->title . '">
                                                                            <img src="' . html::encode($pic_val['url']) . '" alt="" style=" width:380px">
                                                                            <span class="mask"><em>' . $lbb_val->title . '</em></span>
                                                                        </a>
                                                                    </li>';
                                            }
                                        }else{
                                            echo ' <li class="rated-left-list-item">
                                                <a target="_blank" title="' . $lbb_val->title . '">
                                                    <img src="/content/images/def.png" alt="" style=" width:380px">
                                                    <span class="mask"><em>' . $lbb_val->title . '</em></span>
                                                </a>
                                            </li>';
                                        }
                                    }  //轮播图循环结束
                                    echo '</ul> <!--rated-left-list-->';
                                    echo '<ul class="rated-left-img-btn">';
                                    foreach (json_decode($data_val['showArtJson']) as $lbb_k => $lbb_val) {
                                        if ($lbb_k == 0) {
                                            echo '<li class="hover"></li>';
                                        } else if ($lbb_k >= 6) {
                                            break;
                                        } else {
                                            echo '<li class=""></li>';
                                        }
                                    }
                                    echo '  </ul> <!--rated-left-img-btn-->
                                                  </div>'; //top-rated-left-img  <!--轮播结束-->

                                    //右侧新闻列表
                                    echo ' <ul class="top-rated-left-list">';
                                    foreach (json_decode($data_val['showArtJson']) as $lbb_k => $lbb_val) {
                                        if ($lbb_k >= 6) {break;}
                                        echo '<li>
                                                            <a href="/news/news?channelId=' . $lbb_val->id . '#index" target="_blank" title="' . $lbb_val->title . '">' . $lbb_val->title . '</a>
                                                           </li>';
                                    }
                                    echo '</ul> <!--top-rated-left-list-->
                                        </div>'; //top-rated-left-content
                                    echo '</div>'; //top-rated-left
                                    //党群服务
                                    if (!empty($infoData)) {
                                        if (!empty($infoData['userRoleList'])) {
//                                        \common\models\MyFunction::sun_p($infoData);DIE;
                                            echo ' <div class="top-rated-infor">
                                                    <h5 class="tit">党支部信息栏目</h5>
                                                    <ul>
                                                        <li>
                                                            <p>
                                                                <span class="glyphicon glyphicon-user tab-icon"></span>
                                                                党支部人数：' . html::encode($infoData['membersCounts']) . '
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <p>
                                                                <span class="glyphicon glyphicon-list-alt tab-icon"></span>
                                                                党支部考核积分：' . html::encode($infoData['currOrg']['orgPointSum']) . '
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <p>
                                                                <span class="glyphicon glyphicon-map-marker tab-icon"></span>
                                                                地址：<a title="' . html::encode($infoData['currOrg']['address']) . '">' . html::encode($infoData['currOrg']['address']) . '</a>
                                                            </p>
                                                        </li>
                                                    </ul>';
                                            echo '<div class="user-list">';
                                            if (!empty($infoData['userRoleList'])) {
                                                $lun_bo = 0;
                                                foreach ($infoData['userRoleList'] as $data_k => $data_val) {
                                                    if (!empty($data_val['userName'])) {
                                                        $lun_bo =  $lun_bo +1;
                                                        if($lun_bo == 1){
                                                            echo ' <span id="pre" class="glyphicon glyphicon-menu-left user-list-icon user-list-icon-left"></span>
                                                                <span id="next" class="glyphicon glyphicon-menu-right user-list-icon user-list-icon-right"></span>   ';
                                                        }

                                                    }
                                                }
                                            }
                                            echo '<div class="user-list-avatar"> 
                                                        <div class="user-w">';
                                            foreach ($infoData['userRoleList'] as $data_k => $data_val) {
//                                            \common\models\MyFunction::sun_p($data_val);DIE;
                                                if (!empty($data_val['userName'])) {
                                                    echo '<li class="cur">
                                                    <img src="';
                                                    if (isset($data_val['img']) && !empty($data_val['img'])) {
                                                        echo json_decode($data_val['img'])->url;
                                                    } else {
                                                        echo '/content/images/tou.png';
                                                    }
                                                    echo '" width="50" height="50"/>
                                                        <p class="role-name">' . html::encode($data_val['roleName']) . '</p>
                                                        <p class="one_hidden"><a title="' . html::encode($data_val['userName']) . '">' . html::encode($data_val['userName']) . '</a></p>
                                                    </li> ';
                                                }
                                            }
                                            echo '</div><!--user-w-->
                                                     </div> <!--user-list-avatar-->
                                                  </div> <!--user-list-->
                                             </div>';  //top-rated-infor
                                        }
                                    }
                                    echo '</div>'; //top-rated
                                }
                            }else{
                                echo '<div class="nodata">
                                    <p><img src="/content/images/nodata.png"></p><p>暂无数据</p>
                                </div>';
                            }
                        }
                    }else if ($data_val['showType'] == '1200') {
                        //党建聚焦
                        if (!empty($data_val['showArtJson'])) {
//                            \common\models\MyFunction::sun_p($data_val['showArtJson']);
                            echo '<div class="focus ly_items">
                                        <div class="focus-tit">
                                            <div class="org-map-tit">
                                                <h5 class="ly_tits" >' . html::encode($data_val['name']) . '</h5>
                                                <span class="more" onClick="window.open(\'/branch/branch?channelId=' . html::encode($data_val['idStr']) . '&tab=exist&curtab=' . html::encode($data_val['name']) . '#' . html::encode($data_val['name']) . '\')">更多 +</span>
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
                                                    <img src="' . html::encode($pic_val['url']) . '" width="100%" alt="" >
                                                    </p>
                                                    <p class="cz_list_tit">' . html::encode($lbb_val->title) . '</p>
                                                </li>';
                                    }
                                }
                            }
                            echo '</ul><!--cz_list-->';
                            $i=0;
                            $tab = sizeof(json_decode($data_val['showArtJson']));
                            $count = round($tab/4);
                            echo '<ul class="cz_btn" data-id="'.$count.'"">';
                            if($count == 0 && $tab!=0){
                                echo '<li class="hover"></li>';
                            }
                            for($i;$i< $count;$i++){
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
                    }else if ($data_val['showType'] == '1000') {
                        //其他模块
                        $c1000=++$c1000;
                        if (!empty($data_val['showArtJson'])) {
                            echo '<div class="slogan-items ' . ($c1000 % 3 != 0 ? 'massges_mr_l' : '') . '">';
                            echo '  <div class="slogan-item">
                                <div class="slogan-item-tit">
                                <i class="ico pre"></i>';
                            echo '<span>'.$data_val['name'].'</span>';
                            echo '<b data-id="' . html::encode($data_val['idStr']) . '" onClick="window.open(\'/branch/branch?channelId=' . html::encode($data_val['idStr']) . '&tab=exist&curtab=index#index\')">更多 +</b>
                                    </div> <!--slogan-item-tit-->
                                    <ul>';
                            foreach (json_decode($data_val['showArtJson']) as $tit_k => $tit_val) {
                                echo '<li>
                                                <a class="one_hidden dis_inline" href="/news/news?channelId=' . html::encode($tit_val->id) . '#index" target="_blank" title="' . html::encode($tit_val->title) . '">' . html::encode($tit_val->title) . '</a>
                                            </li> ';
                            }
                            echo '</ul>
                                </div> ';
                            echo '  </div>'; //slogan-items
                        }

                    }else if ($data_val['showType'] == '1300') {
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
//                                    \common\models\MyFunction::sun_p($pic_val);
                                        if($zt_k == 0){
                                            if (!empty ($pic_val['seturl'])) {
//                                                \common\models\MyFunction::sun_p($pic_val['seturl']);
                                                echo '<li class="dis_inline curpter adv hvr-rectangle-out" onClick="window.open(\'' . html::encode($pic_val['seturl']) . '?voteSta=0&channelId=' . html::encode($pic_val['id']) . '#index\')">
                                                    <a><img alt="' . html::encode($pic_val['name']) . '" src="' . html::encode($pic_val['url']) . '"/></a>
                                                </li>';
                                            } else {
                                                echo '<li class="dis_inline curpter adv hvr-rectangle-out">
                                                    <a><img alt="' . html::encode($pic_val['name']) . '" src="' . html::encode($pic_val['url']) . '"/></a>
                                                </li>';
                                            }
                                        }
                                        else{
                                            if (!empty ($pic_val['seturl'])) {
                                                echo '<li class="dis_inline curpter adv hvr-rectangle-out" style="margin-left:10px;" onClick="window.open(\'' . html::encode($pic_val['seturl']) . '?voteSta=0&channelId=' . html::encode($pic_val['id']) . '#index\')">
                                                    <a><img alt="' . html::encode($pic_val['name']) . '" src="' . html::encode($pic_val['url']) . '"/></a>
                                                </li>';
                                            } else {
                                                echo '<li class="dis_inline curpter adv hvr-rectangle-out" style="margin-left:10px;">
                                                    <a><img alt="' . html::encode($pic_val['name']) . '" src="' . html::encode($pic_val['url']) . '"/></a>
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
            }else{
                echo '<div class="nodata">
                    <p><img src="/content/images/nodata.png"></p><p>暂无数据</p>
                </div>';
            }
        }
        ?>
        <!--内容结束-->
    </div>
</div>
