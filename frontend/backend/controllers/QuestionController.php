<?php
namespace backend\controllers;
use app\core\back\BaseBackController;
use common\models\MyFunction;


class QuestionController extends BaseBackController
{
    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionQuestion_list(){//问卷调查信息列表
        self::iflogin();
        $session = \Yii::$app->session;
        $user_info = json_decode($session->get('user_info'), true);
        $roleId = $user_info['userRoleIds'];
        $publishName = isset($_GET['name']) ? addslashes($_GET['name']) : null;
        $arr = array(
            "state" => addslashes($_GET['state']),
            "publishName" => $publishName,
//            'orgId' => $this->get_curr_org_id()
        );
        $sendArr = array(
            'orgId' => $this->get_curr_org_id(),
            'platformId' => $this->get_curr_platform_id(),
            'roleId' =>$roleId,
            "questionPublish" => $arr,
        );
//        $publishName = isset($_GET['name']) ? addslashes($_GET['name']) : null;
//        $sendArr = array(
////            "state" => addslashes($_GET['state']),
//            "publishName" => $publishName,
//            'orgId' => $this->get_curr_org_id(),
//            'userId' => $this->get_curr_user_id(),
//            'roleId' => $this->get_curr_role_id(),
//            'platformId' => $this->get_curr_platform_id()
//        );
//        MyFunction::sun_p($sendArr);
        $sendArr = self::init_page_params($sendArr);//TODO 注意：这个是分页必须的
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/QuestionSurveyService/queryQuestionPublishList', json_encode($sendArr));
//        MyFunction::sun_p($resultData);DIE;
        if ($resultData['status'] == "1000") {
            $pageCounts = $resultData['data']['counts'];
            return $this->render('question_list', ['data' => $resultData['data'], 'page' => self::init_page_result($pageCounts)]);
        }else{
            return $this->redirect('/layouts/error404');
        }
    }
    public function actionQuestion_add(){//添加问卷调查信息
        $id = addslashes($_GET['publishIdStr']);
        $editArr = array(
            'id' => $id
        );
        $sendArr = array(
            "questionPublish" => $editArr
        );
        $rstData = MyFunction::http_post(HTTP_HOSTS . '/QuestionSurveyService/queryQuestionPublishOne', $sendArr); //根据用户id和问卷id预览提交后的问卷
//        MyFunction::sun_p($rstData);DIE;
        if ($rstData['status'] == '1000') {
            return $this->render('question_add', ['rstData' => $rstData['data']['result']]);
        }else if($rstData['status'] == '9999'){
            return $this->render('/layouts/errorMsg', ['data' => $rstData['data']]);
        } else {
            return $this->redirect('/layouts/error404');
        }
    }
    public function actionQuestion_submit(){//提交问卷调查信息
        self::iflogin();
        $sendArr = array(
            'userId' => $this->get_curr_user_id(),
            'regionId' => '',
            'orgId' => $this->get_curr_org_id(),
            'publishId' => addslashes($_POST['publishIdStr']),
            'publishName' => addslashes($_POST['publishName']),
            'platformId' => $this->get_curr_platform_id(),
            'questionSurveyDetails' => json_decode($_POST['onlineExamDetails'])
        );
//        MyFunction::sun_p($sendArr);
        $rstData = MyFunction::http_post(HTTP_HOSTS . '/QuestionSurveyService/saveQuestionRecord', $sendArr);
//        MyFunction::sun_p($rstData);die;
        if($_POST['yes']==1){
            $state = addslashes($_POST['state']);
            $publishIdStr = addslashes($_POST['publishIdStr']);
            $publishName = addslashes($_POST['publishName']);
            $publishRemark = addslashes($_POST['publishRemark']);
            if($rstData['status']=="1000"){
                return $this->redirect('/question/question_success?publishIdStr='.$publishIdStr.'&publishName='.$publishName.'&publishRemark='.$publishRemark.'');
            }else{
                return $this->redirect('/layouts/error404');
            }

        }
    }
    public function actionQuestion_success(){ //成功提交数据
        return $this->render('/question/question_success');
    }

}
