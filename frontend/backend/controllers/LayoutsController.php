<?php

namespace backend\controllers;

use app\core\back\BaseBackController;
use common\models\Fang;
use common\models\MyFunction;
use Yii;
use yii\base\Response;
use yii\mutex\MysqlMutex;
use yii\web\Request;

class LayoutsController extends BaseBackController
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /*public function actionMain_left()
    {
        return $this->render('main_left');
    }

    public function actionMain_left_sec()
    {
        return $this->render('main_left_sec');
    }*/

    //上传图片
    public function actionUpload_files()
    {
        if (isset($_POST['name'])) {
            $result = MyFunction::upload_files($_FILES['file'], $_POST);
            return $result;
        }
        return false;
    }

    public function actionGet_location()
    {
        if (isset($_GET['location'])) {
//            MyFunction::sun_p($_GET['location']);
            $header = array(
                'Content-Type: application/json',
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_URL, 'http://api.map.baidu.com/geocoder?location=' . $_GET['location'] . '&output=json&key=TSsdFsHz4DRwOHX1uFhuwStNDGg9tRLD');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $output = curl_exec($ch);
            curl_close($ch);
//            MyFunction::sun_p($output);die;
//            $resultData = MyFunction::http_get('http://api.map.baidu.com/geocoder?location=' . $_POST['location'] . '&output=json&key=TSsdFsHz4DRwOHX1uFhuwStNDGg9tRLD');
            return $output;
        }
        return 'test';
    }

    public function actionError404()
    {
        return $this->render('error404');
    }
}