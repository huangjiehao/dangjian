<?php

namespace backend\controllers;

use app\core\back\BaseBackController;
use common\models\Fang;
use common\models\MyFunction;
use Yii;
use yii\base\Response;
use yii\mutex\MysqlMutex;
use yii\web\Request;
class InfoController extends BaseBackController
{
    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionInfo(){ //显示信息详情，目前纯静页
        return $this->render('info');
    }
}