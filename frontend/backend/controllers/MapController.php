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


class MapController extends BaseBackController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionMap(){
        //组织架构
        $starArr = array(
            'orgLevel' => 2,
            'platformId' => $this->get_curr_platform_id()
        );
        $starData = MyFunction::http_post(HTTP_HOSTS . '/AccountService/getOrgAll', $starArr);
        if ($starData['status'] == "1000"  ) {
            $resultData['starData'] = $starData['data'];
        }
        $resultData['starData'] = $starData['data'];
//        MyFunction::sun_p($resultData);DIE;


        $mapArr=array(
            'limitCounts'=>20,
            'pageNumber'=>0
        );
        $mapData=MyFunction::http_post(HTTP_HOSTS . '/MapInformation/getPageMap',json_encode($mapArr));
//        echo json_encode($mapData);die;
        if($mapData['status']=="1000"){
            $resultData['mapData']=$mapData['data'];
        }
//                MyFunction::sun_p($resultData);DIE;
        return $this->render('map',['resultData' => $resultData]);

    }

    public function actionMap_resource(){
        //组织架构
        $starArr = array(
            'orgLevel' => 2,
            'platformId' => $this->get_curr_platform_id()
        );
        $starData = MyFunction::http_post(HTTP_HOSTS . '/AccountService/getOrgAll', $starArr);
        if ($starData['status'] == "1000"  ) {
            $resultData['starData'] = $starData['data'];
        }
        $resultData['starData'] = $starData['data'];
//        MyFunction::sun_p($resultData);DIE;


        $mapArr=array(
            'limitCounts'=>20,
            'pageNumber'=>0
        );
        $mapData=MyFunction::http_post(HTTP_HOSTS . '/MapInformation/getPageMap',json_encode($mapArr));
//        echo json_encode($mapData);die;
        if($mapData['status']=="1000"){
            $resultData['mapData']=$mapData['data'];
        }
//                MyFunction::sun_p($resultData);DIE;
        return $this->render('map_resource',['resultData' => $resultData]);

    }
}
