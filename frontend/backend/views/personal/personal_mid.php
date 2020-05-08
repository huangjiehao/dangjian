<?php
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['name'];
$userId = $user_msginfo['idStr'];
$userLevel = $user_msginfo['userLevel'];
$orgName = $user_msginfo['orgName'];
use yii\helpers\Html;
?>
<link href="/content/css/style.min.css" rel="stylesheet" type="text/css"/>
<link href="/content/plugins/message/message.css" rel="stylesheet" type="text/css"/>
<script src="/content/plugins/message/message.js" type="text/javascript"></script>
<style>
    body{ font-family: "open sans","Helvetica Neue",Helvetica,Arial,sans-serif;font-size:12px;color: #000;  }
    .container{ min-width: 1200px; background: #fff; }
    .main-header{margin: 25px auto 0 auto;color: #000; font-family: 'Microsoft YaHei'; }
    .month{ width: 60px; overflow: hidden; padding:0; }
    .table-bordered>thead{background: transparent;color: #000;font-size: 12px;}
    .table-bordered>thead>tr>th{ text-align: center; }
    .table-bordered>tbody>tr>td,
    .table-bordered>tbody>tr>th,
    .table-bordered>tfoot>tr>td,
    .table-bordered>tfoot>tr>th,
    .table-bordered>thead>tr>td,
    .table-bordered>thead>tr>th,
    .table-bordered{ border-color: #222; color: #000;padding:7px 3px;}

    @media screen and (min-width: 1200px){
        .container {
            width: 85%;
        }
    }

    .font-b {
        font-size: 16px;
        font-weight: 900;
        /* padding:7px 15px!important;*/
    }
    td input{border:0!important;outline: none!important; width:100%!important; height: 100%!important; min-height: 35px; text-align: center; background: #fff;}
    .tooltip.in{opacity: 0.96;}
    .tooltip-inner{
        max-width: 600px;
        padding: 10px;
        color: #333;
        font-size: 14px;
        background-color: #fff;
        border:1px solid #ccc;
        border-radius: 4px;
        letter-spacing: 2px;
        text-align: left;
        -moz-box-shadow:2px 2px 5px #333333; -webkit-box-shadow:2px 2px 5px #333333; box-shadow:2px 2px 5px #333333;
    }
    .tooltip.right .tooltip-arrow{ border-right-color: #a1b3c3;}
    td span{display: block;cursor:pointer;}
    .bg-curr {background-color:#fff;}

    td span{ padding:5px 0;}

</style>

<script>
    $(function () {
        $("input").each(function(index){
            $(this).parent().css("padding","0");
        });
        $("[data-toggle='tooltip']").tooltip();

        $("input").focus(function(){
            $(this).parent().parent().addClass("bg-curr");
            $(this).parent().parent().children().find("input").css("background","#f5f5f5");
            $(this).parent().find("input").css("background","#f9f9f9");
        });
        $("input").blur(function(){
            $(this).parent().parent().removeClass("bg-curr");
            $(this).parent().find("input").css("background","#fff");
            $(this).parent().parent().children().find("input").css("background","#fff");
        });
    });
</script>
<div class="container">
    <div class="main-header fs-24 text-c font-b9">
        <?php if($userLevel==0){
            echo '党员积分管理卡（普通党员）';
        }else if($userLevel==1){
            echo '党员积分管理卡（中层干部）';
        }
        ?>
    </div>
    <div class="main-title fs-16 ftf-m text-r">
        <?php if(!empty($dataTime['result'])){
            echo '<p class="col-sm-2 pull-left" style="padding: 0;">
                <select id="coinYear" class="form-control">';
            foreach ($dataTime['result'] as $data_k => $data_val){
                echo '<option value="'.html::encode($data_val['coinYear']).'">'.html::encode($data_val['coinYear']).'</option>';
            }
            echo '</select> 
            </p>';
        }else{
            echo '<input type="hidden" id="coinYear" value="'.date('Y').'"/>';
        }
        ?>
        <p style="height: 34px;line-height: 34px;"><span>党组织：<b><?=$orgName ?></b></span>&nbsp;&nbsp;&nbsp;<span>姓名：<b><?=$userName ?></b></span></p>
    </div>
    <div class="main-content">
        <table class="table table-bordered" style="table-layout:fixed;">
            <thead>
            <th class="month" style="width: 35px;font-family: 'Microsoft YaHei';">序号</th>
            <th class="month" style="width: 35px;font-family: 'Microsoft YaHei';">标准</th>
            <?php if($userLevel==1){
                echo '<th class="month" style="width:35px;font-family: \'Microsoft YaHei\';">目标</th>';
            }else{
                echo '<th class="month" style="width: 75px;font-family: \'Microsoft YaHei\';">目标</th>';
            }
            ?>
            <th style="width: 5%;font-family: 'Microsoft YaHei';">类别</th>
            <th style="width: 12%;font-family: 'Microsoft YaHei';">内容</th>
            <th style="width: 23%;font-family: 'Microsoft YaHei';">评议标准</th>
            <th class="month">1月</th>
            <th class="month">2月</th>
            <th class="month">3月</th>
            <th class="month">4月</th>
            <th class="month">5月</th>
            <th class="month">6月</th>
            <th class="month">7月</th>
            <th class="month">8月</th>
            <th class="month">9月</th>
            <th class="month">10月</th>
            <th class="month">11月</th>
            <th class="month">12月</th>
            </thead>
            <tbody>
            <?php
            if(!empty($data['result'])){
                foreach ($data['result'] as $data_k => $data_val) {
                    echo '<tr>';
                    echo '<td>' . ($data_k + 1) . '</td>';
                    if(!empty($data_val['criteria']) && !empty($data_val['criteria']['rowSpanCount']) && !empty($data_val['criteria']['content']) && !empty($data_val['criteria']['colSpanCount'])){
                        echo '<td class="font-b" rowspan="'.html::encode($data_val['criteria']['rowSpanCount']).'" colspan="'.html::encode($data_val['criteria']['colSpanCount']).'">'.$data_val['criteria']['content'].'</td>';
                    }
                    if(!empty($data_val['target'])&& !empty($data_val['target']['rowSpanCount']) && !empty($data_val['target']['content'])&& !empty($data_val['target']['colSpanCount']) ) {
                        if ($userLevel == 1) {
                            echo '<td class="font-b" rowspan="' . html::encode($data_val['target']['rowSpanCount']) . '" colspan="' . html::encode($data_val['target']['colSpanCount']) . '">' . $data_val['target']['content'] . '</td>';
                        }else{
                            echo '<td rowspan="' . html::encode($data_val['target']['rowSpanCount']) . '" colspan="' . html::encode($data_val['target']['colSpanCount']) . '">' . $data_val['target']['content'] . '</td>';
                        }
                    }
                    if(!empty($data_val['type']['content'])){
                        echo '<td rowspan="'.html::encode($data_val['type']['rowSpanCount']).'" colspan="'.html::encode($data_val['type']['colSpanCount']).'">'.$data_val['type']['content'].'</td>';
                    }
                    if(!empty($data_val['contentDetail']['content'])){
                        echo '<td rowspan="'.html::encode($data_val['contentDetail']['rowSpanCount']).'" colspan="'.html::encode($data_val['contentDetail']['colSpanCount']).'" class="text-l" style="padding:0 10px;">';
                        if(!empty($data_val['criteriaDetail'])) {
                            echo '<span data-toggle="tooltip" data-placement="top">';
                        }
                        echo $data_val['contentDetail']['content'];
                        echo '</td>';
                    }
                    if(!empty($data_val['criteriaDetail']['content'])){
                        echo '<td class="text-l" style="padding:0 10px;">';
                        if(!empty($data_val['criteriaDetail'])) {
                            echo '<span data-toggle="tooltip" data-placement="top">';
                        }
                        echo $data_val['criteriaDetail']['content'];
                        echo '</td>';
                    }
//                    \common\models\MyFunction::sun_p($data_val['marVal']);DIE;
                    echo '<td><input data-id="'.html::encode($data_val['id']).'" data-month="1" id="janVal" name="janVal" value="'.html::encode($data_val['janVal']).'" type="text" class="addCoin"  onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                                <input type="hidden" id="oldJanVal" value="'.html::encode($data_val['janVal']).'" /></td>
                            <td><input data-id="'.html::encode($data_val['id']).'" data-month="2" id="febVal" name="febVal" value="'.html::encode($data_val['febVal']).'" type="text" class="addCoin" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                                <input type="hidden" id="oldFebVal" value="'.html::encode($data_val['febVal']).'" /></td>
                            <td><input data-id="'.html::encode($data_val['id']).'" data-month="3" id="marVal" name="marVal" value="'.html::encode($data_val['marVal']).'" type="text" class="addCoin" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                                <input type="hidden" id="oldMarVal" value="'.html::encode($data_val['marVal']).'" /></td>
                            <td><input data-id="'.html::encode($data_val['id']).'" data-month="4" id="apriVal" name="apriVal" value="'.html::encode($data_val['apriVal']).'" type="text" class="addCoin" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                                <input type="hidden" id="oldApriVal" value="'.html::encode($data_val['apriVal']).'" /></td>
                            <td><input data-id="'.html::encode($data_val['id']).'" data-month="5" id="mayVal" name="mayVal" value="'.html::encode($data_val['mayVal']).'" type="text" class="addCoin" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                                <input type="hidden" id="oldMayVal" value="'.html::encode($data_val['mayVal']).'" /></td>
                            <td><input data-id="'.html::encode($data_val['id']).'" data-month="6" id="juneVal" name="juneVal" value="'.html::encode($data_val['juneVal']).'" type="text" class="addCoin" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                                <input type="hidden" id="oldJuneVal" value="'.html::encode($data_val['juneVal']).'" /></td>
                            <td><input data-id="'.html::encode($data_val['id']).'" data-month="7"  id="julyVal" name="julyVal" value="'.html::encode($data_val['julyVal']).'" type="text" class="addCoin" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                                <input type="hidden" id="oldJulyVal" value="'.html::encode($data_val['julyVal']).'" /></td>
                            <td><input data-id="'.html::encode($data_val['id']).'" data-month="8"  id="augVal" name="augVal" value="'.html::encode($data_val['augVal']).'" type="text" class="addCoin" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                                <input type="hidden" id="oldAugVal" value="'.html::encode($data_val['augVal']).'" /></td>
                            <td><input data-id="'.html::encode($data_val['id']).'" data-month="9"  id="sepVal" name="sepVal" value="'.html::encode($data_val['sepVal']).'" type="text" class="addCoin" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                                <input type="hidden" id="oldSepVal" value="'.html::encode($data_val['sepVal']).'" /></td>
                            <td><input data-id="'.html::encode($data_val['id']).'" data-month="10" id="octVal" name="octVal" value="'.html::encode($data_val['octVal']).'" type="text" class="addCoin" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                                <input type="hidden" id="oldOctVal" value="'.html::encode($data_val['octVal']).'" /></td>
                            <td><input data-id="'.html::encode($data_val['id']).'" data-month="11" id="novVal" name="novVal" value="'.html::encode($data_val['novVal']).'" type="text" class="addCoin" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                                <input type="hidden" id="oldNovVal" value="'.html::encode($data_val['novVal']).'" /></td>
                            <td><input data-id="'.html::encode($data_val['id']).'" data-month="12" id="decVal" name="decVal" value="'.html::encode($data_val['decVal']).'" type="text" class="addCoin" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                                <input type="hidden" id="oldDecVal" value="'.html::encode($data_val['decVal']).'" /></td>
                    </tr>';
                }

            }
            ?>
            <?php if(!empty($bottomData)){
                if(!empty($bottomData['result'])){
                    echo '<tr>
                        <td></td>
                        <td><strong>说明</strong></td>
                        <td colspan="16">党员积分作为年度表彰重要依据;违法党规党纪、违反的党员，实施一票否决，该年度积分为0</td>
                    </tr>
                    <tr>
                        <td rowspan="3" colspan="3" class="font-b">季度评议</td>
                        <td rowspan="3" colspan="2" class="text-l">党员每月自主申报积分事项和积分，每月支委会初评，每月党员大会评定公示，年末根据四个季度积分计算出年度积分，本年度积分的20%作为下年度基础分，新转入党员基础分以上年度本支部平均基础分作为基础分。</td>
                        <td rowspan="1" colspan="1">月度积分：</td>
                        <td><input class="addCoinMonth mon_1" readonly data-month="1" id="janVal_m" name="janVal" value="'.html::encode($bottomData['result']['janVal']).'" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="'.html::encode($bottomData['result']['janVal']).'" /></td>
                        <td><input class="addCoinMonth mon_2" readonly data-month="2" id="febVal_m" name="febVal" value="'.html::encode($bottomData['result']['febVal']).'" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="'.html::encode($bottomData['result']['febVal']).'" /></td>
                        <td><input class="addCoinMonth mon_3" readonly data-month="3" id="marVal_m" name="marVal" value="'.html::encode($bottomData['result']['marVal']).'" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="'.html::encode($bottomData['result']['marVal']).'" /></td>
                        <td><input class="addCoinMonth mon_4" readonly data-month="4" id="apriVal_m" name="apriVal" value="'.html::encode($bottomData['result']['apriVal']).'" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="'.html::encode($bottomData['result']['apriVal']).'" /></td>
                        <td><input class="addCoinMonth mon_5" readonly data-month="5" id="mayVal_m" name="mayVal" value="'.html::encode($bottomData['result']['mayVal']).'" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="'.html::encode($bottomData['result']['mayVal']).'" /></td>
                        <td><input class="addCoinMonth mon_6" readonly data-month="6" id="juneVal_m" name="juneVal" value="'.html::encode($bottomData['result']['juneVal']).'" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="'.html::encode($bottomData['result']['juneVal']).'" /></td>
                        <td><input class="addCoinMonth mon_7" readonly data-month="7" id="julyVal_m" name="julyVal" value="'.html::encode($bottomData['result']['julyVal']).'" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="'.html::encode($bottomData['result']['julyVal']).'" /></td>
                        <td><input class="addCoinMonth mon_8" readonly data-month="8" id="augVal_m" name="augVal" value="'.html::encode($bottomData['result']['augVal']).'" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="'.html::encode($bottomData['result']['augVal']).'" /></td>
                        <td><input class="addCoinMonth mon_9" readonly data-month="9" id="sepVal_m" name="sepVal" value="'.html::encode($bottomData['result']['sepVal']).'" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="'.html::encode($bottomData['result']['sepVal']).'" /></td>
                        <td><input class="addCoinMonth mon_10" readonly data-month="10" id="octVal_m" name="octVal" value="'.html::encode($bottomData['result']['octVal']).'" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="'.html::encode($bottomData['result']['octVal']).'" /></td>
                        <td><input class="addCoinMonth mon_11" readonly data-month="11" id="novVal_m" name="novVal" value="'.html::encode($bottomData['result']['novVal']).'" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="'.html::encode($bottomData['result']['novVal']).'" /></td>
                        <td><input class="addCoinMonth mon_12" readonly data-month="12" id="decVal_m" name="decVal" value="'.html::encode($bottomData['result']['decVal']).'" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="'.html::encode($bottomData['result']['decVal']).'" /></td>
                    </tr>
                    <tr>
                        <td rowspan="1" colspan="1">季度积分：</td>
                        <td>第一季度</td>
                        <td colspan="2"><input type="text" value="'.html::encode($bottomData['result']['season1Val']).'" class="addCoin_1" readonly/></td>
                        <td>第二季度</td>
                        <td colspan="2"><input type="text" value="'.html::encode($bottomData['result']['season2Val']).'" class="addCoin_2" readonly/></td>
                        <td>第三季度</td>
                        <td colspan="2"><input type="text" value="'.html::encode($bottomData['result']['season3Val']).'" class="addCoin_3" readonly/></td>
                        <td>第四季度</td>
                        <td colspan="2"><input type="text" value="'.html::encode($bottomData['result']['season4Val']).'" class="addCoin_4" readonly/></td>
                    </tr>
                    <tr>
                        <td rowspan="1" colspan="1">年度积分：</td>
                        <td colspan="12"><input type="text" id="monthSum" value="'.html::encode($bottomData['result']['annualVal']).'" readonly/></td>
                    </tr>';
                }else{
                    echo '<tr>
                        <td></td>
                        <td><strong>说明</strong></td>
                        <td colspan="16">党员积分作为年度表彰重要依据;违法党规党纪、违反的党员，实施一票否决，该年度积分为0</td>
                    </tr>
                    <tr>
                        <td rowspan="3" colspan="3" class="font-b">季度评议</td>
                        <td rowspan="3" colspan="2" class="text-l">党员每月自主申报积分事项和积分，每月支委会初评，每月党员大会评定公示，年末根据四个季度积分计算出年度积分，本年度积分的20%作为下年度基础分，新转入党员基础分以上年度本支部平均基础分作为基础分。</td>
                        <td rowspan="1" colspan="1">月度积分：</td>
                        <td><input class="addCoinMonth mon_1" readonly data-month="1" id="janVal_m" name="janVal" value="" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="0"/></td>
                        <td><input class="addCoinMonth mon_2" readonly data-month="2" id="febVal_m" name="febVal" value="" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="0"/></td>
                        <td><input class="addCoinMonth mon_3" readonly data-month="3" id="marVal_m" name="marVal" value="" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="0"/></td>
                        <td><input class="addCoinMonth mon_4" readonly data-month="4" id="apriVal_m" name="apriVal" value="" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="0"/></td>
                        <td><input class="addCoinMonth mon_5" readonly data-month="5" id="mayVal_m" name="mayVal" value="" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="0"/></td>
                        <td><input class="addCoinMonth mon_6" readonly data-month="6" id="juneVal_m" name="juneVal" value="" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="0"/></td>
                        <td><input class="addCoinMonth mon_7" readonly data-month="7" id="julyVal_m" name="julyVal" value="" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="0"/></td>
                        <td><input class="addCoinMonth mon_8" readonly data-month="8" id="augVal_m" name="augVal" value="" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="0"/></td>
                        <td><input class="addCoinMonth mon_9" readonly data-month="9" id="sepVal_m" name="sepVal" value="" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="0"/></td>
                        <td><input class="addCoinMonth mon_10" readonly data-month="10" id="octVal_m" name="octVal" value="" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" /></td>
                        <td><input class="addCoinMonth mon_11" readonly data-month="11" id="novVal_m" name="novVal" value="" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="0"/></td>
                        <td><input class="addCoinMonth mon_12" readonly data-month="12" id="decVal_m" name="decVal" value="" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" onafterpaste="if(isNaN(value))execCommand(\'undo\')"/>
                            <input type="hidden" value="0"/></td>
                    </tr>
                    <tr>
                        <td rowspan="1" colspan="1">季度积分：</td>
                        <td>第一季度</td>
                        <td colspan="2"><input type="text" value="" class="addCoin_1" readonly/></td>
                        <td>第二季度</td>
                        <td colspan="2"><input type="text" value="" class="addCoin_2" readonly/></td>
                        <td>第三季度</td>
                        <td colspan="2"><input type="text" value="" class="addCoin_3" readonly/></td>
                        <td>第四季度</td>
                        <td colspan="2"><input type="text" value="" class="addCoin_4" readonly/></td>
                    </tr>
                    <tr>
                        <td rowspan="1" colspan="1">年度积分：</td>
                        <td colspan="12"><input id="monthSum" type="text" value="" readonly/></td>
                    </tr>';
                }
            }
            ?>
            </tbody>
        </table>
        <div style="height: 10px;"></div>
    </div>
</div>
<script>
    $(function() {
        //鼠标移入事件
        $(".addCoin").mouseenter(function () {
            var userCoinHeaderId = $(this).data('id');
        });
        <!-- 鼠标移出事件-->
        $(".addCoin").keyup(function () { //移出保存数据
            var userCoinHeaderId = $(this).data('id');
            var oldVal = $(this).next().val();
            var currMonth = $(this).data('month');
            var coinYear = $("#coinYear").val();

            var  janVal = $(this).parent().siblings().find("#janVal").val(),
                febVal = $(this).parent().siblings().find("#febVal").val(),
                marVal = $(this).parent().siblings().find("#marVal").val(),
                apriVal = $(this).parent().siblings().find("#apriVal").val(),
                mayVal =  $(this).parent().siblings().find("#mayVal").val(),
                juneVal = $(this).parent().siblings().find("#juneVal").val(),
                julyVal = $(this).parent().siblings().find("#julyVal").val(),
                augVal = $(this).parent().siblings().find("#augVal").val(),
                sepVal = $(this).parent().siblings().find("#sepVal").val(),
                octVal = $(this).parent().siblings().find("#octVal").val(),
                novVal = $(this).parent().siblings().find("#novVal").val(),
                decVal = $(this).parent().siblings().find("#decVal").val();
            var isAdd = ""; //判断是否输入值，不输入则不调用接口
            switch(currMonth){
                case 1:
                    janVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 2:
                    febVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 3:
                    marVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 4:
                    apriVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 5:
                    mayVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 6:
                    juneVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 7:
                    julyVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 8:
                    augVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 9:
                    sepVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 10:
                    octVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 11:
                    novVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 12:
                    decVal = $(this).val();
                    isAdd = $(this).val();
                    break;
            }
            if(isAdd == "" || isAdd!=oldVal ){ //isAdd != "" &&
                $.ajax({
                    url:'/personal/personal_save',
                    data:{
                        "userCoinHeaderId":userCoinHeaderId,
                        "coinYear":coinYear,
                        "janVal":janVal,
                        "febVal":febVal,
                        "marVal":marVal,
                        "apriVal":apriVal,
                        "mayVal":mayVal,
                        "juneVal":juneVal,
                        "julyVal":julyVal,
                        "augVal":augVal,
                        "sepVal":sepVal,
                        "octVal":octVal,
                        "novVal":novVal,
                        "decVal":decVal
                    },
                    type : 'POST',
                    dataType : 'json',
                    success:function(result){
                        $.message('保存成功！');
                        var rst = result['data']['listUserCoinReview']['0'];
                        $("#janVal_m").val(rst['janVal']);
                        $("#febVal_m").val(rst['febVal']);
                        $("#marVal_m").val(rst['marVal']);
                        $("#apriVal_m").val(rst['apriVal']);
                        $("#mayVal_m").val(rst['mayVal']);
                        $("#juneVal_m").val(rst['juneVal']);
                        $("#julyVal_m").val(rst['julyVal']);
                        $("#augVal_m").val(rst['augVal']);
                        $("#sepVal_m").val(rst['sepVal']);
                        $("#octVal_m").val(rst['octVal']);
                        $("#novVal_m").val(rst['novVal']);
                        $("#decVal_m").val(rst['decVal']);

                        $(".addCoin_1").val(rst['season1Val']);
                        $(".addCoin_2").val(rst['season2Val']);
                        $(".addCoin_3").val(rst['season3Val']);
                        $(".addCoin_4").val(rst['season4Val']);

                        $("#monthSum").val(rst['annualVal']);

                    },error:function(){
                        $.message({
                            message:'保存失败！',
                            type:'error'
                        });
                    }
                });
            }

        });

        //月度积分鼠标移入事件
        <!-- 月度积分鼠标移出事件-->

        $(".addCoinMonth").keyup(function () { //移出保存数据
            var index = $(".addCoinMonth").index(this);
            /* alert(index+1);*/
            var currMonth = $(this).data('month');
            var oldVal = $(this).next().val();
            var coinYear = $("#coinYear").val();
            var currVal = $(this).val();

            var janVal = $(this).parent().siblings().find("#janVal_m").val(),
                febVal = $(this).parent().siblings().find("#febVal_m").val(),
                marVal = $(this).parent().siblings().find("#marVal_m").val(),
                apriVal = $(this).parent().siblings().find("#apriVal_m").val(),
                mayVal =  $(this).parent().siblings().find("#mayVal_m").val(),
                juneVal = $(this).parent().siblings().find("#juneVal_m").val(),
                julyVal = $(this).parent().siblings().find("#julyVal_m").val(),
                augVal = $(this).parent().siblings().find("#augVal_m").val(),
                sepVal = $(this).parent().siblings().find("#sepVal_m").val(),
                octVal = $(this).parent().siblings().find("#octVal_m").val(),
                novVal = $(this).parent().siblings().find("#novVal_m").val(),
                decVal = $(this).parent().siblings().find("#decVal_m").val();
            var isAdd = ""; //判断是否输入值，不输入则不调用接口
            switch(currMonth){
                case 1:
                    janVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 2:
                    febVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 3:
                    marVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 4:
                    apriVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 5:
                    mayVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 6:
                    juneVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 7:
                    julyVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 8:
                    augVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 9:
                    sepVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 10:
                    octVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 11:
                    novVal = $(this).val();
                    isAdd = $(this).val();
                    break;
                case 12:
                    decVal = $(this).val();
                    isAdd = $(this).val();
                    break;
            }
            if(isAdd != ""&& isAdd != oldVal){
                $.ajax({
                    url:'/personal/personal_savemonth',
                    data:{
                        "coinYear":coinYear,
                        "janVal":janVal,
                        "febVal":febVal,
                        "marVal":marVal,
                        "apriVal":apriVal,
                        "mayVal":mayVal,
                        "juneVal":juneVal,
                        "julyVal":julyVal,
                        "augVal":augVal,
                        "sepVal":sepVal,
                        "octVal":octVal,
                        "novVal":novVal,
                        "decVal":decVal
                    },
                    type : 'POST',
                    dataType : 'json',
                    success:function(result){
                        console.dir(result);
                        var mon_1,mon_2,mon_3,mon_4,mon_5,mon_6,mon_7,mon_8,mon_9,mon_10,mon_11,mon_12,addCoin_1,addCoin_2,addCoin_3,addCoin_4;
                        if(index<=2){
                            if($(".mon_1").val()==""){ mon_1 = parseInt(0); }else{ mon_1 = parseInt($(".mon_1").val()); }
                            if($(".mon_2").val()==""){ mon_2 = parseInt(0); }else{ mon_2 = parseInt($(".mon_2").val()); }
                            if($(".mon_3").val()==""){ mon_3 = parseInt(0); }else{ mon_3 = parseInt($(".mon_3").val()); }

                            $(".addCoin_1").val(mon_1+mon_2+mon_3);
                        }else if(index<=5){
                            if($(".mon_4").val()==""){ mon_4 = parseInt(0); }else{ mon_4 = parseInt($(".mon_4").val()); }
                            if($(".mon_5").val()==""){ mon_5 = parseInt(0); }else{ mon_5 = parseInt($(".mon_5").val()); }
                            if($(".mon_6").val()==""){ mon_6 = parseInt(0); }else{ mon_6 = parseInt($(".mon_6").val()); }

                            $(".addCoin_2").val(mon_4+mon_5+mon_6);
                        }else if(index<=8){
                            if($(".mon_7").val()==""){ mon_7 = parseInt(0); }else{ mon_7 = parseInt($(".mon_7").val()); }
                            if($(".mon_8").val()==""){ mon_8 = parseInt(0); }else{ mon_8 = parseInt($(".mon_8").val()); }
                            if($(".mon_9").val()==""){ mon_9 = parseInt(0); }else{ mon_9 = parseInt($(".mon_9").val()); }

                            $(".addCoin_3").val(mon_7+mon_8+mon_9);
                        }else if(index<=11){
                            if($(".mon_10").val()==""){ mon_10 = parseInt(0); }else{ mon_10 = parseInt($(".mon_10").val()); }
                            if($(".mon_11").val()==""){ mon_11 = parseInt(0); }else{ mon_11 = parseInt($(".mon_11").val()); }
                            if($(".mon_12").val()==""){ mon_12 = parseInt(0); }else{ mon_12 = parseInt($(".mon_12").val()); }

                            $(".addCoin_4").val(mon_10+mon_11+mon_12);
                        }
                        if($(".addCoin_1").val()==""){ addCoin_1 = parseInt(0); }else{ addCoin_1 = parseInt($(".addCoin_1").val()); }
                        if($(".addCoin_2").val()==""){ addCoin_2 = parseInt(0); }else{ addCoin_2 = parseInt($(".addCoin_2").val()); }
                        if($(".addCoin_3").val()==""){ addCoin_3 = parseInt(0); }else{ addCoin_3 = parseInt($(".addCoin_3").val()); }
                        if($(".addCoin_4").val()==""){ addCoin_4 = parseInt(0); }else{ addCoin_4 = parseInt($(".addCoin_4").val()); }

                        $("#monthSum").val(addCoin_1 + addCoin_2 + addCoin_3 + addCoin_4);
                        $.message('保存成功！');
                    },error:function(){
                        $.message({
                            message:'保存失败！',
                            type:'error'
                        });
                    }
                });
            }
        });
    });
</script>
