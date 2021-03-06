<?php

use yii\helpers\Html;

$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$pre_username = $user_msginfo['name'];
$pre_userId = $user_msginfo['idStr'];
?>
<link href="/content/css/course/course.css" rel="stylesheet" type="text/css"/>
<script src="/content/js/course/course.js" type="text/javascript"></script>

<style>
    .tcdPageCode {
        padding: 15px 5px;
        color: #ccc;
        text-align: center;
    }

    .tcdPageCode a {
        color: #428bca;
        display: inline-block;
        height: 25px;
        line-height: 25px;
        padding: 0 5px;
        border: 1px solid #ddd;
        margin: 0 2px;
        border-radius: 4px;
        vertical-align: middle;
    }

    .tcdPageCode a:hover {
        text-decoration: none;
        border: 1px solid #428bca;
    }

    .tcdPageCode span.current {
        font-size: 12px;
        display: inline-block;
        height: 25px;
        line-height: 25px;
        padding: 0 5px;
        margin: 0 2px;
        color: #fff;
        background-color: #428bca;
        border: 1px solid #428bca;
        border-radius: 4px;
        vertical-align: middle;
    }

    .tcdPageCode span.disabled {
        font-size: 12px;
        display: inline-block;
        height: 25px;
        line-height: 25px;
        padding: 0 5px;
        margin: 0 2px;
        color: #bfbfbf;
        background: #f2f2f2;
        border: 1px solid #bfbfbf;
        border-radius: 4px;
        vertical-align: middle;
    }

    .input {
        height: 31px;
        line-height: 31px;
        border: 0 !important;
        vertical-align: top;
    }
</style>
<script type="text/javascript" src="/content/plugins/page/jquery.page.js"></script>
<script type="text/javascript">
    $(function () {
        if ($("#infoTitle").length > 0) {
            $('#myModal').modal({keyboard: true});
            $("#myModal").modal({backdrop: "static", keyboard: false}); // 标记：已经向该访客弹出过消息。30天之内不要再弹
        }
    });
</script>
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title" id="myModalLabel" style="text-align:center;">生日贺卡</h2>
            </div>
            <div class="modal-body"><!--全屏滚动-->
                <?php
                if (!empty($birthdayData)) {
                    echo '<input type="hidden" id="infoTitle" value="' . html::encode($birthdayData['infoTitle']) . '"/>';
                    echo '<p>' . html::encode($birthdayData['infoContent']) . '</p>
                        <p>' . html::encode($birthdayData['birthdayCard']['cardName']) . '</p>
                        <p style="overflow: hidden;">';
                    if (!empty($birthdayData['birthdayCard']['cardImgJson'])) {
                        foreach (json_decode($birthdayData['birthdayCard']['cardImgJson']) as $pic_k => $pic_val) {
                            echo '<img alt="' . $birthdayData['infoTitle'] . '" src="' . $pic_val->url . '"/>';
                        }
                    }
                    echo '</p>';
                }
                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="btn" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- 结束触发模态框 -->

<div class="main ly_main">
    <div class="main_content">
        <!-- tab -->
        <div class="article_tags">
            <span class="icon"></span>
            <span class="tag">活动分类</span>
            <ul class="tagcns">
<!--                --><?php
//                if (!empty($data)) {
//                    if (empty($_GET['coursetypeId'])) {
//                        echo '<li class="item active"><a href="course_list?coursetypeId=#在线学习">全部</a></li>';
//                    } else {
//                        echo '<li class="item"><a href="course_list?coursetypeId=#在线学习">全部</a></li>';
//                    }
//                    foreach ($coursetypeList['listStudyChannelBra'] as $data_k => $data_val) {
//                        if (!empty($_GET['coursetypeId'])) {
//                            if ($_GET['coursetypeId'] == $data_val['idStr']) {
//                                echo '<li class="item active"><a href="course_list?coursetypeId=' . html::encode($data_val['idStr']) . '#在线学习">' . html::encode($data_val['name']) . '</a></li>';
//                            } else {
//                                echo '<li class="item"><a href="course_list?coursetypeId=' . html::encode($data_val['idStr']) . '#在线学习">' . html::encode($data_val['name']) . '</a></li>';
//                            }
//                        } else {
//                            echo '<li class="item"><a href="course_list?coursetypeId=' . html::encode($data_val['idStr']) . '#在线学习">' . html::encode($data_val['name']) . '</a></li>';
//                        }
//                    }
//                }
//                ?>

            </ul>
        </div>

        <div class="ly_search">
            <form id="search_mini_form" action="course_list#在线学习" class="formData" method="post" role="form"
                  enctype="multipart/form-data">
                <!-- <div class="input-group">
                     <input type="text" class="form-control" name="searchName" >
                     <span class="input-group-btn">
                         <button type="submit" class="btn btn-primary">搜索</button>
                     </span>
                 </div>-->
                <div class="form-search">
                    <button type="submit" title="搜索" class="button" id="submit"></button>
                    <input id="search" type="text" name="searchName" value="" placeholder="搜索..." class="input"
                           maxlength="128"/>
                    <button type="reset" id="gh-search-reset" class="gh-search-reset"><span
                                class="gh-text-replace">×</span></button>
                </div>
            </form>

            <!-- 图文展示 -->
            <div class="row-fluid">
                <div class="carousel slide" id="myCarousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            <ul class="thumbnails">
                                <li class="span3" id="" name="" onclick="">
                                    <div class="thumbnailtrans">
                                        <div class="thumbnail">
                                            <a href="javascript:void(0);">
                                                <img src="" alt="">
                                            </a>
                                        </div>
                                        <div class="caption">
                                            <p><a href="javascript:void(0);" title="">哈哈哈哈哈</a></p>
                                            <p class="pull-left">66666</p>
                                            <p class="pull-right">77777</p>
                                        </div>
                                    </div>
                                </li>
<!--                                <div class="nodata">-->
<!--                                    <p><img src="/content/images/nodata.png"></p>-->
<!--                                    <p>暂无数据</p>-->
<!--                                </div>-->
                            </ul>
                            <?php require(__DIR__ . '/../layouts/pageNumbers.php'); ?>
                        </div><!-- /Slide1 -->
                    </div>
                </div><!-- /#myCarousel -->

            </div><!-- /.row -->

        </div>
    </div>
</div>
<!--<script type="text/javascript">-->
<!--    var tiaoshu=1000;//数据的条数-->
<!--    var yexian=4;//每页几条数据-->
<!--    var ye=  Math.ceil(tiaoshu/yexian);//可以分为几页-->
<!--    var currentUrl01 = decodeURI(window.location.href);-->
<!--    var arr01 = currentUrl01.split("?");-->
<!--    $('#zongye').text(ye);-->
<!--    $('#dang').html(arr01[1]);-->
<!--    $(function () {-->
<!--        $('#tiao').val(arr01[1]);-->
<!--        setTimeout(function () {-->
<!--            $("#zhuan").click()-->
<!--        },10);-->
<!--    });-->
<!--    function bian(yeshu){-->
<!--        var stateObject = {};-->
<!--        var title = "";-->
<!--        var newUrl ="" ;-->
<!--        if(arr01[0]!=parseInt($('#dang').text())){-->
<!--            newUrl =arr01[0]+"?"+yeshu;-->
<!--            history.pushState(stateObject,title,newUrl);-->
<!--        }-->
<!--    }-->
<!---->
<!--    ////////////////////////////////这里面获取数据  p 为当前页数-->
<!--    $(".tcdPageCode").createPage({-->
<!--        pageCount:ye,-->
<!--        current:1,-->
<!--        backFn:function(p){-->
<!--            console.log(p);-->
<!--            bian(p);-->
<!--        }-->
<!--    });-->
<!--</script>-->

