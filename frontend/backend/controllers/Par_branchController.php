<?php
namespace backend\controllers;
use app\core\back\BaseBackController;
use common\models\MyFunction;


class Par_branchController extends BaseBackController
{
    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionPar_branch(){
        $orgId = $_GET['idStr'];
        $resultData = array();
        $pages = array(
            "pageNumber" => 1,
            "limitCounts" => 1
        );
        if($orgId!='org') {
            $users = array(
                "platformId" => $this->get_curr_platform_id(),
                "orgId" => $orgId,
                "voteParam" => $pages
            );
        }else{
            $users = array(
                "platformId" => $this->get_curr_platform_id(),
                "orgId" => $this->get_curr_org_id(),
                "voteParam" => $pages
            );
        }
        $id = array(
            "platformId" => $this->get_curr_platform_id(),
            "orgId" => $orgId
        );
//        MyFunction::sun_p($id);die;
        $infoData = MyFunction::http_post(HTTP_HOSTS . '/AccountService/getOrgUserRoleInfo', $id);
        $picData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getIndexPortalInfo', $users);//getIndexPortalInfo //getIndexPortalChannel
//        MyFunction::sun_p($picData);die;
        if ($picData['status'] == "1000"  ) {
            $resultData['picData'] = $picData['data'];
        }
//        MyFunction::sun_p($picData);die;
        return $this->render('/par_branch/par_branch',['resultData' => $resultData,'infoData' => $infoData['data']]);
    }
}

