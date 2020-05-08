<?php
use common\models\MyFunction;
$platformInfo = MyFunction::init_platform();//存入客户端session，避免频繁从服务端读取
use yii\helpers\Html;
?>
<link href="/content/plugins/bootstrap-zTree/css/bootstrapStyle/bootstrapStyle.css" rel="stylesheet">
<script src="/content/plugins/bootstrap-zTree/js/jquery.ztree.core.js" type="text/javascript"></script>
<script src="/content/plugins/bootstrap-zTree/js/jquery.ztree.excheck.js" type="text/javascript"></script>
<script src="/content/plugins/bootstrap-zTree/js/jquery.ztree.exedit.js" type="text/javascript"></script>

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=FMYkGaEksPC6FfaDMG8aXIdWhx51GAL8"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" />

<script src="/content/js/uncommon/map.js" type="text/javascript"></script>
<link rel="stylesheet" href="/content/css/uncommon/map.css" />

<div id="MapInfoCon" class="pull-left">
    <input type="hidden" id="lat" value="<?php if(isset($platformInfo['lat'])&&!empty($platformInfo['lat'])){echo html::encode($platformInfo['lat']);}else{echo 0;}  ?>"/>
    <input type="hidden" id="lng" value="<?php if(isset($platformInfo['lng'])&&!empty($platformInfo['lng'])){echo html::encode($platformInfo['lng']);}else{echo 0;}  ?>"/>
    <!-- 收索 -->
    <div id="MapInfoNav">
        <span class="toolBtn-cont"><span class="toolBtn-img"></span>机构</span>
        <textarea id="dataSource" style="display: none;"><?php if(!empty($resultData['starData'])) {echo html::encode(json_encode($resultData['starData']['listOrg']));} ?></textarea>
        <input type="text" class="textbox" id="search_str" name="search_str" caption="null">
        <input type="button" value="搜索" onclick="doSearch();" class="sbtn">
    </div>
    <!--收索结束-->
    <div id="treePanel" style="overflow: hidden;">
        <div id="mgrbtn" style="padding-left: 3px;"></div>
        <ul id="treeDemo" class="ztree"></ul>
    </div>
</div>
<?php if(!empty($resultData['starData'])){//组织架构
    echo '<div class="mar_b">
        <textarea style="display: none;" id="mygis">' . html::encode(json_encode($resultData['starData']['listOrg'])) . '</textarea>
        <div id="allmap"></div>
    </div>
    <!-- 地图-->
    <div id="windowInfo" style="display: none;">
        <div class="mapInfo">
            <span>全称：<span style="font-weight: bold">#[fullName]</span></span><br>
            <span>地址：<span style="font-weight: bold">#[address]</span></span>
        </div>
        <div>
        </div>
    </div>';
}
?>
