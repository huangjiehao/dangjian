<?php
use common\models\MyFunction;
use yii\helpers\Html;

$platformInfo = MyFunction::init_platform();//存入客户端session，避免频繁从服务端读取
//MyFunction::sun_p($platformInfo);DIE;
$sldName = isset($platformInfo['sldName'])?$platformInfo['sldName']:null;

?>
<link href="/content/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
<script src="/content/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<!--<link rel="stylesheet" href="/content/css/font-awesome.css">-->
<link href="/content/css/uncommon/branch.css" rel="stylesheet" type="text/css"/>
<style>
    .dj-news-tit{ width:150px; display: inline-block; *zoom:1;*display: inline; vertical-align: top;}
</style>
<div class="ly_main">
    <div class="dj-top">
        <span class="glyphicon glyphicon-map-marker"></span>
        <span>当前位置:</span>
        <span>首页</span>
        <span> > </span>
        <?php
        if(!empty($resultData['allData'])){
            if(!empty($resultData['allData']['name'])){
                echo '<span>'.html::encode($resultData['allData']['name']).'</span>';
            }
        }
        ?>
    </div>
    <div id="ly_dj_news">
        <!--支部党建-->
        <div class="dj-news-tit">
            <?php
            if(!empty($resultData['allData'])){
                if(!empty($resultData['allData']['childArtChannel'])) {
                    echo '<div id="lyg_left_bar" class="mar_b"><dl>';
                    foreach ($resultData['allData']['childArtChannel'] as $data_k => $data_val) {//$data_k 侧导航栏
                        if (isset($_GET['tab'])) {//\common\models\MyFunction::sun_p($_GET['tab']);die;
                            if ($_GET['channelId'] == html::encode($data_val['idStr'])) {//\common\models\MyFunction::sun_p($data_val['idStr']);die;
                                echo '<dt class="lyg_current" onClick="location=\'/branch/branch?channelId=' . html::encode($data_val['idStr']) . '&tab=exist\'">
                                    <a class="lyg_current-item active-style">
                                    ' . html::encode($data_val['name']) . '
                                     <i class="glyphicon glyphicon-chevron-right lyg_current-item-icon"></i>
                                    </a> 
                               </dt>';//lyg_current
//                                \common\models\MyFunction::sun_p( html::encode($data_val['name']));DIE;
                            }else {
                                echo '<dt class="lyg_current" onClick="location=\'/branch/branch?channelId=' . html::encode($data_val['idStr']) . '&tab=exist\'">
                                    <a class="lyg_current-item">
                                    ' . html::encode($data_val['name']) . '
                                     <i class="glyphicon glyphicon-chevron-right lyg_current-item-icon"></i>
                                    </a>
                              </dt>';//
                            }
                        }else {
                            if ($data_k == 0)  {// 党建要闻 群团工作 学习专栏    显示侧边栏
                                echo '<dt class="lyg_current" onClick="location=\'/branch/branch?channelId=' . html::encode($data_val['idStr']) . '&tab=exist\'">
                                    <a class="lyg_current-item active-style">
                                    ' . html::encode($data_val['name']) . '
                                     <i class="glyphicon glyphicon-chevron-right lyg_current-item-icon"></i>
                                    </a>
                               </dt>';//lyg_current
                            }else {
                                echo '<dt class="lyg_current" onClick="location=\'/branch/branch?channelId=' . html::encode($data_val['idStr']) . '&tab=exist\'">
                                    <a class="lyg_current-item">
                                    ' . html::encode($data_val['name']) . '
                                    <i class="glyphicon glyphicon-chevron-right lyg_current-item-icon"></i>
                                    </a>
                               </dt>';
                            }
                        }
                    }
                    echo '</dl>
                    </div>';
                }
            }
            ?>
        </div>
        <?php
        if(!empty($resultData['allData'])) {
            if ($resultData['allData']['hasSubChannel'] == 0) {
                echo ' <ul><div class="list">';
            } else {
                echo ' <ul  style="width: calc(100% - 200px); display: inline-block; margin-left:35px; ">
                     <div class="list" >';
            }
        }
        ?>
        <?php
        if(!empty($resultData['allData'])) {
            if($resultData['allData']['hasSubChannel'] == 0)  //党员先锋  文明创建
            {
                if(!empty($resultData['allData']['firstArtChannelArticleList'])) {
                    foreach ($resultData['allData']['firstArtChannelArticleList'] as $data_k => $data_val) {
                        if($data_k == 0){
                            echo '<span class="news-text-right-tit">'.html::encode($resultData['allData']['name']).'</span>
                                <div class="dj-news-text-top" onClick="window.open(\'/news/news?channelId=' . html::encode($data_val['idStr']) . '\')">';
                                    echo '<div class="dis_inline" style="height: 162px;line-height:162px;overflow: hidden;">';
                                        if(!empty($data_val['smallPic'])){
                                            $url = json_decode($data_val['smallPic'])[0]->url;
                                            echo '<img src="'.$url.'" alt=""  width="160" height="162">';
                                        }else{
                                            if($sldName == 'kpqx'){
                                                echo '<img src="/content/images/kpqx_logo_1.png" width="160" alt="">';
                                            }else if($sldName=='pylyj'){
                                                echo '<img src="/content/images/pylyj_default.png" width="160" alt="">';
                                            }else if($sldName=='mjnhyczj'){
                                                echo '<img src="/content/images/mjnhyczj_dibu.png" width="160" alt="">';
                                            }else{
                                                echo '<img src="/content/images/default3.png" width="160" alt="">';
                                            }
                                        }
                                    echo '</div>';
                                    echo '<div class="news-text-right">';
                                    if(!empty($resultData['allData']['name'])){
                                        echo '<span class="line-style"></span>';
                                    }
                                    echo '
                                    <h4>' . html::encode($data_val['title']) .' </h4>
                                    <p class="strip">' . strip_tags($data_val['details']['content']) . ' </p>
                                    <p class="news-text-right-bottom">
                                    ' . date("Y-m-d", html::encode($data_val['createTime'])) . ' 
                                    <span class="news-text-right-btn">查看详情 ></span>
                                    </p>
                                </div>
                            </div>';
                        }else{
                            echo '<li class="list-item">  <!--党员先锋-->
                                <a href="/news/news?channelId=' . html::encode($data_val['idStr']) . '" target="_blank" style="width:calc(100% - 90px);" title="' . html::encode($data_val['title']) . '">
                                <i class="fa fa-clone list-item-icon"></i>
                                ' . html::encode($data_val['title']) . ' 
                                </a>
                                ' . date("Y-m-d", html::encode($data_val['createTime'])) . '
                            </li>';
                        }
                    }
                }
            }else{
                if(!empty($resultData['allData'])) {
                    if (!empty($resultData['allData']['firstArtChannelArticleList'])) {
                        foreach ($resultData['allData']['firstArtChannelArticleList'] as $data_k => $data_val) {
                            echo '<li class="list-item "  style="cursor: pointer;" onclick="window.open(\'/news/news?channelId=' . html::encode($data_val['idStr']) . '\')">  <!--党建要闻 群团工作 学习专栏 有侧边栏 内容右放-->
                                <a href="/news/news?channelId=' . html::encode($data_val['idStr']) . '" target="_blank" title="' . html::encode($data_val['title']) . '">
                                <i class="fa fa-clone list-item-icon"></i>
                                ' . html::encode($data_val['title']) . ' 
                                </a>
                                ' . date("Y-m-d", html::encode($data_val['createTime'])) . '
                            </li>';
                        }
                    }
                }
            }
        }
        ?>
        <?php
        if(isset($_GET['tab'])){
            if(!empty($resultData['allData'])) {
                if (!empty($resultData['allData']['articleList'])) {
                    foreach ($resultData['allData']['articleList'] as $data_k => $data_val) {
                        if($data_k == 0){
                            echo '<span class="news-text-right-tit">'.html::encode($resultData['allData']['name']).'</span>
                                <div class="dj-news-text-top" onClick="window.open(\'/news/news?channelId=' . html::encode($data_val['idStr']) . '\')">';
                            echo '<div class="dis_inline" style="height: 162px;line-height:162px;overflow: hidden;">';
                            if(!empty($data_val['url'])){
                                echo '<img src="'.$data_val['url'].'" alt=""  width="160" height="100%">';
                            }else{
                                if($sldName == 'kpqx'){
                                    echo '<img src="/content/images/kpqx_logo_1.png" width="160" alt="">';
                                }else if($sldName=='pylyj'){
                                    echo '<img src="/content/images/pylyj_default.png" width="160" alt="">';
                                }else if($sldName=='mjnhyczj'){
                                    echo '<img src="/content/images/mjnhyczj_dibu.png" width="160" alt="">';
                                }else{
                                    echo '<img src="/content/images/default3.png" width="160" alt="">';
                                }
                            }
                            echo '</div>';
                            echo '<div class="news-text-right">';
                            if(!empty($resultData['allData']['name'])){
                                echo '<span class="line-style"></span>';
                            }
                            echo '
                                    <h4>' . html::encode($data_val['title']) .' </h4>
                                    <p class="strip">' . strip_tags($data_val['details']['content']) . ' </p>
                                    <p class="news-text-right-bottom">
                                    ' . date("Y-m-d", html::encode($data_val['createTime'])) . ' 
                                    <span class="news-text-right-btn">查看详情 ></span>
                                    </p>
                                </div>
                            </div>';
                        }else {
                            echo '<li class="list-item " onclick="window.open(\'/news/news?channelId=' . html::encode($data_val['idStr']) . '\')">
                                <a target="_blank" title="' . html::encode($data_val['title']) . '">
                                <i class="fa fa-clone list-item-icon"></i>
                                ' . html::encode($data_val['title']) . '
                                 </a>
                                 ' . date("Y-m-d", html::encode($data_val['createTime'])) . '
                             </li>';
                        }
                    }
                }
            }
        }else{
            if(!empty($resultData['allData'])){
                if(!empty($resultData['allData']['articleList'])){
                    foreach ($resultData['allData']['articleList'] as $data_k => $data_val) {
                        echo '<li class="list-item " onclick="window.open(\'/news/news?channelId=' . html::encode($data_val['idStr']) . '\')">
                            <a ';if($resultData['allData']['hasSubChannel'] != 0){echo 'style="width:calc(100% - 90px);"';}  echo 'target="_blank" title="' . html::encode($data_val['title']) . '">
                            <i class="fa fa-clone list-item-icon"></i>
                            ' . html::encode($data_val['title']) . '
                             </a>
                             '.date("Y-m-d", html::encode($data_val['createTime'])).'
                         </li>';
                    }
                }
            }
        }
        ?>
        <?php
        if(!empty($resultData['allData'])) {
            if(isset($_GET['tab'])){
                if(empty($resultData['allData']['articleList'])){
                    echo '<div class="nodata">
                        <p><img src="/content/images/nodata.png"></p><p>暂无数据</p>
                    </div>';
                }
            }else{
                if(empty($resultData['allData']['firstArtChannelArticleList'])){
                    echo '<div class="nodata">
                        <p><img src="/content/images/nodata.png"></p><p>暂无数据</p>
                    </div>';
                }
            }
        }else{
            echo '<div class="nodata">
                <p><img src="/content/images/nodata.png"></p><p>暂无数据</p>
            </div>';
        }
        ?>
        </ul>
    </div>
</div>
</div>
<?php require(__DIR__ . '/../layouts/pageNumbers.php'); ?>
