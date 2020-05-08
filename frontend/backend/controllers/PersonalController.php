<?php

namespace backend\controllers;

use app\core\back\BaseBackController;
use common\models\Fang;
use common\models\MyFunction;
use Yii;
use yii\base\Response;
use yii\mutex\MysqlMutex;
use yii\web\Request;

class PersonalController extends BaseBackController
{

    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionPersonal(){ //党群服务所有信息
        self::iflogin();
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $pre_username = $user_msginfo['name'];
        $pre_userId = $user_msginfo['idStr'];
        $userId ='userId='.$pre_userId;
        $sendArr = array(
            'userId' => $pre_userId,
            'platformId' => $this->get_curr_platform_id()
        );
//        MyFunction::sun_p($sendArr);DIE;
        $infoData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getIndividualCenterData', $sendArr);
        if ($infoData['status'] == "1000"  ) {
            $resultData['infoData'] = $infoData['data'];
        }

        $birthdayData = MyFunction::http_get(HTTP_HOSTS . '/BirthdayCardService/sendBirthdayCard', $userId);
        return $this->render('personal',['resultData' => $resultData,'birthdayData' => $birthdayData['data']]);
    }
    public function actionPersonal_development(){
        return $this->render('/personal/personal_development');
    }

    /*党员积分管理（中层干部）*/
    public function actionPersonal_mid(){
        self::iflogin();
        $resultData = array();

        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $userId = $user_msginfo['idStr'];
        $userLevel = $user_msginfo['userLevel'];
//        MyFunction::sun_p($userLevel);

        /*查出当前用户的所有年份*/
        $userCoin = array(
            'userId' => $userId,
        );
        $sendArr = array(
            'userCoin' => $userCoin,
        );
        $timeData = MyFunction::http_post(HTTP_HOSTS . '/UserCoinService/getCoinYearList', $sendArr);
        /*查出当前用户的所有数据*/
        $sendArr = array(
            'userId' =>  $userId,
            'userLevel' => $userLevel,
            'coinYear' => date('Y') //获取当前年份
        );
//        MyFunction::sun_p($getAllData['data']);die;
        $getAllData = MyFunction::http_post(HTTP_HOSTS . '/UserCoinHeaderService/queryUserCoinHeaderByUserIdAndCoinYear', $sendArr);//UserCoinHeaderService/getUserUserCoinHeaderTree
//        MyFunction::sun_p($getAllData['data']);die;

        //查询月度积分季度积分年度积分
        $userCoinReview = array(
            'userId' => $userId,
            'coinYear' => date('Y') //获取当前年份
        );
        $sendArr = array(
            'userCoinReview' => $userCoinReview,
        );
        $bottomData = MyFunction::http_post(HTTP_HOSTS . '/UserCoinReviewService/getUserCoinReviewByUserIdAndDate', $sendArr);//UserCoinReviewService/getUserCoinReviewPage
//        MyFunction::sun_p($bottomData['data']);die;

        return $this->render('/personal/personal_mid',['data' => $getAllData['data'],'dataTime' => $timeData['data'],'bottomData' => $bottomData['data'],'resultData' => $resultData]);
    }
    public function actionPersonal_save(){
        self::iflogin();
        $resultData = array();

        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $userId = $user_msginfo['idStr'];
        $userLevel = $user_msginfo['userLevel'];
        $userStatus = $user_msginfo['status'];

        //添加加自评积分记录
        $userCoin = array(
            'userCoinHeaderId' => addslashes($_POST['userCoinHeaderId']),
            'janVal' => addslashes($_POST['janVal']),
            'febVal' => addslashes($_POST['febVal']),
            'marVal' => addslashes($_POST['marVal']),
            'apriVal' => addslashes($_POST['apriVal']),
            'mayVal' => addslashes($_POST['mayVal']),
            'juneVal' => addslashes($_POST['juneVal']),
            'julyVal' => addslashes($_POST['julyVal']),
            'augVal' => addslashes($_POST['augVal']),
            'sepVal' => addslashes($_POST['sepVal']),
            'octVal' => addslashes($_POST['octVal']),
            'novVal' => addslashes($_POST['novVal']),
            'decVal' => addslashes($_POST['decVal']),
            'platformId' => $this->get_curr_platform_id(),
            'status' => $userStatus,
            'userId' => $userId,
            'coinYear' => addslashes($_POST['coinYear'])
        );
        $sendArr = array(
            'userCoin' => $userCoin,
        );
//        return json_encode($sendArr);
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/UserCoinService/addUserCoin', $sendArr);///UserCoinService/addUserCoin
        return json_encode($resultData);
//        return $this->render('/personal/personal_mid',['resultData' => $resultData]);
    }
    public function actionPersonal_savemonth(){
        self::iflogin();
        $resultData = array();

        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $userId = $user_msginfo['idStr'];
        $userLevel = $user_msginfo['userLevel'];
        $userStatus = $user_msginfo['status'];

        $userCoinReview = array(
            'janVal' => addslashes($_POST['janVal']),
            'febVal' => addslashes($_POST['febVal']),
            'marVal' => addslashes($_POST['marVal']),
            'apriVal' => addslashes($_POST['apriVal']),
            'mayVal' => addslashes($_POST['mayVal']),
            'juneVal' => addslashes($_POST['juneVal']),
            'julyVal' => addslashes($_POST['julyVal']),
            'augVal' => addslashes($_POST['augVal']),
            'sepVal' => addslashes($_POST['sepVal']),
            'octVal' => addslashes($_POST['octVal']),
            'novVal' => addslashes($_POST['novVal']),
            'decVal' => addslashes($_POST['decVal']),
            'platformId' => $this->get_curr_platform_id(),
            'status' => $userStatus,
            'userId' => $userId,
            'coinYear' => addslashes($_POST['coinYear'])
        );
        $sendArr = array(
            'userCoinReview' => $userCoinReview,
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/UserCoinReviewService/addUserCoinReview', $sendArr);
        return json_encode($resultData);
    }

    public function actionMessage_box(){  //留言箱添加
        self::iflogin();
        $resultData = array();

        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $userId = $user_msginfo['idStr'];
        $sendArr = array(
            'userId' => $userId,
            'platformId' => $this->get_curr_platform_id()
        );
        $infoData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getIndividualCenterData', $sendArr);
        if ($infoData['status'] == "1000"  ) {
            $resultData['infoData'] = $infoData['data'];
        }

        //获取所有的用户列表信息
        $sendArr = array(
            'platformId' => $this->get_curr_platform_id(),
            'orgId' => $this->get_curr_org_id()

        );
        $getUserAllData = MyFunction::http_post(HTTP_HOSTS . '/MessageBoxService/getUserByOrgBox', $sendArr);
        if ($getUserAllData['status'] == "1000") {
            $resultData['data'] = $getUserAllData['data'];
        }

        //获取所有留言信息
        $boxArr = array(
            'platformId' => $this->get_curr_platform_id(),
            'sendUserId' => $userId
        );
        $getMessageBoxData = MyFunction::http_post(HTTP_HOSTS . '/MessageBoxService/getMessageBoxPage', $boxArr);
        // MyFunction::sun_p($getMessageBoxData);DIE;

        return $this->render('/personal/message_box',['data' => $getUserAllData['data'],'boxData' => $getMessageBoxData['data'],'resultData' => $resultData]);
    }
    public function actionBox_submit(){//留言箱信息提交
        $user = addslashes($_POST['user']);//按逗号分离字符串
        $user = explode(',',$user);
        $replyContents = addslashes($_POST['replyContents']);

        $messageBoxArr = array(
            "contents" => $replyContents,
            "recUserId" => $user[0],
            "recUserName" => $user[2],
            "recOrgId" => $user[1],
            "recOrgName" => $user[3],//要发送的人*/
            "sendUserId" => $this->get_curr_user_id(),//登录人信息
            "sendUserName" => $this->get_curr_user_name(),
            "sendOrgId" => $this->get_curr_org_id(),
            "sendOrgName" => $this->get_curr_org_name()
        );
        $sendArr = array(
            'platformId' => $this->get_curr_platform_id(),
            "messageBox" => $messageBoxArr
        );
//        MyFunction::sun_p($sendArr);die;

        $resultData = MyFunction::http_post(HTTP_HOSTS . '/MessageBoxService/addMessageBoxBatchCus', $sendArr);
//        MyFunction::sun_p($resultData);die;
        if ($resultData['status'] == "1000") {
            return $this->redirect('/personal/message_box?status=1#grzx');
        } else {
            return $resultData['msg'];
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

    }

    public function actionExam_list(){
        self::iflogin();
        $sendArr = array(
            'userId' => $this->get_curr_user_id(),
            'platformId' => $this->get_curr_platform_id()
        );
        $infoData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getIndividualCenterData', $sendArr);//
//        MyFunction::sun_p($infoData);DIE;
        if ($infoData['status'] == "1000"  ) {
            $resultData['infoData'] = $infoData['data'];
        }
        $arr = array(
            'userId' => $this->get_curr_user_id()
        );
        $rstData = MyFunction::http_post(HTTP_HOSTS . '/OnLineExamService/queryUserExamList', $arr);
//        MyFunction::sun_p($rstData);DIE;
        return $this->render('exam_list',['resultData' => $resultData,'rstData' => $rstData['data']]);
    }
    public function actionExam_question(){  //考试试题
        self::iflogin();
        $idStr = addslashes($_GET['publishIdStr']);
        $id = array(
            'id' => $idStr
        );
        $arr = array(
            'examPublish' => $id
        );
        $rstData = MyFunction::http_post(HTTP_HOSTS . '/OnLineExamService/queryExamPublishOne', $arr);
//        MyFunction::sun_p($rstData);DIE;
        return $this->render('exam_question',['rstData' => $rstData['data']['result']]);
    }
    public function actionExam_question_submit(){
        self::iflogin();
        $sendArr = array(
            'userId' => $this->get_curr_user_id(),
            'regionId' => '',
            'publishId' => addslashes($_POST['publishIdStr']),
            'publishName' => addslashes($_POST['publishName']),
            'leftTime' => addslashes($_POST['leftTime']),
            'onlineExamDetails' => json_decode($_POST['onlineExamDetails'])
        );
        $rstData = MyFunction::http_post(HTTP_HOSTS . '/OnLineExamService/saveExamRecord', $sendArr);
//        return $this->redirect('/personal/exam_list?state='.addslashes($_POST['state']).'&idStr='.$userId.'&publishName='.addslashes($_POST['publishName']));
        if($_POST['yes']==1){
            $state = addslashes($_POST['state']);
            $publishIdStr = addslashes($_POST['publishIdStr']);
            $publishName = addslashes($_POST['publishName']);
            $publishRemark = addslashes($_POST['publishRemark']);
            if($rstData['status']=="1000"){
//                MyFunction::sun_p($rstData);die;
                $onlineExamScoreId = $rstData['data']['onlineExamScoreId'];
                return $this->redirect('/personal/exam_success?score='.$rstData['data']['onlineExamScore']['score'].'&state='.$state.'&publishIdStr='.$publishIdStr.'&publishName='.$publishName.'&onlineExamScoreId='.$onlineExamScoreId.'&publishRemark='.$publishRemark.'');
            }else{
                return $this->redirect('/layouts/error404');
            }

        }
    }
    public function actionExam_success(){ //成功提交数据
        return $this->render('/personal/exam_success');
    }
    public function actionExam_dtls(){  //考试试题
        self::iflogin();
        $arr = array(
            'publishId' => addslashes($_GET['publishIdStr']),
            'userId' => $this->get_curr_user_id(),
            'onlineExamScoreId' => addslashes($_GET['onlineExamScoreId']),
            'platformId' => $this->get_curr_platform_id()
        );
        $rstData = MyFunction::http_post(HTTP_HOSTS . '/OnLineExamService/getOnlineExamDetail', $arr);
//        MyFunction::sun_p($rstData);DIE;
        return $this->render('exam_dtls',['rstData' => $rstData['data']]);
    }

    public function actionPersonal_update(){ //个人信息查询
        self::iflogin();
        $sendArr = array(
            'currOrgId' =>$this->get_curr_platform_id(),
            'platformId' =>$this->get_curr_platform_id()
        );
        $getData = MyFunction::http_post(HTTP_HOSTS . '/DevpPartyerService/getOrgTree', $sendArr);
        $userData = MyFunction::http_post(HTTP_HOSTS . '/AccountService/getUserAddView', $sendArr);
        return $this->render('personal_update',['data'=>$getData['data']['result'],'userdata'=>$userData['data']]);
    }



}