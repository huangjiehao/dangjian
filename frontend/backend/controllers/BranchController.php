<?php
namespace backend\controllers;

use app\core\back\BaseBackController;
use common\models\Fang;
use common\models\MyFunction;
use Yii;
use yii\base\Response;
use yii\mutex\MysqlMutex;
use yii\web\Request;


class BranchController extends BaseBackController
{
    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionBranch(){
        /*获取出所有的数据*/
        $resultData = array();
        $channelId = addslashes($_GET['channelId']);
        if(!isset($_GET['tab'])){
            $channelId = 'channelId=' . $channelId; //channelId=272331143548899342
            $allData = MyFunction::http_get(HTTP_HOSTS . '/PortalService/getDataFromNavPage',$channelId);
            if ($allData['status'] == "1000"  ) {
                $resultData['allData'] = $allData['data'];
            }
        }else{
            $channelArr = array(
                'channelId' => $channelId,
                'platformId' => $this->get_curr_platform_id()
            );
            $allData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getArticlePageByChannelId',$channelArr);
            if ($allData['status'] == "1000"  ) {
                $resultData['allData'] = $allData['data'];
            }
        }

        /*沃字组织图信息*/
        $starArr = array(
            'platformId' => $this->get_curr_platform_id()
        );
        $starData = MyFunction::http_post(HTTP_HOSTS . '/AccountService/getOrgAll', $starArr);
        if ($starData['status'] == "1000"  ) {
            $resultData['starData'] = $starData['data'];
        }
        return $this->render('branch',['resultData' => $resultData]);
    }
}
