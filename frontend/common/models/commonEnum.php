<?php
namespace common\models;

class commonEnum
{
    //获取招标方式
    static function getAllInviteBidsTypeId(  $inviteBidsTypeId ){//声明一个属性或方法
        $inviteBidsType = "没有状态";
        switch( $inviteBidsTypeId ){
            case 4:
                $inviteBidsType = "公开招标";
                break;
            case 5:
                $inviteBidsType = "内部邀标";
                break;
        }
        return $inviteBidsType;
    }

    //课程性质
    static function getCrlmPty( $id ){//声明一个属性或方法
        $CrlmPty = "没有状态";
        switch( $id ){
            case 19:
                $CrlmPty = "必学";
                break;
            case 20:
                $CrlmPty = "选学";
                break;
        }
        return $CrlmPty;
    }
    static function getDocumentStatus($satus){
        $statusName="无";
        switch ($satus){
            case 0:
                $statusName="草稿";
                break;
            case 1:
                $statusName="已发送";
                break;
        }
        return $statusName;
    }
    static function getWishState($satus){
        $statusName="无";
        switch ($satus){
            case 0:
                $statusName="草稿";
                break;
            case 1:
                $statusName="认领中";
                break;
            case 2:
                $statusName="已认领";
                break;
            case 3:
                $statusName="已完成";
                break;
        }
        return $statusName;
    }

//    申请救助进度
    static function getRescueState($rescuesatus){
        $rescuestatusName="无";
        switch ($rescuesatus){
            case 0:
                $rescuestatusName="待审核";
                break;
            case 1:
                $rescuestatusName="已通过";
                break;
            case 2:
                $rescuestatusName="未通过";
                break;
        }
        return $rescuestatusName;
    }

    //获取投票类型
    static function getAllVoteTypeId(  $voteType ){ //声明一个属性或方法
        $getVoteType = "没有状态";
        switch( $voteType ){
            case 0:
                $getVoteType = "基层评议";
                break;
            case 1:
                $getVoteType = "活动投票";
                break;
            case 2:
                $getVoteType = "先进党员";
                break;
            case 3:
                $getVoteType = "选举投票";
                break;
        }
        return $getVoteType;
    }

    static function getAnsType($satus){
        $statusName="无";
        switch ($satus){
            case 0:
                $statusName="草稿";
                break;
            case 1:
                $statusName="待答复";
                break;
            case 2:
                $statusName="已答复";
                break;
            case 3:
                $statusName="公开";
                break;
            case 4:
                $statusName="屏蔽";
                break;
        }
        return $statusName;
    }

    //投票方式
    static function getAllVoteVisitorId($voteType){ //声明一个属性或方法
        $getVoteType = "没有状态";
        switch( $voteType ){
            case 0:
                $getVoteType = "非游客投票";
                break;
            case 1:
                $getVoteType = "游客投票";
                break;
        }
        return $getVoteType;
    }

};

?>