<?php

namespace backend\controllers;

use app\core\back\BaseBackController;
use common\models\Fang;
use common\models\MyFunction;
use Yii;
use yii\base\Response;
use yii\mutex\MysqlMutex;
use yii\web\Request;

class DonationController extends BaseBackController
{

    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

//爱心救助列表
    public function actionDonation_list(){
        self::iflogin();
        $Arr=array(
            "actionsState"=>"-1",
            "actionsType"=>"",
            "userId"=>$this->get_curr_user_id()
        );
        $Arr = self::init_page_params($Arr);//TODO 注意：这个是分页必须的
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/DonationService/getDonationListCus',$Arr);
        $pageCounts = $resultData['data']['counts']; //TODO 注意：这个是分页必须的
//        MyFunction::sun_p($resultData);DIE;
        return $this->render('/donation/donation_list',['data' => $resultData['data'], 'page' => self::init_page_result($pageCounts)]);
    }

    //捐献详情
    public function actionDonation_detail(){
        self::iflogin();
        $id='id='.addslashes($_GET['idStr']);
        $resultData=MyFunction::http_get(HTTP_HOSTS.'/DonationService/getDonationOneById',$id);
//        MyFunction::sun_p($resultData);die;
        if($resultData['status']=='1000'){
            return $this->render('donation_detail',['detailData'=>$resultData['data']]); //跳转至wish_details页面
        }else{
            return $this->redirect('/layouts/error404');
        }
    }

    //报名
    public function actionDonationreport_submit(){
        $post = $_POST;
        $sendArr = $this->init_send_arr($post);
        $sendArr['userId']=$this->get_curr_user_id();
        if($sendArr['postType']=='0'){
//            MyFunction::sun_p($sendArr);die;
            $pageStatus = self::init_submit($post, $sendArr, '', '/DonationEnterService/updateDonationEnter');
        }else{
            $pageStatus = self::init_submit($post, $sendArr, '', '/DonationEnterService/addDonationEnterNotes');
        }
//        MyFunction::sun_p($sendArr);die;
        return $this->redirect('donation_detail?idStr='.$sendArr['donationId'].'&status='.$pageStatus);
    }

}