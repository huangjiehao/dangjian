<?php

namespace backend\controllers;

use app\core\back\BaseBackController;
use common\models\Fang;
use common\models\MyFunction;
use Yii;
use yii\base\Response;
use yii\mutex\MysqlMutex;
use yii\web\Request;

class WishController extends BaseBackController
{

    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

//心愿列表
    public function actionWish_list(){
        self::iflogin();  //判断是否登录
        $Arr=array(
            'name'=>null
        );
        $Arr = self::init_page_params($Arr);//TODO 注意：这个是分页必须的
//        MyFunction::sun_p($Arr);DIE;
        if($_GET['type']=='0'){
            $resultData = MyFunction::http_post(HTTP_HOSTS . '/UserWishService/getUserWishPage',$Arr);
        }else{
            $resultData = MyFunction::http_post(HTTP_HOSTS . '/UserWishService/getUserWishOffersPage',$Arr);
        }
//        MyFunction::sun_p($resultData);die;
        $pageCounts = $resultData['data']['counts']; //TODO 注意：这个是分页必须的     数量

//        MyFunction::sun_p($pageCounts);DIE;
        return $this->render('/wish/wish_list',['data' => $resultData['data'], 'page' => self::init_page_result($pageCounts)]);
    }
    //党群服务
    public function actionWish_fw(){
        self::iflogin();  //判断是否登录
        $Arr=array(
            'name'=>null
        );
        $Arr = self::init_page_params($Arr);//TODO 注意：这个是分页必须的
        if($_GET['type']=='0'){
            $resultData = MyFunction::http_post(HTTP_HOSTS . '/UserWishService/getUserWishPage',$Arr);
        }else{
            $resultData = MyFunction::http_post(HTTP_HOSTS . '/UserWishService/getUserWishOffersPage',$Arr);
        }
        $pageCounts = $resultData['data']['counts']; //TODO 注意：这个是分页必须的     数量
        return $this->render('/wish/wish_fw',['data' => $resultData['data'], 'page' => self::init_page_result($pageCounts)]);
    }
    //心愿添加
    public function actionWish_add(){
        self::iflogin();
        return $this->render('/wish/wish_add'); //跳转至wish_add 页面
    }
    //心愿提交
    public function actionWish_submit(){
        $post = $_POST;  //提交的内容
//        MyFunction::sun_p($post);DIE;
        $sendArr = $this->init_send_arr($post); ////提交的内容
//        MyFunction::sun_p($sendArr);DIE;
        $sendArr['wishState']=1;
        $sendArr['userId']=$this->get_curr_user_id();
        $sendArr['userName']=$this->get_curr_user_name();
        $sendArr['orgId']=$this->get_curr_org_id();
        $sendArr['orgName']=$this->get_curr_org_name();
        $sendArr['platformId']=$this->get_curr_platform_id();
//        MyFunction::sun_p($sendArr);die;
        if($sendArr['type']==0){
            $pageStatus = self::init_submit($post, $sendArr, '/UserWishService/addUserWish', '/UserWishService/addUserWish');  //个人心愿

        }else{
            $pageStatus = self::init_submit($post, $sendArr, '/UserWishService/addUserWishOffers', '/UserWishService/addUserWishOffers'); //心愿能力
        }
//        MyFunction::sun_p($resultData);dievar_dump($resultData);
        return $this->redirect('wish_add?type='.$sendArr['type'].'&status='.$pageStatus);

    }
    //心愿详情
    public function actionWish_detail(){
        self::iflogin();
        $type=addslashes($_GET['type']); //心愿类型
        $id='id='.addslashes($_GET['idStr']);   //id=317167711077666833  具体哪一条心愿的id
        if($type==0){
            $resultData = MyFunction::http_get(HTTP_HOSTS . '/UserWishService/getUserWishOneById', $id);  //个人心愿
//        MyFunction::sun_p($resultData);die;
        }else{
            $resultData = MyFunction::http_get(HTTP_HOSTS . '/UserWishService/getUserWishOffersOneById', $id); //心愿能力
//            MyFunction::sun_p($resultData);die;
        }
        if($resultData['status']=='1000'){
//            MyFunction::sun_p($resultData['data']);DIE;
            return $this->render('wish_detail',['data'=>$resultData['data']]); //跳转至wish_details页面
        }
    }
    //认领
    public function actionWishHelper_submit(){
        $post = $_POST;
        $sendArr = $this->init_send_arr($post);
        $sendArr['helperId']=$this->get_curr_user_id();
//        MyFunction::sun_p($sendArr);die;
        $pageStatus = self::init_submit($post, $sendArr, '/UserWishService/addUserWishHelper', '/UserWishService/addUserWishHelper');
        return $this->redirect('wish_detail?idStr='.$sendArr['userWishId'].'&status='.$pageStatus);
    }

    //删除心愿能力
    public function actionWishHelper_remove(){
        $id='id='.addslashes($_POST['idStr']);
        $result=MyFunction::http_get(HTTP_HOSTS.'/UserWishService/removeUserWishOffersById',$id);
        return json_encode($result);
    }
}