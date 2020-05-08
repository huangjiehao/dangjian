<?php
use yii\helpers\Html;
use common\models\MyFunction;
?>
<!--<textarea id="privilegeTree"style="display: none">--=json_encode($user_privilege_tree)<!--</textarea>-->
<!--<input type="hidden" id="HTTP_DOMAIN" value="--><?php //echo HTTP_BACKEND ?><!--">-->
<!--<input type="hidden" id="userid" value="--><?//= html::encode($userId) ?><!--">-->
<!--<input type="hidden" id="roleid" value="--><?//= $roleid ?><!--">-->
<!--<input type="hidden" id="userType" value="--><?//= $userType ?><!--">-->
<link href="/content/css/uncommon/portrait.css" rel="stylesheet">
<script src="/content/js/jquery-easing.1.3.js" type="text/javascript"></script>

<div id="main">
    <div class="content">
        <div class="group_list">
            <div class="menu">
                <div class="menuParent">
                    <div class="ListTitlePanel">
                        <div class="ListTitle">
                            <strong>中共广州市白云区委员会组织部</strong>
                            <div class="leftbgbt"> </div>
                        </div>
                    </div>
                    <div class="menuList" style="display: none">
                        <div> <a href="#">小陈</a></div>
                        <div> <a href="#">小李 </a> </div>
                        <div> <a href="#">小张</a></div>
                    </div>
                </div>
                <div class="menuParent">
                    <div class="ListTitlePanel">
                        <div class="ListTitle">
                            <strong>中共广州市番禺区委员会组织部</strong>
                            <div class="leftbgbt2"> </div>
                        </div>
                    </div>
                    <div class="menuList" style="display: none">
                        <div> <a href="#">小黑</a></div>
                        <div> <a href="#">Steve Jobs</a></div>
                        <div> <a href="#">比尔盖茨</a></div>
                        <div> <a href="#">马芸</a></div>
                    </div>
                </div>
                <div class="menuParent">
                    <div class="ListTitlePanel">
                        <div class="ListTitle">
                            <strong>中共广州市天河区委员会组织部</strong>
                            <div class="leftbgbt2"> </div>
                        </div>
                    </div>
                    <div class="menuList" style="display: none">
                        <div> <a href="#">小姚</a></div>
                        <div> <a href="#">小龟</a></div>
                        <div> <a href="#">小马</a></div>
                        <div> <a href="#">小绿</a></div>
                    </div>
                </div>
                <div class="menuParent">
                    <div class="ListTitlePanel">
                        <div class="ListTitle">
                            <strong>中共广州市越秀委员会组织部</strong>
                            <div class="leftbgbt2"> </div>
                        </div>
                    </div>
                    <div class="menuList" style="display: none">
                        <div> <a href="#">小欧</a></div>
                        <div> <a href="#">小丑</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table">
            <div class="tbHead">
                <div>姓名</div>
                <div>性别</div>
                <div>民族</div>
                <div>生日</div>
                <div>所在单位</div>
                <div>所属组织</div>
            </div>
            <div class="tbBody">
                <ul>
                    <li>
                        <div>黑百合</div>
                        <div>女</div>
                        <div>汉</div>
                        <div>1998-11-20</div>
                        <div>四川</div>
                        <div>中共白云区</div>
                    </li>
                    <li>
                        <div>白百合</div>
                        <div>女</div>
                        <div>汉</div>
                        <div>1998-11-20</div>
                        <div>四川</div>
                        <div>中共白云区</div>
                    </li>
                    <li>
                        <div>绿百合</div>
                        <div>女</div>
                        <div>汉</div>
                        <div>1998-11-20</div>
                        <div>四川</div>
                        <div>中共白云区</div>
                    </li>
                    <li>
                        <div>黄百合</div>
                        <div>女</div>
                        <div>汉</div>
                        <div>1998-11-20</div>
                        <div>四川</div>
                        <div>中共白云区</div>
                    </li>
                    <li>
                        <div>紫百合</div>
                        <div>女</div>
                        <div>汉</div>
                        <div>1998-11-20</div>
                        <div>四川</div>
                        <div>中共白云区</div>
                    </li>
                    <li>
                        <div>蓝百合</div>
                        <div>女</div>
                        <div>汉</div>
                        <div>1998-11-20</div>
                        <div>四川</div>
                        <div>中共白云区</div>
                    </li>
                    <li>
                        <div>彩虹百合</div>
                        <div>女</div>
                        <div>汉</div>
                        <div>1998-11-20</div>
                        <div>四川</div>
                        <div>中共白云区</div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var menuParent = $('.menu > .ListTitlePanel > div');//获取menu下的父层的DIV
        var menuList = $('.menuList');
        $('.menu > .menuParent > .ListTitlePanel > .ListTitle').each(function(i) {//获取列表的大标题并遍历
            $(this).click(function(){
                if($(menuList[i]).css('display') == 'none'){
                    $(menuList[i]).slideDown(300);
                }
                else{
                    $(menuList[i]).slideUp(300);
                }
            });
        });
        $('.tbBody li').on('click',function () {
            // window.open('portrait_info','','height=800')
            window.open('/content/images/dyhx.png','','height=800')
        })
    });

</script>

