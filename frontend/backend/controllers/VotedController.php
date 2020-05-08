<?php

namespace backend\controllers;

use app\core\back\BaseBackController;
use common\models\Fang;
use common\models\MyFunction;
use Yii;
use yii\base\Response;
use yii\mutex\MysqlMutex;
use yii\web\Request;

class VotedController extends BaseBackController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionVoted_list()
    { //新投票管理界面
        $getId = $_GET['id'];
        if($_GET['visitor'] == 0){
            if($this->iflogin()){            $this->redirect($this->loginUrl);        }
            $voteArr = array(
                'id' => $getId,
                'platformId' => $this->get_curr_platform_id(),
                'voterId' => $this->get_curr_user_id()
            );
//            MyFunction::sun_p($voteArr);DIE;
        }else{
            $voteArr = array(
                'id' => $getId,
                'loginUserId' => $this->get_curr_user_id(),
                'platformId' => $this->get_curr_platform_id()
            );
        }
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/VoteService/getVoteCusOne', $voteArr);
        if ($resultData['status'] == "1000") {
            if ($resultData['data']['vote']['visitor'] == 0) {
                if($this->iflogin()){            $this->redirect($this->loginUrl);        }
            }
            return $this->render('voted_list', ['resultData' => $resultData['data']['vote'], 'rstData' => $resultData['data'], 'voteAllNum' => $resultData['data']['voteAllNum'], 'voteerNum' => $resultData['data']['voteerNum']]);
        }
    }

    public function actionVoted_dtls()
    {
        /*投票信息显示*/
      //  if($this->iflogin()){            $this->redirect($this->loginUrl);        }

        $getId = $_GET['id'];
        /*MyFunction::sun_p($getId);die;*/
        if($_GET['visitor'] == 1){
            $voteArr = array(
                'id' => $getId,
                'loginUserId' => $this->get_curr_user_id(),
                'platformId' => $this->get_curr_platform_id()
            );
        }else{
            if($this->iflogin()){            $this->redirect($this->loginUrl);        }
            $voteArr = array(
                'id' => $getId,
                'platformId' => $this->get_curr_platform_id(),
                'loginUserId' => $this->get_curr_user_id()
               /* 'voterId' => $this->get_curr_user_id()*/
            );
//            MyFunction::sun_p($voteArr);DIE;

        }
//        MyFunction::sun_p($voteArr);
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/VoteService/getVoteCusOne', $voteArr);
//        MyFunction::sun_p($resultData);die;

        if ($resultData['status'] == "1000") {
            if ($resultData['data']['vote']['visitor'] == 0) {
                if($this->iflogin()){            $this->redirect($this->loginUrl);        }
            }
            return $this->render('voted_dtls', ['resultData' => $resultData['data']['vote'], 'rstData' => $resultData['data'], 'voteAllNum' => $resultData['data']['voteAllNum'], 'voteerNum' => $resultData['data']['voteerNum']]);
        }  //跳转至voted_dtls页面
    }

    public function actionVoted_tab()
    { //投票内页详情2
        $resultData = array();
        $pageNumber = 1;
        $limitCounts = 1000;
        //条件查询
        if (isset($_POST['postObj'])) {
            $postObj = json_decode($_POST['postObj'], true);
            $pageNumber = $postObj['postIndex'];
        }
        $title= isset($_GET['title'])?$_GET['title']:null;
        $voteArr = array(
            'title' => $title,
            'voteSta' => 1, //最新投票
            'voteType' => $_GET['voteSta'],
            'pageNumber' => $pageNumber,      //当前页码（起始数为1），选填（不填默认为1）
            'limitCounts' => $limitCounts      //每页条数，选填（不填默认为10）
        );
        $allData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getPortalVotePage', $voteArr);
        // MyFunction::sun_p($allData);DIE;
        $voteArr = array(
            'voteSta' => 3, //最新投票
            'voteType' => $_GET['voteSta'], //
            'pageNumber' => $pageNumber,      //当前页码（起始数为1），选填（不填默认为1）
            'limitCounts' => $limitCounts      //每页条数，选填（不填默认为10）
        );
        $jsData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getPortalVotePage', $voteArr);
//        MyFunction::sun_p($resultData);DIE;
        if ($allData['status'] == "1000") {
            $resultData['allData'] = $allData['data'];
//              MyFunction::sun_p($resultData['allData']);DIE;
            return $this->render('voted_tab', ['data' => $resultData['allData'], 'jsData' => $jsData['data'], 'postIndex' => $pageNumber, 'postLimitCounts' => $limitCounts, 'voteArr' => $voteArr]);
        }
    }

    //投票详情
    public function actionVote()
    {
        /*投票信息显示*/

        $getId = $_GET['id'];
        $voteArr = array(
            'voteId' => $getId,
            'userId' => $this->get_curr_user_id(),
            'platformId' => $this->get_curr_platform_id(),
        );
//        MyFunction::sun_p($voteArr);DIE;
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getVoteDetailOneById', $voteArr);
//        MyFunction::sun_p($resultData);DIE;
        if ($resultData['status'] == "1000") {
            return $this->render('vote', ['resultData' => $resultData['data']['result']]);
        }

    }

    public function actionVoted_submit()
    {  //投票数据提交
        $value = $_POST;
        if($_POST['visitor'] == 1){
            $resultDataId = $_POST['resultDataId'];//MyFunction::http_get(HTTP_HOSTS . '/VoteService/getVisitorIdWorker')
            $visitorName = '游客';
            $orgIdStr = "";
        }else{
            $resultDataId = $this->get_curr_user_id();
            $orgIdStr = $this->get_curr_user_org_id();
            $visitorName = $this->get_curr_user_name();
        }

        $voteArr = array(
            'voteId' => $value['voteId'],
            'voterId' => $resultDataId,
            'platformId' => $this->get_curr_platform_id(),
            'voterName' => $visitorName,
            'visitor' => $_POST['visitor'],
            'beVotedMembers' => $_POST['beVotedMembers'],
            'voterOrgId' => $orgIdStr
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/VoteService/vote', $voteArr);
        return json_encode($resultData);

    }

}