<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/14
 * Time: 19:30
 */

namespace backend\controllers;

use app\core\back\BaseBackController;
use common\models\Fang;
use common\models\MyFunction;
use Yii;


class AdviceController extends BaseBackController
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    //建议列表
    public function actionAdvice_list(){ //知识库列表
        self::iflogin();
        $sendArr = array(
            'loginUserId' => $this->get_curr_user_id(),
        );
        $sendArr = self::init_page_params($sendArr);//TODO 注意：这个是分页必须的
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getUniAnswersTopicPage',$sendArr);
//        MyFunction::sun_p($resultData);DIE;
        $pageCounts = $resultData['data']['counts']; //TODO 注意：这个是分页必须的
        if($resultData['status']=='1000'){
            return $this->render('/answers/answers_list', [ 'data' => $resultData, 'page' => self::init_page_result($pageCounts)]);
        } else {
            return $this->redirect('/layouts/error404');
        }
    }

    public function actionAnswers_details()
    {

        self::iflogin();
        $topicReplylimit = 5;
        $userId = $this->get_curr_user_id();
        $sendArr = array(
            'platformId' => $this->get_curr_platform_id(),
            'id' => addslashes($_GET['id']),
            'loginUserId' => $userId
        );
        $data = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersTopicCusOne', $sendArr);
        if ($data['status'] == "1000") {
            return $this->render('/answers/answers_details', ['data' => $data['data'], 'replyList' => $data['data']['answersTopicReplies'], 'topicReplylimit' => $topicReplylimit]);
        } else {
            return $this->redirect('/layouts/error404');
        }
    }

    public function actionAnswers_dtls()
    {
        self::iflogin();
        $topicReplylimit = 5;
        $userId = $this->get_curr_user_id();
        $sendArr = array(
            'platformId' => $this->get_curr_platform_id(),
            'id' => addslashes($_GET['id']),
            'loginUserId' => $userId
        );

        $data = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersTopicCusOne', $sendArr);
        $notifStr = addslashes($_GET['notif']);
        if(isset($notifStr)){
            //确认为已读消息
            $quesendArr = array(
                'platformId' => $this->get_curr_platform_id(),
                'id' => $notifStr,
                'isRead' => 1
            );
            $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/updateAnswersNotification', $quesendArr);
            if ($data['status'] == "1000" && $resultData['status'] == "1000") {
                return $this->render('/answers/answers_dtls', ['data' => $data['data'], 'replyList' => $data['data']['answersTopicReplies'], 'topicReplylimit' => $topicReplylimit]);
            } else {
                return $this->redirect('/layouts/error404');
            }
        }else{
            if ($data['status'] == "1000") {
                return $this->render('/answers/answers_dtls', ['data' => $data['data'], 'replyList' => $data['data']['answersTopicReplies'], 'topicReplylimit' => $topicReplylimit]);
            } else {
                return $this->redirect('/layouts/error404');
            }
        }
    }


    public function actionAnswers_reply()
    {
        $answersTopicReply = array(
            'platformId' => $this->get_curr_platform_id(),
            'createUserId' => $this->get_curr_user_id(),
            'createUserName' => $this->get_curr_user_name(),
            'createOrgId' => $this->get_curr_org_id(),
            'createOrgName' => $this->get_curr_org_name(),
            'topicId' => addslashes($_POST['topicId']),
            'topicCreateUserId' => addslashes($_POST['topicCreateUserId']),
            'topicCreateUserName' => addslashes($_POST['topicCreateUserName']),
            'replyPid' => addslashes($_POST['replyPid']),
            'commentContents' => addslashes($_POST['commentContents']),
            'createUserImg' => "",
            'replyUserId' => addslashes($_POST['replyUserId']),
            'replyUserName' => addslashes($_POST['replyUserName']),
            'replyUserImg' => ""
        );
        $sendArr = array(
            'platformId' => $this->get_curr_platform_id(),
            'answersTopicReply' => $answersTopicReply
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/addAnswersTopicReplyCus', $sendArr);
        return json_encode($resultData);
    }

    public function actionAnswers_praise()
    {
        $sendArr = array(
            'platformId' => $this->get_curr_platform_id(),
            'loginUserId' => $this->get_curr_user_id(),
            'loginUserName' => $this->get_curr_user_name(),
            'id' => addslashes($_POST['id'])
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/addAnswersTopicPraiseMprCus', $sendArr);
        return json_encode($resultData);
    }

    public function actionAnswers_notif()
    {
        self::iflogin();
        $topicType = 30;
        if (isset($_GET['topicType'])) {
            $topicType = $_GET['topicType'];
        }
        $resultData = null;
        if ($topicType == 1000) {
            $sendArr = array(
                'loginUserId' => $this->get_curr_user_id(),
                'platformId' => $this->get_curr_platform_id(),
                'isRead' => 0
            );
            $sendArr = self::init_page_params($sendArr);//TODO 注意：这个是分页必须的
            $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersTopicAttentionPage', $sendArr);
            $pageCounts = $resultData['data']['counts']; //TODO 注意：这个是分页必须的

        } else if ($topicType == 40) {
            $sendArr = array(
                'createUserId' => $this->get_curr_user_id(),
                'platformId' => $this->get_curr_platform_id()
            );
            $sendArr = self::init_page_params($sendArr);//TODO 注意：这个是分页必须的
            $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getUniAnswersTopicPage', $sendArr);
            $pageCounts = $resultData['data']['counts']; //TODO 注意：这个是分页必须的

        } else {
            $sendArr = array(
                'loginUserId' => $this->get_curr_user_id(),
                'type' => $topicType,
                'platformId' => $this->get_curr_platform_id(),
                'isRead' => 0
            );
            $sendArr = self::init_page_params($sendArr);//TODO 注意：这个是分页必须的
            $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersNotificationPage', $sendArr);
            $pageCounts = $resultData['data']['counts']; //TODO 注意：这个是分页必须的
        }
        //    $this->sun_p($resultData);Die;
        if ($resultData['status'] == "1000") {
            $param = array(
                'topicType' => $topicType
            );
            return $this->render('/answers/answers_notification', ['data' => $resultData, 'param' => $param, 'page' => self::init_page_result($pageCounts)]);
//            'postIndex' => $pageNumber, 'postLimitCounts' => $limitCounts]

        } else {
            return $this->redirect('/layouts/error404');
        }
    }

    /*public function actionAnswers_read()
    {
        $sendArr = array(
            'platformId' => $this->get_curr_platform_id(),
            'id' => addslashes($_POST['notif']),
            'isRead' => 1
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/updateAnswersNotification', $sendArr);
        return json_encode($resultData);
    }*/

    public function actionAnswers_attention()
    {
        $sendArr = array(
            'topicId' => addslashes($_POST['topicId']),
            'loginUserId' => $this->get_curr_user_id(),
            'loginUserName' => $this->get_curr_user_name(),
            'platformId' => $this->get_curr_platform_id()
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/addAnswersTopicAttentionMprCus', $sendArr);
        return json_encode($resultData);
    }

    public function actionAnswers_add_topic()
    {
        self::iflogin();
        /*$img = "";
        if (isset($_POST['img'])) {
            $img = addslashes($_POST['img']);
        }*/
        $answersTopic = array(
            'platformId' => $this->get_curr_platform_id(),
            'title' => addslashes($_POST['title']),
            /*  'img' => $img,*/
            'contents' => addslashes($_POST['contents']),
            'createUserId' => $this->get_curr_user_id(),
            'createUserName' => $this->get_curr_user_name(),
            'createOrgId' => $this->get_curr_org_id(),
            'createOrgName' => $this->get_curr_org_name(),
            'topicKeyId' => addslashes($_POST['topicKeyId']),
//            'contents' => addslashes($_POST['contents'])
        );
        $sendArr = array(
            'answersTopic' => $answersTopic,
            'platformId' => $this->get_curr_platform_id()
        );
//        MyFunction::sun_p($sendArr);die;
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/addAnswersTopicCus', $sendArr);
        if ($resultData['status'] == "1000") {
            return $this->redirect('/answers/answers_list');
        }
    }

    public function actionAnswers_reply_list()
    {
        $sendArr = array(
            'replyPid' => addslashes($_POST['id']),
            'limitCounts' => addslashes($_POST['limitCounts']),
            'pageNumber' => addslashes($_POST['pageNumber']),
            'platformId' => $this->get_curr_platform_id()
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersTopicReplyPage', $sendArr);
        return json_encode($resultData);
    }
}

