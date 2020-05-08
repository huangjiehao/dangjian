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

class MailboxController extends BaseBackController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    //书记信箱页面
    public function actionMailbox(){
        return $this->render('mailbox');
    }

    //答题提交答案
    public function  actionMailbox_submit() {

        if ($this->iflogin()) {             return $this->redirect($this->loginUrl);         };
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $post=$_POST;
        $sendArr = $this->init_send_arr($post);
        $sendArr['platformId']=$this->get_curr_platform_id();
        $arr=array(
            'secretaryMail'=>$sendArr
        );
//        MyFunction::sun_p($sendArr);die;
        $pageStatus = self::init_submit($post, $arr, '/SecretaryMailService/addSecretaryMail', '/SecretaryMailService/addSecretaryMail');
//        MyFunction::sun_p($pageStatus);die;
        return $this->redirect('/mailbox/mailbox?status='.$pageStatus);
    }

}