<?php
use yii\helpers\Html;
?>
<style type="text/css" media="screen">
    body{background:#e9eaef;}
    h3{font-weight:700;font-size:2.5rem;}
    .tm{padding-top:24px; font-size: 2.2rem;}
    .tm span{color:#e10602;padding:0 5px;font-weight:700;}
    .wrapper_page {  text-align: center;}
</style>
<DIV class="ly_main">
<h3>成功提交试卷！</h3>
    <a id="Btn" class="btn btn-primary" href="/personal/exam_list?title=在线考试" style="margin-top:20px;"><I class="fa fa-undo"></I>返回考试列表</a>
</DIV>
<script type="text/javascript">

    function sendStats(url){
        window.close();
        window.reload();
    }

    var time = document.getElementById('time');
    var btn = document.getElementById('Btn');
    function count(){
        if( +time.innerHTML > 0 ){
            time.innerHTML = time.innerHTML - 1;
        }else{
            sendStats('gotobaidu');
            location.href = btn.href;
        }
    }
    setInterval(count , 2000);

    btn.onclick = function(){
        sendStats('gotobaidu');
    };

    $("#Btn").click(function () {
        if(window.opener && !window.opener.closed) {
            window.opener.location.reload(); //刷新父窗口中的网页
        }
    })

</script>
