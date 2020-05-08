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


class AnswersController extends BaseBackController
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionAnswers_list(){ //知识库列表
        if($this->iflogin()){$this->redirect($this->loginUrl);}
        $app = 1;$isApp = MyFunction::is_mobile($app);

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
            $findName = $_GET['findName'];
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
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersTopicPage',$sendArr);
//        MyFunction::sun_p($resultData);DIE;
        $pageCounts = $resultData['data']['counts']; //TODO 注意：这个是分页必须的
        if ($resultData['status'] == "1000") {
            $data['data'] = $resultData['data'];
            $param = array(
                'field' => $field,
                'findName' => $findName,
                'topicKeyId' => $topicKeyId
            );
            return $this->render('/answers/answers_list', ['kayData' => $keyResultData['data'],'allNum'=>$allNum,'app'=>$isApp, 'param' => $param, 'data' => $resultData, 'page' => self::init_page_result($pageCounts)]);
        } else {
            return $this->redirect('/layouts/error404');
        }
    }

    public function actionAnswers_details()
    {
        if($this->iflogin()){$this->redirect($this->loginUrl);}
        $topicReplylimit = 5;
        $userId = $this->get_curr_user_id();
        $sendArr = array(
            'platformId' => $this->get_curr_platform_id(),
            'id' => $_GET['id'],
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
        if($this->iflogin()){$this->redirect($this->loginUrl);}
        $app = 1;$isApp = MyFunction::is_mobile($app);

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
                return $this->render('/answers/answers_dtls', ['data' => $data['data'],'app'=>$isApp, 'replyList' => $data['data']['answersTopicReplies'], 'topicReplylimit' => $topicReplylimit]);
            } else {
                return $this->redirect('/layouts/error404');
            }
        }else{
            if ($data['status'] == "1000") {
                return $this->render('/answers/answers_dtls', ['data' => $data['data'],'app'=>$isApp, 'replyList' => $data['data']['answersTopicReplies'], 'topicReplylimit' => $topicReplylimit]);
            } else {
                return $this->redirect('/layouts/error404');
            }
        }
    }


    public function actionAnswers_reply()
    {
        if($this->iflogin()){$this->redirect($this->loginUrl);}
        $answersTopicReply = array(
            'platformId' => $this->get_curr_platform_id(),
            'topicId' => $_POST['topicId'],
            'topicCreateUserId' => $_POST['topicCreateUserId'],
            'topicCreateUserName' => $_POST['topicCreateUserName'],
            'replyPid' => $_POST['replyPid'],
            'commentContents' => $_POST['commentContents'],
            'createUserId' => $this->get_curr_user_id(),
            'createUserName' => $this->get_curr_user_name(),
            'createUserImg' => "",
            'createOrgId' => $this->get_curr_org_id(),
            'createOrgName' => $this->get_curr_org_name(),
            'replyUserId' => $_POST['replyUserId'],
            'replyUserName' => $_POST['replyUserName'],
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
        if($this->iflogin()){$this->redirect($this->loginUrl);}
        $sendArr = array(
            'platformId' => $this->get_curr_platform_id(),
            'loginUserId' => $this->get_curr_user_id(),
            'loginUserName' => $this->get_curr_user_name(),
            'id' => $_POST['id']
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/addAnswersTopicPraiseMprCus', $sendArr);
        return json_encode($resultData);
    }

    public function actionAnswers_notif()
    {
        if($this->iflogin()){$this->redirect($this->loginUrl);}
        $app = 1;$isApp = MyFunction::is_mobile($app);
        $topicType = 0;
        if (isset($_GET['topicType'])) {
            $topicType = $_GET['topicType'];
        }
        $resultData = null;
        if ($topicType == 2) {
            $sendArr = array(
                'loginUserId' => $this->get_curr_user_id(),
                'platformId' => $this->get_curr_platform_id(),
                'isRead' => 0
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
                'isRead' => 0
            );
//            MyFunction::sun_p($sendArr);
           $sendArr = self::init_page_params($sendArr);//TODO 注意：这个是分页必须的
            $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersTopicPage', $sendArr);
//            MyFunction::sun_p($resultData);DIE;
           $pageCounts = $resultData['data']['notificationNum']; //TODO 注意：这个是分页必须的

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
            return $this->render('/answers/answers_notification', ['data' => $resultData,'app'=> $isApp, 'param' => $param, 'page' => self::init_page_result($pageCounts)]);
//            'postIndex' => $pageNumber, 'postLimitCounts' => $limitCounts]

        } else {
            return $this->redirect('/layouts/error404');
        }
    }

    /*public function actionAnswers_read()
    {
        $sendArr = array(
            'platformId' => $this->get_curr_platform_id(),
            'id' => $_POST['notif'],
            'isRead' => 1
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/updateAnswersNotification', $sendArr);
        return json_encode($resultData);
    }*/

    public function actionAnswers_attention(){
        if($this->iflogin()){$this->redirect($this->loginUrl);}
        $session = \Yii::$app->session;
        $user_local = json_decode($session->get('user_local'), true);
        $userName = $user_local['name'];
        $sendArr = array(
            'topicId' => $_POST['topicId'],
            'loginUserId' => $this->get_curr_user_id(),
            'loginUserName' => $userName,
            'platformId' => $this->get_curr_platform_id()
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/addAnswersTopicAttentionMprCus', $sendArr);
        return json_encode($resultData);
    }

    public function actionAnswers_add_topic()
    {
        if($this->iflogin()){$this->redirect($this->loginUrl);}
        $answersTopic = array(
            'platformId' => $this->get_curr_platform_id(),
            'title' => $_POST['title'],
            'contents' => $_POST['contents'],
            'createUserId' => $this->get_curr_user_id(),
            'createUserName' => $this->get_curr_user_name(),
            'createOrgId' => $this->get_curr_org_id(),
            'createOrgName' => $this->get_curr_org_name(),
            'topicKeyId' => $_POST['topicKeyId'],
        );
        $sendArr = array(
            'answersTopic' => $answersTopic,
            'platformId' => $this->get_curr_platform_id()
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/addAnswersTopicCus', $sendArr);
        if ($resultData['status'] == 1000) {
            return 1;
        }
        return 0;
    }

    public function actionAnswers_reply_list()
    {
        $sendArr = array(
            'replyPid' => $_POST['id'],
            'limitCounts' => $_POST['limitCounts'],
            'pageNumber' => $_POST['pageNumber'],
            'platformId' => $this->get_curr_platform_id()
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/AnswersTopicService/getAnswersTopicReplyPage', $sendArr);
        return json_encode($resultData);
    }
}

