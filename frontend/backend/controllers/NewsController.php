<?php

namespace backend\controllers;

use app\core\back\BaseBackController;
use common\models\Fang;
use common\models\MyFunction;
use Yii;
use yii\base\Response;
use yii\mutex\MysqlMutex;
use yii\web\Request;


class NewsController extends BaseBackController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionNews_search(){  //待完成搜索功能
        $value = $_GET;
        $title = addslashes($value['title']);
        $resultData = array(); //根据当前的id获取文章信息
        $sendArr = array(
            'platformId' => $this->get_curr_platform_id(),
            'title' => $title,
            'artSta'=>4
        );
//        MyFunction::sun_p($sendArr);DIE;
        $infoData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/searchArticlePage', $sendArr);
        if ($infoData['status'] == "1000"  ) {
            $resultData['infoData'] = $infoData['data'];
        }
//        MyFunction::sun_p($infoData);die;
        return $this->render('news_search',['resultData' => $resultData]);
    }

    public function actionNews(){
        $resultData = array(); //根据当前的id获取文章信息
        $id = addslashes($_GET['channelId']);
//        echo json_encode($id);die;
        $id = 'id=' . $id.'&platformId='.$this->get_curr_platform_id();
        $infoData = MyFunction::http_get(HTTP_HOSTS . '/PortalService/getArticleDetailOneById', $id);
//        MyFunction::sun_p($infoData);die;
        if ($infoData['status'] == "1000"  ) {
            $this->set_page_title($infoData['data']['title']);
            $this->set_page_description($infoData['data']['content']);
            $resultData['infoData'] = $infoData['data'];
        }
        return $this->render('/news/news',['resultData' => $resultData]);
    }

    public function actionNews_create(){
        $resultData = array(); //组织架构数据
        $starArr = array(
            'platformId' => $this->get_curr_platform_id()
        );
        $starData = MyFunction::http_post(HTTP_HOSTS . '/AccountService/getOrgAll', $starArr);
        if ($starData['status'] == "1000"  ) {
            $resultData['starData'] = $starData['data'];
        }

        $channelId = addslashes($_GET['channelId']);//根据当前选中的id获取当前频道信息
        $channelId = 'channelId=' . $channelId;
        $wmcjData = MyFunction::http_get(HTTP_HOSTS . '/PortalService/getDataFromNavPage',$channelId);
        if ($wmcjData['status'] == "1000"  ) {
            $resultData['wmcjData'] = $wmcjData['data'];
        }
//        MyFunction::sun_p($resultData['wmcjData']);die;
        $channelIdArr = array(
            "pageNumber"=>"1",
            "limitCounts"=>"20",
            'channelId' => $channelId
        );
        $currIdData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getArticlePageByChannelId', $channelIdArr);
//        MyFunction::sun_p($currIdData);die;
        if ($currIdData['status'] == "1000"  ) {
            $resultData['currIdData'] = $currIdData['data'];
        }
        return $this->render('/news/news_create',['resultData' => $resultData]);

    }
    public function actionArticle_contribute(){
        return $this->render('/news/articleContribute');
    }
    public function actionArticle_submit(){
        $data=$_POST;
        $arr=array(
            'title'=>$data['title'],
            'body'=>$data['url'],
            'themeId'=>$data['channelId']
        );
        $resultData=MyFunction::http_post(HTTP_HOSTS . '/OperationContributeService/addOperationContribute',$arr);
        if($resultData['status']=='1000'){
            return $this->redirect('/news/news?channelId='.$data['channelId'].'&status=1');
        }else{
            echo 'error';
        }
    }
}
