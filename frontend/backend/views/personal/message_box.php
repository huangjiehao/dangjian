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
<script src="/content/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="/content/js/personal/pc.js" type="text/javascript"></script>
<script src="/content/js/personal/personal.js" type="text/javascript"></script>

<style>
    form{  padding: 3rem 10rem;  }
</style>
<input type="text" id="status" value="<?php if(isset($_GET['status'])){echo html::encode($_GET['status']);}?>">
<?php if(!empty($resultData['infoData'])) {
    echo '<div class="main_m_r" style="border:2px solid #F6F6F6;">
            <form role="form" class="form-horizontal" method="post" action="box_submit" >
                <div style="text-align: center">';
    echo '<div class="form-group">
                        <label class="col-sm-3 control-label fs-20 font-b9" style="color:#006600;">对用户留言：</label>
                        <div class="col-sm-8">
                            <select id="user" name="user" type="text" class="form-control">';
    if(!empty($data)){
        if(!empty($data['listUser'])){
            foreach ($data['listUser'] as $data_k => $data_val){
                echo '<option value="'.html::encode($data_val['idStr']).','.html::encode($data_val['orgIdStr']).','.html::encode($data_val['name']).','.html::encode($data_val['orgName']).'" >'.html::encode($data_val['name']).'</option>';
            }
        }
    }
    echo '</select>
                        </div>
                    </div>';

    echo '<div class="form-group">
                        <label class="col-sm-3 control-label fs-20 font-b9" style="color:#006600;">我要留言：</label>
                        <div class="col-sm-8">
                            <textarea style="width:100%;height:100px;" class="form-control" onKeyUp="keypress(id)" onblur="keypress(id)"
                                  name="replyContents" id="reason" placeholder="请输入"></textarea>
                                  <div class="text-right"><em id="pinglunDes" style="color:red">255</em>/<span>255</span></div>
                        </div>
                    </div>
                    <button type="submit" class="btn submit_btn btn-primary  btn-size-medium">提交</button>
                </div>';//300
    if(!empty($boxData)){
        echo '<div style="margin:30px;">';
        foreach ($boxData['messageBoxList'] as $data_k => $data_val){
            echo '<div style="clear:both;text-align:left;font-size:16px;line-height:22px;">
                            <h3 class="fs-14 font-b9" style="text-align:left;color:#006600;padding: 8px 10px;background: #f3f0f0;">
                            '.html::encode($data_val['sendUserName']).': 
                            <span class="pull-right" style="font-weight: normal;">'.date("Y-m-d H:i", html::encode($data_val['createTime'])).'</span></h3>
                            <p class="fs-14" style="margin:5px 20px">'.html::encode($data_val['contents']).'</p>
                        </div>';
            if(empty($data_val['replyContents'])){
                echo '<p style="color: red;padding-bottom: 10px;margin:5px 20px;">等待回复中...</p>';
            }else{
                echo '<div style="padding: 10px 0 0 0;">
                                 <h3 class="fs-14 font-b9" style="color:#006600;margin: 0 0 0 35px; padding-bottom:10px; border-bottom: 1px dotted #ddd;">
                                 '.html::encode($data_val['recUserName']).'回复: 
                                 <span class="pull-right" style="font-weight: normal;">'.date("Y-m-d H:i", html::encode($data_val['replyTime'])).'</span></h3>
                                 <div class="fs-14" style="clear:both;line-height:22px;margin: 0px 0 10px 40px;">
                                     '.html::encode($data_val['replyContents']).'
                                 </div>
                            </div>';
                //评价
                echo '<div class="topic-actions" style="margin: 0px 0 10px 40px;" >
                                      <div style="text-align:left;position:relative;width:98%;margin-top:5px;">
                                         <div id="score" class="score" style="width:110px;height:20px;display:inline;overflow:hidden;position:absolute;background:transparent url(/content/images/star_info.png) no-repeat scroll left top;">
                                              <div id="convdiv" style="width:'.($data_val['evaluateScore']*22).'px;height: 20px;position: absolute;overflow: hidden;background: url(&quot;/content/images/star_info.png&quot;) 0px -41px no-repeat scroll transparent;"></div>
                                              <div data-id="'.html::encode($data_val['idStr']).'" data-score="'.html::encode($data_val['evaluateScore']).'">
                                                  <a class="star" data-index="5" style="position:absolute;height:20px;width:108px;" title="满意度5分"></a>
                                                  <a class="star" data-index="4" style="position:absolute;height:20px;width:86px;" title="满意度4分"></a>
                                                  <a class="star" data-index="3" style="position:absolute;height:20px;width:64px;" title="满意度3分"></a>
                                                  <a class="star" data-index="2" style="position:absolute;height:20px;width:42px;" title="满意度2分"></a>
                                                  <a class="star" data-index="1" style="position:absolute;height:20px;width:20px;" title="满意度1分"></a>
                                              </div>
                                         </div>
                                         
                                      </div>
                                  </div>';
            }
        }
        echo '</div>';
    }
    echo '</form>';

    echo '</div></div><!-- main_m_r -->';

    echo '</div >';
}?>
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

        if($("#status").val()==1){
            swal({
                    title: "提交成功",
                    type: "success",
                    confirmButtonText: "确 定"
                },
                function (isConfirm) {
                    if (isConfirm) {
                        if (close) {
                            window.location.href="/personal/message_box#grzx";
                        } else {
                            swal.close();
                        }
                    }
                });
        }

        $('form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                replyContents: {
                    validators: {
                        notEmpty: {
                            message: '留言内容不能为空！'
                        }
                    }
                }
            }
        });

    });
</script>
