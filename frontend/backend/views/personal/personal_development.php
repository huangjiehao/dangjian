<?php
//use common\models\MyFunction;
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$userName = $user_msginfo['name'];
$userId = $user_msginfo['idStr'];
use yii\helpers\Html;
?>
<link href="/content/css/timeline_develope/timeline.css" rel="stylesheet" type="text/css"/>
<link href="/content/css/course/course.css" rel="stylesheet" type="text/css"/>
<link href="/content/css/uncommon/personal.css" rel="stylesheet" type="text/css"/>
<script src="/content/js/personal/jquery-latest.js" type="text/javascript"></script>
<script src="/content/js/personal/pc.js" type="text/javascript"></script>

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
        padding: 1px 5px!important;
    }
    .text-font{
        font-size: 16px;
    }
    .btn-margin-left{
        margin-left: 7px;
    }
    .ibox-content{
        height: calc(100% - 60px);
        overflow: scroll;
    }
    .btn-think{
        display: inline-block;
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
        <div style="display: inline-block"><button class="btn btn-success ">上传书面思想汇报</button></div>
        <div style="display: inline-block"><button class="btn btn-warning ">书面思想汇报模板</button></div>
    </div>
    <div class="content">
        <article>
            <!--<h3>发展党员</h3>-->
            <section>
                <span class="point-time point-green"></span>
                <time >
                    <span>入党申请</span>
                </time>
                <aside>
                    <div class="things"><span class="text-green text-font">递交入党申请书</span> </div>
                    <div class="brief">
                        <a href="http://163.177.111.135:8100/upload//2018/04/08//b64f4026-efa9-4a1a-b7c3-975b195d6877.docx" class="btn btn-success btn-margin-left ">申请书模板</a>
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-yellow"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-yellow text-font">党组织派人对话</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time><span>入党积极分子的确定和培养教育</span></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">党组织培养和教育</span></div>
                    <div class="brief">
                        <button class="btn btn-warning btn-margin-left">志愿服务详情</button>
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">推荐和确定入党积极分子</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">上级党委备案</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">指定培养联系人</span></div>
                    <div class="brief">
                        <button class="btn btn-primary ">联系人详情</button>
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">培养教育考察</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time><span>发展对象的确定和考察</span></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">确定发展对象</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">确定入党介绍人</span></div>
                    <div class="brief">
                        <button class="btn btn-primary ">介绍人详情</button>
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">政治审查</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">开展集中培训</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time><span>预备党员的接收</span></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">支部委员会的审查</span></div>
                    <div class="brief">

                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">上级党委预审</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">填写《入党志愿书》</span></div>
                    <div class="brief">
                        <button class="btn btn-primary">填写入党志愿书</button>
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">支部大会讨论接收预备党员</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">上级党委安排谈话</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">上级党委审批</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time><span>预备党员的教育考察和转正</span></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">再上一级党委组织部门备案</span></div>
                    <div class="brief">

                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">编入党支部和党小组</span></div>
                    <div class="brief">

                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">入党宣誓</span></div>
                    <div class="brief">

                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">预备党员的教育考察</span></div>
                    <div class="brief">

                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">转正申请</span></div>
                    <div class="brief">
                        <button class="btn btn-primary ">填写转正申请书</button>
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">支部大会讨论</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">上级党委审批</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
            <section>
                <span class="point-time point-grey"></span>
                <time></time>
                <aside>
                    <div class="things"><span class="text-grey text-font">材料归档</span></div>
                    <div class="brief">
                    </div>
                </aside>
            </section>
        </article>
    </div>
</div >

