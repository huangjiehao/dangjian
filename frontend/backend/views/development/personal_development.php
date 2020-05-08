<?php
use yii\helpers\Html;
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['name'];
$userId = $user_msginfo['idStr'];
?>
<link href="/content/css/timeline_develope/timeline.css" rel="stylesheet" type="text/css"/>
<link href="/content/css/course/course.css" rel="stylesheet" type="text/css"/>
<link href="/content/css/uncommon/personal.css" rel="stylesheet" type="text/css"/>
<script src="/content/js/personal/jquery-latest.js" type="text/javascript"></script>
<script src="/content/js/personal/pc.js" type="text/javascript"></script>
<script src="/content/js/uncommon/init_wev8.js" type="text/javascript"></script>
<script>
    $(function() {//九宫格
        /*判断是否是第4个*/
        $(".span3").each(function(index){
            if(Math.ceil((index+1)%3)==0){
                $(this).css("margin-right","0");
            }
        });
    });
    /* 退出登录 */
    function logout() {
        swal({
            title: "确定退出？",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "确 定",
            cancelButtonText: "取 消",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                window.location = '/account/login_out'
            } else {
                swal.close();
            }
        });
    }
</script>
<style>
    .navbar-top-links li a{
        padding:4px 20px;
    }
    .nav.navbar-right>li>a{
        color:#fff;
    }
    .nav>li>a:focus, .nav>li>a:hover{
        background-color: #bf0a0a;
    }
    .navbar-top-links li:last-child{
        margin-right: 10px;
    }
    .btn{
        padding: 0!important;
    }
    .text-font{
        font-size: 16px;
    }
    .btn-margin-left{
        margin-left: 7px;
    }
</style>
<div class="top-bar" >
    <div class="top-center" >
        <div class="pull-left" >
            <img  src = "/content/images/title.png" />
            <span id = "admin" >入党申请</span >
        </div >
        <ul class="nav navbar-top-links navbar-right" >
            <li class="hidden-xs">
                <a href = "#" class="J_menuItem" data-index = "0" ><?=html::encode($user_msginfo['name'])?></a >
            </li >
            <li class="dropdown hidden-xs" onclick = "logout()" >
                <a class="right-sidebar-toggle" aria-expanded = "false">
                    <i class="fa fa-tasks" ></i > 退出
                </a >
            </li >
        </ul >
    </div >
</div >
<!--------------------蓝色顶部的结束-->
<div class="main-wrap" >
    <div style="margin: 0 30%">
        <div style="display: inline-block "><button class="btn btn-success " <?php if(!isset($data)){echo 'style="display:none;"';}?> onclick="openMediumWindow('/development/development_apply?type=2&idStr=<?php if (!empty($data)){echo $data['applyer']['id'];}?>')">上传书面思想汇报</button></div>
        <div style="display: inline-block"><a class="btn btn-warning " href="/filedownload/思想汇报模板.docx" target="_blank">书面思想汇报模板</a></div>
    </div>
    <div class="content">
        <article>
            <!--<h3>发展党员</h3>-->
            <section data-sta="1" id="1">
                <span class="point-time point-grey"></span>
                <div class="div-title"><span>入党申请</span></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">递交入党申请书</span> </div>
                    <div class="brief">
                        <button class="btn btn-warning " onclick="openFullWindow('/development/development_base?type=1')">填写个人信息及上传入党申请书</button>
                        <a href="/filedownload/申请书模板.docx" class="btn btn-success btn-margin-left ">申请书模板</a>
                    </div>
                </aside>
            </section>
            <section data-sta="2" id="2">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">党组织派人对话</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="3" id="3">
                <span class="point-time point-grey"></span>
                <div class="div-title"> <span>入党积极分子的确定和培养教育</span></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">党组织培养和教育</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="4" id="4">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">推荐和确定入党积极分子</span></div>
                    <div class="brief">

                    </div>
                </aside>
            </section>
            <section data-sta="5" id="5">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">发布公示</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="6" id="6">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">公示7天</span></div>
                    <div class="brief">

                    </div>
                </aside>
            </section>
            <section data-sta="7" id="7">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">填写公示结果记录表</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="8" id="8">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">上级党委备案</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="9" id="9">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">指定培养联系人</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="10" id="10">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">培养教育考察</span></div>
                    <div class="brief" >
                    </div>
                </aside>
            </section>
            <section data-sta="11" id="11">
                <span class="point-time point-grey"></span>
                <div class="div-title"><span>发展对象的确定和考察</span></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">确定发展对象</span></div>
                    <div class="brief">

                    </div>
                </aside>
            </section>
            <section data-sta="12" id="12">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">发布公示</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="13" id="13">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">公示7天</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="14" id="14">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">填写公示结果记录表</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="15" id="15">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">上级党委备案</span></div>
                    <div class="brief">

                    </div>
                </aside>
            </section>
            <section data-sta="16" id="16">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">确定入党介绍人</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="17" id="17">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">政治审查</span></div>
                    <div class="brief">

                    </div>
                </aside>
            </section>
            <section data-sta="18" id="18">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">开展集中培训</span></div>
                    <div class="brief">
                        <button class="btn btn-primary" onclick="openMediumWindow('/development/development_apply?idStr=<?php if (!empty($data)){
                        echo html::encode($data['applyer']['id']);}?>&type=3')">上传培训班结业证扫描件</button>
                    </div>
                </aside>
            </section>
            <section data-sta="19" id="19">
                <span class="point-time point-grey"></span>
                <div class="div-title"><span>预备党员的接收</span></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">支部委员会的审查</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="20" id="20">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">发布公示</span></div>
                    <div class="brief">

                    </div>
                </aside>
            </section>
            <section data-sta="21" id="21">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">公示7天</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="22" id="22">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">填写公示结果记录表</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="23" id="23">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">上级党委预审</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="24" id="24">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">填写《入党志愿书》</span></div>
                    <div class="brief">
                        <button class="btn btn-primary" onclick="openMediumWindow('/development/development_apply?idStr=<?php if (!empty($data)){
                            echo html::encode($data['applyer']['id']);}?>&type=4')">上传入党志愿书</button>
                        <button class="btn btn-primary" onclick="openFullWindow('/development/volunteer_template?idStr=<?php if (!empty($data)){
                            echo html::encode($data['applyer']['id']);}?>&type=4')">入党志愿书模板</button>
                </aside>
            </section>
            <section data-sta="25" id="25">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">支部大会讨论接收预备党员</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="26" id="26">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">上级党委安排谈话</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="27" id="27">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">上级党委审批</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="28" id="28">
                <span class="point-time point-grey"></span>
                <div class="div-title"><span>预备党员的教育考察和转正</span></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">再上一级党委组织部门备案并编入党支部和党小组</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>

            <section data-sta="29" id="29">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">入党宣誓</span></div>
                    <div class="brief">
                        <button class="btn btn-primary" onclick="openMediumWindow('/development/development_apply?idStr=<?php if (!empty($data)){
                            echo html::encode($data['applyer']['id']);}?>&type=5')">上传入党宣誓图片</button>
                    </div>
                </aside>
            </section>
            <section data-sta="30" id="30">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">预备党员谈话记录</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="31" id="31">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">预备党员的教育考察</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="32" id="32">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">转正申请</span></div>
                    <div class="brief">
                        <button class="btn btn-primary" onclick="openMediumWindow('/development/development_apply?idStr=<?php if (!empty($data)){
                            echo html::encode($data['applyer']['id']);}?>&type=6')">填写转正申请书</button>
                </aside>
            </section>
            <section data-sta="33" id="33">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">预备党员转正征求意见记录表</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="34" id="34">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">发布公示</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="35" id="35">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">公示7天</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="36" id="36">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">填写公示结果记录表</span></div>
                    <div class="brief">
                </aside>
            </section>
            <section data-sta="37" id="37">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">支部大会讨论</span></div>
                    <div class="brief">

                    </div>
                </aside>
            </section>
            <section data-sta="38" id="38">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">上级党委审批</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section data-sta="39" id="39">
                <span class="point-time point-grey"></span>
                <div class="div-title"></div>
                <aside>
                    <div class="things"><span class="text-grey text-font">材料归档</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
        </article>
    </div>
<!--    <div class="bottom_tools " style="bottom: 40px;"><a id="scrollUp" href="javascript:;" title="飞回顶部" style="display: block;"></a></div>-->
    <input type="hidden" id="devpPartyerSta" value="<?php if(!empty($data)){echo html::encode($data['applyer']['devpPartyerSta']);}?>">
</div >
<script type="text/javascript">
    $(function () {
        var sta=$("#devpPartyerSta").val();
        if(sta==''){
            sta=1;
            $("section").each(function () {
               if($(this).data("sta")==1){
                   $(this).find(".point-time").addClass("direction-backgroudn").removeClass("point-grey").removeClass("point-time");
                    $(this).find(".text-font").addClass("text-yellow").removeClass("text-grey");
                }else {
                    $(this).find(".brief").hide();
                }
            })
        }else {
            $("section").each(function () {
                if($(this).data("sta")<sta){
                    $(this).find(".point-time").addClass("point-green").removeClass("point-grey");
                    $(this).find(".text-font").addClass("text-green").removeClass("text-grey");
                    $(this).find(".brief").hide();
                }else if($(this).data("sta")==sta){
                    if(sta>=0&&sta<3){
                        if(sta!=1){
                            $("#1").find(".div-title").children().remove();
                        }
                        $(this).find(".div-title").append("<span>入党申请</span>");
                    }else if(sta>=3&&sta<11){
                        if(sta!=3){
                            $("#3").find(".div-title").children().remove();
                        }
                        $(this).find(".div-title").append("<span>入党积极分子的确定和培养教育</span>");
                    }else if(sta>=11&&sta<19){
                        if(sta!=11){
                            $("#11").find(".div-title").children().remove()
                        }
                        $(this).find(".div-title").append("<span>发展对象的确定和考察</span>");
                    }else if(sta>=19&&sta<28){
                        $("#19").find(".div-title").children().remove()
                        $(this).find(".div-title").append("<span>预备党员的接收</span>");
                    }else if(sta>=28){
                        if(sta!=28){
                            $("#28").find(".div-title").children().remove()
                        }
                        $(this).find(".div-title").append("<span>预备党员的教育考察和转正</span>");
                    }
                    $(this).find(".point-time").addClass("direction-backgroudn").removeClass("point-grey").removeClass("point-time");
                    $(this).find(".text-font").addClass("text-yellow").removeClass("text-grey");
                }else {
                    $(this).find(".brief").hide();
                }
            })
        }
//移动到流程所在位置
        $('html,body').animate({scrollTop: (($("#"+sta).offset().top)-100)}, {duration:10, easing:'swing'});
    })
</script>

