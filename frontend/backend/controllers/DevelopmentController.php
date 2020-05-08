<?php

namespace backend\controllers;

use app\core\back\BaseBackController;
use common\models\Fang;
use common\models\MyFunction;
use Yii;
use yii\base\Response;
use yii\mutex\MysqlMutex;
use yii\web\Request;

class DevelopmentController extends BaseBackController
{

    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    //个人党员发展流程
    public function actionPersonal_development(){
        $id='applyerId='.addslashes($_GET['idStr']);
//        MyFunction::sun_p($id);die;
        $resultData = MyFunction::http_get(HTTP_HOSTS .'/DevpPartyerService/getDevpPartyerFileOneByApplyerId',$id);
//        MyFunction::sun_p($resultData);die;
        if($resultData['status']=='8888'){
            return $this->render('personal_development');
        }elseif ($resultData['status']=='1000'){
            return $this->render('personal_development',['data' => $resultData['data']]);
        }else{
            return $this->redirect('/layouts/error404');
        }
    }
    //上传入党申请表页面
    public function actionDevelopment_apply(){
        return $this->render('development_apply');
//        return $this->redirect('/development/development_apply');
    }
    //提交文件
    public function actionDevelopment_apply_submit(){
        $post=$_POST;
        $type=addslashes($post['type']);
        //上传培训班结业证扫描件,上传入党志愿书
        if($type==3||$type==4||$type==5||$type==6){
            $arr=array(
                'orgId'=>$this->get_curr_org_id(),
                'orgName'=>$this->get_curr_org_name(),
                'applyerId'=>$this->get_curr_user_id(),
                'fileInfoList'=>json_decode($post['fileJson'],true)
            );
//            MyFunction::sun_p($arr);die;
            if($type==3){
                $resultData=MyFunction::http_post(HTTP_HOSTS.'/DevpPartyerService/addTrainCertificate',$arr);
            }elseif ($type==5){
                $resultData=MyFunction::http_post(HTTP_HOSTS.'/DevpPartyerService/addJurationPic',$arr);
            }elseif ($type==6){
                $resultData=MyFunction::http_post(HTTP_HOSTS.'/DevpPartyerService/submitPartyerPaper',$arr);
            }else{
                $resultData=MyFunction::http_post(HTTP_HOSTS.'/DevpPartyerService/addJoinApplication',$arr);
            }
        }else if($type==2){
            //上传思想汇报
            $arr=array(
                'applyerId'=>$this->get_curr_user_id(),
                'fileInfoList'=>json_decode($post['fileJson'],true)
            );

            $resultData=MyFunction::http_post(HTTP_HOSTS.'/DevpPartyerService/submitThoughtPaper',$arr);
//             MyFunction::sun_p($resultData);die;

        }
        if ($resultData['status'] == '1000') {
            return $this->redirect('/development/development_apply?type='.addslashes($post['type']).'&status=1');
        } else {
            return $this->redirect('/development/development_apply?type='.addslashes($post['type']).'&status=3&msg=' . $resultData['msg']);
        }

    }
    //填写个人信息页面
    public function actionDevelopment_base(){
        if(isset($_GET['edit'])){
            $id='id='.addslashes($_GET['idStr']);
//            MyFunction::sun_p($id);die;
            $resultData = MyFunction::http_get(HTTP_HOSTS . '/DevpPartyerService/getApplyPaperOneById', $id);
//            MyFunction::sun_p($resultData);die;
            return $this->render('development_base',['editData'=>$resultData['data']]);
        }else{
            $sendArr = array(
                'currOrgId' =>$this->get_curr_org_id()
            );
            $getData = MyFunction::http_post(HTTP_HOSTS . '/DevpPartyerService/getOrgTree', $sendArr);
//            MyFunction::sun_p($getData);die;
            return $this->render('development_base',['data'=>$getData['data']['result']]);
        }
    }
    //填写个人信息提交
    public function actionDevelopment_base_submit(){
        $post=$_POST;
        $arr = $this->init_send_arr($post);
        $arr['resumeList']=json_decode($arr['resumeList']);
        $arr['familyMemberList']=json_decode($arr['familyMemberList']);
        $arr['relativeList']=json_decode($arr['relativeList']);
        $arr['birthday']=strtotime(addslashes($arr['birthday']));
        $arr['joinWorkDate']=strtotime(addslashes($arr['joinWorkDate']));
        $arr['joinLeagueDate']=strtotime(addslashes($arr['joinLeagueDate']));
        $arr['recently3Performance']=implode(",", $arr['recently3Performance']);
        $arr['id']=$this->get_curr_user_id();
        $arr['fileInfoList']=null;
        $sendArr=array(
            'applyer'=>$arr,
            'applyerId'=>$this->get_curr_user_id(),
            'fileInfoList'=>json_decode($post['fileInfoList']),
        );
        $resultData=MyFunction::http_post(HTTP_HOSTS.'/DevpPartyerService/submitJoinApplyPaper',$sendArr);
        $id=$this->get_curr_user_id();
        $ids='id='.$id;
        $userData=MyFunction::http_get(HTTP_HOSTS.'/DevpPartyerService/getUserById',$ids);
        $session = \Yii::$app->session;
        $session->set('user_msginfo', null);
        $session->set('user_msginfo', json_encode($userData['data']));
        return json_encode($resultData);
        /*$pageStatus = self::init_submit($post, $sendArr, '/DevpPartyerService/submitJoinApplyPaper', '/DevpPartyerService/submitJoinApplyPaper');
        return $this->redirect('/development/development_base?status='.$pageStatus);*/
    }
    //入党志愿书模板
    public function actionVolunteer_template(){
        return $this->render('volunteer_template');
    }
    //发展党员展示
    public function actionDevelopment_show(){
        return $this->render('development_show');
    }

}