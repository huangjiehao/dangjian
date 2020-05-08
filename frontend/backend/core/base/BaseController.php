<?php

namespace app\core\base;

use app\common\MyFunction;
use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\search\UserSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class BaseController extends Controller
{
    public $_url_host = HTTP_HOSTS;

    //获取当前教师所在学校的所有年级
    protected $_url_get_all_grade = '/BaseDataService/getSchoolAllGrades';

    //验证手机号是否存在
    protected $_url_ifexit_phone = '/AccountService/hasKidParentByCellphone';


    /**
     * URL-api 接口管理
     */

    /**
     * 获取当前教师所在学校的所有年级
     */
    public function api_get_all_grade($data)
    {
        $url_all_grade = $this->_url_host . $this->_url_get_all_grade;
        return MyFunction::http_get($url_all_grade, $data);

    }

    /**
     * 验证手机号是否存在
     */
    public function api_ifexit_phone($data)
    {
        $url_check_phone = $this->_url_host . $this->_url_ifexit_phone;
        return MyFunction::http_get($url_check_phone, 'cellphone=' . $data);
    }


    /**
     * 判断是否登录
     */
    public function iflogin()
    {
        $session = \Yii::$app->session;
        $username = $session->get('pre_username');
        if (empty($username)) {
            return true;
        }
    }


    /**
     * @return 全局用户信息
     */
    public function getUser()
    {
        $session = \Yii::$app->session;
        return json_decode($session->get('user_mess'), true);
    }

    /**
     * @return 全局学校信息；
     */
    public function getSchool()
    {
        $session = \Yii::$app->session;
        return json_decode($session->get('school_mess'), true);
    }

    /**
     * @param $request
     * @param null $data
     * @return array|mixed
     */
    public function getRequest($request, $data = null)
    {
        if ($request == 'post') {
            if ($data) {
                return \Yii::$app->request->post($data);
            } else {
                return \Yii::$app->request->post();
            }

        }

        if ($request == 'get') {
            if ($data) {
                return \Yii::$app->request->get($data);
            } else {
                return \Yii::$app->request->get();
            }
        }
    }
}
