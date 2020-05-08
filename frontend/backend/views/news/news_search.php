<?php
use yii\helpers\Html;
?>
<style type="text/css">
    #data{
        width:1200px;
        margin: 0 auto;
        overflow: hidden;
        background: #fff;
    }
    .jiansuo{
        padding:5px 0 0 0;
        margin: 0 auto;
        width:1171px;
        background: #fff;
        cursor: pointer;
    }
    .jiansuo_list {

    }
    .jiansuo_title
    {
        width:1171px;
        height: 45px;
        line-height:45px;
        text-align:left;
    }

    .jiansuo_nr
    {
        width:1171px;
        letter-spacing: 1px;
        line-height: 22px;
    }

    .jiansuo_date
    {
        width:1171px;
        height: 34px;
        line-height:34px;
        text-align:right;
    }

    .jiansuo_center_page
    {
        margin: 0px auto;
        width: auto;
        max-width: 1171px;
        min-width:1171px;
        height: 40px;
        line-height:40px;
        overflow: hidden;
        margin-top:10px;
        background-position: 25px;
        background-color:#ffffff;

    }

    .jiansuo_center_buttom
    {
        margin: 0px auto;
        width:1000px;
        height: 48px;
        line-height:48px;
        border-top:2px solid #0168B7;
        margin-top:10px;
        margin-bottom:10px;
        text-align:center;
    }
    .font_lan_16 a{
        font: 700 18px/26px "\5FAE\8F6F\96C5\9ED1",tahoma;
        color: #da3606;
    }
    .font_hui_15_02{
        font-family: "微软雅黑";
        font-size: 14px;
        color: #756464;
    }
    .jiansuo_date{
        font-size: 14px;
        border-bottom:1px dashed #CCCCCC;
    }

    .jiansuo_nr.font_hui_15_02 p{
        margin:0 15px;
    }

</style>

<style type="text/css">
    body {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box
    }
    .title.mapInfo span {
        color: red;
        font-size: 1.1em;
        font-weight: bold;
        font-family: "Microsoft YaHei";
    }

    .top-bar {
        height: 40px;
        line-height: 40px;
    }

    .top-bar a {
        color: #333;
    }

    .top-bar .search {
        margin-top: 5px;
        width: 300px;
    }

    .top-bar .search form {
        line-height: 24px;
        position: relative;
    }

    .top-bar .search input {
        border: 0 !important;
    }

    .top-bar .search input[type=text] {
        width: 220px;
        height: 24px;
        line-height: 14px;
        border-radius: 5px 0 0 5px;
    }

    .top-bar .search .btnSubmit {
        width: 60px;
        height: 24px;
        text-indent: 0;
        background: #eee;
        border-radius: 0 5px 5px 0;
    }

    .main-wrap {
        width: 1200px;
        margin: 0 auto;
        background: #6daf19;
    }

    .main-wrap-date {
        padding-left: 20px;
        color: #fff;
        font-size: 14px;
    }

    .main-wrap:before,
    .main-wrap:after {
        display: table;
        content: " ";
    }

    .main-wrap:after {
        clear: both;
    }
</style>

<script type="text/javascript">
    $(function() {
        $("#search_title").val($("#titleName").val());

        //设置高度
       /* var mainHeight = $(window).height() - 296;
        var curHeight = $("#data").height();
        if(curHeight > mainHeight){
            $("#data").css("height",curHeight+"px");
        }else{
            $("#data").css("height",mainHeight+"px");
        }*/
    });
   /* window.onresize = function(){
        var mainHeight = $(window).height() - 296;
        var curHeight = $("#data").height();
        if(curHeight > mainHeight){
            $("#data").css("height",curHeight+"px");
        }else{
            $("#data").css("height",mainHeight+"px");
        }
    }*/
</script>
<div id="data">
    <?php
    echo '<input id="titleName" type="hidden" value="'.$_GET['title'].'"/>';
    if(!empty($resultData['infoData']['listArticle'])){
        foreach ($resultData['infoData']['listArticle'] as $data_k => $data_val){
            echo '<div class="jiansuo" onclick="window.open(\'/news/news?channelId=' . html::encode($data_val['idStr']) . '#首页\')">
                    <div class="jiansuo_list">
                        <div class="jiansuo_title font_lan_16"><a href="" target="_blank">'.html::encode($data_val['title']).'</a></div>
                        <div class="jiansuo_nr font_hui_15_02">';if(isset($data_val['summary'])){echo html::encode($data_val['summary']);} echo '</div>
                        <div class="jiansuo_date font_hui_15">【'.html::encode($data_val['channelName']).'】</div>
                        <div class="jiansuo_date font_hui_15">[ 发布日期：'.date("Y 年 m 月 d 日", html::encode($data_val['createTime'])).' ]</div>
                    </div>
                </div>';
        }
    }else{
        echo '<div class="nodata">
            <p><img src="/content/images/nodata.png"></p><p>暂无数据</p>
        </div>';
    }
    ?><div class="clearfix" style="height: 30px;"></div>

</div>
