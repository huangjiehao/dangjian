<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/11
 * Time: 10:22
 */
?>
<script src="/content/js/feature.presenter.1.5.min.js"></script>
<script src="/content/js/jquery.timelinr-0.9.53.js"></script>
<link href="/content/css/uncommon/info.css" rel="stylesheet" type="text/css"/>

<div id="main">
    <!-- 开始 -->
    <div id="test-element"></div>
    <!-- 结束 -->
<!--    <h2 class="top_title">时间轴展示区</h2>-->
    <div id="timeline">
        <ul id="dates">
            <li><a href="#2015" style="color:#ff5c57;">2015<i></i></a></li>
            <li><a href="#2016" style="color:#ff764c;">2016<i></i></a></li>
            <li><a href="#2017" style="color:#ff9947;">2017<i></i></a></li>
            <li><a href="#专题" style="color:#ffb135;">专题<i></i></a></li>
        </ul>
        <ul id="issues">
            <li id="2015">
                <h1>2015年</h1>
                <p>深入学习贯彻党的十八届五中全会精神</p>
            </li>
            <li id="2016">
                <h1>2016年</h1>
                <p>深入学习贯彻党的十八届六中全会精神</p>
                <p> “三型”党组织建设</p>
                <p>“两学一做”学习教育</p>
                <p>党建工作优秀案例</p>
            </li>
            <li id="2017">
                <h1>2017年</h1>
                <p>学习宣传贯彻十九大精神</p>
                <p>支部结对共建</p>
                <p>机关服务品牌</p>
            </li>
            <li id="常驻专题">
                <h1>常驻专题</h1>
                <p>党员志愿服务</p>
                <p>作风建设在路上</p>
                <p>支部工作电教片</p>
            </li>
        </ul>
    </div>

</div>

<script type="text/javascript">
    /* 图片地址可以是相对路径或绝对路径；标题和描述可以包含HTML */
    var settings = [ {image: '/content/images/zzsc1.png', heading: '纪律建设', description: '<p>纪律建设1</p><p>纪律建设2</p>'},
        {image: '/content/images/zzsc2.png', heading: '政治建设', description: '<p>政治建设1</p><p>政治建设2</p>'},
        {image: '/content/images/zzsc3.png', heading: '作风建设', description: '<p>作风建设1</p><p>作风建设2</p>'},
        {image: '/content/images/zzsc4.png', heading: '组织建设', description: '<p>组织建设1</p><p>组织建设2</p>'},
        {image: '/content/images/zzsc5.png', heading: '制度建设', description: '<p>制度建设1</p><p>制度建设2</p>'},
        {image: '/content/images/zzsc6.png', heading: '思想建设', description: '<p>思想建设1</p><p>思想建设2</p>'}
    ];

    var options = {
        circle_radius: 220,
        normal_feature_size: 110,
        highlighted_feature_size: 150,
        top_margin: 100,
        bottom_margin: 50,
        spacing: 40,
        min_padding: 50,
        heading_font_size: 30,
        description_font_size: 20,
        type: 'image'
    };

    var fp = new FeaturePresenter($("#test-element"), settings, options);
    fp.createPresenter();

    /*时间轴*/
    $(function(){
        $().timelinr({
            autoPlay: 'false',
            autoPlayDirection: 'forward',
            startAt: 4
        })
    });

</script>
