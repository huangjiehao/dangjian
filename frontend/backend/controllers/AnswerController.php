<?php
namespace backend\controllers;
use app\core\back\BaseBackController;
use common\models\Fang;
use common\models\MyFunction;
use Yii;


class AnswerController extends BaseBackController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionAnswer_list(){ //知识库列表
        if($this->iflogin()){ $this->redirect($this->loginUrl); }

        /**
         * 我的关注
         */
        $sendArr = array(
            'loginUserId' => $this->get_curr_user_id(),
            'platformId' => $this->get_curr_platform_id(),
            'isRead' => 0
        );
        $attentionData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersTopicAttentionPage', $sendArr);
        $isAttention = $attentionData['data']['isAttention'];
        /**
         * 我的提问
         */
        $sendArr = array(
            'loginUserId' => $this->get_curr_user_id(),
            'createUserId' => $this->get_curr_user_id(),
            'platformId' => $this->get_curr_platform_id(),
            'isRead' => 0
        );
        $notifData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersTopicPage', $sendArr);
        $notifData = $notifData['data']['notificationNum'];
        $allNum = $isAttention + $notifData;
        //结束

        $sendArr = array(
            'platformId' => $this->get_curr_platform_id(),
        );
        $keyResultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersTopicKeyAll',$sendArr);
        $field = 'create_date';
        if (isset($_GET['field'])) {
            $field = $_GET['field'];
        }

        $findName = null;
        if (isset($_GET['findName'])) {
            $findName = preg_replace("/[\s]+/is","|",$_GET['findName']);
            if ($findName == "" || $findName == 'undefined') {
                $findName = null;
            }
        }
        $topicKeyId = null;
        if (isset($_GET['topicKeyId'])) {
            $topicKeyId = $_GET['topicKeyId'];
            if ($topicKeyId == 0 || $topicKeyId == 'undefined') {
                $topicKeyId = null;
            }
        }
        $sendArr = array(
            'loginUserId' => $this->get_curr_user_id(),
            'findName' => $findName,
            'topicKeyId' => $topicKeyId,
            'platformId' => $this->get_curr_platform_id(),
            'type' => 3,
            'field' => $field
        );
        $sendArr = self::init_page_params($sendArr);//TODO 注意：这个是分页必须的
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersTopicFrontPage',$sendArr);// /AnswersTopicService/getAnswersTopicPage
//        MyFunction::sun_p($allNum);DIE;
        $pageCounts = $resultData['data']['counts']; //TODO 注意：这个是分页必须的
        if ($resultData['status'] == "1000") {
            $data['data'] = $resultData['data'];
            $param = array(
                'field' => $field,
                'findName' => $findName,
                'topicKeyId' => $topicKeyId
            );
            return $this->render('answer_list', ['kayData' => $keyResultData['data'],'allNum'=>$allNum, 'param' => $param, 'data' => $resultData, 'page' => self::init_page_result($pageCounts)]);
        } else {
            return $this->redirect('/layouts/error404');
        }
    }

    public function actionAnswer_dtls(){ //知识库详情
        if($this->iflogin()){$this->redirect($this->loginUrl);}

        $topicReplylimit = 5;
        $userId = $this->get_curr_user_id();
        $sendArr = array(
            'platformId' => $this->get_curr_platform_id(),
            'id' => $_GET['id'],
            'loginUserId' => $userId
        );

        $data = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersTopicCusOne', $sendArr);
//        MyFunction::sun_p($data);DIE;
        if(isset($_GET['notif'])){
            $notif = isset($_GET['notif'])?$_GET['notif']:'';
            //确认为已读消息
            $quesendArr = array(
                'platformId' => $this->get_curr_platform_id(),
                'id' => $notif,
                'isRead' => 1,
                'recUserId' =>  $this->get_curr_user_id(),
                'topicId' => $_GET['id']
            );
//            MyFunction::sun_p($quesendArr);
            $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/updateAnswersNotification', $quesendArr);
//            MyFunction::sun_p($resultData);DIE;
            if ($data['status'] == "1000" && $resultData['status'] == "1000") {
                return $this->render('answer_dtls', ['data' => $data['data'], 'replyList' => $data['data']['answersTopicReplies'], 'topicReplylimit' => $topicReplylimit]);
            } else {
                return $this->redirect('/layouts/error404');
            }
        }else{
            if ($data['status'] == "1000") {
                return $this->render('answer_dtls', ['data' => $data['data'], 'replyList' => $data['data']['answersTopicReplies'], 'topicReplylimit' => $topicReplylimit]);
            } else {
                return $this->redirect('/layouts/error404');
            }
        }

    }

    public function actionAnswer_notif()
    {
        if($this->iflogin()){$this->redirect($this->loginUrl);}
        $topicType = 0;
        if (isset($_GET['topicType'])) {
            $topicType = $_GET['topicType'];
        }
        $resultData = null;
        if ($topicType == 2) {
            $sendArr = array(
                'loginUserId' => $this->get_curr_user_id(),
                'platformId' => $this->get_curr_platform_id(),
            );
            $sendArr = self::init_page_params($sendArr);//TODO 注意：这个是分页必须的
            $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersTopicAttentionPage', $sendArr);
//            MyFunction::sun_p($resultData);DIE;
            $pageCounts = $resultData['data']['counts']; //TODO 注意：这个是分页必须的

        } else if ($topicType == 1) {
            $sendArr = array(
                'loginUserId' => $this->get_curr_user_id(),
                'createUserId' => $this->get_curr_user_id(),
                'platformId' => $this->get_curr_platform_id(),
            );
            $sendArr = self::init_page_params($sendArr);//TODO 注意：这个是分页必须的
            $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersTopicFrontPage', $sendArr);///AnswersTopicService/getAnswersTopicPage
//            MyFunction::sun_p($resultData);DIE;
            $pageCounts = $resultData['data']['counts']; //TODO 注意：这个是分页必须的

        } else {
            $sendArr = array(
                'loginUserId' => $this->get_curr_user_id(),
                'platformId' => $this->get_curr_platform_id(),
                'type' => 3
            );
            $sendArr = self::init_page_params($sendArr);//TODO 注意：这个是分页必须的
            $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersTopicFrontPage',$sendArr);// /AnswersTopicService/getAnswersTopicPage
            $pageCounts = $resultData['data']['notificationNum']; //TODO 注意：这个是分页必须的
        }
        if ($resultData['status'] == "1000") {
            $param = array(
                'topicType' => $topicType
            );
            return $this->render('/answer/answer_notification', ['data' => $resultData['data'], 'param' => $param, 'page' => self::init_page_result($pageCounts)]);

        } else {
            return $this->redirect('/layouts/error404');
        }
    }
}