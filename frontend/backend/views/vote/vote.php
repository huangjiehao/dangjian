<?php
use yii\helpers\Html;
?>
<link href="/content/css/uncommon/artice.css" rel="stylesheet" type="text/css"/>
<style>
    #ly_article_bar{
        width:100%;max-width: 100%;
    }
    .panel-body{
        padding: 20px 0 30px 0;
        width: 60%;
        margin: 0 auto;
    }
    .ly_title_span{
        margin: 10px 20px 30px 0;
    }
    .ly_progress_vote{
        padding:0;
    }
</style>
<div class="ly_main">
    <div id="ly_dj_news">
        <div class="ly_article">
            <?php
            if(!empty($resultData)){
//                \common\models\MyFunction::sun_p($resultData);DIE;
                echo '<div id="ly_article_bar">
                 <h1 class="ly_title">'.html::encode($resultData['title']).'</h1>
                 <div class="ly_title_span">
                     <span class="pull-right">发布时间：' . date("Y-m-d", html::encode($resultData['createDate'])) . '</span>
                 </div>
                 <form class="form-horizontal" role="form" enctype="multipart/form-data" action="vote_submit"  id="radioSelect" method="post">
                     <input type="hidden" name="voteId" id="voteId"/>
                     <input type="hidden" name="votedMemberId" id="votedMemberId"/>
                     <input type="hidden" name="idStr" id="idStr" value="'.$_GET['id'].'"/>
                     <input type="hidden" name="haveSubmit" id="haveSubmit" value=""/>
                     <fieldset>
                        <legend>'.$resultData['content'].'</legend>';
                if(!empty($resultData['votedMemberList'])){
                    if(!empty($resultData['voteLogList'])){
                        // print_r($resultData['voteLogList']);
                        foreach($resultData['voteLogList'] as $k => $data_k){//判断是否选中
                            foreach ($resultData['votedMemberList'] as $i => $val){
                                echo '<p>';
                                if(!empty($data_k['votedMemberIdStr'])&&$data_k['votedMemberIdStr'] == $val['id']){
                                    echo '<input class="magic-radio" type="radio" checked name="opinions" id="totally'.$i.'" value="'.$i.'" data-mid="'.html::encode($val['id']).'" data-vote="'.html::encode($val['voteIdStr']).'"/>
                                            <label style="font-size:1.1em" for="totally'.$i.'">正确</label>';
                                }else{
                                    echo '<input class="magic-radio" type="radio" name="opinions" id="totally'.$i.'" value="'.$i.'" data-mid="'.html::encode($val['id']).'" data-vote="'.html::encode($val['voteIdStr']).'"/>
                                            <label style="font-size:1.1em" for="totally'.$i.'">正确</label>';
                                }
                                echo '<label for="'.$i.'">'.html::encode($val['name']).'</label>
                                      </p>';
                            }
                        }
                    }else{//还没有投票
                        foreach ($resultData['votedMemberList'] as $i => $val){
//                                    \common\models\MyFunction::sun_p($val);DIE;
                            echo '<p>';
                            echo '<input class="magic-radio" type="radio" name="opinions" id="totally'.$i.'" value="'.$i.'" data-mid="'.html::encode($val['idStr']).'" data-vote="'.html::encode($val['voteIdStr']).'"/>
                                    <label style="font-size:1.1em" for="totally'.$i.'">正确</label>';
                            echo '<label for="'.$i.'">'.html::encode($val['name']).'</label>
                                      </p>';
                        }

                    }

                }
                echo '</fieldset>';
                if($resultData['canVote'] == 0){
                    echo '<div class="footer">
                             <span class="btn btn-primary">已投票</span>
                         </div>';
                }else{
                    echo '<div class="footer">
                             <button type="submit" class="btn btn-primary submit_btn" onclick="return voteSubmit();">给Ta投票</button>
                         </div>';
                }

                echo '</form>';
                if($resultData['canVote'] == 0) {
                    if (!empty($resultData['votedMemberList'])) {
                        foreach ($resultData['votedMemberList'] as $i => $val) {
                            $tickets = 0;//设变量
                            $tickets += $val['tickets'];
                            echo '<div class="ly_progress_vote">
                                    <div style="width: 100%;height: 28px;"><h3 class="progress-title pull-left">' . html::encode($val['name']) . '</h3><h3 class="progress-title pull-right">总' . $tickets . '票</h3></div>
                                    <div class="progress">';
                            if($resultData['voteCount']==0){
                                echo '<div class="progress-bar" style="width:0%; background:#97c513;">
                                            <div class="progress-value"></div>
                                        </div>';
                            }else{
                                echo '<div class="progress-bar" style="width:' . (round((($tickets / $resultData['voteCount'] * 100)), 2)) . '%; background:#97c513;">
                                                <div class="progress-value">' . html::encode($val['tickets']) . '票</div>
                                            </div>';
                            }
                            echo '</div>
                               </div>';
                        }
                    }
                }
                echo '<div class="panel-body">
                    <div style="border-bottom: 1px solid #ddd; margin-bottom: 8px;"><p class="fa fa-info-circle" style="font-size: 18px;">参与成员投票成员（'.( empty($resultData['voterName'])? 0: html::encode(count($resultData['voterName']))).'）</p></div> ';
                if(!empty($resultData['voterName'])){
                    foreach ($resultData['voterName'] as $i => $val){
                        echo '<button type="button" class="btn btn-warning m-r-sm">'.html::encode($val).'</button>';
                    }
                }
                echo '</div>';
            }
            ?>

        </div>
    </div>
</div>

<script>
    function voteSubmit(){
        var voteId = $().val();
//        var votedMemberId =$("#votedMemberId").val();
        var haveSubmit = $("#haveSubmit").val("1");
        if(haveSubmit!=''){
            if(voteId==''){
                swal({
                    title: "请先选择！",
                    type: "warning",
                    confirmButtonText: "确 定"
                });
            }else{
                window.location.href="/vote/vote";
            }
        }else{
            swal({
                title: "每人仅限投一张票！",
                type: "warning",
                confirmButtonText: "确 定"
            });
        }
    }
    $("input[type=radio]").click(function(){
        $("#voteId").val($(this).data("vote"));
        $("#votedMemberId").val($(this).data("mid"));
    })
</script>
