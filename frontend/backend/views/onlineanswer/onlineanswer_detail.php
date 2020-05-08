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
<script src="/content/plugins/message/message.js" type="text/javascript"></script>

<?php
        echo '<div class="main_m_r" style="border:2px solid #F6F6F6;"><form role="form" method="post" action="question_submit">
                <div style="height:300px;">';
                if(!empty($data)){
                    echo '<div style="margin:30px;">';
                    foreach ($data as $data_k => $data_val){
                            echo '<div style="padding: 10px 0 0 0;">
                                 <h3 class="fs-14 font-b9" style="color:#006600;margin: 0px 0 10px 0;">
                                 '.html::encode($data_val['replyUserName']).'回复: 
                                 <span class="pull-right" style="font-weight: normal;">回复时间:'.date("Y-m-d H:i", html::encode($data_val['replyTime'])).'</span></h3>
                                 <div class="fs-14" style="clear:both;line-height:22px;">
                                     '.html::encode($data_val['replyContents']).'
                                 </div>
                            </div>';

                        }

                    echo '</div>';
                }
            echo '</form>';

        echo '</div></div><!-- main_m_r -->';

    echo '</div >';
?>
<style>
    #score{text-align:left;}
    .score a:hover{background:url("/content/images/star_info.png") 0 -21px no-repeat;}
</style>
<script>
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
        if ($.trim($('#userRoleIds').val() != '')) {
            $('#selUserRoleIds').selectpicker('val', $('#userRoleIds').val());
        }
    });
</script>
