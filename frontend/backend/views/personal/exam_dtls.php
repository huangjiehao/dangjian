<?php
use yii\helpers\Html;
?>
<script src="/content/js/uncommon/jquery.countdown.js"></script>
<link href="/content/css/uncommon/exam.css" rel="stylesheet">
<div class="container">
    <!--nr start-->
    <div class="test_main">
        <div class="nr_left">
            <div class="test">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="exam_question_submit">
                    <input type="hidden" id="onlineExamDetails" name="onlineExamDetails" value=""/>
                    <input type="hidden" id="state" name="state" value="<?=$_GET['state'] ?>"/>

                    <input type="hidden" id="hour" name="hour" value=""/>
                    <input type="hidden" id="min" name="min" value=""/>
                    <input type="hidden" id="sec" name="min" value=""/>
                    <input type="hidden" id="leftTime" name="leftTime" value=""/>
                    <div style="padding:15px;">
                        <p style="color:#389fc3;text-align: center;font-size: 24px;"><?=html::encode($_GET['publishName']) ?></p>
                        <p style="color:#389fc3;text-align: center;font-size: 18px;margin-bottom: 0;"><?=html::encode($_GET['publishRemark']) ?></p>
                    </div>
                    <?php if(!empty($rstData)){ //examItems
//                        \common\models\MyFunction::sun_p($rstData);DIE;
                        foreach ($rstData['examItemSets'] as $data_k => $data_val) {  //判断题型。。。
                            if (!empty($data_val)) {
//                                \common\models\MyFunction::sun_p($data_val);DIE;
                                if($data_val['itemType'] == '0') {
                                    if($data_val['itemCounts']!=0){
                                        echo '<div class="test_content">
                                        <div class="test_content_title">';
                                        echo '<p>
                                                <span>单选题，共</span>
                                                <i class="content_lit">'.html::encode($data_val['itemCounts']).'</i>
                                                <span>题，</span>
                                                <span>合计</span>
                                                <i class="content_fs">'.html::encode($data_val['itemCounts']*$data_val['itemScore']).'</i><span>分</span>
                                            </p>';
                                        echo '</div></div>';
                                    }
                                    echo '<div class="test_content_nr">
                                    <ul>';
                                    foreach ($rstData['listOnlineExamDetail'] as $data_item_k => $data_item_val) {  //单选题选项题目展示区。。。
                                        if($data_item_val['itemType']==0){
                                            echo '<li id="qu_0_' . ($data_item_k) . '">
                                                    <div class="test_content_nr_tt">
                                                        <i>' . ($data_item_k + 1) . '</i><font>' . html::encode($data_item_val['item']) . '</font><b class="icon iconfont"></b>
                                                    </div>
                                                    <div class="test_content_nr_main">
                                                        <ul data-id="' . html::encode($data_item_val['idStr']) . '" data-item="' . html::encode($data_item_val['item']) . '" data-num="' . ($data_item_k + 1) . '">';
                                            foreach ($data_item_val['options'] as $data_option_k => $data_option_val) { //选项循环
                                                echo '<li class="option">
                                                                <input type="radio" class="magic-radio" name="answer_' . $data_item_k . '" id="' . ($data_item_k) . '_answer_' . ($data_item_k + 1) . '_option_' . ($data_option_k + 1) . '" data-val="' . ($data_option_k) . '" 
                                                                ';if($data_option_val['selected']==1){echo 'checked';} echo ' disabled/>
                                                                <label for="' . ($data_item_k) . '_answer_' . ($data_item_k + 1) . '_option_' . ($data_option_k + 1) . '">
                                                                    <p class="ue" style="display: inline;">' . html::encode($data_option_val['option']) . '</p>
                                                                </label>
                                                            </li>';
                                            }
                                            echo '</ul>';
                                            if($data_item_val['isCorrect']==0){
                                                echo '<div class="tips error">回答有误，正确答案为：'.html::encode($data_item_val['answer']).'</div>';
                                            }else{
                                                echo '<div class="tips success">回答正确</div>';
                                            }
                                            echo '</div><!-- test_content_nr_main -->
                                                    </li>';
                                        }


                                    }
                                    echo '</ul>
                                    </div>';//单选结束
                                }
                                if($data_val['itemType'] == '1') {
                                    if($data_val['itemCounts']!=0){
                                        echo '<div class="test_content">
                                        <div class="test_content_title">';
                                        echo '<p>
                                                <span>多选题，共</span>
                                                <i class="content_lit">'.html::encode($data_val['itemCounts']).'</i>
                                                <span>题，</span>
                                                <span>合计</span>
                                                <i class="content_fs">'.html::encode($data_val['itemCounts']*$data_val['itemScore']).'</i><span>分</span>
                                            </p>';
                                        echo '</div></div>';
                                    }
                                    echo '<div class="test_content_nr">
                                    <ul>';
                                    foreach ($rstData['listOnlineExamDetail'] as $data_item_k => $data_item_val) {  //单选题选项题目展示区。。。
                                        if($data_item_val['itemType']==1){
                                            echo '<li id="qu_1_' . ($data_item_k) . '">
                                                    <div class="test_content_nr_tt">
                                                        <i>' . ($data_item_k + 1) . '</i><font>' . html::encode($data_item_val['item']) . '</font><b class="icon iconfont"></b>
                                                    </div>
                                                    <div class="test_content_nr_main">
                                                        <ul data-id="' . html::encode($data_item_val['idStr']) . '" data-item="' . html::encode($data_item_val['item']) . '" data-num="' . ($data_item_k + 1) . '">';
                                            foreach ($data_item_val['options'] as $data_option_k => $data_option_val) { //选项循环
                                                echo '<li class="option">
                                                                <input type="checkbox" class="magic-checkbox" name="answers' . $data_item_k . '" id="' . ($data_item_k) . '_answers_' . ($data_item_k + 1) . '_option_' . ($data_option_k + 1) . '" data-val="' . ($data_option_k) . '" 
                                                                ';if($data_option_val['selected']==1){echo 'checked';} echo ' disabled/>
                                                                <label for="' . ($data_item_k) . '_answers_' . ($data_item_k + 1) . '_option_' . ($data_option_k + 1) . '">
                                                                    <p class="ue" style="display: inline;">' . html::encode($data_option_val['option']) . '</p>
                                                                </label>
                                                            </li>';
                                            }
                                            echo '</ul>';
                                            if($data_item_val['isCorrect']==0){
                                                echo '<div class="tips error">回答有误，正确答案为：'.html::encode($data_item_val['answer']).'</div>';
                                            }else{
                                                echo '<div class="tips success">回答正确</div>';
                                            }
                                            echo '</div><!-- test_content_nr_main -->
                                                    </li>';
                                        }


                                    }
                                    echo '</ul>
                                    </div>';//单选结束
                                }
                                if($data_val['itemType'] == '2') {
                                    if($data_val['itemCounts']!=0){
                                        echo '<div class="test_content">
                                        <div class="test_content_title">';
                                        echo '<p>
                                                <span>判断题，共</span>
                                                <i class="content_lit">'.html::encode($data_val['itemCounts']).'</i>
                                                <span>题，</span>
                                                <span>合计</span>
                                                <i class="content_fs">'.html::encode($data_val['itemCounts']*$data_val['itemScore']).'</i><span>分</span>
                                            </p>';
                                        echo '</div></div>';
                                    }

                                    echo '<div class="test_content_nr">
                                    <ul>';
                                    foreach ($rstData['listOnlineExamDetail'] as $data_item_k => $data_item_val) {  //单选题选项题目展示区。。。
                                        if($data_item_val['itemType']==2){
                                            echo '<li id="qu_2_' . ($data_item_k) . '">
                                                    <div class="test_content_nr_tt">
                                                        <i>' . ($data_item_k + 1) . '</i><font>' . html::encode($data_item_val['item']) . '</font><b class="icon iconfont"></b>
                                                    </div>
                                                    <div class="test_content_nr_main">
                                                        <ul data-id="' . html::encode($data_item_val['idStr']) . '" data-item="' . html::encode($data_item_val['item']) . '" data-num="' . ($data_item_k + 1) . '">';
                                            foreach ($data_item_val['options'] as $data_option_k => $data_option_val) { //选项循环
                                                echo '<li class="option">
                                                                            <input type="radio" class="magic-radio" name="single_' . $data_item_k . '" id="' . ($data_item_k) . '_single_' . ($data_item_k + 1) . '_option_' . ($data_option_k + 1) . '" data-val="' . ($data_option_k) . '" 
                                                                            ';if($data_option_val['selected']==1){echo 'checked';} echo ' disabled/>
                                                                            <label for="' . ($data_item_k) . '_single_' . ($data_item_k + 1) . '_option_' . ($data_option_k + 1) . '">
                                                                                <p class="ue" style="display: inline;">' . html::encode($data_option_val['option']) . '</p>
                                                                            </label>
                                                                        </li>';
                                            }
                                            echo '</ul>';
                                            if($data_item_val['isCorrect']==0){
                                                echo '<div class="tips error">回答有误，正确答案为：'.html::encode($data_item_val['answer']).'</div>';
                                            }else{
                                                echo '<div class="tips success">回答正确</div>';
                                            }
                                            echo '</div><!-- test_content_nr_main -->
                                              </li>';
                                        }


                                    }
                                    echo '</ul>
                                    </div>';//单选结束
                                }

                            }
                        }
                    }?>
                    <input type="hidden" name="publishIdStr" value="<?= html::encode($_GET['publishIdStr'])?>"/>
                    <input type="hidden" name="publishName" value="<?= html::encode($_GET['publishName'])?>"/>
                </form>
            </div>

        </div>
    </div>
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
</script>
<style>
    .tips{
        background: #efeeee; font-size: 1.35rem; height:3rem; line-height:3rem; text-align:center;
    }
    .tips.error{ color:red; }
    .tips.success{ color:green; }
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

    .ly_min{ min-width: 100px;}

    .magic-radio[disabled] + label, .magic-checkbox[disabled] + label{
        color: #333;
    }
    .magic-radio:checked[disabled] + label:after,.magic-checkbox:checked[disabled] + label:before{
        background: #5d9cec;
    }

    .ly_wrap,.ly_menu,.ly_footer{ display: none;}

</style>
<script language="javascript">
    document.onkeydown = function (e) {
        var ev = window.event || e;
        var code = ev.keyCode || ev.which;
        if (code == 116) {
            ev.keyCode ? ev.keyCode = 0 : ev.which = 0;
            cancelBubble = true;
            return false;
        }
    } //禁止f5刷新

</script>
