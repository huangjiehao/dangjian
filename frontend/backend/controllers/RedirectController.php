<?php
namespace backend\controllers;
use app\core\back\BaseBackController;
use common\models\Fang;
use common\models\MyFunction;
use Yii;

class RedirectController extends BaseBackController
{
    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionRedirect()
    {
        if(isset($_GET['code'])){
            $authorizedCode = 'authorizedCode=' . addslashes($_GET['code']).'&platformId='.$this->get_curr_platform_id();
            $newData = MyFunction::http_get(HTTP_HOSTS . '/AccountService/uniDirect', $authorizedCode);//联通oa跳转到党建系统（自动登录）
            //MyFunction::sun_p($newData);die;
            $sendArr = array(
                'currOrgId' =>$this->get_curr_platform_id(),
                'platformId' =>$this->get_curr_platform_id()
            );
            $getData = MyFunction::http_post(HTTP_HOSTS . '/DevpPartyerService/getOrgTree', $sendArr);
            if(isset($newData['data']['result']['orgId'])){  //判断是否是第一次登录
                if($newData['data']['result']['orgId']==0){
                    return $this->render('/redirect/redirect',['data'=>$getData['data']['result'],'newdata'=>$newData['data']['result']]);
                }else{  //已经登录过了，默认去登录
                    $login_info = $newData['data']['result'];
                    $orgId = $login_info['orgId'] ;
                    $loginName =$login_info['loginName'];
                    $password =$login_info['password'];
                    $users = array(
                        'loginName' => $loginName,
                        'password' => $password,
                        'platformId' => $this->get_curr_platform_id(),
                        'qryOneLevle' => 1,
                        'isFrontend' => 1
                    );
                    $res = MyFunction::http_post(HTTP_HOSTS . '/AccountService/userLogin', $users);
                    if (!empty($res)) {
                        if ($res['status'] == '1000') {
                            //MyFunction::sun_p($res) ;die;
                            $hasPrivilege = 0;
                            $user_privilege_tree = '';
                            if ($res['data']['hasPrivilege'] == 1) {
                                $user_privilege_tree = $res['data']['privilegeTree'];
                                $hasPrivilege = 1;
                            }
                            //登录成功；设置session用户名；设置session的生命周期；
                            $lifetime = 3600 * 6 * 4;
                            session_set_cookie_params($lifetime);
                            $session = \Yii::$app->session;
                            $currPlatformId = $res['data']['user']['platformId'];
                            $user_msginfo = $res['data']['user'];
                            $username = $res['data']['user']['name'];
                            $userId = $res['data']['user']['idStr'];
                            $currOrgId = $res['data']['user']['orgId'];
                            $currOrgName = $res['data']['user']['orgName'];
                            //设置session
                            $session->set('user_msginfo', json_encode($user_msginfo));
                            $session->set('pwd', $password);
                            $session->set('currPlatformId', $currPlatformId);
                            $session->set('pre_username', $username);
                            $session->set('pre_userId', $userId);
                            $session->set('currOrgId', $currOrgId);
                            $session->set('currOrgName', $currOrgName);

                            $session->set('user_privilege_tree-font', $user_privilege_tree);
                            $session->set('hasPrivilege', $hasPrivilege);
                            $cookies = \Yii::$app->response->cookies;
                            $cookies->add(new \yii\web\Cookie([
                                'name' => 'pre_username',
                                'expire' => time() + 3600,
                            ]));
                            return $this->redirect('/account/index#首页');
                        }
                    }
                    return $this->redirect('/layouts/error404.php');
                }

            }else{
                return $this->render('/redirect/redirect',['data'=>$getData['data']['result'],'newdata'=>$newData['data']['result']]);
            }

        }

        if(isset($_GET['loginName'])){
            $arr = array(
                'id' => addslashes($_GET['idStr']),
                'orgId' => addslashes($_GET['orgId']),
                'loginName' => addslashes($_GET['loginName']),
                'orgLevel' => 1
            );
            $getData = MyFunction::http_post(HTTP_HOSTS . '/AccountService/updateUser', $arr);
            if($getData['status'] == "1000"){
                $data = \Yii::$app->request->post();
                $users = array(
                    'loginName' => addslashes($_GET['loginName']),
                    'password' => addslashes($_GET['password']),
                    'platformId' => $this->get_curr_platform_id()
                );
                $res = MyFunction::http_post(HTTP_HOSTS . '/AccountService/userLogin', $users);
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
                        session_set_cookie_params($lifetime);
                        $session = \Yii::$app->session;
                        $currPlatformId = $res['data']['user']['platformId'];
                        $user_msginfo = $res['data']['user'];
                        $username = $res['data']['user']['name'];
                        $userId = $res['data']['user']['idStr'];
                        $currOrgId = $res['data']['user']['orgId'];
                        $currOrgName = $res['data']['user']['orgName'];
                        //设置session
                        $session->set('user_msginfo', json_encode($user_msginfo));
                        $session->set('pwd', md5($_GET['password']));
                        $session->set('currPlatformId', $currPlatformId);
                        $session->set('pre_username', $username);
                        $session->set('pre_userId', $userId);
                        $session->set('currOrgId', $currOrgId);
                        $session->set('currOrgName', $currOrgName);

                        $session->set('user_privilege_tree-font', $user_privilege_tree);
                        $session->set('hasPrivilege', $hasPrivilege);
                        $cookies = \Yii::$app->response->cookies;
                        $cookies->add(new \yii\web\Cookie([
                            'name' => 'pre_username',
                            'expire' => time() + 3600,
                        ]));
                        return $this->redirect('/account/index#index');
                    }
                }
                return $this->redirect('/layouts/error404.php');
            }
        }

    }

}