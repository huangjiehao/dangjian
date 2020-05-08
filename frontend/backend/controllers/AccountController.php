<?php

namespace backend\controllers;

use app\core\back\BaseBackController;
use common\models\Fang;
use common\models\MyFunction;
use Yii;
use yii\base\Response;
use yii\mutex\MysqlMutex;
use yii\web\Request;

class AccountController extends BaseBackController
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    //默认页面
    public function actionDef()
    {
        return $this->render('def');
    }

    //升级页面
    public function actionUp()
    {
        return $this->redirect('/upgrade.html');
    }
    public function actionStudy_online()
    {
        return $this->render('study_online');
    }

    public function actionIndex(){ //新版首页
        $resultData = array();
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $pre_userId = $user_msginfo['idStr'];

        $pages = array(
            "pageNumber" => 1,
            "limitCounts" => 1
        );
        $users = array(
            "platformId" => $this->get_curr_platform_id(),
            "orgId" => $this->get_curr_org_id(),
            "voteParam" => $pages
        );
//        echo json_encode($users);die;
        $picData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getIndexPortalInfo', $users);//getIndexPortalInfo //getIndexPortalChannel
//        var_dump($picData);die;
        if ($picData['status'] == "1000") {
            $resultData['picData'] = $picData['data'];
        }

        $starArr = array(
            'orgLevel' => 2,
            'platformId' => $this->get_curr_platform_id()
        );
        $starData = MyFunction::http_post(HTTP_HOSTS . '/AccountService/getOrgAll', $starArr);
//        MyFunction::sun_p($starData);die;

        $mapArr =array(
            'limitCounts'=>20,
            'pageNumber'=>0
        );
        $mapData=MyFunction::http_post(HTTP_HOSTS . '/MapInformation/getPageMap',json_encode($mapArr)) ;
//        MyFunction::sun_p($mapData);die;
        if($mapData['status']=="1000"){
            $resultData['mapData']=$mapData['data'];
        }
//        echo json_encode($resultData['mapData']);die;
        if (isset($user_msginfo['idStr'])) {
            $courseArr = array(
                'userId' => $pre_userId,
                'platformId' => $this->get_curr_platform_id()
            );
//            MyFunction::sun_p($courseArr);die;
            $courseData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getIndividualCenterData', $courseArr);
        } else {
            $courseArr = array(
                'platformId' => $this->get_curr_platform_id()
            );
            $courseData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/getStudyInFoPage', $courseArr);
        }
//        MyFunction::sun_p($picData);die;
        if ($starData['status'] == "1000") {
            $resultData['starData'] = $starData['data'];
        }

        $resultData['starData'] = $starData['data'];

        return $this->render('index', ['resultData' => $resultData, 'courseData' => $courseData['data']]);
    }
    public function actionIndex_ysd(){ //新版首页
        $resultData = array();
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $pre_userId = $user_msginfo['idStr'];

        $pages = array(
            "pageNumber" => 1,
            "limitCounts" => 1
        );
        $users = array(
            "platformId" => $this->get_curr_platform_id(),
            "orgId" => $this->get_curr_org_id(),
            "voteParam" => $pages
        );
        $picData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getIndexPortalInfo', $users);//getIndexPortalInfo //getIndexPortalChannel
        if ($picData['status'] == "1000") {
            $resultData['picData'] = $picData['data'];
        }

        $starArr = array(
            'orgLevel' => 2,
            'platformId' => $this->get_curr_platform_id()
        );
        $starData = MyFunction::http_post(HTTP_HOSTS . '/AccountService/getOrgAll', $starArr);
//        MyFunction::sun_p($picData);die;
        if (isset($user_msginfo['idStr'])) {
            $courseArr = array(
                'userId' => $pre_userId,
                'platformId' => $this->get_curr_platform_id()
            );
//            MyFunction::sun_p($courseArr);die;
            $courseData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getIndividualCenterData', $courseArr);
        } else {
            $courseArr = array(
                'platformId' => $this->get_curr_platform_id()
            );
            $courseData = MyFunction::http_post(HTTP_HOSTS . '/LearningService/getStudyInFoPage', $courseArr);
        }
//        MyFunction::sun_p($picData);die;
        if ($starData['status'] == "1000") {
            $resultData['starData'] = $starData['data'];
        }

        $resultData['starData'] = $starData['data'];

        return $this->render('index_ysd', ['resultData' => $resultData, 'courseData' => $courseData['data']]);
    }

    //登陆页面
    public function actionLogin()
    {
        return $this->render('/account/login');
    }

    public function actionLogin_submit()
    {
        $data = \Yii::$app->request->post();
        $users = array(
            'loginName' => $data['username'],
            'password' => md5($data['password']),
            'platformId' => $this->get_curr_platform_id(),
            'qryOneLevle' => 1,
            'isFrontend' => 1
        );
        $res = MyFunction::http_post(HTTP_HOSTS . '/AccountService/userLogin', $users);
//            return json_encode($res);
        if (!empty($res)) {
            if ($res['status'] == '1000') {
                $hasPrivilege = 0;
                $user_privilege_tree = '';
                if ($res['data']['hasPrivilege'] == 1) {
                    $user_privilege_tree = $res['data']['privilegeTree'];
                    $hasPrivilege = 1;
                }
                //登录成功；设置session用户名；设置session的生命周期；
                $lifetime = 3600 * 6 * 4;
//                session_set_cookie_params($lifetime);
                $session = \Yii::$app->session;
                $currPlatformId = $res['data']['user']['platformId'];
                $user_msginfo = $res['data']['user'];
                $username = $res['data']['user']['name'];
                $userId = $res['data']['user']['idStr'];
                $roleId = $res['data']['user']['userRoleIds'];
                $currOrgId = $res['data']['user']['orgIdStr'];
                $currOrgName = $res['data']['user']['orgName'];
                //设置session
                $session->set('user_msginfo', json_encode($user_msginfo));
                $session->set('pwd', md5($data['password']));
                $session->set('currPlatformId', $currPlatformId);
                $session->set('pre_username', $username);
                $session->set('pre_userId', $userId);
                $session->set('currOrgId', $currOrgId);
                $session->set('currOrgName', $currOrgName);
                $session->set('pre_roleId', $roleId);
//                return json_encode($username);
                $session->set('user_privilege_tree-font', $user_privilege_tree);
                $session->set('hasPrivilege', $hasPrivilege);
                $cookies = \Yii::$app->response->cookies;
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'pre_username',
                    'expire' => time() + 3600,
                ]));
                return 1;
            }
        }
        return 2;
    }

    public function actionLogin_out()
    {
        $session = \Yii::$app->session;
        $session->set('user_msginfo', null);
        $session->set('pwd', null);
        $session->set('currPlatformId', null);
        $session->set('pre_username', null);
        $session->set('pre_userId', null);
        $session->set('currOrgId', null);
        $session->set('currOrgName', null);
        $session->set('user_privilege_tree-font', null);
        $session->set('hasPrivilege', null);
        return $this->redirect('/account/index');
    }

    //用户列表页
    public function actionUser()
    {
        $pageNumber = 1;
        $limitCounts = 10;
        $name = null;
        //条件查询
//      var_dump($_POST['postObj']);die;
        $postObjStr = addslashes($_POST['postObj']);
        if (isset($postObjStr)) {
            $postObj = json_decode($postObjStr, true);
            $pageNumber = $postObj['postIndex'];
            $name = $postObj['name'];
        }

        $sendArr = array(
            'name' => $name,
            'pageNumber' => $pageNumber,      //当前页码（起始数为1），选填（不填默认为1）
            'limitCounts' => $limitCounts      //每页条数，选填（不填默认为10）
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/AccountService/getUserPage', $sendArr);
        //$tsArr = '{"data":{"apiStatus":1000,"counts":3,"listUser":[{"id":"432","name":"McLaughlin","account":"aaaa","cellphone":"12","gender":"1","dept":"2","job":"awd","entryDate":"1512446064","createDate":"1512446064","idStr":"432"},{"id":"4534","name":"fe","account":"we","cellphone":"54","gender":"2","dept":"4","job":"fe","entryDate":"1512446064","createDate":"1512446064","idStr":"4534"}]},"msg":"SUCCESS","status":1000}';
        //$resultData=json_decode($tsArr, true);
        if ($resultData['status'] == "1000") {
            return $this->render('user', ['data' => $resultData, 'postIndex' => $pageNumber, 'postLimitCounts' => $limitCounts, 'sendArr' => $sendArr]);
        } else {
            var_dump($resultData);
        }
    }


    public function actionPro_index(){ //新版首页
        return $this->render('pro_index');
    }

}
