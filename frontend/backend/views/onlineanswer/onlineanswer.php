<?php
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['name'];
$userId = $user_msginfo['idStr'];
use yii\helpers\Html;
?>
<link href="/content/css/course/course.css" rel="stylesheet" type="text/css"/>
<link href="/content/css/uncommon/personal.css" rel="stylesheet" type="text/css"/>
<link href="/content/css/uncommon/newpersonal.css" rel="stylesheet" type="text/css"/>
<link href="/content/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>

<!--<script src="/content/js/personal/jquery-latest.js" type="text/javascript"></script>-->
<script src="/content/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="/content/js/personal/pc.js" type="text/javascript"></script>
<script src="/content/js/personal/personal.js" type="text/javascript"></script>

<link href="/content/plugins/message/message.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="/content/css/font-awesome.css">
<script src="/plugins/daterangepicker/moment.js" type="text/javascript"></script>
<script src="/content/plugins/message/message.js" type="text/javascript"></script>
<style>
    .list_answer{
        border-bottom: 1px solid #cac7c7;
        padding-bottom: 9px;
        clear:both;
        text-align:left;
        font-size:16px;
        line-height:22px
    }
</style>
<?php
    echo '<div class="main_m_r ly_main" style="border:2px solid #F6F6F6;">
        <form role="form" method="post" action="question_submit" onsubmit="return appendAnswerperson();">
             <div style="height:300px;">';
                echo '<label class="col-sm-12 control-label fs-20 font-b9" style="margin: 10px 0;color:#006600;">对用户提问：</label>';
                echo '<div class="col-sm-12">
                        <select id="user" name="user" type="text" class="form-control select_picker" multiple="multiple">';
                        if(!empty($data)){
                            if(!empty($data['listUser'])){
                                foreach ($data['listUser'] as $data_k => $data_val){
                                    echo '<option value="'.html::encode($data_val['idStr']).','.html::encode($data_val['name']).'" >'.html::encode($data_val['name']).'</option>';
                                }
                            }
                        }
                        echo '</select>
                        <input type="hidden" name="recUserJson" class="userArr">
                 </div>';

                echo '<label class="col-sm-12 control-label fs-20 font-b9" style="margin: 10px 0;color:#006600;">问题标题：</label>
                <div class="col-sm-12 text-c">
                    <input id="title" name="title" class="form-control reason" style="  border:1px solid #ccc;" ></input>
                </div>
                <label class="col-sm-12 control-label fs-20 font-b9" style="margin: 10px 0;color:#006600;">我的问题：</label>
                <div class="col-sm-12 text-c">
                    <textarea id="contents" name="contents" class="form-control reason" style="height: 100px;border:1px solid #ccc;" onKeyUp="keypress(id)" onblur="keypress(id)"></textarea>
                    <div class="text-right"><em id="pinglunDes" style="color:red">255</em>/<span>255</span></div>
                    <button type="submit" class="btn submit_btn btn-primary  btn-size-medium">提交</button>
                </div>
            </div>';//300
            if(!empty($getansData)){
                echo '<div style="margin:30px;">';
                foreach ($getansData['result'] as $data_k => $data_val){
                    echo '<div class="list_answer" style=";">
                        <h3 class="fs-14 font-b9" style="text-align:left;color:#006600;margin: 8px 0;">
                        '.html::encode($data_val['title']).': 
                        <span class="pull-right" style="font-weight: normal;">提问时间:'.date("Y-m-d H:i", html::encode($data_val['createTime'])).'</span></h3>
                        <a href="/onlineanswer/onlinanswer_detail?idStr='.html::encode($data_val['idStr']).'" class="btn btn-info" style="display: inline-block;float: right;padding: 1px 4px;">详情</a>
                        <p class="fs-14">'.html::encode($data_val['contents']).'</p>
                    </div>';
                }
                echo '</div>';
            }
    echo '</form>';

echo '</div></div><!-- main_m_r -->';

echo '</div >';

?>
<?php require(__DIR__ . '/../layouts/pageNumbers.php'); ?>
<style type="text/css">
    #score{text-align:left;}
    .score a:hover{background:url("/content/images/star_info.png") 0 -21px no-repeat;}
</style>
<script type="text/javascript">
    //设置数字限制
    function keypress(currId){
        var text1=document.getElementById(currId).value;
        var len;//记录剩余字符串的长度
        if(text1.length>=255){
            document.getElementById(currId).value=text1.substr(0,255);
            len=0;
        }else{
            len=255-text1.length;
        }
        document.getElementById("pinglunDes").innerText= len;
    }
    var i = 0;
    $(".star").click(function(){
        var score = $(this).parent().data("score");
        if( i!=0 || score != 0){
            $.message({
                message:'已评，请勿重复评论！',
                type:'warning'
            });
        }else{
            var num =$(this).data("index");
            var idStr =$(this).parent().data("id");
            $(this).parent().prev().css("width",(num * 22)+"px");
            $.ajax({
                url: '/personal/box_star_submit',
                data: {"id": idStr, "evaluateScore": num},
                type: 'post',
                success: function (result) {
                    $.message('评分成功！');
                }, error: function () {
                    $.message({
                        message:'评分失败！',
                        type:'error'
                    });
                }
            });
            return i=1;
        }
    });

    $(function(){
        $('form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                contents: {
                    validators: {
                        notEmpty: {
                            message: '我的问题不能为空！'
                        }
                    }
                },
                title: {
                    validators: {
                        notEmpty: {
                            message: '标题不能为空！'
                        }
                    }
                },
                user: {
                    validators: {
                        notEmpty: {
                            message: '请选择提问人！'
                        }
                    }
                }
            }
        });
        if ($.trim($('#userRoleIds').val() != '')) {
            $('#selUserRoleIds').selectpicker('val', $('#userRoleIds').val());
        }
        $('.select_picker').selectpicker({
            'selectedText': 'cat',
            'actionsBox':true,
            'liveSearch': true,
            'noneSelectedText': '--请选择--'
        });
    });
    function appendAnswerperson() {
        var user=$('#user').val();
        var userArr=[];
        if(user!=''){
            for (var i=0;i<user.length;i++){
                var obj={};
                obj.id=user[i].split(',')[0];
                obj.name=user[i].split(',')[1];
                userArr[userArr.length]=obj;
            }
            $(".userArr").val(JSON.stringify(userArr));
        }
    }
</script>
