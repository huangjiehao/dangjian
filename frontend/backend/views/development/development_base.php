
<link href="/content/css/development/development_index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/content/js/myTree/my.tree.css">
<input type="hidden" id="HTTP_HOSTS" value="<?php echo HTTP_HOSTS ?>">
<?php
use yii\helpers\Html;
$session = \Yii::$app->session;
$user=json_decode($session->get("user_msginfo"));
?>
<!-- Content Wrapper. Contains page content -->
<style>
    .laydate_table {
        display: none;
    }
    #laydate_hms{
        display: none !important;
    }
    .laydate-icon{
        background: none!important;
        padding-right: 0!important;
    }
    .laydate_body .laydate_chnext cite{
        border-left-style: solid!important;
        border-left-color: #fff!important;
    }
    .laydate_body .laydate_chprev cite {
        border-right-style: solid!important;
        border-right-color: #fff!important;
    }
    .laydate_body .laydate_chdown cite, .laydate_body .laydate_ym label {
        border-top-color: #fff!important;
    }
    .laydate_body .laydate_chtop cite {
        border-bottom-color: #fff!important;
    }
</style>
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <div class="container un_dif">
        <section class="content-header">
            <h3>
                上传入党申请书

            </h3>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12 un_float" >
                    <div class="box box-primary">
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form id="fromData" class="form-horizontal" role="form" enctype="multipart/form-data" method="post"
                              action="" >
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">入党组织</label>
                                    <div class="col-sm-6">
                                        <input id="selectParent" type="text" class="select-tree form-control" placeholder="--请选择--"
                                               data-tree-data="parentData" name="parentName" data-name="orgId"
                                               data-val="<?php if (!empty($data['data'])) {
                                                   echo html::encode($data['data']['parentId']);
                                               } ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">姓名：</label>
                                    <div class="col-sm-6" >
                                        <input type="text" class="form-control" placeholder="请输入" name="name"
                                               value="<?php if(!empty( $editData)){echo html::encode($editData['applyer']['name']);}else{echo html::encode($user->name); }?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">性别：</label>
                                    <div class="col-sm-6" >
                                        <select class="form-control" name="gender">
                                            <option value="1" <?php if(!empty($editData)&&$editData['applyer']['gender)']==1){echo 'selected'; }else{echo  $user->gender==1?'selected':''; }?>>男</option>
                                            <option value="2" <?php if(!empty($editData)&&$editData['applyer']['gender)']==2){echo 'selected'; }else{echo  $user->gender==2?'selected':''; }?>>女</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">民族：</label>
                                    <div class="col-sm-6" >
                                        <input type="text" class="form-control" placeholder="请输入" name="nation"
                                               value="<?php if(!empty( $editData)){echo html::encode($editData['applyer']['nation']);}else{echo html::encode($user->nation); }?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">出生年月：</label>
                                    <div class="col-sm-6" >
                                        <input type="text" class="form-control date_picker_single birthday" placeholder="请输入" name="birthday"
                                               value="<?php if(!empty( $editData)){echo date("Y-m-d", html::encode($editData['applyer']['joinWorkDate']));}?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">出生地：</label>
                                    <div class="col-sm-6" >
                                        <input type="text" class="form-control" placeholder="请输入" name="birthplace"
                                               value="<?php if(!empty( $editData)){echo html::encode($editData['applyer']['birthplace']);}else{echo html::encode($user->birthplace); }?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">住址：</label>
                                    <div class="col-sm-6" >
                                        <input type="text" class="form-control" placeholder="请输入" name="address"
                                               value="<?php if(!empty( $editData)){echo html::encode($editData['applyer']['address']);}else{echo html::encode($user->address); }?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">学历：</label>
                                    <div class="col-sm-6" >
                                        <input type="text" class="form-control" placeholder="请输入" name="education"
                                               value="<?php if(!empty( $editData)){echo html::encode($editData['applyer']['education']);}else{echo html::encode($user->education); }?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">毕业学校：</label>
                                    <div class="col-sm-6" >
                                        <input type="text" class="form-control" placeholder="请输入" name="university"
                                               value="<?php if(!empty( $editData)){echo html::encode($editData['applyer']['university']);}?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">专业：</label>
                                    <div class="col-sm-6" >
                                        <input type="text" class="form-control" placeholder="请输入" name="major"
                                               value="<?php if(!empty( $editData)){echo html::encode($editData['applyer']['major']);}?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">工作单位：</label>
                                    <div class="col-sm-6" >
                                        <input type="text" class="form-control" placeholder="请输入" name="company"
                                               value="<?php if(!empty( $editData)){echo html::encode($editData['applyer']['company']);}?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">职务：</label>
                                    <div class="col-sm-6" >
                                        <input type="text" class="form-control" placeholder="请输入" name="job"
                                               value="<?php if(!empty( $editData)){echo html::encode($editData['applyer']['job']);}?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">参加工作时间：</label>
                                    <div class="col-sm-6" >
                                        <input type="text" class="form-control date_picker_single" placeholder="请输入" name="joinWorkDate"
                                               value="<?php if(!empty( $editData)){echo date("Y-m-d", html::encode($editData['applyer']['joinWorkDate']));}?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">加入共青团时间：</label>
                                    <div class="col-sm-6" >
                                        <input type="text" class="form-control date_picker_single" placeholder="请输入" name="joinLeagueDate"
                                               value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">往年绩效：</label>
                                    <?php
                                    if(!empty($editData)){
                                        $rp=explode(',',html::encode($editData['applyer']['recently3Performance']));
                                    }
                                    ?>
                                    <div class="col-sm-6" >
                                        <input type="text" class="form-control recently3Performance" placeholder="请输入" name="recently3Performance[]"
                                               value="<?php if(!empty($editData)){echo html::encode($rp[0]);}?>">
                                        <input type="text" class="form-control recently3Performance" placeholder="请输入" name="recently3Performance[]"
                                               value="<?php if(!empty($editData)){echo html::encode($rp[1]);}?>">
                                        <input type="text" class="form-control recently3Performance" placeholder="请输入" name="recently3Performance[]"
                                               value="<?php if(!empty($editData)){echo html::encode($rp[2]);}?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="resumeListHide" value="<?php if(!empty($editData)){echo html::encode(json_encode(html::encode($editData['applyer']['resumeList'])));}?>">
                                    <label class="col-sm-2 control-label">个人简历：</label>
                                    <div class="col-sm-6" >
                                        <table class="table-devebase">
                                            <tr class="resume_tr">
                                                <td><input class="resumeStrat datainput " name="resumeStrat" placeholder="2007年9月" style="width: 88px;"  ></td>
                                                <td>至</td>
                                                <td><input class="resumeOff datainput"  name="resumeOff" placeholder="2013年6月" style="width: 88px" ></td>
                                                <td>在</td>
                                                <td><input  class="resumeExperience" name="resumeExperience" placeholder="例:在xx小学学习" style="width: 578px;"></td>
                                                <td><button type="button" class="btn btn-warning" style="padding: 0" onclick="delDevelopmentTr(this)">删除</button></td>
                                            </tr>
                                            <?php
                                            if(!empty($editData)){
                                                foreach ($editData['applyer']['resumeList'] as $rmNum=>$rmVal){
                                                    echo '<tr class="resume_tr">
                                                            <td><input class="resumeStrat datainput" placeholder="2007年9月" style="width: 78px;" value="'.date("Y年m月",html::encode($rmVal['beginDate'])).'"  ></td>
                                                            <td>至</td>
                                                            <td><input class="resumeOff datainput"  placeholder="2013年6月" style="width: 78px"  value="'.date("Y年m月",html::encode($rmVal['endDate'])).'" ></td>
                                                            <td>在</td>
                                                            <td><input  class="resumeExperience" placeholder="例:在xx小学学习" style="width: 586px;" value="'.html::encode($rmVal['details']).'"></td>
                                                            <td><button type="button" class="btn btn-warning" style="padding: 0" onclick="delDevelopmentTr(this)">删除</button></td>
                                                        </tr>';
                                                }
                                            }
                                            ?>
                                        </table>
                                        <button type="button" class="btn btn-primary btn-add-develop" onclick="addDevelopmentTr(this)">增加一行</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="familyMemberListHide" value="<?php if(!empty($editData)){echo json_encode(html::encode($editData['applyer']['familyMemberList']));}?>">
                                    <label class="col-sm-2 control-label">家庭成员基本情况：</label>
                                    <div class="col-sm-9" >
                                        <table class="table-devebase">
                                            <tr class="homebase_tr">
                                                <td><input class="homebaseRelation" name="homebaseRelation" placeholder="例:父亲" style="width: 50px"></td>
                                                <td>：</td>
                                                <td><input class="homebaseName" name="homebaseName" placeholder="例:张三" style="width: 50px"></td>
                                                <td>,</td>
                                                <td><input class="homebaseEthnic" name="homebaseEthnic" placeholder="例:汉" style="width:30px"></td>
                                                <td>族，</td>
                                                <td><input class="homebaseBirth datainput" name="homebaseBirth" placeholder="1987年7月" style="width: 88px" ></td>
                                                <td>出生，现</td>
                                                <td><input class="homebaseJob" name="homebaseJob"  placeholder="例:任xx单位xx职务" style="width:374px;"></td>
                                                <td>，</td>
                                                <td><input class="homebasePoliticalSta" name="homebasePoliticalSta" placeholder="例:中共党员" style="width: 75px"></td>
                                                <td><button type="button" class="btn btn-warning" style="padding: 0" onclick="delDevelopmentTr(this)">删除</button></td>
                                            </tr>
                                            <?php
                                            if(!empty($editData)){
                                                foreach ($editData['applyer']['familyMemberList'] as $fmNum=>$fmVal){
                                                    echo '  <tr class="homebase_tr">
                                                                <td><input class="homebaseRelation"  name="homebaseRelation" placeholder="例:父亲" style="width: 50px" value="'.html::encode($fmVal['relation']).'"></td>
                                                                <td>：</td>
                                                                <td><input class="homebaseName" name="homebaseName" placeholder="例:张三" style="width: 50px" value="'.html::encode($fmVal['name']).'"></td>
                                                                <td>,</td>
                                                                <td><input class="homebaseEthnic" name="homebaseEthnic" placeholder="例:汉" style="width:30px" value="'.html::encode($fmVal['nation']).'"></td>
                                                                <td>族，</td>
                                                                <td><input class="homebaseBirth  datainput" name="homebaseBirth"  placeholder="1987年7月" style="width: 88px" value="'.date("Y年m月",html::encode($fmVal['birthday'])).'"  ></td>
                                                                <td>出生，现</td>
                                                                <td><input class="homebasePoliticalSta" name="homebasePoliticalSta"  placeholder="例:任xx单位xx职务" style="width:374px;" value="'.html::encode($fmVal['job']).'"></td>
                                                                <td>，</td>
                                                                <td><input  class=" homebaseJob" name="homebaseJob" placeholder="例:中共党员" style="width: 75px" value="'.html::encode($fmVal['job']).'"></td>
                                                                <td><button type="button" class="btn btn-warning" style="padding: 0" onclick="delDevelopmentTr(this)">删除</button></td>
                                                            </tr>';
                                                }
                                            }
                                            ?>
                                        </table>
                                        <button type="button" class="btn btn-primary btn-add-develop" onclick="addDevelopmentTr(this)">增加一行</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="relativeListHide" value="<?php if(!empty($editData)){echo json_encode(html::encode($editData['applyer']['relativeList']));}?>">
                                    <label class="col-sm-2 control-label">社会主要关系情况：</label>
                                    <div class="col-sm-9" >
                                        <table class="table-devebase">
                                            <tr class="socialbase_tr">
                                                <td ><input class="socialbaseRelation" name="socialbaseRelation" placeholder="例:岳父" style="width: 50px"></td>
                                                <td>：</td>
                                                <td><input class="socialbaseName" name="socialbaseName" placeholder="例:李四" style="width: 50px"></td>
                                                <td>,</td>
                                                <td><input class="socialbaseEthnic" name="socialbaseEthnic" placeholder="例:汉" style="width:30px"></td>
                                                <td>族，</td>
                                                <td><input class="socialbaseBirth  datainput" name="socialbaseBirth" placeholder="1987年7月" style="width: 88px"  ></td>
                                                <td>出生，现</td>
                                                <td><input class="socialbasePoliticalSta" name="socialbasePoliticalSta" placeholder="例:任xx单位xx职务" style="width:374px;"></td>
                                                <td>，</td>
                                                <td><input class="socialbaseJob" name="socialbaseJob"  placeholder="例:中共党员" style="width: 75px"></td>
                                                <td><button type="button" class="btn btn-warning" style="padding: 0" onclick="delDevelopmentTr(this)">删除</button></td>
                                            </tr>
                                            <?php
                                            if(!empty($editData)){
                                                foreach ($editData['applyer']['relativeList'] as $reNum=>$reVal){
                                                    echo '  <tr class="homebase_tr">
                                                                <td><input class="socialbaseRelation" name="socialbaseRelation" placeholder="例:父亲" style="width: 50px" value="'.html::encode($reVal['relation']).'"></td>
                                                                <td>：</td>
                                                                <td><input class="socialbaseName" name="socialbaseName" placeholder="例:张三" style="width: 50px" value="'.html::encode($reVal['name']).'"></td>
                                                                <td>,</td>
                                                                <td><input class="socialbaseEthnic" name="socialbaseEthnic" placeholder="例:汉" style="width:30px" value="'.html::encode($reVal['nation']).'"></td>
                                                                <td>族，</td>
                                                                <td><input class="socialbaseBirth datainput" name="socialbaseBirth"  placeholder="1987年7月" style="width: 88px" value="'.date("Y年m月",html::encode($reVal['birthday'])).'" ></td>
                                                                <td>出生，现</td>
                                                                <td><input class="socialbasePoliticalSta" name="socialbasePoliticalSta" placeholder="例:任xx单位xx职务" style="width:374px;" value="'.html::encode($reVal['job']).'"></td>
                                                                <td>，</td>
                                                                <td><input class="socialbaseJob" name="socialbaseJob" placeholder="例:中共党员" style="width: 75px" value="'.html::encode($reVal['job']).'"></td>
                                                                <td><button type="button" class="btn btn-warning" style="padding: 0" onclick="delDevelopmentTr(this)">删除</button></td>
                                                            </tr>';
                                                }
                                            }
                                            ?>
                                        </table>
                                        <button type="button" class="btn btn-primary btn-add-develop" onclick="addDevelopmentTr(this)">增加一行</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">上传入党申请扫描件：</label>
                                    <div class="col-sm-9" >
                                        <div class="upload-files-main" name="fileInfoList" data-p-height="50" data-accept=".png,.jpg,.jpeg" >
                                            <!--<div class="files-data"><?/*=$editData['projEstb']['estbAtt'] */?></div>-->
                                            <?php require(__DIR__ . '/../layouts/upload_files.php'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="resumeList" class="resume" value="">
                            <input type="hidden" name="familyMemberList" class="homebase" value="">
                            <input type="hidden" name="relativeList" class="socialbase" value="">
                            <input type="hidden" name="edit" class="edit"
                                   value="<?php echo(isset($_GET['edit']) ? $_GET['edit'] : '') ?>">
                            <input type="hidden" name="id"
                                   value="<?php echo(isset($_GET['idStr']) ? $_GET['idStr'] : '') ?>">
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="button" id="submitBtn" class="btn submitBtn btn-primary btn-size-medium">添加</button>
                                <a type="button" class="btn btn-danger btn-size-medium"
                                   href="javascript:window.opener=null;window.open('','_self');window.close();">关闭</a>
                            </div>
                    </div>
                    </form>
                </div>
                <!-- /.col (RIGHT) -->
            </div>
            <!-- /.row -->
        </section>
    </div>
    <!-- /.content -->
    <div id="parentData" class="hide"><?= json_encode($data) ?></div>
</div>

<link href="/content/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/content/css/font-awesome.css">

<link rel="stylesheet" href="/content/plugins/laydate/skins/molv/laydate.css">
<link rel="stylesheet" href="/content/plugins/laydate/need/laydate.css">
<link href="/content/plugins/message/message.css" rel="stylesheet" type="text/css"/>
<script src="/content/plugins/message/message.js" type="text/javascript"></script>
<script type="text/javascript" src="/content/js/myTree/my.tree.js"></script>
<script type="text/javascript" src="/content/js/uncommon/page_add.js?v=2"></script>
<script type="text/javascript" src="/content/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/content/js/uploadfiles/upload.js"></script>
<script type="text/javascript" src="/content/js/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="/content/js/development/development.js"></script>
<script src="/content/plugins/daterangepicker/moment.js" type="text/javascript"></script>

<script src="/content/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="/content/js/datepickerSelect.js" type="text/javascript"></script>
<script type="text/javascript" src="/content/plugins/laydate/laydate.js"></script>


<script type="text/javascript">
    function laydateonclick() {
        laydate({istime: true,format: 'YYYY年MM月'})
    }
    $(document).ready(function () {
        $("#ly_header").remove();
        $("#ly_menu").remove();
        $(".top-bar").remove();
        $("#ly_footer").remove();

//        $("body").css("min-width","");
        var len=$(window).width();
        $("body").css("min-width",len);
        var height=$(window).height();
        $("body").css("min-height",height)

        //验证时间格式
        $(document).on('blur','.datainput',function () {
            var val=$(this).val();
            var reg=/ ^(^(\d{4}|\d{2})(\-|\/|\.)\d{1,2}\3\d{1,2}$)|(^\d{4}年\d{1,2}月$)$/;
            if(!reg.test(val)){
                $.message({
                    message:'格式错误',
                    type:'error'
                });
                $(this).focus();
            }
        });

        //验证时间插件
        $(document).on('click','.available',function () {
            $('form').data('bootstrapValidator')
                .updateStatus('birthday', 'NOT_VALIDATED',null)
                .validateField('birthday');
            $('form').data('bootstrapValidator')
                .updateStatus('joinWorkDate', 'NOT_VALIDATED',null)
                .validateField('joinWorkDate');
            $('form').data('bootstrapValidator')
                .updateStatus('joinLeagueDate', 'VALID')
                .validateField('joinLeagueDate');
        });
        /* $('#fromData').bootstrapValidator({
  //        live: 'disabled',
              message: 'This value is not valid',
              feedbackIcons: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                  name: {
                      validators: {
                          notEmpty: {
                              message: '姓名不能为空'
                          },
                      }
                  },
                  parentName: {
                      validators: {
                          notEmpty: {
                              message: '入党组织不能为空'
                          },
                      }
                  },
                  gender: {
                      validators: {
                          notEmpty: {
                              message: '性别不能为空'
                          },
                      }
                  },
                  nation: {
                      validators: {
                          notEmpty: {
                              message: '民族不能为空'
                          },
                      }
                  },
                  birthday: {
                      validators: {
                          notEmpty: {
                              message: '出生日期不能为空'
                          },
                      }
                  },
                  address: {
                      validators: {
                          notEmpty: {
                              message: '住址不能为空'
                          },
                      }
                  },
                  company: {
                      validators: {
                          notEmpty: {
                              message: '工作单位不能为空'
                          },
                      }
                  },
                  job: {
                      validators: {
                          notEmpty: {
                              message: '职位不能为空'
                          },
                      }
                  },
                  birthplace: {
                      validators: {
                          notEmpty: {
                              message: '出生地不能为空'
                          },
                      }
                  },
                  education: {
                      validators: {
                          notEmpty: {
                              message: '学历不能为空'
                          },
                      }
                  },
                  university: {
                      validators: {
                          notEmpty: {
                              message: '学校不能为空'
                          },
                      }
                  },
                  major: {
                      validators: {
                          notEmpty: {
                              message: '专业不能为空'
                          },
                      }
                  },
                  joinWorkDate: {
                      validators: {
                          notEmpty: {
                              message: '参加工作时间不能为空'
                          },
                      }
                  },
                  recently3Performance: {
                      validators: {
                          notEmpty: {
                              message: '绩效不能为空'
                          },
                      }
                  },

              }

          });
          //登录数据提交*/
        $('#submitBtn').click(function () {
            $("#fromData").bootstrapValidator('validate');
            if($("#fromData").data("bootstrapValidator").isValid()){
                var status=true;
                //绩效
                $('.recently3Performance').each(function () {
                    if($(this).val()==""){
                        $.message({
                            message:'绩效不能为空',
                            type:'error'
                        });
                        $(this).focus();
                        status=false;
                        return;
                    }
                })
                if(!status){
                    return;
                }
                //个人简历

                var str=[];
                $('.resume_tr').each(function () {
                    $this=$(this);
                    var obj={};
                    var  beginDate=$(this).find('.resumeStrat').val();
                    var endDate=$(this).find('.resumeOff').val();
                    var details=$(this).find('.resumeExperience').val();
                    if(!addValidator(beginDate,$(this).find('.resumeStrat'),"开始时间不能为空")){
                        status=false;
                        $(this).find('.resumeStrat').focus();
                        return;
                    }
                    if(! addValidator(endDate,$(this).find('.resumeOff'),"结束时间不能为空")){
                        status=false;
                        return;
                    }
                    if(!addValidator(details,$(this).find('.resumeExperience'),"经历不能为空")){
                        status=false;
                        return;
                    }
                    obj.beginDate=changTime(beginDate)
                    obj.endDate=changTime(endDate);
                    obj.details=details;
                    str[str.length]=obj;
                })
                if(!status){
                    return;
                }
                $(".resume").val(JSON.stringify(str));
                //家庭成员基本情况
                var strTwo=[];
                $('.homebase_tr').each(function () {
                    $this=$(this);
                    var obj={};
                    var relation=$(this).find('.homebaseRelation').val();
                    var name=$(this).find('.homebaseName').val();
                    var nation=$(this).find('.homebaseEthnic').val();
                    var birthday=$(this).find('.homebaseBirth').val();
                    var politicalSta=$(this).find('.homebasePoliticalSta').val();
                    var job=$(this).find('.homebaseJob').val();
                    if(!addValidator(relation,$(this).find('.homebaseRelation'),"家庭关系不能为空")){
                        status=false;
                        return;
                    }
                    if(! addValidator(name,$(this).find('.homebaseName'),"名字不能为空")){
                        status=false;
                        return;
                    }
                    if(!addValidator(nation,$(this).find('.homebaseEthnic'),"民族不能为空")){
                        status=false;
                        return;
                    }
                    if(!addValidator(birthday,$(this).find('.homebaseBirth'),"出生日期不能为空")){
                        status=false;
                        return;
                    }
                    if(!addValidator(politicalSta,$(this).find('.homebasePoliticalSta'),"政治面貌不能为空")){
                        status=false;
                        return;
                    }
                    if(!addValidator(job,$(this).find('.homebaseJob'),"职务不能为空")){
                        status=false;
                        return;
                    }
                    obj.relation=relation
                    obj.name=name
                    obj.nation=nation
                    obj.birthday=changTime(birthday);
                    obj.politicalSta=politicalSta
                    obj.job=job
                    strTwo[strTwo.length]=obj;
                })
                $(".homebase").val(JSON.stringify(strTwo));
                //社会关系基本情况
                var strThree=[];
                $('.socialbase_tr').each(function () {
                    $this=$(this);
                    var obj={};
                    var relation=$(this).find('.socialbaseRelation').val();
                    var name=$(this).find('.socialbaseName').val();
                    var nation=$(this).find('.socialbaseEthnic').val();
                    var birthday=$(this).find('.socialbaseBirth').val();
                    var politicalSta=$(this).find('.socialbasePoliticalSta').val();
                    var job=$(this).find('.socialbaseJob').val();
                    if(!addValidator(relation,$(this).find('.socialbaseRelation'),"家庭关系不能为空")){
                        status=false;
                        return;
                    }
                    if(! addValidator(name,$(this).find('.socialbaseName'),"名字不能为空")){
                        status=false;
                        return;
                    }
                    if(!addValidator(nation,$(this).find('.socialbaseEthnic'),"民族不能为空")){
                        status=false;
                        return;
                    }
                    if(!addValidator(birthday,$(this).find('.socialbaseBirth'),"出生日期不能为空")){
                        status=false;
                        return;
                    }
                    if(!addValidator(politicalSta,$(this).find('.socialbasePoliticalSta'),"政治面貌不能为空")){
                        status=false;
                        return;
                    }
                    if(!addValidator(job,$(this).find('.socialbaseJob'),"职务不能为空")){
                        status=false;
                        return;
                    }
                    obj.relation=relation;
                    obj.name=name;
                    obj.nation=nation;
                    obj.birthday=changTime(birthday);
                    obj.politicalSta=politicalSta;
                    obj.job=job;
                    strThree[strThree.length]=obj;
                })
                $(".socialbase").val(JSON.stringify(strThree));
                var fileInfoList=$(".upload-files-result").val();
                if (!status){
                    return
                }if(fileInfoList==undefined||fileInfoList==""||fileInfoList==null){
                    alert("请上传申请书");
                    return
                }else {
                    $.ajax({
                        async : false,
                        url: '/development/development_base_submit',
                        type: 'post',
                        data: $('#fromData').serializeArray(),
                        success: function (result) {
                            console.dir(result);
                            var data=JSON.parse(result)
                            if (data['status'] == 1000) {
                                showSwal(1,null,'操作成功','close');
                            } else {
                                showSwal(3,null,data['msg'],null);
                            }
                        }, error: function (error) {
                            showSwal(3,null,'操作失败',null);
                        }
                    });
                }
                return false;
            }

        });
    });
    function addValidator(val,i,msg) {
        if(val==""||val==null||val==undefined){
            $.message({
                message:msg,
                type:'error'
            });
            $(i).focus();
            return false;
        }else {
            return true;
        }
    }
</script>
<style>
    body{
        overflow-y: scroll;
    }
    .table-devebase>tbody>tr{
        height: 25px;
    }
    .wrapper_page{
        overflow: auto;
    }

</style>