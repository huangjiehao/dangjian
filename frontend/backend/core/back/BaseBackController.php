<?php

namespace app\core\back;

use common\models\MyFunction;
use Yii;
use yii\web\Controller;
use app\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\core\base\BaseController;

/**
 * UserController implements the CRUD actions for User model.
 */
class BaseBackController extends BaseController
{
    const close_page = 1; //关闭页面（保存成功）
    const success_page = 2; //添加成功
    const error_page = 3; //提示失败
    const base_privilege_parent_id = 1;
    const base_privilege_level = 2;
    const base_org_parent_id = 1; //基础的组织父级
    const  base_page_param = array(
        'pageNumber' => 1,
        'limitCounts' => 20
    );
    public $sun = array();
    public $loginUrl = '/account/login';
    public function init()
    {
        $this->sun = array(
            'a' => 1,
            'b' => 2,
           'c' => $_SERVER['SERVER_ADDR']
//            'c' => $_SERVER['LOCAL_ADDR']
        );

//        $_GET['token'];

    }

    /**
     * 设置页面标题（必须设置）,会同时设置菜单标题，如果不需要，则通过下方的set_menu_title方法设置空值来取消
     * @param $pageTitle
     */
    public function set_page_title($pageTitle)
    {
        $this->getView()->params['pageTitle'] = $pageTitle;
        $this->getView()->params['menuTitle'] = $pageTitle;
    }

    /**
     * 设置菜单标题
     * @param $menuTitle
     */
    public function set_menu_title($menuTitle)
    {
        $this->getView()->params['menuTitle'] = $menuTitle;
    }

    /**
     * 设置页面描述内容（可不设置，新闻资讯类页面必须设置，值设置为内容）
     * @param $description
     */
    public function set_page_description($description)
    {
        $description = str_replace('&nbsp;', '', $description);
        $description = str_replace(' ', '', $description);
        $description = trim($description);
        $this->getView()->params['description'] = $description;
    }

    /**
     * 设置页面返回链接（可不设置，默认为返回上一页）
     * @param $backLink
     */
    public function set_page_back_link($backLink)
    {
        $this->getView()->params['backLink'] = $backLink;
    }

    public function get_curr_user_id()
    {
        $session = \Yii::$app->session;
        return $session->get('pre_userId');
    }
    public function get_curr_role_id()
    {
        $session = \Yii::$app->session;
        return $session->get('pre_roleId');
    }
    public function get_curr_user_org_id()
    {
        $session = \Yii::$app->session;
        return $session->get('currOrgId');
    }

    public function get_curr_user_name()
    {
        $session = \Yii::$app->session;
        return $session->get('pre_username');
    }

    public function get_curr_user_psd()
    {
        $session = \Yii::$app->session;
        return $session->get('pwd');
    }

    public function get_curr_platform_id()
    {
        $platformInfo = MyFunction::init_platform();
        return $platformInfo['platformId'];
    }

    public function get_curr_org_id()
    {
        $platformInfo = MyFunction::init_platform();
        return $platformInfo['orgId'];
    }

    public function get_curr_org_name()
    {
        $platformInfo = MyFunction::init_platform();
//        MyFunction::sun_p($platformInfo);DIE;
        return $platformInfo['orgName'];
    }

    public function init_send_arr($params)
    {
        $sendArr = array();
        foreach ($params as $key => $value) {
            $sendArr[$key] = $value;
        }
        return $sendArr;
    }

    public function init_submit($post, $arr, $update_url, $add_url)
    {
        if (isset($post['edit']) && !empty($post['edit'])) {
            $arr['id'] = $post['idStr'];
            $url = $update_url;
            $pageStatus = self::close_page;
        } else {
            $url = $add_url;
            $pageStatus = self::success_page;
        }
        $resultData = MyFunction::http_post(HTTP_HOSTS . $url, $arr);
//        MyFunction::sun_p($resultData);die;
        if ($resultData['status'] != 1000) {
            $pageStatus = self::error_page . "&msg=" . $resultData['msg'];
        }
        return $pageStatus;
    }

    /**
     * 通用成功跳转
     * @param unknown $url 成功后跳转的URL
     * @param number $sec 自动跳转秒数
     * @return Ambigous <string, string>
     */
    public function alertGreenReload($url = [], $mess = '')
    {
        $view = \Yii::$app->view;
        $view->params['status'] = '';
        $view->params['linav'] = '';
        $url = empty($url) ? ['/admin/msg'] : $url;
        $url = \yii\helpers\Url::toRoute($url);
        return $this->render('/admin/msg', ['gotoUrl' => $url, 'mess' => $mess, 'sec' => 1, 'stat' => 'green_reload']);
    }

    /**
     * 通用错误跳转
     * @param string $mess 错误提示信息
     */
    public function alertRedReload($url = [], $mess = '')
    {
        $view = \Yii::$app->view;
        $view->params['status'] = '';
        $view->params['linav'] = '';
        $url = empty($url) ? ['/admin/msg'] : $url;
        $url = \yii\helpers\Url::toRoute($url);
        return $this->render('/admin/msg', ['gotoUrl' => $url, 'mess' => $mess, 'sec' => 1, 'stat' => 'red_reload']);

    }

    public function init_page_params($sendArr)
    {
        $sendArr['limitCounts'] = isset($_GET['lcs']) ? $_GET['lcs'] : 20;
        $sendArr['pageNumber'] = isset($_GET['page']) ? $_GET['page'] : 1;
        return $sendArr;
    }

    public function init_page_result($pageCounts)
    {
        $page['counts'] = isset($pageCounts) ? $pageCounts : 0;
        $page['limitCounts'] = isset($_GET['lcs']) ? $_GET['lcs'] : 20;
        $page['pageNumber'] = isset($_GET['page']) ? $_GET['page'] : 1;
//        MyFunction::sun_p($page);DIE;
        return $page;
    }

}
