
<?php
use yii\helpers\Html;
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['name'];
$userId = $user_msginfo['idStr'];
?>
<link href="/content/css/course/course.css" rel="stylesheet" type="text/css"/>
<link href="/content/css/uncommon/personal.css" rel="stylesheet" type="text/css"/>
<link href="/content/css/uncommon/newpersonal.css" rel="stylesheet" type="text/css"/>
<link href="/content/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>

<!--<script src="/content/js/personal/jquery-latest.js" type="text/javascript"></script>-->
<script src="/content/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="/content/js/personal/pc.js" type="text/javascript"></script>
<script src="/content/js/personal/personal.js" type="text/javascript"></script>

<link href="/content/css/uncommon/wish.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="/content/css/font-awesome.css">
<script src="/plugins/daterangepicker/moment.js" type="text/javascript"></script>
<script src="/content/plugins/message/message.js" type="text/javascript"></script>
<script src="/content/js/pageScript/wish.js" type="text/javascript"></script>
<style>
    .btn-pad{
        padding: 0 10px!important;
        right: 11px!important;
        position: absolute;
    }
</style>
<div class="Contant Mwidth">
    <div class="ContantRight">
        <!--  -->
        <div class="secmain">
            <!--<div class="secmain-select">
                <div class="secmain-select-type">
                    <p>分类</p>
                    <ul class="secmain-type">
                        <li  class=""><a data-type="0" href="/wish/wish_list?type=0">个人心愿</a></li>
                        <li  class=""><a data-type="3" href="/wish/wish_list?type=3">我的心愿</a></li>
                        <li class=""><a data-type="1" href="/wish/wish_list?type=1">心愿能力</a></li>
                        <li class=""><a data-type="2" href="/wish/wish_list?type=2">我的心愿能力</a></li>
                    </ul>
                    <a href="/wish/wish_add?type=<?/*=$_GET['type'] */?>" target="_blank" class="btn btn-info" style=" float: right;margin-right: 4%!important; margin: 10px auto;"><?/*=(($_GET['type']==0||$_GET['type']==3)?'许愿':'添加心愿能力')*/?></a>
                </div>
                <?php
            /*                if($_GET['type']==0){
                                echo '
                               <!-- <div class="secmain-select-type">
                                    <p>认领状态</p>
                                    <ul class="secmain-type">
                                        <li class=""><a href="/Service/Wish/?wstatus=4">认领中</a></li>
                                        <li class=""><a href="/Service/Wish/?wstatus=5">已认领</a></li>
                                    </ul>
                                </div>-->';
                            }
                            */?>

            </div>-->
            <ul class="secmain-list wish">
                <?php
                if(!empty($data['listDonation'])){
                    foreach ($data['listDonation'] as $num =>$val){
                        echo'
                           <li>
                                <a target="_blank"  href="/donation/donation_detail?idStr='.$val['idStr'].'">
                                    <div class="txt">'.$val['actionsTitle'].'</div>
                                    <div class="adds">'.$val['contentsText'].'</div>
                                     <div class="adds">报名开始时间：'.date("Y-m-d", html::encode($val['publishBeginTime'])).'</div>
                                     <div class="adds">报名结束时间：'.date("Y-m-d", html::encode($val['publishEndTime'])).'</div>
                                     <div class="adds">活动开始时间：'.date("Y-m-d", html::encode($val['actionsBeginTime'])).'</div>
                                     <div class="adds">活动开始时间：'.date("Y-m-d", html::encode($val['actionsEndTime'])).'</div>
                                    <div class="num"><span class="rnum ';if(isset($val['enterState'])){
                                        echo(html::encode($val['enterState'])==0?'bg-wish-state-red':'bg-wish-state-yellow') ;}echo '">';
                                        if(isset($val['enterState'])){
                                            echo (html::encode($val['enterState'])==0?'已报名':'未报名');
                                        }
                                        echo '</span><span class="pnum">'.html::encode($val['linkmanName']).'</span></div>
                                    <i></i>
                                </a>';
                        echo '
                            </li>';
                    }
                }
                ?>
                <a ></a>

            </ul>
        </div>
    </div>
</div>
<?php require(__DIR__ . '/../layouts/pageNumbers.php'); ?>
<script>
    $(function () {
        var location = window.location;
        var search = location.search;
        var searchArr = search.length ? search.substr(1, search.length).split('&') : [];
        var searchObj = {};
        var $msg = "";
        for (var i in searchArr) {
            var item = searchArr[i].split('=');
            searchObj[item[0]] = item[1];
        }
        if(searchObj.type!=undefined&&searchObj.type!=''){
            $('.secmain-type').find('a[data-type='+searchObj.type+']').addClass('hover-a');
            $('.search_params')
        }
    })
</script>

