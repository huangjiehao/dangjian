<?php
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['name'];
$userId = $user_msginfo['idStr'];
use yii\helpers\Html;
//?>
<script type="text/javascript" src="/content/js/myTree/my.tree.js"></script>
<link rel="stylesheet" href="/content/js/myTree/my.tree.css">
<input type="hidden" id="HTTP_HOSTS" value="<?php echo HTTP_HOSTS ?>">
<Link href="/content/css/uncommon/user_add.css"  rel="stylesheet" type="text/css"/>
<script src="/js/uploadfiles/upload.single.js" type="text/javascript"></script>
<script src="/js/uploadfiles/upload.slice.js" type="text/javascript"></script>

<link rel="stylesheet" href="/content/plugins/daterangepicker/daterangepicker.css">
<script src="/content/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="/content/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="/content/js/commonDate.js" type="text/javascript"></script>
<link href="/content/css/uncommon/newpersonal.css" rel="stylesheet">
<style type="text/css">
    #personal, .work, #files, #tools, #integral{ margin: 0;}
</style>
<div id="main">
    <div id="personal" class="container update_user ly_main">
        <h3 class="container">修改密码</h3>
        <div class="update_user_input container"><!-- 传输方式-->
            <form class="form-horizontal" id="dataForm" role="form" enctype="multipart/form-data" method="post" action="/user/user_update_pwd_submit" >
                <input type="hidden" name="id" value="<?=$userId?>">
                <div class="form-group">
                    <label class="col-sm-3 control-label" >新密码</label >
                    <div class="col-sm-8" >
                        <input type="text" class="form-control" placeholder ="字母加数字，6-16位" name = "password" value ="" >
                    </div >
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" >确认密码</label >
                    <div class="col-sm-8" >
                        <input type="text" class="form-control" placeholder = "字母加数字，6-16位" name = "confirmPassword" value = "" >
                    </div >
                </div>

                <div class="footer-btn">
                    <button type="submit" class="btn submit_btn btn-primary btn-size-medium need-alert" onclick="return saveUserInfo();">修改</button>
                    <a type="button" class="btn btn-danger close_win" href="javascript:history.back(-1);">返回</a>
                </div>
            </form>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                $('form').bootstrapValidator({
                    message: 'This value is not valid',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        password: {
                            validators: {
                                notEmpty: {
                                    message: '密码不能为空'
                                }, identical: {
                                    field: 'confirmPassword',
                                    message: '密码和确认密码不一致'
                                }
                            },
                            stringLength: {
                                min: 6,
                                max: 18,
                                message: '密码为6-18位'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_\.]+$/,
                                message: '只能是数字和字母'
                            },
                        },
                        confirmPassword: {
                            message: '密码格式有误',
                            validators: {
                                notEmpty: {
                                    message: '确认密码不能为空'
                                }, identical: {
                                    field: 'password',
                                    message: '密码和确认密码不一致'
                                }, stringLength: {
                                    min: 6,
                                    max: 18,
                                    message: '确认密码为6-18位'
                                }, regexp: {
                                    regexp: /^[a-zA-Z0-9_\.]+$/,
                                    message: '只能是数字和字母'
                                }
                            }
                        }
                    }
                });


            });
            // function saveUserInfo() {
            //     swal({
            //             title: "确定修改吗？",
            //             text: "退出登录生效",
            //             type: "warning",
            //             showCancelButton: true,
            //             confirmButtonColor: "#DD6B55",
            //             confirmButtonText: "确定",
            //             cancelButtonText: "取消",
            //             closeOnConfirm: false,
            //             closeOnCancel: false
            //         },
            //         function(isConfirm){
            //             if (isConfirm) {
            //                 $("form").submit();
            //             }else {
            //                 swal.close();
            //             }
            //         });
            //     return false;
            // }
            $("#isshow").change(function () {
                var curVal = $(this).val();
                if(curVal == 1){
                    $("#show").show();
                }else{
                    $("#show").hide();
                }
            });

            function saveUserInfo() {
                swal({
                        title: "确定保存数据吗？",
                        text: "保存成功后，需要重新登录！",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "确定",
                        cancelButtonText: "取消",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm){
                        if (isConfirm) {
                            $("form").submit();
                        }else {
                            swal.close();
                        }
                    });
                return false;
            }


        </script>
</div>
