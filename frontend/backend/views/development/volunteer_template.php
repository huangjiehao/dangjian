<?php
use yii\helpers\Html;
?>
<link href="/content/css/development/development_index.css" rel="stylesheet" type="text/css">
<input type="hidden" id="HTTP_HOSTS" value="<?php echo HTTP_HOSTS ?>">
<!-- Content Wrapper. Contains page content -->
<style>
    .content{
        overflow-y: scroll;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="container un_dif">
        <section class="content-header">
            <h3>
                入党志愿书模板
            </h3>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-9 un_float">
                    <div class="box box-primary">
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post"
                              action="/development/development_apply_submit">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        入党志愿书模板
                                    </label>
                                    <div class="col-sm-9" >
                                        <a target="_blank" href="/filedownload/入党志愿书.pdf" class="btn  btn-primary btn-size-medium" >下载</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-7 control-label">需要上传部分：</label>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-6" >
                                        <img src="/filedownload/volunteerneed/1.jpg" style="width: 135%">
                                        <img src="/filedownload/volunteerneed/2.jpg" style="width: 135%">
                                        <img src="/filedownload/volunteerneed/3.jpg" style="width: 135%">
                                        <img src="/filedownload/volunteerneed/4.jpg" style="width: 135%">
                                        <img src="/filedownload/volunteerneed/5.jpg" style="width: 135%">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="type"
                                   value="<?php echo(isset($_GET['type']) ? $_GET['type'] : '') ?>">
                            <input type="hidden" name="edit"
                                   value="<?php echo(isset($_GET['edit']) ? $_GET['edit'] : '') ?>">
                            <input type="hidden" name="id"
                                   value="<?php echo(isset($_GET['idStr']) ? $_GET['idStr'] : '') ?>">
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <?php
                                if (!empty($data)) {
                                    echo '<button type="submit" class="btn submit_btn btn-primary btn-size-medium">';
                                    echo(isset($_GET['edit']) ? '保存' : '添加');
                                    echo '</button>';
                                } else {
                                    echo '<button type="submit" class="btn submit_btn btn-primary btn-size-medium">添加</button>';
                                }
                                ?>
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
</div>

<script src="/content/js/uncommon/init_wev8.js" type="text/javascript"></script>
<script type="text/javascript" src="/content/js/uncommon/page_add.js?v=2"></script>
<script type="text/javascript" src="/content/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/content/js/uploadfiles/upload.js"></script>
<script type="text/javascript" src="/content/js/bootstrapValidator.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#ly_header").remove();
        $("#ly_menu").remove();
        $(".top-bar").remove();
        $("#ly_footer").remove();

        var len=$(window).width();
        $("body").css("min-width",len);

        $(document).on('click','.submit_btn',function () {
            var file=$("input[name='fileJson']").val();
            if(file==null||file==undefined){
                $("form").bootstrapValidator("addField", "fileJson", {
                    validators: {
                        notEmpty: {
                            message: '上传扫描件不能为空'
                        },
                    }
                });
            }
        });
        $(document).on('click','.upload-files-submit-btn',function () {
            $("form").bootstrapValidator('removeField','fileJson');
            $("form").bootstrapValidator("addField", "fileJson", {
            });
        });
    });
</script>
