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

class UncorruptedController extends BaseBackController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    //廉洁举报页面
    public function actionUncorrupted(){
        return $this->render('uncorrupted');
    }

    //举报提交
    public function  actionUncorrupted_submit() {

        if ($this->iflogin()) {
            return $this->redirect($this->loginUrl);
        };
        $post=$_POST;
        $sendArr = $this->init_send_arr($post);
        $sendArr['sendUserId']=$this->get_curr_user_id();
        $sendArr['sendUserName']=$this->get_curr_user_name();
//        MyFunction::sun_p($sendArr);die;
        $pageStatus = self::init_submit($post, $sendArr, '/AnonymousReportService/addAnonymousReport', '/AnonymousReportService/addAnonymousReport');
//        MyFunction::sun_p($pageStatus);die;
        return $this->redirect('/mailbox/mailbox?status='.$pageStatus);
    }

}