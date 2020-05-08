<?php
use yii\helpers\Html;
?>
<link href="/content/plugins/message/message.css" rel="stylesheet" type="text/css"/>
<script src="/content/plugins/message/message.js" type="text/javascript"></script>
<link rel="stylesheet" href="/content/js/myTree/my.tree.css">
<script type="text/javascript" src="/content/js/myTree/my.tree.js"></script>
<link href="/content/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
<script src="/content/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<link href="/content/css/bootstrapValidator.min.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="/content/js/bootstrapValidator.min.js"></script>
<link rel="stylesheet" href="/content/css/uncommon/redirect.css">
<?php if(!empty($newdata)) {
//    if(isset($newdata['idCard'])) {
    echo '<div class="main">
        <div class="login-wrap">
            <div class="wrap clearfix">
                <div class="form-box fr loginV2"  style="display:block;">
                    <ul class="form-tab clearfix">
                        <li class="tab-li cur"><a href="javascript:;">个人信息</a></li>
                    </ul>
                    <div class="form-con">
                        <div class="login-normal" style="display:block;">
                            <form class="form-horizontal"><!--id="nameLoginForm Personal_data_submit"-->
                                <div class="form-error" style=""><i></i><label class="text"></label></div>
                                <div class="form-group">
                                    <dl class="clearfix">
                                        <dt>所属组织：</dt>
                                        <dd>
                                            <input id="selectParent" type="text" class="select-tree form-control"
                                                   data-tree-data="parentData" data-name="orgId" name="orgName"
                                                   data-other-param="lftVal,rgtVal"
                                                   placeholder="--请选择到具体支部--"
                                                   data-val="';
                                            if (!empty($data['data'])) {
                                                echo html::encode($data['data']['orgIdStr']);
                                            }
                                            echo '" />
                                        </dd>
                                    </dl>
                                </div>
                             
                                <div class="form-group">
                                    <dl class="top1 clearfix">
                                        <dt>账号：</dt>
                                        <dd><input type="text" id="loginName" name="loginName" class="form-control input-text" autocomplete="off" value="'.html::encode($newdata['loginName']).'"  placeholder="请输入账号"></dd>
                                    </dl>
                                </div>
                                <input type="hidden" id="idStr" name="idStr" class="form-control input-text" autocomplete="off" value="'.html::encode($newdata['idStr']).'"  placeholder="用户id">
                                <input type="hidden" id="password" name="password" class="form-control input-text" autocomplete="off" value="'.html::encode($newdata['password']).'"  placeholder="请输入身份证号码">
                                <div class="btn-box clearfix">
                                    <input id="submitBtn" class="btn btn-primary btn-size-medium" type="submit" value="保    存" >
                                </div>
                                <input type="hidden" id="loginName" name="password" class="form-control input-text" autocomplete="off" value="'.html::encode($newdata['password']).'"  placeholder="请输入账号">
                            </form>
                            <div id="parentData" style="display: none;">' . html::encode(json_encode($data)) . '</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
//    }
}

?>
<script>
    $(document).ready(function () {
        $('.select_picker').selectpicker({
            'selectedText': 'cat',
            'actionsBox':true,
            'liveSearch': true,
            'noneSelectedText': '--请选择--'
        });
        if ($.trim($('#userRoleIds').val() != '')) {
            $('#selUserRoleIds').selectpicker('val', $('#userRoleIds').val());
        }

        $('form').bootstrapValidator({
//            live: 'disabled',
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
            }
        });
    });



</script>

