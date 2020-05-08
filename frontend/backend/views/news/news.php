<?php

use common\models\MyFunction;
use yii\helpers\Html;

?>
<link href="/content/css/uncommon/artice.css" rel="stylesheet" type="text/css"/>
<link href="/content/css/share.min.css" rel="stylesheet" type="text/css"/>
<style>
    .social-share .icon-wechat .wechat-qrcode {
        top: 40px !important;
    }

    .article {
        padding: 1em 1.5em;
    }

    .form-group {
        margin: 10px auto;
        overflow: hidden;
    }

    .form-group label {
        font-size: 16px;
    }

    .u-p-img {
        display: none !important;
    }

    .u-p-p-s p {
        margin-bottom: 0 !important;
    }

    /*.progress{*/
    /*display: none!important;*/
    /*}*/
    .cutline {
        padding: 1em 1.5em;
        width: 100%;
        height: 1px;
        border-top: 1px solid #ccc;
    }

    .submit_btn {
        width: 120px;
        height: 32px;
        line-height: 32px;
        background: #428bca;
        color: #fff;
        border-color: #357ebd;
        font-size: 14px;
        border-radius: 5px;
    }
    .form-control-feedback{
        right: 10px!important;
    }
</style>

<div class="ly_main">
    <input type="hidden" id="news_url" value="<?= 'http://' . MyFunction::get_sld_name() . '' . HTTP_NEWS . '' ?>">

    <div id="ly_dj_news">
        <!--支部党建-->
        <?php if (!empty($resultData['infoData'])) {
//            echo json_encode($resultData['infoData']);die;
            $this->title = $resultData['infoData']['title'];
            echo '<div class="ly_article">
            <input type="hidden" id="news_title" value="' . $resultData['infoData']['title'] . '">
            <input type="hidden" id="news_id" value="' . $_GET['channelId'] . '">
                <div id="ly_article_bar">
                    <h1 class="ly_title">' . html::encode($resultData['infoData']['title']) . '</h1>';
            if (!empty($resultData['infoData']['author'])) {
                echo '<h2 class="ly_title sec">作者：' . html::encode($resultData['infoData']['author']) . '</h2>';
            }
            echo '<div class="ly_title_span" style="text-align: center;">
                        <div id="share" class="share"></div>
                        <span>发布时间：' . date("Y 年 m 月 d 日", html::encode($resultData['infoData']['publishTime'])) . '</span>
                    </div>
                    <div class="mar_b">
                        <div class="ly_article_box">
                            <div class="ly_article_content">
                                ' . $resultData['infoData']['content'] . '   
                            </div>
                        </div>
                    </div>';
            if (!empty($resultData['infoData']['author'])) {
                echo '<div class="footer"><span class="ly_title_span pull-right">(责编：' . html::encode($resultData['infoData']['author']) . ')</span></div>';
            }
            echo '</div>
                <!--热门列表-->
                <div class="ranklist">
                    <h3>热门文章推荐</h3>
                    <ol>';
            if (!empty($resultData['infoData']['hotTopTenArticle'])) {
                foreach ($resultData['infoData']['hotTopTenArticle'] as $data_k => $data_val) {
                    if ($data_k > 2) {
                        echo '<li>
                                    <em>' . ($data_k + 1) . '</em>   <!--前三个红色标记-->
                                    <a href="/news/news?channelId=' . html::encode($data_val['id']) . '#news" title="' . html::encode($data_val['title']) . '" target="_blank">' . html::encode($data_val['title']) . '</a>
                                </li>';
                    } else {
                        echo '<li class="top">
                                    <em>' . ($data_k + 1) . '</em>
                                    <a href="/news/news?channelId=' . html::encode($data_val['id']) . '#news" title="' . html::encode($data_val['title']) . '" target="_blank">' . html::encode($data_val['title']) . '</a>
                                </li>';
                    }
                }

                echo '</ol>
                    <div class="clear"></div>
                </div>
            </div>';
            }
        } ?>

            <form role="form" enctype="multipart/form-data" method="post" action="article_submit" onsubmit="return appendNesSign()">
                <div class="article">
                    <div class="cutline"></div>
                    <div class="form-group">
                        <div class="col-sm-8">
                            <label class="col-sm-4 control-label">投稿标题：</label>
                            <div class="col-sm-12">
                                <input type="text" name="title" class="form-control" id="title">

                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-left: 15px">
                        <div class="col-sm-12">
                            <div class="upload-files-main" name="url" data-p-height="50" data-accept=""
                                 data-max-count="1" data-multiple="false">
                                <?php require(__DIR__ . '/../layouts/upload_files.php'); ?>
                            </div>
                            <input type="hidden" id="pic"  />
                            <input type="hidden" name="channelId" value="<?php echo $_GET['channelId'] ?>">
                        </div>
                    </div>
                    <div class="col-sm-24" style="margin-left: 30px;margin-top: 50px">
                        <button type="submit" class="submit_btn" id="submit_btn">提交</button>
                    </div>
                </div>
            </form>

    </div>

</div>
<script src="/content/js/jquery.share.min.js"></script>
<script src="/content/js/uploadfiles/upload.js"></script>
<script type="text/javascript">
    $(function () {
        var id = $('#news_id').val();
        var title = $('#news_title').val();
        var url = $('#news_url').val();
        $('img').removeAttr('title');
        $('#share').share(
            {
                sites: ['weibo', 'wechat', 'qzone', 'qq'], // 启用的站点
                disabled: ['google', 'facebook', 'twitter'], // 禁用的站点
                url: url + '/news/newsdetail?idStr=' + id + '&title=', // 网址，默认使用 window.location.href
                source: '', // 来源（QQ空间会用到）, 默认读取head标签：<meta name="site" content="http://overtrue" />
                title: '<?=$this->title?>', // 标题，默认读取 document.title 或者 <meta name="title" content="share.js" />
                description: '',
//                description: '<?//=$this->metaTags?>//', // 描述, 默认读取head标签：<meta name="description" content="PHP弱类型的实现原理分析" />
                image: '', // 图片, 默认取网页中第一个img标签
                wechatQrcodeTitle: '微信扫一扫：分享', // 微信二维码提示文字
                wechatQrcodeHelper: '<p>微信里点“发现”，扫一下</p><p>二维码便可将本文分享至朋友圈。</p>'
            });

        $('form').bootstrapValidator({
//        live: 'disabled',
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                // url: {
                //     validators: {
                //         notEmpty: {
                //             message: '请上传上传稿件'
                //         },
                //     }
                // },
                title: {
                    validators: {
                        notEmpty: {
                            message: '请输入标题'
                        }
                    }
                },
            }
        });

    });
    function appendNesSign() {
        var uploadFilesBox = $(".upload-files-box").find(".upload-files-item").length;
        var pic = $("#pic").val();
        if(uploadFilesBox>=1 && pic=="" ){
            swal({
                title: "请点击上传文件",
                type: "warning",
                confirmButtonText: "确定"
            },function (isConfirm) {
                if(isConfirm) {
                    $(".layout_loading").css("display", "none");
                    return true;
                }
            });
            return false;
        }
    }
    $(".upload-files-submit-btn").click(function(){
        $("#pic").val(1);
        $(".submit_btn").removeAttr("disabled");
    });
</script>
