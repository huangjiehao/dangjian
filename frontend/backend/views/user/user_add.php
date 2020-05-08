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

<?php //require(__DIR__ . '/../layouts/page_add.php'); ?>

<div class="container update_user">
    <h3 class="container">编辑用户</h3>
    <div class="update_user_input container"><!-- 传输方式-->
        <form class="form-horizontal" id="dataForm" role="form" enctype="multipart/form-data" method="post" action="/user/user_submit" >
            <input type="hidden" name="id" value="<?=$userId?>">
            <input type="hidden" name="lftVal" value="<?php if (!empty($data['data'])) {
                echo html::encode($data['data']['orgLftVal']);
            } ?>">
            <input type="hidden" name="rgtVal" value="<?php if (!empty($data['data'])) {
                echo html::encode($data['data']['orgRgtVal']);
            } ?>">

            <div class="form-group">
                <label class="col-sm-3 control-label">头像：</label>
                <div class="col-sm-8">
                    <div class="upload-file-single-main" name="img" data-accept=".png,.jpg,.jpeg">
                        <div class="files-data"><?php if(isset($data['data']['img'])){if(isset(json_decode($data['data']['img'])->url)){echo json_decode($data['data']['img'])->url;}else{echo $data['data']['img'];}}?></div>
                        <?php require(__DIR__ . '/../layouts/upload_file_single.php'); ?>
                    </div>
                </div>
            </div>

            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">所属组织</label>
                <input type="hidden" id="orgName" name="orgName" value="<?php if(!empty($data['data'])){echo html::encode($data['data']['name']);}?>">
                <div class="col-sm-8">
                    <input id="selectParent" type="text" class="select-tree form-control"
                           data-tree-data="parentData" data-name="orgId" name="orgName"
                           data-other-param="lftVal,rgtVal"
                           placeholder="--请选择--"
                           disabled="disabled"
                           data-val="<?php if (!empty($data['data'])) {
                               echo html::encode($data['data']['orgIdStr']);
                           } ?>"/>
                </div>
            </div>

            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">姓名</label>
                <div class="col-sm-8">
                    <input type="text" id="userName" class="form-control" placeholder="请输入姓名"
                           name="name"
                           value="<?php if (!empty($data['data'])) {
                               echo html::encode($data['data']['name']);
                           } ?>" disabled>
                </div>
            </div>
            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">性别</label>
                <div class="col-sm-8">
                    <input type="hidden" id="hdGender" name="gender" value="<?php if (!empty($data['data'])) {
                        echo html::encode($data['data']['gender']);
                    } ?>">
                    <select type="text" id="gender" class="form-control select-auto-data"
                            data-val-id="hdGender"
                            name="gender">
                        <option value="">--请选择--</option>
                        <option value="1" <?php if (!empty($data['data'])) { if($data['data']['gender']=='1'){echo 'selected';}}?> />男
                        <option value="2" <?php if (!empty($data['data'])) { if($data['data']['gender']=='2'){echo 'selected';}}?> />女
                    </select>
                </div>
            </div>
            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">用户等级</label>
                <div class="col-sm-8">
                    <select type="text" id="userLevel" class="form-control" name="userLevel">
                        <option value="0" <?php if (!empty($data['data']) && html::encode($data['data']['userLevel']) == 0) {
                            echo 'selected';
                        } ?>>普通党员
                        </option>
                        <option value="1" <?php if (!empty($data['data']) && html::encode($data['data']['userLevel']) == 1) {
                            echo 'selected';
                        } ?>>中层干部
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">身份证号码</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="请输入身份证号码"
                           maxlength="18" name="idCard"
                           value="<?php if (!empty($data['data'])) {
                               echo html::encode($data['data']['idCard']);
                           } ?>">
                </div>
            </div>
            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">用户类型</label>
                <div class="col-sm-8">
                    <input type="hidden" id="hdUserType" value="<?php if (!empty($data['data'])) {
                        echo html::encode($data['data']['userType']);
                    } ?>">
                    <select type="text" id="selUserType" class="form-control select-auto-data"
                            data-val-id="hdUserType"
                            name="userType" disabled>
                        <option value="0"  <?php if(!empty($data['data'])&& $data['data']['userType'] == 0) {echo 'selected';}?>>普通用户</option>
                        <option value="1000" <?php if(!empty($data['data'])&& $data['data']['userType'] == 1000) {echo 'selected';}?>>团员</option>
                        <option value="2000" <?php if(!empty($data['data'])&& $data['data']['userType'] == 2000) {echo 'selected';}?>>积极分子</option>
                        <option value="3000" <?php if(!empty($data['data'])&& $data['data']['userType'] == 3000) {echo 'selected';}?>>预备党员</option>
                        <option value="4000" <?php if(!empty($data['data'])&& $data['data']['userType'] == 4000) {echo 'selected';}?>>正式党员</option>
                    </select>
                </div>
            </div>
            <div class="form-group clearfloat partyPeople hideDiv">
                <label class="col-sm-3 control-label">入党时间</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control date_picker_single"  autocomplete="off" placeholder="请输入" name="joinTime"
                           value="<?php if (!empty($data['data'])) {
                               echo $data['data']['joinTime']==0?'':date('Y/m/d',html::encode($data['data']['joinTime']));
                           } ?>" />
                    <input type="hidden" id="isSave" name="isSave" value="">
                </div>
            </div>
            <div class="form-group  clearfloat">
                <label class="col-sm-3 control-label">角色</label>
                <div class="col-sm-8">
                    <input  class="form-control" disabled
                            value="<?php
                            foreach ($data['select']['roles']  as $i =>$item){
                                if(!empty($data['data'])&&strpos($data['data']['userRoleNames'],$item['name'])!==false){
                                    if($i!=0){
                                        echo ',';
                                    }
                                    echo html::encode($item['name']);
                                }
                            }
                            ?>"
                    />
                </div>
            </div>
            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">系统登录账号</label>
                <div class="col-sm-8">
                    <input type="text" id="userAccount" class="form-control"
                           placeholder="请输入登录账号，用于登录后台管理或党员党群服务"
                           name="loginName"
                           value="<?php if (!empty($data['data'])) {
                               echo html::encode($data['data']['loginName']);
                           } ?>" disabled>
                </div>
            </div>
            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">曾用名</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="请输入" name="hisName"
                           value="<?php if (!empty($data['data'])) {
                               echo html::encode($data['data']['hisName']);
                           } ?>">
                </div>
            </div>
            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">手机</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="请输入" name="phone"
                           value="<?php if (!empty($data['data'])) {
                               echo html::encode($data['data']['phone']);
                           } ?>">
                </div>
            </div>
            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">固话</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="请输入" name="telephone"
                           value="<?php if (!empty($data['data'])) {
                               echo html::encode($data['data']['telephone']);
                           } ?>">
                </div>
            </div>
            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">邮箱</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="请输入" name="email"
                           value="<?php if (!empty($data['data'])) {
                               echo html::encode($data['data']['email']);
                           } ?>">
                </div>
            </div>
            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">地址</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="请输入" name="address"
                           value="<?php if (!empty($data['data'])) {
                               echo html::encode($data['data']['address']);
                           } ?>">
                </div>
            </div>
            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">生日</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="请输入" name="birthday"
                           value="<?php if (!empty($data['data']['birthday'])&&$data['data']['birthday']!=0) {
                               echo date("Y/m/d",html::encode($data['data']['birthday']));
                           }else{
                               echo '0';
                           } ?>">
                </div>
            </div>
            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">民族</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="请输入" name="nation"
                           value="<?php if (!empty($data['data'])) {
                               echo html::encode($data['data']['nation']);
                           } ?>">
                </div>
            </div>
            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">籍贯</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="请输入" name="birthplace"
                           value="<?php if (!empty($data['data'])) {
                               echo html::encode($data['data']['birthplace']);
                           } ?>">
                </div>
            </div>
            <div class="form-group clearfloat">
                <label class="col-sm-3 control-label">学历</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="请输入" name="education"
                           value="<?php if (!empty($data['data'])) {
                               echo html::encode($data['data']['education']);
                           } ?>">
                </div>
            </div>

            <div class="footer-btn">
                <?php
                if (!empty($data['data'])) {
                    echo '<button type="submit" class="btn submit_btn btn-primary btn-size-medium need-alert" onclick="return saveUserInfo();">';
                    echo(isset($_GET['edit']) ? '保 存' : '添 加');
                    echo '</button>';
                } else {
                    echo '<button type="submit" class="btn submit_btn btn-primary btn-size-medium">添 加</button>';
                }
                ?>
                <a type="button" class="btn btn-danger close_win" href="javascript:history.back(-1);">返回</a>
            </div>
        </form>

        <input type="hidden" id="allowAdd" value="<?= empty($data['allowAdd']) ? 'true' : html::encode($data['allowAdd']) ?>">
        <div id="parentData" class="hide"><?= html::encode(json_encode($data['select']['orgTree']['result'])) ?></div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".hideDiv").css("display","none");
            var selType=$('#selUserType').val();
            if(selType==4000){
                $('.partyPeople').css("display","block");
            }
            $("#show").hide();
            var isAllowAdd = $('#allowAdd').val();
            if (isAllowAdd != '' && !isAllowAdd) {
                swal({
                        title: "用户数量已达上限",
                        text: '请联系管理员增加用户授权',
                        type: "warning",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "确 定",
                        closeOnConfirm: true,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        window.close();
                    });
            }

            /**
             * 生成系统账号
             */
            $('#bulidAccount').click(function () {
                var userName = $('#userName').val();
                if ($.trim(userName) == '') {
                    swal({title: '请先输入姓名', text: '系统登录账号是以姓名为基础来生成的', type: 'warning', confirmButtonText: '确 定'},
                        function () {
                            setTimeout(function () {
                                $('#userName').focus();
                            }, 500);
                        });
                    return false;
                }
                if (!isChinese(userName)) {
                    swal({title: '姓名必须是中文', text: '姓名必须2-6位的汉字', type: 'warning', confirmButtonText: '确 定'},
                        function () {
                            setTimeout(function () {
                                $('#userName').focus();
                            }, 500);
                        });
                }
                var namePinYin = convertToPinyin(userName.substr(0, 1));
                var otherName = userName.substr(1, userName.length);
                var otherNameArr = otherName.split('');
                for (var i in otherNameArr) {
                    namePinYin += convertToPinyin(otherNameArr[i]).substr(0, 1);
                }
                $('#userAccount').val(namePinYin + mathRand());

                $('form').data('bootstrapValidator')
                    .updateStatus('loginName', 'VALID')
                    .validateField('loginName');
            });

            $('form').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    orgName: {
                        validators: {
                            notEmpty: {
                                message: '所属组织不能为空'
                            },
                        }
                    },
                    loginName: {
                        message: '无效的系统账号',
                        validators: {
                            notEmpty: {
                                message: '系统账号不能为空'
                            },
                            stringLength: {
                                min: 3,
                                max: 30,
                                message: '系统账号必须大于3个字符，长度必须小于30个字符'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z]+[a-zA-Z0-9_]+$/,
                                message: '系统账号必须以字母开头，并由字母、数字和下划线组成'
                            },
                        }
                    },
                    name: {
                        validators: {
                            notEmpty: {
                                message: '姓名不能为空'
                            },
                            regexp: {
                                regexp: /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,6}$/,
                                message: '姓名必须2-6位的汉字'
                            },
                        }
                    },
                    idCard: {
                        validators: {
                            notEmpty: {
                                message: '身份证号码不能为空'
                            },
                            stringLength: {
                                min: 15,
                                max: 18,
                                message: '身份证号码长度为15或18位'
                            },
                            callback: {/*自定义，可以在这里与其他输入项联动校验*/
                                message: '身份证号码无效！',
                                callback:function(value, validator,$field){
                                    //15位和18位身份证号码的正则表达式
                                    var regIdCard = /^(^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$)|(^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[Xx])$)$/;
                                    //如果通过该验证，说明身份证格式正确，但准确性还需计算
                                    var idCard = value;
                                    if (regIdCard.test(idCard)) {
                                        if (idCard.length == 18) {
                                            var idCardWi = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2); //将前17位加权因子保存在数组里
                                            var idCardY = new Array(1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2); //这是除以11后，可能产生的11位余数、验证码，也保存成数组
                                            var idCardWiSum = 0; //用来保存前17位各自乖以加权因子后的总和
                                            for (var i = 0; i < 17; i++) {
                                                idCardWiSum += idCard.substring(i, i + 1) * idCardWi[i];
                                            }
                                            var idCardMod = idCardWiSum % 11;//计算出校验码所在数组的位置
                                            var idCardLast = idCard.substring(17);//得到最后一位身份证号码
                                            //如果等于2，则说明校验码是10，身份证号码最后一位应该是X
                                            if (idCardMod == 2) {
                                                if (idCardLast == "X" || idCardLast == "x") {
                                                    return true;
                                                    //alert("恭喜通过验证啦！");
                                                } else {
                                                    return false;
                                                    //alert("身份证号码错误！");
                                                }
                                            } else {
                                                //用计算出的验证码与最后一位身份证号码匹配，如果一致，说明通过，否则是无效的身份证号码
                                                if (idCardLast == idCardY[idCardMod]) {
                                                    //alert("恭喜通过验证啦！");
                                                    return true;
                                                } else {
                                                    return false;
                                                    //alert("身份证号码错误！");
                                                }
                                            }
                                        }
                                    } else {
                                        //alert("身份证格式不正确!");
                                        return false;
                                    }
                                }
                            }
                        }
                    },
                    gender: {
                        validators: {
                            notEmpty: {
                                message: '请选择性别'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: '邮箱不能为空'
                            },
                            emailAddress: {
                                message: '邮箱格式有误'
                            }
                        }
                    },
                    birthday: {
                        validators: {
                            date: {
                                format: 'YYYY/MM/DD',
                                message: '格式请参考：YYYY/MM/DD'
                            }
                        }
                    },
                    phone: {
                        message: '手机号无效',
                        validators: {
                            regexp: { //匹配规则
                                regexp: /^[1][3,4,5,7,8][0-9]{9}$/,
                                message: '手机号格式不正确'
                            }
                        }
                    }
                }
            });


        });
        function saveUserInfo() {
            swal({
                    title: "确定更新吗？",
                    text: "",
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




