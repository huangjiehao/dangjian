<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
/*
* 微信预留信息
* URL服务器地址：http://manage.faxie8.xin/wechat/index
* Token令牌：faxie8
* EncodingAESKey(消息加解密密钥）gVrttty2Vi6u5HY1lPDcaiBOOHXj59R7oQm4WhPXAh6

* $token='faxie8';
* $EncodingAESKey='6wyi6CAmMdwIWAU2Fq58jvGpfQWrsquYGnyOI7caKpm';
* $AppSecret='a6b7b9d8ac83ac8b62a56187954a9959';

* 返回  code state
*/
//        $appid = 'wxa4dff1adf5ea0aba'; //芷晴
$appid = 'wx434c76853b3136f9'; //发泄吧
//        $redirect_uri='http://manage.faxie8.xin/oauth.php';
$redirect_uri = 'http://manage.faxie8.xin/phonelogin/oauth';
$en_uri = urlencode($redirect_uri);
header('location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . $en_uri . '&response_type=code&scope=snsapi_userinfo,snsapi_login&state=123&connect_redirect=1#wechat_redirect');


?>
</body>
</html>