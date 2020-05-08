<?php
$title="在线考试";
echo "<script>document.title = \"".$title."\" </script>";
?>
<script src="/content/js/uncommon/jquery.countdown.js"></script>
<link href="/content/css/uncommon/exam.css?v=20181126" rel="stylesheet">
<script type="text/javascript" src="/content/js/bootstrapValidator.min.js"></script>
<div>
    <!--nr start-->
    <div class="test_main" style="max-width: 1000px;">
        <div class="nr_left">
            <div class="test">
                <form class="form-horizontal" id="formData" role="form" enctype="multipart/form-data" method="post" action="/personal/exam_question_submit">
                    <input type="hidden" class="search_params" id="state" name="state" value="<?=$_GET['state'] ?>"/>
                    <input type="hidden" class="search_params" id="publishIdStr" name="publishIdStr" value="<?=$_GET['publishIdStr'] ?>"/>
                    <input type="hidden" class="search_params" id="publishName" name="publishName" value="<?=$_GET['publishName'] ?>"/>
                    <input type="hidden" class="search_params" id="publishRemark" name="publishRemark" value="<?=$_GET['publishRemark'] ?>"/>

                    <input type="hidden" id="yes" name="yes" value=""/>
                    <input type="hidden" id="unfinishQuestion" name="unfinishQuestion" value=""/>
                    <input type="hidden" id="onlineExamDetails" name="onlineExamDetails" value=""/>
                    <input type="hidden" id="state" name="state" value="<?=$_GET['state'] ?>"/>

                    <input type="hidden" id="hour" name="hour" value=""/>
                    <input type="hidden" id="min" name="min" value=""/>
                    <input type="hidden" id="sec" name="min" value=""/>
                    <input type="hidden" id="leftTime" name="leftTime" value=""/>
                    <div style="padding:15px;">
                        <p style="color:#389fc3;text-align: center;font-size: 24px;"><?=$_GET['publishName'] ?></p>
                        <p style="color:#389fc3;text-align: center;font-size: 18px;margin-bottom: 0;"><?=$_GET['publishRemark'] ?></p>
                    </div>
                    <?php if(!empty($rstData)){ //examItems
                        foreach ($rstData['itemsMap'] as $data_k => $data_val) {
                            if (!empty($data_val)) {
//                                \common\models\MyFunction::sun_p($rstData['examItemSets']);DIE;
                                if($data_k == 'itemType0') {
                                    echo '<div class="test_content">
                                        <div class="test_content_title">
                                       <!-- <h2></h2>-->';
                                    if(!empty($rstData['examItemSets'])){
                                        echo '<p>
                                                        <span>单选题，共</span>
                                                        <i class="content_lit">'.$rstData['examItemSets'][0]['itemCounts'].'</i>
                                                        <span>题，</span>
                                                        <span>合计</span>
                                                        <i class="content_fs">'.$rstData['examItemSets'][0]['totalScore'].'</i><span>分</span>
                                                  </p>';
                                    }
                                    echo '</div></div>';
                                    echo '<div class="test_content_nr">
                                        <ul>';
                                    foreach ($data_val as $type_k => $type_val) {
//                                        \common\models\MyFunction::sun_p($type_val);DIE;
                                        echo '<li id="qu_0_' . ($type_k) . '">
                                                <div class="test_content_nr_tt">
                                                    <i>' . ($type_k + 1) . '</i><font>' . $type_val['item'] . '</font><b class="icon iconfont"></b>
                                                </div>
                                                <div class="test_content_nr_main">
                                                    <ul data-id="'.$type_val['idStr'].'" data-item="'.$type_val['item'].'" data-num="'.($type_k + 1).'">';
                                        foreach ($type_val['options'] as $data_i => $data_optval) {
                                            echo '<li class="option">
                                                            <input type="radio" class="magic-radio" name="answer_' . $type_k . '" id="' . ($type_k) . '_answer_' . ($type_k + 1) . '_option_' . ($data_i + 1) . '" data-val="'.($data_i).'">
                                                            <label for="' . ($type_k) . '_answer_' . ($type_k + 1) . '_option_' . ($data_i + 1) . '">
                                                                <p class="ue" style="display: inline;">' . $data_optval['option'] . '</p>
                                                            </label>
                                                        </li>';
                                        }
                                        echo '</ul>
                                                </div><!-- test_content_nr_main -->
                                            </li>';
                                    }
                                    echo '</ul>
                                    </div>';//单选结束
                                }
                                if($data_k == 'itemType1') {
                                    echo '<div class="test_content">
                                        <div class="test_content_title">
                                            <!--<h2></h2>-->';
                                    if(!empty($rstData['examItemSets'])){
                                        echo '<p>
                                                       <span>多选题，共</span><i class="content_lit">'.$rstData['examItemSets'][1]['itemCounts'].'</i><span>题，</span><span>合计</span><i class="content_fs">'.$rstData['examItemSets'][1]['totalScore'].'</i><span>分</span>
                                                       </p>';
                                    }
                                    echo '</div>
                                    </div>';
                                    echo '<div class="test_content_nr">
                                        <ul>';
                                    foreach ($data_val as $type_k => $type_val) {
//                                        \common\models\MyFunction::sun_p($data_val);DIE;
                                        echo '<li id="qu_1_' . ($type_k) . '">
                                                <div class="test_content_nr_tt">
                                                    <i>' . ($type_k + 1) . '</i><font>' . $type_val['item'] . '</font><b class="icon iconfont"></b>
                                                </div>
                
                                                <div class="test_content_nr_main">
                                                    <ul data-id="'.$type_val['idStr'].'" data-item="'.$type_val['item'].'">';
                                        foreach ($type_val['options'] as $data_i => $data_optval) {
                                            echo '<li class="option">
                                                            <input type="checkbox" class="magic-checkbox" name="answers' . ($type_k) . '" id="' . ($type_k) . '_answers_' . ($type_k + 1) . '_option_' . ($data_i + 1) . '" data-val="'.($data_i).'">
                                                            <label for="' . ($type_k) . '_answers_' . ($type_k + 1) . '_option_' . ($data_i + 1) . '">
                                                                <p class="ue" style="display: inline;">' . $data_optval['option'] . '</p>
                                                            </label>
                                                        </li>';
                                        }
                                        echo '</ul>
                                                </div>
                                            </li>';
                                    }
                                    echo '</ul>
                                    </div>'; //多选结束
                                }
                                if($data_k == 'itemType2') {
                                    echo '<div class="test_content">
                                        <div class="test_content_title">
                                        <!--<h2></h2>-->';
                                    if(!empty($rstData['examItemSets'])){
                                        echo '<p>
                                             <span>判断题，共</span><i class="content_lit">'.$rstData['examItemSets'][2]['itemCounts'].'</i><span>题，</span><span>合计</span><i class="content_fs">'.$rstData['examItemSets'][2]['totalScore'].'</i><span>分</span>
                                           </p>';
                                    }
                                    echo '</div></div>';
                                    echo '<div class="test_content_nr">
                                        <ul>';
                                    foreach ($data_val as $type_k => $type_val) {
//                                        \common\models\MyFunction::sun_p($type_val);DIE;
                                        echo '<li id="qu_2_' . ($type_k) . '">
                                                <div class="test_content_nr_tt">
                                                    <i>' . ($type_k + 1) . '</i><font>' . $type_val['item'] . '</font><b class="icon iconfont"></b>
                                                </div>
                                                <div class="test_content_nr_main">
                                                    <ul data-id="'.$type_val['idStr'].'" data-item="'.$type_val['item'].'">';
                                        foreach ($type_val['options'] as $data_i => $data_optval) {
                                            echo '<li class="option">
                                                <input type="radio" class="magic-radio" name="single_' . $type_k . '" id="' . ($type_k) . '_single_' . ($type_k + 1) . '_option_' . ($data_i + 1) . '" data-val="'.($data_i).'">
                                                <label for="' . ($type_k) . '_single_' . ($type_k + 1) . '_option_' . ($data_i + 1) . '" >
                                                    <p class="ue" style="display: inline;">' . $data_optval['option'] . '</p>
                                                </label>
                                            </li>';
                                        }
                                        echo '</ul>
                                                </div><!-- test_content_nr_main -->
                                            </li>';
                                    }
                                    echo '</ul>
                                    </div>';//判断题结束
                                }

                            }
                        }
                    }?>
                    <div class="test_title">
                        <p class="test_time">
                            <i class="icon iconfont">&#xe6fb;</i><b class="alt-1"><?=floor($_GET['duration']/60) ?>:<?=($_GET['duration']%60) ?></b>
                        </p>
                        <font><button class="btn submit_btn btn-primary btn-size-medium" type="submit" data-state="1" onclick="return submit_question();">交卷</button></font>
                    </div>
                    <input type="hidden" name="publishIdStr" value="<?= $_GET['publishIdStr']?>"/>
                    <input type="hidden" name="publishName" value="<?= $_GET['publishName']?>"/>
                </form>
            </div>
        </div>
    </div>
    <!--  选项卡-->
    <div class="nr_right">
        <div class="nr_rt_main">
            <div class="rt_nr1">
                <div class="rt_nr2">
                    <div class="rt_nr1_title">
                        <h1>
                            <i class="icon iconfont"></i>答题进度卡
                        </h1>
                    </div><div class="rt_content">
                        <?php if(!empty($rstData)) { //examItems
//                    \common\models\MyFunction::sun_p($rstData);DIE;
                            echo '<div class="rt_content">';
                            foreach($rstData['examItemSets'] as $data_rst_k => $data_rst_val){
                                if($data_rst_k == 0){ //单选题
                                    if($rstData['examItemSets'][0]['itemCounts']!=0){
                                        echo '<div class="rt_content_tt">
                                        <h2>单选题</h2>';
                                        if(!empty($rstData['examItemSets'])){
                                            echo '<p><span>共</span><i class="content_lit">'.$rstData['examItemSets'][0]['itemCounts'].'</i><span>题，</span>
                                        <span>合计</span><i class="content_fs">'.$rstData['examItemSets'][0]['totalScore'].'</i><span>分</span></p>';
                                        }
                                        echo '</div>';
                                    }
                                    echo '<div class="rt_content_nr answerSheet">
                                <ul>';
//                            \common\models\MyFunction::sun_p($rstData['itemsMap']['itemType0']);DIE;
                                    if(!empty($rstData['itemsMap']['itemType0'])){
                                        foreach ($rstData['itemsMap']['itemType0'] as $data_k => $data_val) {
                                            echo '<li><a href="#qu_0_'.$data_k.'">'.($data_k+1).'</a></li>';
                                        }
                                    }
                                    echo '</ul>';
                                    echo '</div>';
                                }
                                if($data_rst_k == 1){
                                    if($rstData['examItemSets'][1]['itemCounts']!=0){
                                        echo '<div class="rt_content_tt">
                                        <h2>多选题</h2>';
                                        if(!empty($rstData['examItemSets'])){
                                            echo '<p><span>共</span><i class="content_lit">'.$rstData['examItemSets'][1]['itemCounts'].'</i><span>题，</span>
                                        <span>合计</span><i class="content_fs">'.$rstData['examItemSets'][1]['totalScore'].'</i><span>分</span></p>';
                                        }
                                        echo '</div>';
                                    }
                                    echo '</div>
                            <div class="rt_content_nr answerSheet">
                                <ul>';
                                    if(!empty($rstData['itemsMap']['itemType1'])){
                                        foreach ($rstData['itemsMap']['itemType1'] as $data_k => $data_val) {
                                            echo '<li><a href="#qu_1_'.$data_k.'">'.($data_k+1).'</a></li>';
                                        }
                                    }
                                    echo '</ul>';
                                    echo '</div>';
                                }
                                if($data_rst_k == 2){
                                    if($rstData['examItemSets'][2]['itemCounts']!=0){
                                        echo '<div class="rt_content_tt">
                                        <h2>判断题</h2>';
                                        if(!empty($rstData['examItemSets'])){
                                            echo '<p><span>共</span><i class="content_lit">'.$rstData['examItemSets'][2]['itemCounts'].'</i><span>题，</span>
                                        <span>合计</span><i class="content_fs">'.$rstData['examItemSets'][2]['totalScore'].'</i><span>分</span></p>';
                                        }
                                        echo '</div>';
                                    }
                                    echo '<div class="rt_content_nr answerSheet">
                                <ul>';
                                    if(!empty($rstData['itemsMap']['itemType2'])){
                                        foreach ($rstData['itemsMap']['itemType2'] as $data_k => $data_val) {
                                            echo '<li><a href="#qu_2_'.$data_k.'">'.($data_k+1).'</a></li>';
                                        }
                                    }
                                    echo '</ul>';
                                    echo '</div>';
                                }
                            }
                            echo '</div>';

                        }?>
                    </div>
                    <div class="isshow"><button class="btn btn-default" onclick="return toogle_t();">隐藏/展开</button></div>
                </div>
            </div>
        </div>
        <!-- 结束 -->
        <div class="foot"></div>
        <div></div>
        <!--nr end-->
    </div>
    <script>
        window.jQuery(function($) {
            "use strict";
            $('time').countDown({
                with_separators : false
            });
            $('.alt-1').countDown({
                css_class : 'countdown-alt-1'
            });
            $('.alt-2').countDown({
                css_class : 'countdown-alt-2'
            });

        });
        $(window).resize(function () {$(".test_title").css("width",$(".test_main").width()+"px");});
        $(function() {//九宫格

            setCountDown_time();//设置时间倒计时

            $(".test_title").css("width",$(".test_main").width()+"px");
            $(".ly_min").css("display","none");
            $("#ly_menu").css("display","none");
            $("#ly_footer").css("display","none");

            /**
             * 判断是否已选择
             */
            $('li.option label').click(function () {
                var examId = $(this).closest('.test_content_nr_main').closest('li').attr('id'); // 得到题目ID
                var cardLi = $('a[href=#' + examId + ']'); // 根据题目ID找到对应答题卡
                // 设置已答题
                if (!cardLi.hasClass('hasBeenAnswer')) {
                    cardLi.addClass('hasBeenAnswer');
                }
            });
            $('li.option .magic-radio').click(function () {
                var examId = $(this).closest('.test_content_nr_main').closest('li').attr('id'); // 得到题目ID
                var cardLi = $('a[href=#' + examId + ']'); // 根据题目ID找到对应答题卡
                // 设置已答题
                if (!cardLi.hasClass('hasBeenAnswer')) {
                    cardLi.addClass('hasBeenAnswer');
                }
            });
            $('li.option .magic-checkbox').click(function () {
                $(this).parent().addClass("two");
                var examId = $(this).closest('.test_content_nr_main').closest('li').attr('id'); // 得到题目ID
                var cardLi = $('a[href=#' + examId + ']'); // 根据题目ID找到对应答题卡
                // 设置已答题
                if (!cardLi.hasClass('hasBeenAnswer')) {
                    cardLi.addClass('hasBeenAnswer');
                }
            });

        });

        /* 时间倒计时*/
        var timer;//声明一个定时器
        function setCountDown_time(){
            timer = window.setInterval("ls()",1000);
        }
        function ls() {
            var hour = $(".hh-1").text() + $(".hh-2").text();
            var min = $(".mm-1").text() + $(".mm-2").text();
            var sec = $(".ss-1").text() + $(".ss-2").text();
            if($(".hh-1").text()=="0"){ hour = $(".hh-2").text();}
            if($(".mm-1").text()=="0"){ min = $(".mm-2").text();}
            if($(".ss-1").text()=="0"){ sec = $(".ss-2").text();}
            var maxtime =parseInt(hour*60*60)+parseInt(min*60)+parseInt(sec);

            if(maxtime == 0) {
                window.clearInterval(timer);
                swal({
                    title: "考试结束，该试卷已提交！",
                    type: "warning",
                    confirmButtonText: "确 定",
                });
                // alert("考试结束，该试卷已提交!");
                submit_question();
                $("#formData").submit();
                // window.opener.location.reload(); //刷新父窗口中的网页
            }
            return false;
        }
        //结束

        function submit_question() {
            var hour = $(".hh-1").text()+$(".hh-2").text();
            $("#hour").val(hour);
            var min = $(".mm-1").text()+$(".mm-2").text();
            $("#min").val(min);
            var sec = $(".ss-1").text()+$(".ss-2").text();
            $("#sec").val(sec);

            $("#leftTime").val(parseInt($("#hour").val()*60*60) + parseInt($("#min").val()*60) +parseInt($("#sec").val()));
            var recogArr = [];
            var unfinish = '';
            $(".test_content_nr_main ul").each(function(i){
                var obj ={};
                var pList = "";
                var subjectIdStr = $(this).data("id");
                var subjectItem = $(this).data("item");
                var subjectIdNum = $(this).data("num");
                $(this).find('input:checked').each(function (j) {
                    pList += $(this).data("val")+",";
                });
                var str = pList.substr(0,pList.length-1);

                if(pList == null || pList == "") {
                    unfinish = 1;
                    obj.itemId = subjectIdStr;
                    obj.item = subjectItem;
                    obj.optionValue = "";
                    recogArr[recogArr.length]=obj;
                    $("#onlineExamDetails").val(JSON.stringify(recogArr));
                }else{
                    obj.itemId = subjectIdStr;
                    obj.item = subjectItem;
                    obj.optionValue = str;
                    recogArr[recogArr.length]=obj;
                    $("#onlineExamDetails").val(JSON.stringify(recogArr));
                }

            });
//        var state = $(this).data("state");
            if ( unfinish == 1) {
                swal({
                        title: "还有题目未完成确定提交？",
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
                            $("#yes").val("1");
                            submit_question();
                            $("#formData").submit();
                        } else {
                            $("#yes").val("2");
                            swal.close();
                        }
                    });
            }else{
                swal({
                        title: "确定提交？",
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
                            $("#yes").val("1");
                            submit_question();
                            $("#formData").submit();
                        } else {
                            swal.close();
                        }
                    });

            }
            return false;
        }

        function toogle_t(){
            $(".rt_nr2").toggle(250);
        }

    </script>
    <style type="text/css">
        .answerSheet li a {
            display: block;
        }
        .hasBeenAnswer {
            background: #5d9cec;
            color: #fff;
        }
        .option label{
            cursor: pointer!important;
        }
        @media screen and (max-width: 1200px){
            .hold-transition.skin-blue.sidebar-mini {
                min-width: 100px;
                overflow-x: scroll;
            }
        }
        .btn.focus, .btn:focus, .btn:hover{
            color:#389fc3;
        }
        .ly_min{ min-width: 100px;}

        .isshow{ text-align: center; padding:5px 0;}
    </style>
    <script type="text/javascript">
        document.onkeydown = function (e) {
            var ev = window.event || e;
            var code = ev.keyCode || ev.which;
            if (code == 116) {
                ev.keyCode ? ev.keyCode = 0 : ev.which = 0;
                cancelBubble = true;
                return false;
            }
        } //禁止f5刷新
        document.oncontextmenu=function(){return false};//禁止右键刷新

    </script>
