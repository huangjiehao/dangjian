<?php
use yii\helpers\Html;
?>
<style>
    body{
        background: #f5f5f5;
    }
    .question{
        font-size: 14px;
        padding: 2px 10px;
    }
    @media screen and (max-width: 1171px) {
        .hold-transition.skin-blue.sidebar-mini {
            min-width: calc(100% - 750px)!important;
        }
    }
    ::-webkit-scrollbar-thumb {
        background-color: #f5f5f5;
    }
    .mar_t{
        margin-top: 10px;
    }

    input[type=checkbox], input[type=radio]{
        margin: 4px 8px 0 0;
    }
    .sweet-alert{
        margin-left: 0;
    }
</style>
<?php
if (!empty($questionData['listStudyQuestion'])) {
    echo '
        <div class="mar_t">
            <p style="font-size: 25px;">试题：</p>
        </div>';
}
foreach ($questionData['listStudyQuestion'] as $data_key => $data_val) {
    echo '<div class="question">
                <div>
                    <p data-ask="'.$data_val['answers'].'">'. ($data_key+1) .'.'. html::encode($data_val['question']) .'';
                    if ($data_val['answerType'] == 2) {
                        echo '<span style="font-weight: bold">( 判断题 )</span>';
                    }else if ($data_val['answerType'] == 1){
                        echo '<span style="font-weight: bold">( 多选题 )</span>';
                    }else if ($data_val['answerType'] == 0){
                        echo '<span style="font-weight: bold">( 单选题 )</span>';
                    }
                    echo '</p>
                </div>
                <div>
                    <p>';
                    if ($data_val['answerType'] == 2) {
                        echo '
                        <input class="magic-radio" type="radio" name="radio'. ($data_key+1) .'" id="radio'. html::encode($data_val['questionKeys'][0]['idStr']) .'" value="正确" />
                        <label style="font-size:1.1em" for="radio'. html::encode($data_val['questionKeys'][0]['idStr']) .'">正确</label>
                        <input class="magic-radio" type="radio" name="radio'. ($data_key+1) .'" id="radio'. html::encode($data_val['questionKeys'][1]['idStr']) .'" value="错误" />
                        <label style="font-size:1.1em" for="radio'. html::encode($data_val['questionKeys'][1]['idStr']) .'">错误</label>';
                    }
                    if ($data_val['answerType'] == 1) {
//                            \common\models\MyFunction::sun_p($data_val);die;
                    echo '
                        <input class="magic-checkbox" type="checkbox" name="checkbox'. ($data_key+1) .'" id="checkbox1'. html::encode($data_val['questionKeys'][0]['idStr']) .'" value="A" />
                        <label style="font-size:1.1em" for="checkbox1'. html::encode($data_val['questionKeys'][0]['idStr']) .'">'. html::encode($data_val['questionKeys'][0]['content']) .'</label>
                        
                        <input class="magic-checkbox" type="checkbox" name="checkbox'. ($data_key+1) .'" id="checkbox2'. html::encode($data_val['questionKeys'][1]['idStr']) .'" value="B" />
                        <label style="font-size:1.1em" for="checkbox2'. html::encode($data_val['questionKeys'][1]['idStr']) .'">'. html::encode($data_val['questionKeys'][1]['content']) .'</label>
                        
                        <input class="magic-checkbox" type="checkbox" name="checkbox'. ($data_key+1) .'" id="checkbox3'. html::encode($data_val['questionKeys'][2]['idStr']) .'" value="C" />
                        <label style="font-size:1.1em" for="checkbox3'. html::encode($data_val['questionKeys'][2]['idStr']) .'">'. html::encode($data_val['questionKeys'][2]['content']) .'</label>
                        
                        <input class="magic-checkbox" type="checkbox" name="checkbox'. ($data_key+1) .'" id="checkbox4'. html::encode($data_val['questionKeys'][3]['idStr']) .'" value="D" />
                        <label style="font-size:1.1em" for="checkbox4'. html::encode($data_val['questionKeys'][3]['idStr']) .'">'. html::encode($data_val['questionKeys'][3]['content']) .'</label>
                        ';
                    }
                    if ($data_val['answerType'] == 0) {
                        echo '
                          <input class="magic-radio" type="radio" name="radio'. ($data_key+1) .'" id="radiod1'. html::encode($data_val['questionKeys'][0]['idStr']) .'" value="A" />
                          <label style="font-size:1.1em" for="radiod1'. html::encode($data_val['questionKeys'][0]['idStr']) .'">'. html::encode($data_val['questionKeys'][0]['content']) .'</label>
                          
                          <input class="magic-radio" type="radio" name="radio'. ($data_key+1) .'" id="radiod2'. html::encode($data_val['questionKeys'][1]['idStr']) .'" value="B" />
                          <label style="font-size:1.1em" for="radiod2'. html::encode($data_val['questionKeys'][1]['idStr']) .'">'. html::encode($data_val['questionKeys'][1]['content']) .'</label>
                          
                          <input class="magic-radio" type="radio" name="radio'. ($data_key+1) .'" id="radiod3'. html::encode($data_val['questionKeys'][2]['idStr']) .'" value="C" />
                          <label style="font-size:1.1em" for="radiod3'. html::encode($data_val['questionKeys'][2]['idStr']) .'">'. html::encode($data_val['questionKeys'][2]['content']) .'</label>
                          
                          <input class="magic-radio" type="radio" name="radio'. ($data_key+1) .'" id="radiod4'. html::encode($data_val['questionKeys'][3]['idStr']) .'" value="D" />
                          <label style="font-size:1.1em" for="radiod4'. html::encode($data_val['questionKeys'][3]['idStr']) .'">'. html::encode($data_val['questionKeys'][3]['content']) .'</label>
                          ';
                    }
                    echo '
                    </p>
                </div>
                <div class="answer_show" style="display: none"><p style="color: #00a1c3">答案分析：'.html::encode($data_val['answersAnalyze']).'</p></div>
            </div>
        ';
}
if (!empty($questionData['listStudyQuestion'])) {
    echo '<input type="hidden" id="resId_question" value="'.(isset($resourseId) ? html::encode($resourseId) : '') .'">
            <div><button id="button" type="submit" class="btn submit_btn btn-primary btn-size-medium" onclick="submit_question()">提交</button></div>';
}else {
    echo '<div class="nodata">
               <p><img src="/content/images/nodata.png"></p><p>暂无题目</p>
          </div>';
}
?>


<script src="/content/js/course/course.js" type="text/javascript"></script>

<script>
    $(function(){
        //隐藏头尾部
        $("#ly_menu").remove();
        $("#ly_header").remove();
        $("#ly_footer").remove();
    });
</script>
