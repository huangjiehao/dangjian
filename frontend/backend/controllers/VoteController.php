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


class VoteController extends BaseBackController
{
    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionVote_list(){
        $resultData = array();
        $title= isset($_GET['title'])?$_GET['title']:null;
        $voteArr = array(
            'title' => $title,
            'voteSta' => 1, //最新投票
            'voteType' => $_GET['voteSta']
        );
        $voteArr = self::init_page_params($voteArr);//TODO 注意：这个是分页必须的
        $allData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getPortalVotePage', $voteArr);
        $pageCounts = NULL;
        if ($allData['status'] == "1000") {
            $resultData['allData'] = $allData['data'];
            $pageCounts = $resultData['allData']['counts'];
        }
        return $this->render('vote_list', ['data' => $resultData['allData'], 'voteArr' => $voteArr, 'page' => self::init_page_result($pageCounts)]);
    }

    public function actionVote_dtls(){
        $visitor = isset($_GET['visitor'])?$_GET['visitor']:'';
        $resultDataId = null;
        if ($visitor == 1) {
            if ($this->iflogin()) { //未登录
                if(isset($_GET['resultDataId'])){
                    if ($_GET['resultDataId'] == null && $_GET['resultDataId'] == 'undefined') {
                        $resultDataId = MyFunction::http_get(HTTP_HOSTS . '/VoteService/getVisitorIdWorker');
                        $resultDataId = $resultDataId['data']['result'];
                        $voterName = '游客';
                    } else {
                        $resultDataId = $_GET['resultDataId'];
                        $voterName = '游客';
                    }
                }else{
                    $resultDataId = MyFunction::http_get(HTTP_HOSTS . '/VoteService/getVisitorIdWorker');
                    $resultDataId = $resultDataId['data']['result'];
                    $voterName = '游客';
                }
            }else {
                $resultDataId = $this->get_curr_user_id();
                $voterName = $this->get_curr_user_name();
            }

        }
        $getId = isset($_GET['id'])?$_GET['id']:'';
        if($visitor == 1){ //游客
            $voteArr = array(
                'id' => $getId,
                'platformId' => $this->get_curr_platform_id(),
                'loginUserId' => $resultDataId,
                'voterName' => $voterName,
                'ss' => 1,
            );
        }else{
            if($this->iflogin()){$this->redirect($this->loginUrl);}
            $voteArr = array(
                'id' => $getId,
                'loginUserId' => $this->get_curr_user_id(),
                'platformId' => $this->get_curr_platform_id(),
                'voterName' => $this->get_curr_user_name(),
            );
        }
//        MyFunction::sun_p($voteArr);DIE;
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/VoteService/getVoteCusOne', $voteArr);

        if ($resultData['status'] == "1000") {
//            MyFunction::sun_p($resultData['data']);DIE;
            return $this->render('vote_dtls', ['resultData' => $resultData['data']['vote'],'resultDataId'=>$resultDataId, 'rstData' => $resultData['data'], 'voteAllNum' => $resultData['data']['voteAllNum'], 'voteerNum' => $resultData['data']['voteerNum']]);
        }
    }
    public function actionVote_r_dtls(){
        $visitor = isset($_GET['visitor'])?$_GET['visitor']:'';
        $resultDataId = null;

        if ($visitor == 1) {
            if ($this->iflogin()) { //未登录
                if(isset($_GET['resultDataId'])){
                    if ($_GET['resultDataId'] == null && $_GET['resultDataId'] == 'undefined') {
                        $resultDataId = MyFunction::http_get(HTTP_HOSTS . '/VoteService/getVisitorIdWorker');
                        $resultDataId = $resultDataId['data']['result'];
                    } else {
                        $resultDataId = $_GET['resultDataId'];
                    }
                }else{
                    $resultDataId = MyFunction::http_get(HTTP_HOSTS . '/VoteService/getVisitorIdWorker');
                    $resultDataId = $resultDataId['data']['result'];
                }
            }else {
                $resultDataId = $this->get_curr_user_id();
            }

        }

        $getId = isset($_GET['id'])?$_GET['id']:'';
        if($visitor == 1){ //游客
            $voteArr = array(
                'id' => $getId,
                'platformId' => $this->get_curr_platform_id(),
                'loginUserId' => $resultDataId,
                'voterName' => $this->get_curr_user_name(),
            );
        }else{
            if($this->iflogin()){$this->redirect($this->loginUrl);}
            $voteArr = array(
                'id' => $getId,
                'loginUserId' => $this->get_curr_user_id(),
                'platformId' => $this->get_curr_platform_id(),
                'voterName' => $this->get_curr_user_name(),
            );
        }
//        MyFunction::sun_p($voteArr);DIE;
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/VoteService/getVoteCusOne', $voteArr);
        if ($resultData['status'] == "1000") {
//            MyFunction::sun_p($resultData['data']);DIE;
            return $this->render('vote_r_dtls', ['resultData' => $resultData['data']['vote'],'resultDataId'=>$resultDataId ,'rstData' => $resultData['data'], 'voteAllNum' => $resultData['data']['voteAllNum'], 'voteerNum' => $resultData['data']['voteerNum']]);
        }
    }

    //投票详情
    public function actionVote(){
        /*投票信息显示*/
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $userId = $user_msginfo['idStr'];

        $getId = $_GET['id'];
        $voteArr = array(
            'voteId' => $getId,
            'userId' => $userId
        );
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/PortalService/getVoteDetailOneById', $voteArr);
//        MyFunction::sun_p($resultData);DIE;
        if ($resultData['status'] == "1000"  ) {
            return $this->render('vote',['resultData' => $resultData['data']['result']]);
        }

    }

    public function actionVote_submit(){
        if($this->iflogin()){            $this->redirect($this->loginUrl);        }
        $session = \Yii::$app->session;
        $user_msginfo = json_decode($session->get('user_msginfo'), true);
        $userId = $user_msginfo['idStr'];
        $orgIdStr = $user_msginfo['orgIdStr'];

        $value = $_POST;
        $voteId = $value['voteId'];
        $votedMemberId = $value['votedMemberId'];
        $voterId = $value['idStr'];
        $voteArr = array(
            'voteId' => $voteId,
            'votedMemberId'=> $votedMemberId,
            'voterId' => $userId,
            'voterOrgId' => $orgIdStr
        );
//        MyFunction::sun_p($voteArr);DIE;
        $resultData = MyFunction::http_post(HTTP_HOSTS . '/VoteService/vote', $voteArr);
        if ($resultData['status'] == "1000") {
            return $this->redirect('/vote/vote?id='.$voterId.'&voteSta=1&votedMemberId='.$votedMemberId.'');
        } else {
            return $this->redirect('/layouts/error404.php');
        }

    }
}

