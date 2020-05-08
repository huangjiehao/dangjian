<?php
use yii\helpers\Html;
$session = \Yii::$app->session;
$user_msginfo = json_decode($session->get('user_msginfo'), true);
$pre_username = $user_msginfo['name'];
$pre_userId = $user_msginfo['idStr'];
?>
<link href="/content/css/course/course_dtls.css" rel="stylesheet" type="text/css"/>
<link href="/content/css/course/site.css" rel="stylesheet" type="text/css"/>
<link href="/content/css/course/siteDetail.css" rel="stylesheet" type="text/css"/>
<input id="pre_username" type="hidden" value="<?=$pre_username ?>"/>
<div class="bg-grey2 pt20 pb10">
    <div class="c_container1200">
        <!--
            上方提示位置
         -->
        <div class="mb15">
            <a href="" class="link16">全部课程</a> <span class="ml8 mr5 text-lightgrey">&gt;</span>
            <a href="" class="link16">专题系列</a><span class="ml8 mr5 text-lightgrey">&gt;</span>
            <span class="text-lightgrey d-in-block ellipsis width300 pr top5"><?php if (!empty($dtlsData)) {echo html::encode($dtlsData['studyInfo']['name']);}?></span>
        </div>
        <!--
            答题区域
         -->
        <div class="clearfix">
            <?php
            $url=isset($resData) ? $resData['studyResource']['url'] : '';
            if(!empty($url)){
                $str= substr($url,-4);
                if($str=="html"||$str==".pdf"){
                    echo '
                   <div class="pull-left" style="width: 745px;height: 550px;" >
                        <iframe style="width: 100%;height: 100%;" src="'.$url.'" scrolling="yes"> </iframe>
                    </div>
                   ';
                }else{
                    echo '<div class="pull-left" id="video"></div>';
                }
            }
            ?>
            <div class="col-sm-8 ph10 pull-left txt">
                <iframe id="iframe" src="/course/course_question?idStr=<?php if (!empty($resData)) {echo $resData['studyResource']['idStr'];}?>#在线学习"></iframe>
            </div>
        </div>
        <input type="hidden" id="courseId_video"
               value="<?php echo(isset($courseId) ? $courseId : '') ?>">
        <input type="hidden" id="resId_video"
               value="<?php echo(isset($resData) ? $resData['studyResource']['url'] : '') ?>">
    </div>
</div>
<div class="bg-white pb40">
    <div class="c_container c_container1200 new_yxt">
        <div class="clearfix">
            <div class="border-l2 bg-white mt10">
                <ul class="nav courselist_nav font-size-14 text-grey">
                    <li class="" id="desc">
                        <a href="javaScript:void(0);" onclick="tabShow('course_xiang')">
                            <span class="font-size-18">课程介绍</span>
                        </a>
                    </li>
                    <li class="active" id="commentlist">
                        <a href="javaScript:void(0);" onclick="tabShow('course_ping')">
                            <span class="font-size-18">学习心得</span>
                        </a>
                    </li>
                    <li class="" id="vediolist">
                        <a href="javaScript:void(0);" onclick="tabShow('vedio_ping')">
                            <span class="font-size-18">视频列表</span>
                        </a>
                    </li>
                </ul>

                <div class="clearfix online_date">
                    <div class="pull-left border-l2r fmr1 width849">
                        <div class="tab-content ">
                            <!-- 课程项 -->
                            <div class="tab-pane mt20 mt15" id="course_xiang">
                                <!-- 课程说明 -->
                                <span class="font-size-16 text-lightdark indent ">积分说明：</span>
                                <span class="lh25 font-size-16 text-lightdark indent">课程必须学习完并答对全部题目才能获得积分</span>
                                <!-- 课程介绍 -->
                                <br>
                                <span class="font-size-16 text-lightdark indent ">课程简介：</span>
                                <span class="lh25 font-size-16 text-lightdark indent"><?php if (!empty($dtlsData)) { echo html::encode($dtlsData['studyInfo']['remark']); } ?></span>
                                <br>
                            </div>

                            <!-- 评论 -->
                            <div class="tab-pane active ph10" id="course_ping">
                                <div class="width760">
                                    <div id="dvComment">
                                        <p class="title font-size-16 mt10">
                                            <span class="ico-line mr10"></span>所有评论（共<span id="totalShow"><?php if(!empty($commentData)) { echo html::encode($commentData['counts']); } ?></span>条）
                                        </p>
                                        <div class="comment_content mt20">
                                            <div class="mar_1">
                                                <input class="form-control mt10" id="commTitle" placeholder="心得标题（不填默认为课程名称）">
                                            </div>
                                            <!--
                                                提交心得
                                             -->
                                            <input type="hidden" id="courseId"
                                                   value="<?php echo(isset($courseId) ? html::encode($courseId) : '') ?>">
                                            <input type="hidden" id="courseName"
                                                   value="<?php echo(isset($courseName) ? html::encode($courseName) : '') ?>">
                                            <div class="row">
                                                <div class="col-sm-2 mt10">
                                                    <span> <img width="50" height="50" class="img-circle" src="/content/images/default_header.png">
                                                    </span>
                                                </div>
                                                <div class="col-sm-22">
                                                    <textarea class="form-control mt10" cols="20" id="commentBody" placeholder="我来说两句..." rows="5"></textarea>
                                                </div>
                                            </div>
                                            <p class="clearfix">
                                                <button class="pull-right lh22 btn-primary btn-sm font-size-14 mt10 ph25" onclick="saveComment()" id="fb">发表</button>
                                            </p>
                                        </div>
                                        <div class="comment_box">
                                            <ol class="comment_list" id="comment_list">
                                                <?php
                                                if (!empty($commentData)){
                                                    foreach ($commentData['listStudyComment'] as $data_key => $data_val) {
                                                        echo '<div>
                                                        <li>
                                                            <div class="avatar">
                                                                <img src="/content/images/default_header.png" height="40" width="40">
                                                            </div><div class="inner">
                                                                <p><span>'. html::encode($data_val['userName']) .'</span><br>
                                                                    <span class="commTitle">'. html::encode($data_val['name']) .'</span>
                                                                    <span class="time" >'. date("Y-m-d", $data_val['createDate']) .'</span>
                                                                </p>
                                                                <div class="meta">
                                                                    <span>'. html::encode($data_val['content']) .'</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </div>';
                                                    }
                                                }
                                                ?>
                                                <div id="page" class="text-center"></div>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 视频列表 -->
                            <div class="tab-pane mt20 ph10" id="vedio_ping">
                                <div class="clearfix" id="vedioList">
                                    <?php
                                    if (!empty($dtlsData)) {
//                                        \common\models\MyFunction::sun_p($dtlsData);DIE;
                                        /*$isComplete = null;
                                        if(isset($resData)){
                                            if(isset($resData['data'])){
                                                $isComplete = $resData['data']['isComplete'];
                                                echo '<input type="text" id="isComplete" value="'.$resData['data']['isComplete'].'"/>';
                                            }
                                        }*/
                                        foreach ($dtlsData['studyResources'] as $data_key => $data_val) {
                                            echo '<a id="'.$data_key.'" href="/course/video_player?idStr='. html::encode($data_val['idStr']) .'&courseId='. html::encode($courseId) .'#在线学习" class="btnsquar btn-bg-white font-size-15">'. ($data_key+1) .'.'. html::encode(substr($data_val['name'], 0, strrpos($data_val['name'], "."))) .'</a>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/content/js/course/course_dtls.js" type="text/javascript"></script>
<script src="/content/plugins/ckplayer/ckplayer/ckplayer.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(function () {
        var resId_url = $('#resId_video').val();
        var st=resId_url.substring(resId_url.length-4);
        if(st=='html'||st=='.pdf'){

        }else {
            var videoObject = {
                container: '#video', //容器的ID或className
                variable: 'player',//播放函数名称
                flashplayer:true,
                poster:'material/poster.jpg',//封面图片
                video: [//视频地址列表形式
                    [resId_url, 'video/mp4', '高清', 10]
                ]
            };
            var player = new ckplayer(videoObject);
        }

    })

</script>