<?php
namespace backend\controllers;
use app\core\back\BaseBackController;
use common\models\MyFunction;



class NewpersonalController extends BaseBackController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionPersonal(){
//        self::iflogin();
        if ($this->iflogin()) {
            return $this->redirect($this->loginUrl);
        }
        /*$session = \Yii::$app->session;
        $username = $session->get('pre_username');
//        var_dump($username);die;
        if (empty($username)) {
            return $this->redirect($this->loginUrl);
        }*/
        $userId ='userId='.$this->get_curr_user_id();
        $resultData=null;
        $sendArr = array(
            'userId' => $this->get_curr_user_id(),
            'platformId' => $this->get_curr_platform_id()
        );
        $infoData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getIndividualCenterData', $sendArr);
        if (isset($infoData['status'])&&$infoData['status'] == "1000"  ) {
            $resultData['infoData'] = $infoData['data'];
        }
        $birthdayData = MyFunction::http_get(HTTP_HOSTS . '/BirthdayCardService/sendBirthdayCard', $userId);
//        MyFunction::sun_p($birthdayData);die;
        $param=array(
            'loginUserId'=>$this->get_curr_user_id()
        );
        $arngmtData=MyFunction::http_post(HTTP_HOSTS.'/PersonalIssueService/getArngmtCount', $param);
        if($arngmtData['status']=='1000'){
            $resultData['arngmtData'] = $arngmtData['data'];
        }
//        MyFunction::sun_p($resultData);die;
        return $this->render('personal',['resultData' => $resultData,'birthdayData' => $birthdayData['data']]);
    }
    //党员画像
    public function actionPortrait(){
//        self::iflogin();
//        if ($this->iflogin()) {
////            return $this->redirect($this->loginUrl);
////        }
////        /*$session = \Yii::$app->session;
////        $username = $session->get('pre_username');
//////        var_dump($username);die;
////        if (empty($username)) {
////            return $this->redirect($this->loginUrl);
////        }*/
////        $userId ='userId='.$this->get_curr_user_id();
////        $resultData=null;
////        $sendArr = array(
////            'userId' => $this->get_curr_user_id(),
////            'platformId' => $this->get_curr_platform_id()
////        );
////        $infoData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getIndividualCenterData', $sendArr);
////        if (isset($infoData['status'])&&$infoData['status'] == "1000"  ) {
////            $resultData['infoData'] = $infoData['data'];
////        }
////        $birthdayData = MyFunction::http_get(HTTP_HOSTS . '/BirthdayCardService/sendBirthdayCard', $userId);
//////        MyFunction::sun_p($birthdayData);die;
////        $param=array(
////            'loginUserId'=>$this->get_curr_user_id()
////        );
////        $arngmtData=MyFunction::http_post(HTTP_HOSTS.'/PersonalIssueService/getArngmtCount', $param);
////        if($arngmtData['status']=='1000'){
////            $resultData['arngmtData'] = $arngmtData['data'];
////        }
//        MyFunction::sun_p($resultData);die;
        return $this->render('portrait');
    }

    public function actionPortrait_info(){
    //        self::iflogin();
//        if ($this->iflogin()) {
////            return $this->redirect($this->loginUrl);
////        }
////        /*$session = \Yii::$app->session;
////        $username = $session->get('pre_username');
//////        var_dump($username);die;
////        if (empty($username)) {
////            return $this->redirect($this->loginUrl);
////        }*/
////        $userId ='userId='.$this->get_curr_user_id();
////        $resultData=null;
////        $sendArr = array(
////            'userId' => $this->get_curr_user_id(),
////            'platformId' => $this->get_curr_platform_id()
////        );
////        $infoData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getIndividualCenterData', $sendArr);
////        if (isset($infoData['status'])&&$infoData['status'] == "1000"  ) {
////            $resultData['infoData'] = $infoData['data'];
////        }
////        $birthdayData = MyFunction::http_get(HTTP_HOSTS . '/BirthdayCardService/sendBirthdayCard', $userId);
//////        MyFunction::sun_p($birthdayData);die;
////        $param=array(
////            'loginUserId'=>$this->get_curr_user_id()
////        );
////        $arngmtData=MyFunction::http_post(HTTP_HOSTS.'/PersonalIssueService/getArngmtCount', $param);
////        if($arngmtData['status']=='1000'){
////            $resultData['arngmtData'] = $arngmtData['data'];
////        }
//        MyFunction::sun_p($resultData);die;
        return $this->render('portraitInfo');
    }
}