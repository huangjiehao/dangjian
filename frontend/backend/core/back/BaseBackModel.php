<?php

namespace app\core\back;

use Yii;
use yii\web\Models;
use app\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\core\base\BaseModel;

/**
 * UserController implements the CRUD actions for User model.
 */
class BaseBackModel extends BaseModel
{
    public function getUserInfo()
    {
        return json_decode($this->session->get('user_mess'), true);
    }

    public function getSchoolInfo()
    {
        return json_decode($this->session->get('school_mess'), true);
    }

    //设置公共导航状态参数；
    public function setLinav($data = 'admin')
    {
        return $this->view->params['linav'] = $data;
    }

    //设置状态参数；
    public function setStatus($status)
    {
        return $this->view->params['status'] = $status;
    }
}
