<?php
use backend\assets\AppAsset;
use common\models\MyFunction;
use yii\helpers\Html;

//saas控制
//存入客户端session，避免频繁从服务端读取
$platformInfo = MyFunction::init_platform();
//MyFunction::sun_p($platformInfo);DIE;
AppAsset::addScript($this, '//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js');

$backLink = isset($this->params['backLink']) ? html::encode($this->params['backLink']) : '';
switch ($backLink) {
    case 'back': //返回上一页
        $backLink = 'javascript:history.back();';
        break;
    case 'home': //跳转到【首页】
        $backLink = '/account/index?tab=0';
        break;
    case 'my': //跳转到【党群服务】
        $backLink = '/personal/personal?tab=2';
        break;
    case 'study': //跳转到【学习】
        $backLink = '/video/video?tab=1';
        break;
    default:
        $backLink = 'javascript:history.back();';
        break;
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
          content="<?= isset($this->params['description']) ? html::encode(strip_tags($this->params['description'])) : html::encode($platformInfo['platformName']) ?>">
    <?= Html::csrfMetaTags() ?>
    <!--    <title><1?//= Html::encode($this->title) ?></title>-->
    <title><?= isset($this->params['pageTitle']) ? html::encode($this->params['pageTitle']) . '-' : '' ?><?= html::encode($platformInfo['platformName']) ?></title>
    <link href="/content/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!--    <link href="/content/css/style.min.css" rel="stylesheet" type="text/css"/>-->

    <link href="/content/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!--    <link href="/content/css/uncommon/index.css" rel="stylesheet" type="text/css"/>-->
    <link href="/content/css/uncommon/dj_banner.css" rel="stylesheet" type="text/css"/>
    <link href="/content/css/common.css" rel="stylesheet" type="text/css"/>
    <!--    <link href="/content/plugins/bootstrap-wysihtml5/bulid.bootstrap.css" rel="stylesheet" type="text/css">-->

    <link href="/content/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
    <link href="/content/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css" rel="stylesheet" type="text/css"/>
    <link href="/content/css/bootstrapValidator.min.css" rel="stylesheet" type="text/css">

    <script src="/content/js/jquery-2.0.3.min.js" type="text/javascript"></script>
    <script src="/content/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/content/js/bootstrapValidator.min.js"></script>
    <script src="/content/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/content/js/uncommon/init_wev8.js"></script>

    <script src="/content/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="/content/js/common.js?v=20190509" type="text/javascript"></script>
    <script src="/content/js/uncommon/page_add.js" type="text/javascript"></script>
    <link href="/content/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
    <script src="/content/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/content/plugins/message/message.js" type="text/javascript"></script>
    <link href="/content/plugins/message/message.css" rel="stylesheet" type="text/css"/>
    <!--<script>
        $(function(){
            window.onresize = function () {
                var mainHeight = $(window).height() - 296;
                var curHeight = $(".ly_main").height();
                if (curHeight > mainHeight) {
                    $(".ly_main").css("height", curHeight + "px");
                } else {
                    $(".ly_main").css("height", mainHeight + "px");
                }
            };
            $(document).ready(function () {
                var mainHeight = $(window).height() - 296;
                var curHeight = $(".ly_main").height();
                if (curHeight > mainHeight) {
                    $(".ly_main").css("height", curHeight + "px");
                } else {
                    $(".ly_main").css("height", mainHeight + "px");
                }
            });
        });
    </script>-->
</head>
<style>
    .mar_ll {
        margin-left: 44px;
    }

    .ly_wrap {
        padding: 0;
    }

    /*返回顶部*/
    #scrollUp, #feedback, .qr_tool {
        background-image: url("/content/images/top.png");
    }

    .bottom_tools {
        position: fixed;
        z-index: 999;
        right: 20px;
        bottom: 40px;
    }

    .bottom_tools > * {
        font: 0/0 a;
        display: block;
        margin-top: 5px;
        color: transparent;
        border: 0;
        background-color: transparent;
        text-shadow: none
    }

    #scrollUp {
        width: 41px;
        height: 35px;
        background-position: 0px -0px;
        display: none;
    }

    #scrollUp:hover {
        background-position: -41px -35px
    }
    .dd{
        color:#333;
        font: normal 27px/26px "simhei"!important;margin-bottom: 8px;
        text-align: center;
    }
    .ee{
        color:#333;
        font: normal 27px/26px "simhei"!important;margin-bottom: 16px!important;
    }
    .rr{
        font: 500 38px/26px "simhei"!important;margin-bottom: 8px;
    }
    .mjnhyczj{height:150px;}

</style>
<script type="text/javascript">
    //支持Enter键登录
    $(function () {

        $("#search_title").keypress(function (e) {
            if (!e) e = window.event;
            if ((e.keyCode || e.which) == 13) {
                var title = $("#search_title").val();
                if (title != '') {
                    window.open("/news/news_search?title=" + title + "");
                } else {
                    swal({
                        title: "请填写搜索内容",
                        text: "搜索内容不能为空！",
                        type: "warning",
                        confirmButtonText: "确 定"
                    });
                    return false;
                }
            }
        });

        //返回顶部
        var $bottomTools = $('.bottom_tools');
        $(window).scroll(function () {
            var scrollHeight = $(document).height();
            var scrollTop = $(window).scrollTop();
            var $windowHeight = $(window).innerHeight();
            scrollTop > 50 ? $("#scrollUp").fadeIn(200).css("display", "block") : $("#scrollUp").fadeOut(200);
            $bottomTools.css("bottom", scrollHeight - scrollTop > $windowHeight ? 40 : $windowHeight + scrollTop + 40 - scrollHeight);
        });
        $('#scrollUp').click(function (e) {
            e.preventDefault();
            $('html,body').animate({scrollTop: 0});
        });
    });
    function searchNews() {
        var title = $("#search_title").val();
        if (title != '') {
            window.open("/news/news_search?title=" + title + "");
        } else {
            swal({
                title: "请填写搜索内容",
                text: "搜索内容不能为空！",
                type: "warning",
                confirmButtonText: "确 定"
            });
            return false;
        }
    }

</script>

<body class="hold-transition skin-blue sidebar-mini">
<!-- 头部 -->
<?php if(isset($platformInfo['sldName'])&&$platformInfo['sldName']=='mjnhyczj'){
    echo '<div id="ly_header" class="ly_min mjnhyczj">';
}else{
    echo '<div id="ly_header" class="ly_min">';
}
?>
    <div class="ly_wrap">
        <div class="ly_lbar ly_fl">
            <div id="ly_logo">
                <a href="/account/index#index">
                    <img src="<?php
                        if(isset($platformInfo['sldName'])&&$platformInfo['sldName']=='mjnhyczj'){
                            if(!empty($platformInfo['topLogo'])){echo html::encode($platformInfo['topLogo']);}
                        }else{
                            if(!empty($platformInfo['topLogo'])){echo html::encode($platformInfo['topLogo']);}
                        }
                    ?>"/>
                </a>
                <div class="ly_logo_tit">
                    <?php
                        if(isset($_GET['zzd'])){
                            echo '<p>'.(html::encode($platformInfo['platformName'])).'-自助端</p>';
                            echo '<p style="font-size: 14px;">'.html::encode($platformInfo['englishName']).'</p>';
                        }else{
                            echo '<p>'.(html::encode($platformInfo['platformName'])).'</p>';
                            echo '<p style="font-size: 14px;">'.html::encode($platformInfo['englishName']).'</p>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="ly_cbar ly_fr">
            <div class="search">
                <input type="text" id="search_title" name="title" onkeyup="filtecharacter(this,0)" maxlength="20" placeholder="请输入关键字">
                <button type="submit" class="submit_btn" onclick="searchNews();">搜索</button>
            </div>
        </div>
        <div class="lyg_clear"></div>
    </div>
</div>
<!--导航-->

<div id="ly_menu">
    <ul class="ly_wrap">
        <li class="lyg_fir" hash="首页">
            <a href="/account/index#首页">首页</a>
        </li>
        <?php
        $menuChannel = MyFunction::get_menu_channel();
        if (!empty($menuChannel)) {
//            MyFunction::sun_p($menuChannel);DIE;
            foreach ($menuChannel as $data_key => $item) {
                echo '<li class="lyg_fir" hash="' . $item->name . '">';
                    if(isset($item->childNodeCount)){
                        $childNodeCount = $item->childNodeCount;
                        echo '<a href="/branch/branch?itemName=' . $item->name . '&channelId=' . $item->idStr . '#' . $item->name . '">' . html::encode($item->name) . '</a>';
                    }else{
                        echo '<a href="/branch/branch?tab=exist&itemName=' . $item->name . '&channelId=' . $item->idStr . '#' . $item->name . '">' . html::encode($item->name) . '</a>';
                    }

               echo '</li>';
            }
        }
        ?>

        <li class="lyg_fir" hash="在线学习">
            <a href="/course/course_list?curtab=zxxx#在线学习">在线学习</a>
        </li>
       <!-- <li class="lyg_fir" hash="信息展示">
           <a href="/info/info#信息展示">信息展示</a>
        </li>-->
        <li class="lyg_fir" hash="党群服务">
            <a href="/newpersonal/personal#党群服务">党群服务</a>
        </li>
        <li class="lyg_fir" hash="工作平台">
<!--            <a href="<?='http://'.MyFunction::get_sld_name() .'.'. HTTP_DOMAIN ?>?#工作平台" target="_blank">工作平台</a> -->
            <a href="<?='http://'.HTTP_DOMAIN ?>?#工作平台" target="_blank">工作平台</a>
        </li>
        <li class="lyg_fir" hash="党建论坛">
            <a href="/bbs/post_list?curtab=zxxx#党建论坛">党建论坛</a>
        </li>
<!--        <li class="lyg_fir" hash="党员画像">-->
<!--            <a href="/newpersonal/portrait#党员画像">党员画像</a>-->
<!--        </li>-->
<!--        <li class="lyg_fir" hash="征文投稿">-->
<!--            <a href="/news/article_contribute#征文投稿">征文投稿</a>-->
<!--        </li>-->
<!--        <li class="lyg_fir" hash="活动相册">-->
<!--            <a href="/course/activity_album_list">活动相册</a>-->
<!--        </li>-->

    </ul>
</div>

<?php $this->beginBody() ?>
<div class="wrapper_page">
    <?= $content ?>
</div>
<?php include '_modal.php'; ?>
<?php $this->endBody() ?>
<div class="bottom_tools "><a id="scrollUp" href="javascript:;" title="返回顶部" style="display: block;"></a></div>
<!--<div class="clearfix" style="height: 30px;"></div>-->
<div id="ly_footer" class="ly_min">
    <div class="ly_wrap">
        <div class="ly_lbar ly_fl">
            <div class="ly_logo"><img style="max-width: 300px;max-height: 100px;" src="<?php if(!empty($platformInfo['bottomLogo'])){echo html::encode($platformInfo['bottomLogo']);}  ?>"/></div>
        </div>
        <div class="ly_cbar ly_fl <?php if(empty($platformInfo['tecSupport'])){echo 'fs_ds';}?>" style="vertical-align: middle;">
            <div class="ly_copyright"><?= html::encode($platformInfo['fullName']) ?><br/>
                <?= html::encode($platformInfo['copyright']) ?><br/>
            </div>
        </div>
        <div class="ly_cbar ly_fr">
            <div class="ly_copyright">
                <?= Html::decode($platformInfo['tecSupport']) ?>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock('view') ?>

<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['view'], \yii\web\View::POS_END); ?>

</body>
</html>
<?php
//MyFunction::sun_p($platformInfo);
$this->endPage() ?>
