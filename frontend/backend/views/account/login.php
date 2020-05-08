<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>党建云平台</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/content/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link href="/content/css/font-awesome.min.css" rel="stylesheet">
    <link href="/content/css/uncommon/login.css" rel="stylesheet">
</head>
<body>

    <div class="login-wrap">
        <div class="wrap clearfix">
            <div class="form-box fr loginV2"  style="display:block;">
                <div class="form-con">
                    <div class="login-normal" style="display:block;">
                        <form class="form-horizontal" id="loginForm"  method="post"><!--id="nameLoginForm"-->
                            <div class="form-error" style=""><i></i><label class="text"></label></div>
                            <dl class="clearfix">
                                <dt>账户名：</dt>
                                <dd><input type="text" id="username" name="username" class="input-text user" autocomplete="off"  placeholder="请输入用户名"/></dd>
                            </dl>
                            <dl class="top1 clearfix">
                                <dt>密<em></em>码：</dt>
                                <dd><input type="password" id="password" name="password" class="input-text pwd" autocomplete="off" value="<?php $cookies = \Yii::$app->request->cookies;
                                $password = $cookies->getValue('password');
                                echo html::encode($password); ?>"  placeholder="请输入密码"></dd>
                            </dl>
                            <div class="btn-box clearfix">
                                <input id="submitBtn" class="btn-settlement" type="submit" value="登    录" >

                            </div>
                        </form>
                        <div class="login-short clearfix">
                            <div class="short-left">
                                <h3>使用自动登录：</h3>
                                <ul class="clearfix">
                                    <li class="user">
                                        <!-- gzlt.a.com:8083/redirect/redirect -->
                                        <!-- http://gz.gd.unicom.local/open/oauth2/auth?response_type=code&client_id=gzdj_2018&redirect_uri=http://www.gzdangjian.com:8011/redirect/redirect      -->
                                        <a href="http://gz.gd.unicom.local/open/oauth2/auth/?response_type=code&client_id=gzdj_2018&redirect_uri=http://gzlt.gzdangjian.com/redirect/redirect#grzx" target="_blank"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
    window.onresize = function(){
        var mainHeight = $(window).height() - 296;
        var curHeight = $(".login-wrap").height();
        if(parseInt(curHeight)+85 > mainHeight){
            $(".login-wrap").css({"height":(parseInt(curHeight)+5)+"px","padding":"85px"});
        }else{
            $(".login-wrap").css({"height":(mainHeight)+"px","padding":"85px"});
        }
    };
    $(function(){
        var mainHeight = $(window).height() - 296;
        var curHeight = $(".login-wrap").height();
        if(parseInt(curHeight)+85 > mainHeight){
            $(".login-wrap").css({"height":(parseInt(curHeight)+85)+"px","padding":"85px"});
        }else{
            $(".login-wrap").css({"height":(mainHeight)+"px","padding":"85px"});
        }

        $('#username').keypress(function (e) {
            if (e.keyCode == 13) {
                if ($('#password').val() == '') {
                    $('#password').focus();
                } else {
                    $('#submitBtn').click();
                }
            }
        });
        $('#password').keypress(function (e) {
            if (e.keyCode == 13) {
                $('#submitBtn').click();
            }
        });

        //支持Enter键登录
        $('#submitBtn').click(function () {//登录数据提交
            $.ajax({
                url: '/account/login_submit',
                type: 'post',
                data: $('#loginForm').serializeArray(),
                success: function (result) {
                    // console.dir(result);
                    if (result == 2) {
                        swal({
                                title: "登录失败",
                                text: "用户名或密码错误，请重试",
                                type: "error",
                                confirmButtonText: "确定",
                            },
                            function (isConfirm) {
                                if (isConfirm) {
                                    swal.close();
                                }
                            });
                    } else {
                        var test = window.location.hash;
                        if (test.indexOf("#") != -1) {  //判断是否有参数
                            var str = test.substr(1); //从第一个字符开始 因为第0个是#号 获取所有除问号的所有符串
                        }
                        if(str == '在线学习'){
                            window.location = '/course/course_list#在线学习';
                        }else{
                            window.location = '/newpersonal/personal#党群服务';
                        }
                    }
                }, error: function (error) {
                    console.dir(error);
                }
            });
            return false;
        });
    });
</script>
