<?php
use yii\helpers\Html;
?>
<link href="/content/css/uncommon/create.css" rel="stylesheet" type="text/css"/>
<script>
    $(document).ready(function() {//九宫格
        $('.artist_l li').each(function(index) {
            if(Math.ceil((index+1)%6)==0){
                $(this).css("margin-right","0");
            }
            $(this).find('a').css('top', -$(this).height());
            $(this).hover(function() {
                    $(this).find('a').animate({
                            'top': '0'
                        },
                        200)
                },
                function() {
                    $(this).find('a').animate({
                            'top': $(this).height()
                        },
                        {
                            duration: 200,
                            complete: function() {
                                $(this).css('top', -$(this).parent('li').height())
                            }
                        })
                })
        });

        /*判断是否是第三个*/
        $(".thumbnails .span3").each(function(index){
            if(Math.ceil((index+1)%3)==0){
                $(this).css("margin-right","0");
            }
        });
    });
</script>

<div class="ly_main">
    <div id="ly_dj_news">
        <!--支部党建-->
        <p class="ly_tits">文明创建</p>
        <div class="ly_branch_top mar_b">
            <div id="lyg_left_bar">
                <dl><!-- lyg_current-->
                    <?php if(!empty($resultData['wmcjData']['artChannelList'])){
                        foreach ($resultData['wmcjData']['artChannelList'] as $data_k => $data_val) {
                            if($data_k == 0){
                                echo '<dt class="current_tab"><a href="/news/news_create?curArtChannelCode=wmcj&channelId=' . html::encode($data_val['idStr']) . '#create" data-id="' . html::encode($data_val['idStr']) . '" target="_blank"> ' . html::encode($data_val['name']) . '</a></dt>';
                            }else{
                                echo '<dt class="current_tab"><a href="/branch/branch?curArtChannelCode=wmcj&channelId=' . html::encode($data_val['idStr']) . '#create" data-id="' . html::encode($data_val['idStr']) . '" target="_blank"> ' . html::encode($data_val['name']) . '</a></dt>';
                            }
                        }
                    }
                    ?>
                </dl>
            </div>

            <!-- 轮播图 -->
            <div class="row-fluid">
                <div class="span12">
                    <div class="carousel slide" id="myCarousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <ul class="thumbnails">
                                    <?php if(!empty($resultData['currIdData']['listArticle'])){
//                                        print_r($resultData['currIdData']['listArticle']);
                                        foreach ($resultData['currIdData']['listArticle'] as $data_k => $data_val) {
                                            echo '<li class="span3">
                                                <div class="thumbnail">
                                                    <a href="#" data-id="' . html::encode($data_val['title']) . '" target="_blank"><img src="/content/images/seimg.jpg" alt=""></a>
                                                </div>
                                                <div class="caption">
                                                    <h3></h3>
                                                    <p style="max-height: 200px;">' . html::encode($data_val['title']) . '</p>
                                                    <span class="pull-left">' . html::encode($data_val['clickTimes']) . '人浏览</span>
                                                    <span class="pull-right">' . html::encode($data_val['createTime']) . '</span>
                                                </div>
                                            </li>';
                                        }
                                    }else{echo '暂无数据';}
                                    ?>
                                </ul>
                            </div><!-- /Slide1 -->
                        </div>
                    </div><!-- /#myCarousel -->
                </div><!-- /.span12 -->
            </div><!-- /.row -->
        </div>

        <!--九宫格-->
        <div class="itagBox mar_b">
            <div class="ly_tits">支部架构</div>
            <ul class="artist_l">
                <?php if(!empty($resultData['starData'])){
//                        print_r($resultData['starData']['listOrg']);
                    foreach ($resultData['starData']['listOrg'] as $data_k => $data_val) {
                        echo '<li class="tag1" data-id="">
                                    <div class="tag_txt">'.html::encode($data_val['name']) . '</div>
                                    <a class="curr_tab" hash="par_branch" href="/par_branch/par_branch?idStr='.$data_val['idStr'].'#par_branch" target="_blank" '.html::encode($data_val['name']) . '>'.html::encode($data_val['name']) . '</a>
                                </li>';
                    }
                }?>
            </ul>
        </div>
    </div>
</div>

