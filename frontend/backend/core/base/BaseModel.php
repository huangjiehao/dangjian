<?php

namespace app\core\base;

use Yii;
use yii\web\Models;
use app\models\User;
use app\models\search\UserSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;

/**
 * UserController implements the CRUD actions for User model.
 */
class BaseModel extends Model
{
    public $isNewRecord;
    public $session;
    public $view;
    public $request;

    public function __construct()
    {
        $this->session = \Yii::$app->session;
        $this->view = \Yii::$app->view;
        $this->request = \Yii::$app->request;
        parent::__construct();
    }

}
