<?php
use yii\helpers\Html;
?>
<!--<link href="/content/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
<link href="/content/css/style.min.css" rel="stylesheet" type="text/css"/>
<style>
    body{ font-family: "Microsoft YaHei";color: #000;  }
    .wrapper_page{min-width: 1520px;}
    .main{ width: 1520px;margin: 30px auto 20px auto; }
    .main-header{ width: 1520px;margin: 0 auto;color: #000;  }
    .month{ width: 60px;/*font-size: 16px;font-weight: 800;*/ overflow: hidden; padding:0; }
    .table-bordered>thead{background: transparent;color: #000;font-size: 15px;font-weight: bold;}
    .table-bordered>thead>tr>th{ text-align: center;}
    .table-bordered>tbody>tr>td,
    .table-bordered>tbody>tr>th,
    .table-bordered>tfoot>tr>td,
    .table-bordered>tfoot>tr>th,
    .table-bordered>thead>tr>td,
    .table-bordered>thead>tr>th,
    .table-bordered{ border-color: #222; color: #000;padding:7px 3px;}

    /*.table-bordered>tbody>tr>td{padding:0;}*/

    .font-b {
        font-size: 16px;
        font-weight: 900;
        padding:7px 15px!important;
    }
    td input{border:0!important;outline: none!important; width:100%!important; height: 100%!important; min-height: 35px; text-align: center;}
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
    .bg-curr {background-color:#eee;}

</style>

<script>
    $(function () {
        $("input").each(function(index){
            $(this).parent().css("padding","0");
        });
        $("[data-toggle='tooltip']").tooltip();

        $("input").focus(function(){
            $(this).parent().parent().addClass("bg-curr");
            $(this).parent().parent().children().find("input").css("background","#eee");
            $(this).parent().find("input").css("background","#f9f9f9");
        });
        $("input").blur(function(){
            $(this).parent().parent().removeClass("bg-curr");
            $(this).parent().find("input").css("background","#fff");
            $(this).parent().parent().children().find("input").css("background","#fff");
        });
    });
</script>
<?php
if(!empty($data)){
    echo json_encode($data['0']['children']['0']);
}
?>
<div class="main">
    <div class="main-header fs-24 text-c font-b9">党员积分管理卡（中层干部）</div>
    <div class="main-title fs-16 ftf-m text-r">
        <p class="pull-left">
            <select id="currTime" class="form-control">
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
            </select>
        </p>
        <p style="height: 34px;line-height: 34px;"><span>支部：<b>广分党委</b></span>&nbsp;&nbsp;&nbsp;<span>姓名：<b>欧阳小妹</b></span></p>
    </div>
    <div class="main-content">
        <table class="table table-bordered" style="table-layout:fixed;">
            <thead>
            <th class="month" style="width: 45px;">序号</th>
            <th class="month" style="width: 45px;">标准</th>
            <th class="month" style="width: 45px;">目标</th>
            <th style="width: 120px;">类别</th>
            <th>内容</th>
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
            <tr>
                <td>1</td>
                <td class="font-b" rowspan="5">信念坚定</td>
                <td class="font-b" rowspan="24">
                    铁一般信仰
                    <br/> <br/> <br/> <br/> <br/> <br/>
                    铁一般信念
                    <br/> <br/> <br/> <br/> <br/> <br/>
                    铁一般记律
                    <br/> <br/> <br/> <br/> <br/> <br/>
                    铁一般担当
                </td>
                <td>自学</td>
                <td rowspan="2" class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">自主学习及参加党组织的各类学习、培训，认真完成党支部的学习任务</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>2</td>
                <td>集中学习</td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>3</td>
                <td>主题党日</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">参加党组织的主题党日活动（每个月最后一周的周五）</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>4</td>
                <td>党费缴纳</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">每月主动及时足额向党组织缴纳党费</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>5</td>
                <td>三会一课</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">组织党支部"三会一课"等组织生活，并做好会议学习笔记</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>

            <tr>
                <td>6</td>
                <td class="font-b" rowspan="4">为人民服务</td>
                <td>谈心谈话制度</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">密切联系群众</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>7</td>
                <td>基层调研</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">下基层调研</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>8</td>
                <td>志愿服务活动</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">参加公司活动及社会济源团体组织的自愿服务活动</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>9</td>
                <td>党群共建</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">参加党员帮扶活动</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>

            <tr>
                <td>10</td>
                <td class="font-b" rowspan="10">勤政务实</td>
                <td>经营业绩</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">在公司发展中能充分发挥基层党组织的战斗堡垒和党员的先锋模范作用</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>11</td>
                <td>明大德</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">富强、明主、文明、和谐</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>12</td>
                <td>重功德</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">自由、平等、公正、法治</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>13</td>
                <td rowspan="4">严私德</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">爱国</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>14</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">敬业</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>15</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">诚信</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>16</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">友善</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>17</td>
                <td>遵纪</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">严格遵守党纪党规（《中国共产党章程》、《准则》、《循规》）</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>18</td>
                <td>守法</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">本人及家庭成员严格遵守各项法律法规（宪法、基本法）</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>19</td>
                <td>循规</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">严格遵守公司章程和内部规章</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>20</td>
                <td class="font-b" rowspan="2">敢于担当</td>
                <td>勇敢担当 敢作为</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">坚决完成上级党组织分配的任务，攻坚克难</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>21</td>
                <td>争当个人先锋</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">争取各项荣誉</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>22</td>
                <td class="font-b" rowspan="3">清正廉洁</td>
                <td rowspan="2">廉洁谈心谈话</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">落实廉洁风险防控相关工作</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>23</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">本单位关键敏感岗位</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>24</td>
                <td>接受廉洁教育</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">按照纪委要求参加廉洁教育</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>25</td>
                <td rowspan="2" colspan="2">批评与自我批评</td>
                <td>明主生活会</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">对照党员标准,进行个人自评、党员互评、民主测评</span></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>26</td>
                <td>组织生活会</td>
                <td class="text-l"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">按照要求召开组织生活会,开展批评与自我批评</span></td>
                <td colspan="11">12月份开始准备召开领导班子组织生活会</td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td></td>
                <td><strong>说明</strong></td>
                <td colspan="15"><span data-toggle="tooltip" data-placement="top" title="深入学习贯彻党的十九大精神，
                    以习近平新时代中国特色社会主义思想武装头脑、指导实践、推动工作，学习党的基本理论知识，有结合实际的学习笔记，积分0.5分/月">党员积分作为年度表彰重要依据;违法党规党纪、违反的党员，实施一票否决，该年度积分为0</span></td>
            </tr>
            <tr>
                <td rowspan="3" colspan="3">季度评议</td>
                <td rowspan="3" colspan="2">党员每月自主申报积分事项和积分，每月支委会初评，每月党员大会评定公示，年末根据四个季度积分计算出年度积分，本年度积分的20%作为下年度基础分，新转入党员基础分以上年度本支部平均基础分作为基础分。</td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
                <td><input type="text"/></td>
            </tr>
            <tr>
                <td>第一季度</td>
                <td colspan="2"><input type="text"/></td>
                <td>第二季度</td>
                <td colspan="2"><input type="text"/></td>
                <td>第三季度</td>
                <td colspan="2"><input type="text"/></td>
                <td>第四季度</td>
                <td colspan="2"><input type="text"/></td>
            </tr>
            <tr>
                <td>月度积分</td>
                <td colspan="3"><input type="text"/></td>
                <td>季度积分</td>
                <td colspan="3"><input type="text"/></td>
                <td>年度积分</td>
                <td colspan="3"><input type="text"/></td>
            </tr>
            </tbody>
        </table>
        <div style="height: 10px;"></div>
    </div>
</div>
