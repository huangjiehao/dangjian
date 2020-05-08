<?php
namespace backend\controllers;

use app\core\back\BaseBackController;
use common\models\MyFunction;
use function PHPSTORM_META\elementType;
use Yii;
use yii\base\Response;
use yii\mutex\MysqlMutex;
use yii\web\Request;


class LessonController extends BaseBackController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionLesson_new_note(){//新建课程笔记
//        $this->iflogin();
        if (isset($_GET['edit'])) {
            $id = $_GET['idStr'];
            $sendArr = array(
                'id' => $id
            );
            $resultData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/getStuNoteCusOne', $sendArr);
            if ($resultData['status'] == '1000') {
                return $this->render('/lesson/lesson_new_note', ['noteDtlsData' => $resultData['data']]);
            }
        }
        return $this->render('/lesson/lesson_new_note');
    }

    //学习中心课程列表
    public function actionCourse_center_list()
    {
//        self::iflogin();
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $userName = $user_msginfo['name'];
        $userId = $user_msginfo['idStr'];
        $platformId = $this->get_curr_platform_id();
        if (isset($_GET['crlmPty'])) {
            $crlmPty = $_GET['crlmPty'];
        }else {
            $crlmPty = "0";
        }
        $sendArr = array(
            'userId' => $userId,
            'crlmPty' => $crlmPty,
            '$platformId' => $platformId
        );
//        MyFunction::sun_p($sendArr);die;
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/getStudyInfoCusByUser', $sendArr);
//        MyFunction::sun_p($resultData);die;
        if ($resultData['status'] == "1000") {
            return $this->render('/lesson/lesson_list', ['courseData' => $resultData]);
        } else {
            return $this->render('/layouts/errorMsg', ['data' => $resultData['data']]);
        }
    }


    //提交笔记
    public function actionNote_submit() {
        self::iflogin();
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $userName = $user_msginfo['name'];
        $userId = $user_msginfo['idStr'];
        $platformId = $this->get_curr_platform_id();
        $tilte = $_POST['tilte'];
        $content = $_POST['content'];
//        MyFunction::sun_p($_POST);die;
        $post=$_POST;
        $sendArr=$this->init_send_arr($post);
        $sendArr['name']=$sendArr['tilte'];
        $sendArr['content']=stripslashes($sendArr['content']);
        $sendArr['userId']=$userId;
        $sendArr['userName']=$userName;
        $sendArr['platformId']=$platformId;
        $sendArr['id']=$_POST['idStr'];
        $arr['stuNote']=$sendArr;
//        MyFunction::sun_p($sendArr);die;
        $pageStatus = self::init_submit($post, $arr, '/LearningService/updateStuNoteCus', '/LearningService/addStuNoteCus');
        return $this->redirect('/lesson/lesson_new_note?status='.$pageStatus);

    }

    //学习中心笔记列表
    public function actionLesson_note() {
        $this->iflogin();
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $userName = $user_msginfo['name'];
        $userId = $user_msginfo['idStr'];
        $pageNumber = 1;
        $limitCounts =999;
        $platformId = $this->get_curr_platform_id();
        $sendArr = array(
            'limitCounts' => $limitCounts,
            'platformId' => $platformId,
            'userId' => $userId,
            'pageNumber' => $pageNumber
        );
//        MyFunction::sun_p($sendArr);
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/getStuNotePage', $sendArr);
//        MyFunction::sun_p($resultData);die;
        if ($resultData['status'] == "1000") {
            return $this->render('/lesson/lesson_note', ['noteData' => $resultData,  'postIndex' => $pageNumber, 'postLimitCounts' => $limitCounts]);
        }
    }

    //学习中心删除一条笔记
    public function actionLesson_note_remove() {
        $getId = $_GET['idStr'];
        $id = array(
            'id' => $getId
        );
//        MyFunction::sun_p($id);DIE;
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/removeStuNoteCus', $id);
        if ($resultData['status'] == "1000") {
            return $this->redirect('/lesson/lesson_note');
        } else {
            var_dump($resultData);
        }
    }

}