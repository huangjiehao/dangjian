<?php

namespace backend\controllers;

use app\core\back\BaseBackController;
use common\models\Fang;
use common\models\MyFunction;
use Yii;
use yii\base\Response;
use yii\mutex\MysqlMutex;
use yii\web\Request;

class OnlineanswerController extends BaseBackController
{

    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function actionOnlineanswer(){  //问题添加
        self::iflogin();
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $userId = $user_msginfo['idStr'];

        //获取所有的用户列表信息
        $sendArr = array(
            'platformId' => $this->get_curr_platform_id(),
            'orgId' => $this->get_curr_org_id()

        );
        $getUserAllData = MyFunction::http_post(HTTP_HOSTS . '/MessageBoxService/getUserByOrgBox', $sendArr);

        //获取所有问题信息
        $qArr=array(
            'recUserId'=>$this->get_curr_user_id(),
            'recOrgId'=>$this->get_curr_org_id()
        );
        $qArr = self::init_page_params($qArr);//TODO 注意：这个是分页必须的
        $getansData = MyFunction::http_post(HTTP_HOSTS . '/OnlineQuestionReplyService/getOnlineQuestionPage',$qArr);
//        MyFunction::sun_p($getansData);die;
        $pageCounts = $getansData['data']['counts']; //TODO 注意：这个是分页必须的

//        MyFunction::sun_p($getansData);DIE;
        return $this->render('/onlineanswer/onlineanswer',['data' => $getUserAllData['data'],'getansData'=>$getansData['data'], 'page' => self::init_page_result($pageCounts)]);
    }
    //问题提交
    public function actionQuestion_submit(){
        $post = $_POST;
        $sendArr = $this->init_send_arr($post);
        $sendArr['sendUserId']=$this->get_curr_user_id();
        $sendArr['sendUserName']=$this->get_curr_user_name();
        $sendArr['sendOrgId']=$this->get_curr_org_id();
        $sendArr['sendOrgName']=$this->get_curr_org_name();
//        MyFunction::sun_p($sendArr);die;
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/OnlineQuestionReplyService/addOnlineQuestion', $sendArr);
//        MyFunction::sun_p($resultData);die;
        if ($resultData['status'] == "1000") {
            return $this->redirect('/onlineanswer/onlineanswer?curtab=grzx#grzx');
        } else {
            var_dump($resultData);
        }
    }
    //查看问题回答
    public function actionOnlinanswer_detail(){
        self::iflogin();
        $id='id='.addslashes($_GET['idStr']);
        $resultData = MyFunction::http_get(HTTP_HOSTS . '/OnlineQuestionReplyService/getRepliesUnderQuestion', $id);
//        MyFunction::sun_p($resultData);die;
        if($resultData['status']=='1000'){
            return $this->render('onlineanswer_detail',['data'=>$resultData['data']['result']]);
        }
    }
    public function actionBox_star_submit(){ //留言箱信息评价
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $userId = $user_msginfo['idStr'];
        $messageBoxArr = array(
            "id" => addslashes($_POST['id']),
            "evaluateScore" => addslashes($_POST['evaluateScore'])
        );
        $sendArr = array(
            "messageBox" => $messageBoxArr
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/MessageBoxService/updateMessageBoxCus', $sendArr);
        return json_encode($resultData);
       /* if ($resultData['status'] == "1000") {
            return $this->redirect('/personal/message_box?idStr='.$userId.'&curtab=grzx#grzx');
        } else {
            var_dump($resultData);
        }*/
    }





}