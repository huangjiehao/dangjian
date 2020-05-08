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

class DemonstrationController  extends BaseBackController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    //示范岗自评页面
    public function actionDemonstration(){
        $id='userId='. $this->get_curr_user_id().'&orgId='.$this->get_curr_org_id();
        $resultData = MyFunction::http_get(HTTP_HOSTS . '/PersonageExamplePostItemService/getPersonageExamplePostItemOneById', $id);
        if($resultData['status']==1000){
            return $this->render('demonstration',['editData'=>$resultData['data']]);
        }else{
            return $this->redirect('/layouts/error404.php');
        }
    }

    //答题提交答案
    public function  actionDemonstration_submit() {
        $this->iflogin();
        $post=$_POST;
        $arr = $this->init_send_arr($post);
        $arr['userId']=$this->get_curr_user_id();
        $arr['state']=0;
//        MyFunction::sun_p($arr);die;
        $pageStatus = self::init_submit($post, $arr, '/PersonageExamplePostItemService/updatePersonageExamplePostItem', '/PersonageExamplePostItemService/updatePersonageExamplePostItem');
//        MyFunction::sun_p($pageStatus);die;
        return $this->redirect('/demonstration/demonstration?status='.$pageStatus);
    }

}