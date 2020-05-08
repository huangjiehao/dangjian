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

class UserController extends BaseBackController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    //党群服务修改个人信息页面
    public function actionUpdate_user(){
        return $this->render('update_user');
    }

    public function actionUser_add()
    {
        $sendArr = array(
            'orgId' => $this->get_curr_org_id(), //组织id
            'platformId' => $this->get_curr_platform_id(), //平台id
        );
//        MyFunction::sun_p( $sendArr);DIE;
        $resultData = array();
        if (isset($_GET['id'])) {
            $pre_userId = $this->get_curr_user_id();  //268280939841458177
            $userId ='id='.$pre_userId;  //id=268280939841458177

            $singleData = MyFunction::http_get(HTTP_HOSTS . '/AccountService/getUserOneById', $userId); //$userId对应信息
            if ($singleData['status'] == 1000) {
                $resultData['data'] = $singleData['data'];
            }
        } else {
            $allowAdd = MyFunction::http_get(HTTP_HOSTS . '/AccountService/isAllowAddUser', 'platformId=' . $this->get_curr_platform_id());
//            MyFunction::sun_p( $allowAdd);die;
            $resultData['allowAdd'] = $allowAdd['data'];
//            MyFunction::sun_p( $resultData['allowAdd']);die;
        }
        $getData = MyFunction::http_post(HTTP_HOSTS . '/AccountService/getUserAddView', $sendArr);
//        MyFunction::sun_p($getData);die;
//
        if ($getData['status'] == 1000) {
            $resultData['select'] = $getData['data'];
//            MyFunction::sun_p( $resultData['select'] );die;
        }
//        MyFunction::sun_p($resultData);die;
        return $this->render('user_add', ['data' => $resultData]);
    }


    public function actionUser_submit()  //用户提交
    {
        $post = $_POST;  //传输方式
        $arr = $this->init_send_arr($post);
//        MyFunction::sun_p($post);die;

//        if($_POST['isShow']==1){
//            if (isset($post['password']) && !empty($post['password'])) {
//                $arr['password'] = md5($post['password']);
//            }else{
//                $arr['password'] = md5('1234567890');
//            }
//        }else{
//            $arr['password'] = $this->get_curr_user_psd();
//        }
        $arr['img']=stripslashes($arr['img']);

        $arr['birthday']=!empty($arr['birthday']) ? strtotime($arr['birthday']):$arr['birthday'];
        $arr['joinTime']=!empty($post['joinTime']) ? strtotime(addslashes($post['joinTime'])) : addslashes($post['joinTime']);
//        MyFunction::sun_p($arr);DIE;

        $pageStatus = self::init_submit($post, $arr, '/AccountService/updateUser', '/AccountService/updateUser');
        if($pageStatus==1||$pageStatus==2){
            return $this->redirect('/user/user_add?status=1&edit=1&id='.$arr['id']);
//            return $this->redirect('/account/login_out');
        }else{
            return $this->redirect('/user/user_add?status='.$pageStatus);
        }
    }

    public function actionUser_update_pwd(){
        return $this->render('user_update_pwd');
    }
    public function actionUser_update_pwd_submit()
    {
        $post = $_POST;
//        MyFunction::sun_p($post);die;
        $arr = array(
            'id' => $this->get_curr_user_id(),
            'loginUserId'=>$this->get_curr_user_id(),
            'loginUserName'=>$this->get_curr_user_name(),
            'loginUserOrgId'=>$this->get_curr_org_id(),
            'loginUserOrgName'=>$this->get_curr_org_name()
        );

        if (isset($post['password']) && !empty($post['password'])) {
            $arr['password'] = addslashes(md5($post['password']));
        }
        $pageStatus = self::init_submit($post, $arr, '/AccountService/updateUser', '/AccountService/updateUser');
        if($pageStatus==1||$pageStatus==2){
            return $this->redirect('/account/login_out');
        }else{
            return $this->redirect('/user/user_update_pwd?status='.$pageStatus);
        }
    }

}