<?php
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['name'];
$userId = $user_msginfo['idStr'];
$userLevel = $user_msginfo['userLevel'];
use yii\helpers\Html;

?>
<link href="/content/css/course/course.css" rel="stylesheet" type="text/css"/>
<link href="/content/css/uncommon/personal.css" rel="stylesheet" type="text/css"/>
<!--<script src="/content/js/personal/jquery-latest.js" type="text/javascript"></script>-->
<script src="/content/js/personal/pc.js" type="text/javascript"></script>
<script src="/content/js/personal/personal.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        if($("#infoTitle").length > 0 ){
            $('#myModal').modal({keyboard: true});
            $("#myModal").modal({backdrop: "static", keyboard: false}); // 标记：已经向该访客弹出过消息。30天之内不要再弹
        }
    });
</script>
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

<?php if(!empty($resultData['infoData'])) {
echo '<div class="top-bar" >
    <div class="top-center" >
        <div class="pull-left" >
            <img  src = "/content/images/title.png" />
            <span id = "admin" >党员个人空间</span >
        </div >
        <ul class="nav navbar-top-links navbar-right" >
            <li class="hidden-xs">
                <a href = "#" class="J_menuItem" data - index = "0" >'.$user_msginfo['name'].'</a >
            </li >
            <li class="dropdown hidden-xs" onclick = "logout()" >
                <a class="right-sidebar-toggle" aria - expanded = "false">
                    <i class="fa fa-tasks" ></i > 退出
                </a >
            </li >
        </ul >
    </div >
</div >
<!--------------------蓝色顶部的结束-->
<div class="main-wrap" >
    <!------------------------个人消息开始---------------------------->
    <div class="col-188 pull-left peopleCenter" >
        <ul class="center1" >
            <li ><span ><a href = "#" ><img src = "/content/images/male1.png" /></a ></span ></li >
            <li class="adminName" ><a href = "#" >'.$user_msginfo['name'].'</a ></li >
            <li class="score" >
                <a href = "#" ><label class="la1" > 积分：'.$resultData['infoData']['personalPoint'].'</label ><label class="la1" ></label ></a ><br />
            </li >
        </ul >
        <p style = "height: 10px;background: #fff;" ></p >
    </div >
    <!------------------------个人消息结束------------------------->
    <div >
        <div >
        <!-----中间内容的开始------------------->
            <div class="ml-20 col-370  pull-left" >
                <div class="main-wrap1 " id = "meddile_one_one" >
                    <div class="col-222 pull-left meddile_one meddile_one01 "  style = "width: 350px;" >
                        <h4 class="middle_ranklist_h4 rankList_blue " ><a href = "javascript:void(0);" > 我的支部</a ></h4 >
                        <ul >
                            <li> '.$resultData['infoData']['branchOrgName'].'</li >
                            <li ><p style = "background: #db2843" >'.$resultData['infoData']['rankFromOrg'].'</p > 个人支部排名</li >
                        </ul >
                    </div >
                    <div class="col-363 pull-right  meddile_one middel_yellow" id = "jifen" style = "width:400px;padding-top: 20px;" >
                        <h4 class="middle_ranklist_h4 rankList_blue " style = "" ><a href = "javascript:void(0);" > 学习积分</a ></h4 >
                        <p style = "clear:both;" ></p >';
                        if (!empty($resultData['infoData']['personalScoreResult'])) {
                            echo '<span class="span">
                                <span style="font-size: 16px;line-height: 40px;color: #333;">选修 </span>
                                <span class="pull-right12">总分：' . $resultData['infoData']['personalScoreResult']['stuChoiceSum'] . '分</span>
                            </span>';
                            if ($resultData['infoData']['personalScoreResult']['stuChoiceSum'] != 0) { //判断选修总分是否为0
                                echo '<div style="position: relative;height: 40px;width: 330px;">
                                        <div class="progress" style="margin-bottom: 30px;">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" 
                                                style="width: ' . (round((($resultData['infoData']['personalScoreResult']['stuChoice'] / $resultData['infoData']['personalScoreResult']['stuChoiceSum'] * 100)), 2)) . '%;"></div>
                                            <p class="progress-bar-p" style="left: ' . (round((($resultData['infoData']['personalScoreResult']['stuChoice'] / $resultData['infoData']['personalScoreResult']['stuChoiceSum'] * 100)), 2)) . '%;top:20px">' . $resultData['infoData']['personalScoreResult']['stuChoice'] . '分</p>
                                         </div>
                                    </div>
                                    <span class="baifenbi baifenbi1">' . (round((($resultData['infoData']['personalScoreResult']['stuChoice'] / $resultData['infoData']['personalScoreResult']['stuChoiceSum'] * 100)), 2)) . '%</span>';

                            } else {
                                echo '<div style="position: relative;height: 40px;width: 330px;">
                                        <div class="progress" style="margin-bottom: 30px;">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" 
                                                style="width: 0%;"></div>
                                            <p class="progress-bar-p" style="left:0%;top:20px">' . $resultData['infoData']['personalScoreResult']['stuChoice'] . '分</p>
                                         </div>
                                    </div>
                                    <span class="baifenbi baifenbi1">0%</span>';
                            }
                            echo '<span class="span">
                                    <span style="font-size: 16px;line-height: 40px;color: #333;">必修 </span>
                                    <span class="pull-right12">总分：' . $resultData['infoData']['personalScoreResult']['stuMustSum'] . '分</span>
                                </span>';

                            if ($resultData['infoData']['personalScoreResult']['stuMustSum'] != 0) { //判断必修总分是否为0
                                echo '<div style="position: relative;height: 40px;width: 330px;">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" 
                                            style="width: ' . (round((($resultData['infoData']['personalScoreResult']['stuMust'] / $resultData['infoData']['personalScoreResult']['stuMustSum'] * 100)), 2)) . '%;">
                                            </div>
                                            <p  class="progress-bar-p" style="left: ' . (round((($resultData['infoData']['personalScoreResult']['stuMust'] / $resultData['infoData']['personalScoreResult']['stuMustSum'] * 100)), 2)) . '%;top:20px;">' . $resultData['infoData']['personalScoreResult']['stuMust'] . '分</p>
                                        </div>
                                    </div>
                                    <span class="baifenbi baifenbi2">' . (round((($resultData['infoData']['personalScoreResult']['stuMust'] / $resultData['infoData']['personalScoreResult']['stuMustSum'] * 100)), 2)) . '%</span>';
                            }else {
                                echo '<div style="position: relative;height: 40px;width: 330px;">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" 
                                            style="width: 0%;">
                                            </div>
                                            <p  class="progress-bar-p" style="left: 0%;top:20px;">' . $resultData['infoData']['personalScoreResult']['stuMust'] . '分</p>
                                        </div>
                                    </div>
                                    <span class="baifenbi baifenbi2">0%</span>';
                            }
                        }
                    echo '</div >
                </div >
            </div >
        <!-----------------中间内容的结束------------------->

    </div >
    </div >

    <div class="ly_main_tab">
		<div class="main_m_l">
            <div class="lm_con">
                <ul>
                    <li>
                        <span class="leftDiv"></span>
                        <a href="/personal/personal#grzx"><i class="direction"></i>
                            <div class="tit"><i class="fa fa-book"></i>我的课程</div>
                        </a>
                    </li>
                    <li>
                        <span class="leftDiv"></span>
                        <a href="/course/study_online#在线学习" target="_blank"><i class="direction"></i>
                            <div class="tit"><i class="fa fa-wifi"></i>在线学习</div>
                        </a>
                    </li>
                   <li>
                        <span class="leftDiv"></span>
                        <a href="/par_branch/par_branch?idStr=org&curtab=zbdj#zbdj" target="_blank"><i class="direction"></i>
                            <div class="tit">&nbsp;<i class="fa fa-resistance"></i>我的党组织</div>
                        </a>
                    </li>
                    <li>
                        <span class="leftDiv"></span>
                        <a href="/development/personal_development?idStr='.$userId.'" target="_blank"><i class="direction"></i>
                            <div class="tit">&nbsp;<i class="fa fa-odnoklassniki"></i>入党申请</div>
                        </a>
                     </li>
                    <li>
                        <span class="leftDiv"></span>
                        <a href="/personal/personal_mid?idStr='.$userId.'#grzx" target="_blank"><i class="direction"></i>
                            <div class="tit">&nbsp;<i class="fa fa-th-large"></i>党员积分管理卡</div>
                        </a>
                        <!--<li>
                            <span class="leftDiv"></span>
                            <a href="/personal/personal_com?idStr='.$userId.'#grzx" target="_blank"><i class="direction"></i>
                                <div class="tit">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-long-arrow-right"></i>普通党员</div>
                            </a>
                         </li>
                         <li>
                            <span class="leftDiv"></span>
                            <a href="/personal/personal_mid?idStr='.$userId.'#grzx" target="_blank"><i class="direction"></i>
                                <div class="tit">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-long-arrow-right"></i>中层干部</div>
                            </a>
                         </li>-->
                     </li>
                     
                     <li>
                        <span class="leftDiv"></span>
                        <a href="/personal/message_box?idStr='.$userId.'&curtab=grzx#grzx" target="_blank"><i class="direction"></i><!--$userId-->
                            <div class="tit"><i class="fa fa-envelope"></i>留言箱</div>
                        </a>
                     </li>
                     <li>
                        <span class="leftDiv"></span>
                        <a href="/personal/exam_list?idStr='.$userId.'&curtab=grzx#grzx" target="_blank"><i class="direction"></i><!--$userId-->
                            <div class="tit"><i class="fa fa-dot-circle-o"></i>考试试题</div>
                        </a>
                     </li>
                </ul>
            </div>   
        </div>';
    if($resultData['infoData']['personalClassResult']['listStudyInfo']){
        echo '<div class="row-fluid" >
            <div class="carousel slide" id = "myCarousel" >
                <div class="carousel-inner" >
                    <div class="item active" >
                        <ul class="thumbnails" >';
                        if(!empty($resultData['infoData']['personalClassResult']['listStudyInfo'])){
                            foreach ($resultData['infoData']['personalClassResult']['listStudyInfo'] as $data_k => $data_val) {
                                $crlmPrc = $data_val['crlmPrc'];
                                $crlmPrcArr = json_decode($crlmPrc, true);
                                $crlmPrcUrl = $crlmPrcArr[0]['url'];
                                //\common\models\MyFunction::sun_p($crlmPrcUrl);
                                echo '<li class="span3">
                                    <div class="thumbnailtrans">
                                        <div class="thumbnail">
                                            <a href="/course/course_dtls?idStr='. $data_val['idStr'] .'&courseName='. $data_val['name'].'#在线学习" >
                                                <img src="';if (!empty($crlmPrcUrl)) {echo $crlmPrcUrl;}else {echo '/content/images/default.png';} echo '" alt="'. $data_val['name'].'" >
                                            </a>
                                        </div>
                                        <div class="caption">
                                            <p><a href="/course/course_dtls?idStr='. $data_val['idStr'] .'&courseName='. $data_val['name'].'#在线学习" title="'. $data_val['name'] .'">'. $data_val['name'] .'</a></p>
                                            <p class="pull-left">'. \common\models\commonEnum::getCrlmPty($data_val['crlmPty']) .'</p>
                                            <p class="pull-right">'. date("Y-m-d", $data_val['createTime']) .'发布</p>
                                        </div>
                                    </div>
                                </li>';
                                }
                            }else{
                                echo '<p>暂无数据！！！</p>';
                            }

                        echo '</ul >
                    </div ><!-- /Slide1-->
                </div >
            </div ><!-- /#myCarousel -->
        </div >';
    }
	echo '</div>
</div >';
}?>


