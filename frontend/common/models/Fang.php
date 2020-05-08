<?php
namespace common\models;
/**
 * Created by PhpStorm.
 * User: Mars
 * Date: 2017/1/10/0010
 * Time: 16:23
 */
class Fang{

//get请求
    static function http_get($url, $data = NULL)
    {
        $url = $url . '?' . $data;
        $header = array(
            'Content-Type: application/json',
            'Authorization: token 4e56266f2502936e0378ea6a985dc74a5bec4280');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        curl_close($ch);

        //打印获得的数据
        return json_decode($output, true);

    }

    //post请求；
    static function http_post($url, $data = NULL)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        if (!empty($data)) {
            if (is_array($data)) {
                $data = json_encode($data, JSON_UNESCAPED_UNICODE);
            }
            $session = \Yii::$app->session;
            $javaSessionId = $session['javaSessionId'];
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type:application/json;charset=utf-8',
                'Content-Length:' . strlen($data),
                'Cookie:sid='.$javaSessionId
            ));
//            echo "124";
//            echo $javaSessionId;
//            die;
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $res = curl_exec($curl);

            $errorno = curl_errno($curl);
            if ($errorno) {
                return array('error' => false, 'errmsg' => $errorno);
            }

            curl_close($curl);
            return json_decode($res, true);

        }
    }

    //post请求；
    static function http_post_stream($url, $data = NULL)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        if (!empty($data)) {
            if (is_array($data)) {
                $data = json_encode($data, JSON_UNESCAPED_UNICODE);
            }
            $session = \Yii::$app->session;
            $javaSessionId = $session['javaSessionId'];
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type:application/json;charset=utf-8',
                'Content-Length:' . strlen($data),
                'Cookie:sid='.$javaSessionId
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $res = curl_exec($curl);

            $errorno = curl_errno($curl);
            if ($errorno) {
                return array('error' => false, 'errmsg' => $errorno);
            }

            curl_close($curl);
            return $res;

        }
    }

}