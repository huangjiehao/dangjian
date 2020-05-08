<?php
use yii\helpers\Html;
use common\models\MyFunction;
?>
<!--<textarea id="privilegeTree"style="display: none">--=json_encode($user_privilege_tree)<!--</textarea>-->
<input type="hidden" id="HTTP_DOMAIN" value="<?php echo HTTP_BACKEND ?>">
<input type="hidden" id="userid" value="<?= html::encode($userId) ?>">
<input type="hidden" id="roleid" value="<?= $roleid ?>">
<input type="hidden" id="userType" value="<?= $userType ?>">
<link href="/content/css/uncommon/portraitInfo.css" rel="stylesheet">
<script src="/content/js/jquery-easing.1.3.js" type="text/javascript"></script>

<div id="main">
    <div class="content">
        <div class="baseInfo">
            <div class="header">基本信息</div>
            <ul>
                <li>姓名：黑百合</li>
                <li>性别：女</li>
                <li>生日：1998-11-20</li>
                <li>民族：汉族</li>
                <li>籍贯：广东 广州</li>
                <li>学历：硕士</li>
                <li>入党时间：2008-07-01</li>
                <li>所属支部：白云区</li>
                <li>党内职务：党员</li>
                <li>工作单位：白云区教育局</li>
                <li>联系方式：12345678900</li>
            </ul>
        </div>
        <div class="studyInfo">
            <div class="header">学习概况</div>
            <ul>
                <li>已学习课时：12课时</li>
                <li>未学习课时：6课时</li>
                <li>浏览资讯时长：7小时30分钟</li>
                <li>最近一次学习时间：2019-10-07</li>
                <li>关注内容：时政 要闻</li>
            </ul>
        </div>
        <div class="groupLife">
            <div class="header">组织生活</div>
            <ul>
                <li>参与活动：12场次</li>
                <li>参与会议：6场次</li>
                <li>党费缴纳：18372.6元</li>
                <li>近期党费缴纳：132.66元</li>
            </ul>
        </div>
        <div class="memberImg">
            <div class="img">
                我是图片
            </div>
        </div>
    </div>
</div>
