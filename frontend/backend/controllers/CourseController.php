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

class CourseController extends BaseBackController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    //课程列表
    public function actionCourse_list()
    {
        if ($this->iflogin()) {             return $this->redirect($this->loginUrl);         };
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $pre_username = $user_msginfo['name'];
        $pre_userId = $user_msginfo['idStr'];
        $userId ='userId='.$pre_userId;

        $pageNumber = 1;
        $limitCounts = 100;
        $name = null;
        if (isset($_GET['coursetypeId'])) {
            $coursetypeId = addslashes($_GET['coursetypeId']);
        }else {
            $coursetypeId = "";
        }
        if (isset($_POST['searchName'])) {
            $searchName = $_POST['searchName'];
        }else {
            $searchName = "";
        }
        //条件查询
        $sendArr = array(
            'name' => $searchName,
            'channelBraId' => $coursetypeId,
            'pageNumber' => $pageNumber,      //当前页码（起始数为1），选填（不填默认为1）
            'limitCounts' => $limitCounts,     //每页条数，选填（不填默认为10）
            'platformId' => $this->get_curr_platform_id(),
            'loginUserId' => $this->get_curr_user_id()
        );
        $sendArr = self::init_page_params($sendArr);//TODO 注意：这个是分页必须的
        $platformIdArr = array(
            'platformId' => $this->get_curr_platform_id()
        );
        $coursetypeList = MyFunction::http_post(HTTP_HOSTS . '/LearningService/getStudyChannelBraCusAll', $platformIdArr);

        $birthdayData = MyFunction::http_get(HTTP_HOSTS . '/BirthdayCardService/sendBirthdayCard', $userId);

        $resultData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/getStudyInFoPage', $sendArr);
        $pageCounts = $resultData['data']['counts']; //TODO 注意：这个是分页必须的
        return $this->render('course_list', ['data' => $resultData, 'coursetypeList' => $coursetypeList['data'],'birthdayData' => $birthdayData['data'],'page' => self::init_page_result($pageCounts)]);
    }


    //课程详情
    public function actionCourse_dtls()
    {
        if ($this->iflogin()) {             return $this->redirect($this->loginUrl);         };
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $pre_username = $user_msginfo['name'];
        $pre_userId = $user_msginfo['idStr'];
        $pageNumber = 1;
        $limitCounts = 5;
        if(!isset($_GET['idStr'])){
            var_dump("请输入id");
        }
        $courseId = addslashes($_GET['idStr']);
        $courseName = addslashes($_GET['courseName']);
//        MyFunction::sun_p($courseName);die;
        $idArr  = array(
            'id' => $courseId,
            'userId' => $pre_userId,
            'platformId' => $this->get_curr_platform_id(),
        );
        $commArr = array(
//            'state'=>1,
            'limitCounts' => $limitCounts,
            'infoId' => $courseId,
            'pageNumber' => $pageNumber,
            'platformId' => $this->get_curr_platform_id()
        );
        $sendArr = array(
            'pageNumber' => $pageNumber,      //当前页码（起始数为1），选填（不填默认为1）
            'limitCounts' => $limitCounts,     //每页条数，选填（不填默认为10）
            'platformId' => $this->get_curr_platform_id(),
        );
        $courseListData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/getStudyInFoPage', $sendArr);
//        MyFunction::sun_p($courseListData);DIE;
        $commentData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/getStudyCommentPage', $commArr);
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/getStudyInFoCusOne', $idArr);
//        MyFunction::sun_p($courseListData);DIE;
        if ($resultData['status'] == 1000) {
            return $this->render('/course/course_dtls', ['courseListData' => $courseListData, 'dtlsData' => $resultData['data'], 'commentData' => $commentData['data'], 'courseId' => $courseId, 'courseName' => $courseName]);
        }else{
            var_dump($resultData);
        }
    }

    //评论心得
    public function actionCourse_comm_submit()
    {
        if ($this->iflogin()) {             return $this->redirect($this->loginUrl);         };
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $pre_userName = $user_msginfo['name'];
        $pre_userId = $user_msginfo['idStr'];
        $value = $_POST;
        $courseId = addslashes($value['courseId']);
        $courseName = addslashes($value['courseName']);
        $commTitle = addslashes($value['commTitle']);
        $commentBody = addslashes($value['commentBody']);
        $courseCommArr = array(
            "name" => $commTitle,
            "content" => $commentBody,
            "userId" => $pre_userId,
            "userName" => $pre_userName,
            "infoId" => $courseId,
            "infoName"=>$value['courseName'],
            "courseName" => $courseName,
            'platformId' => $this->get_curr_platform_id()
        );
//        return json_encode($courseCommArr);
        $editArr = array(
            "studyComment" => $courseCommArr
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/addStudyCommentCus', $editArr);
        if ($resultData['status'] == "1000") {
            return json_encode($resultData['data']);
        }
    }

    //视频播放页面
    public function actionVideo_player()
    {
//        MyFunction::sun_p('ddd');die;
        if ($this->iflogin()) {             return $this->redirect($this->loginUrl);         };
        $pageNumber = 1;
        $limitCounts = 5;
        $value = $_POST;
        $courseId = addslashes($_GET['courseId']);
        if(!isset($_GET['idStr'])){
            var_dump("请输入id");//视频id
        }
        $arr  = array(
            'id' => $courseId,
            'platformId' => $this->get_curr_platform_id()
        );
        $idArr  = array(
            'id' => addslashes($_GET['idStr']),
            'loginUserId' => $this->get_curr_user_id()
        );
        $commArr = array(
            'limitCounts' => $limitCounts,
            'infoId' => $courseId,
            'pageNumber' => $pageNumber,
            'platformId' => $this->get_curr_platform_id()
        );
//        MyFunction::sun_p($commArr);DIE;
        $commentData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/getStudyCommentPage', $commArr);
        $resData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/getStudyResourceCusOne', $idArr);
//        MyFunction::sun_p($resData);DIE;
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/getStudyInFoCusOne', $arr);
//        MyFunction::sun_p($resultData);DIE;
        if ($resultData['status'] == 1000) {
            return $this->render('/course/video_player', ['commentData' => $commentData['data'], 'dtlsData' => $resultData['data'], 'resData' => $resData['data'], 'courseId' => $courseId]);
        }else{
            var_dump($resultData);
        }
    }

    //答题页面
    public function  actionCourse_question() {
        if ($this->iflogin()) {             return $this->redirect($this->loginUrl);         };
        if(!isset($_GET['idStr'])){
            var_dump("请输入id");//视频id
        }
        $resourseId = addslashes($_GET['idStr']);
        $idArr  = array(
            'resourceId' => $resourseId,
            'platformId' => $this->get_curr_platform_id()
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/getStudyQuestionCusAll', $idArr);
//        MyFunction::sun_p($resultData);die;
        if ($resultData['status'] == 1000) {
            return $this->render('/course/course_question', ['questionData' => $resultData['data'], 'resourseId' => $resourseId]);
        }
    }

    //答题提交答案
    public function  actionQuestion_submit() {

        if ($this->iflogin()) {             return $this->redirect($this->loginUrl);         };
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $pre_userName = $user_msginfo['name'];
        $pre_userId = $user_msginfo['idStr'];
        $value = $_POST;
        $resourceId = addslashes($value['resourseId']);
        $courseId = addslashes($value['courseId']);
        $idArr  = array(
            'resourceId' => $resourceId,
            'infoId' => $courseId,
            'platformId' => $this->get_curr_platform_id(),
            'userId' => $pre_userId
        );
//        return json_encode($idArr);
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/updateStudyQuestionByUserId', $idArr);
        if ($resultData['status'] == 1000) {
            return json_encode($resultData['data']);
        }
    }

    //添加学习任务（参加学习）
    public function actionPersonage_stu_add() {
        if ($this->iflogin()) {             return $this->redirect($this->loginUrl);         };
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $pre_userName = $user_msginfo['name'];
        $pre_userId = $user_msginfo['idStr'];
        if (isset($_GET['crlmPty'])) {
            $crlmPty = addslashes($_GET['crlmPty']);
        }else {
            $crlmPty = "0";
        }
        $infoId = addslashes($_GET['courseId']);
        $infoName = addslashes($_GET['courseName']);
        $resourceId = addslashes($_GET['idStr']);
        $arr = array(
            'infoId' => $infoId,
            'infoName' => $infoName,
            'userId' => $pre_userId,
            'userName' => $pre_userName,
            'crlmPty' => $crlmPty,
            'platformId' => $this->get_curr_platform_id()
        );
        $sendArr = array(
            'stuPersonage' => $arr
        );
//        MyFunction::sun_p($sendArr);die;
//        $resultData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/addStuPersonageCus', $sendArr);
//        MyFunction::sun_p('$infoId');die;
        return $this->redirect('/course/video_player?courseId='. $infoId .'&idStr='. $resourceId);
    }

    //学习中心页面
    public function actionStudy_online(){
//        if ($this->iflogin()) {             return $this->redirect($this->loginUrl);         };
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $pre_userName = $user_msginfo['name'];
        $pre_userId = $user_msginfo['idStr'];
        $sendArr = array(
            'userId' => $pre_userId,
            'platformId' => $this->get_curr_platform_id()
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/getStudyInfoNewestCus', $sendArr);
//        MyFunction::sun_p($resultData);die;
        if ($resultData['status'] == '1000') {
            return $this->render('/course/study_online', ['resultData' => $resultData['data']]);
        }
    }


    //活动相册页面
    //活动相册列表
    public function actionActivity_album_list(){
        return $this->render('/course/activity_album_list');
    }
}
