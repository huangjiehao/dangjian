<?php
namespace common\models;

class MyFunction
{
    const LIMIT_SIZE = '5048576000';//10485760  48GB
    const SESSION_PREFIX = 'ZTKJ_PB_FRONT_';//cookie前缀


    /**
     * 初始化平台
     * @return mixed
     */
    public static function init_platform()
    {
        //根据二级域名获取平台id和党委组织id
        $sldName = self::get_sld_name();
//        MyFunction::sun_p($sldName);die;
        $sendArr = array(
            //'sldName' => 'baiyun'
            'sldName' => 'nszzb'
        );
//        MyFunction::sun_p($sendArr);die;
        $session = \Yii::$app->session;
        $platformInfo = self::getSession($sldName . '_platformInfo');// $session->get('platformInfo');
//        MyFunction::sun_p($platformInfo);die;
//        MyFunction::sun_p($platformInfo);DIE;

        if (empty($platformInfo)) {
            $resultData = self::http_post(HTTP_HOSTS . '/SysManageService/getCompanyBySldName', $sendArr);
//            MyFunction::sun_p($resultData);die;
            if ($resultData['status'] != 1000 || empty($resultData['data']['result'])) {
                //企业被禁用，跳转到无法访问页面
                echo '<h1 style="text-align: center;">error</h1>';
                die;
            }
            $resultArr = json_decode($resultData['data']['result'], true);
            if (empty($resultArr['platformId']) || $resultArr['status'] == false) {
                echo '<h1 style="text-align: center;">企业被禁用，请联系管理员</h1>';
                die;
            }

            //存入客户端session，避免频繁从服务端读取
            $session->set('currPlatformId', $resultArr['platformId']);
            $session->set('currOrgDwId', $resultArr['orgId']);
            self::setSession($sldName . '_platformInfo', $resultData['data']['result']);
            return $resultArr;
        }
        return json_decode($platformInfo, true);
    }


    /**
     * 获取菜单频道
     * @return mixed|null
     */
    public static function get_menu_channel()
    {
        $sldName = self::get_sld_name();
//        MyFunction::sun_p($sldName);die;
        if (!empty(self::getSession($sldName . 'menu_channel'))) {
//            MyFunction::sun_p(self::getSession($sldName . 'menu_channel'));die;
            return json_decode(self::getSession($sldName.'menu_channel'));
        } else {
            $resultData = MyFunction::http_post(HTTP_HOSTS . '/ArticleService/getMenuChannel', array('platformId' => self::init_platform()['platformId'],'orgId'=>self::init_platform()['orgId']));
//            MyFunction::sun_p($resultData);die;
            if ($resultData['status'] == 1000) {
                $data = json_encode($resultData['data']['result']);
                self::setSession($sldName . 'menu_channel', $data);
                return json_decode($data);
            }
            return null;
        }
    }

    /**
     * 获取二级域名
     * @return mixed
     */
    public static function get_sld_name()
    {
        $server_name = $_SERVER['SERVER_NAME'];
//        MyFunction::sun_p($server_name);die;
        return explode('.', $server_name)[0];
    }

    /**
     * 获取cookie
     * @param $key
     * @return mixed
     */
    public static function getSession($key)
    {
        $session = \Yii::$app->session;
//        MyFunction::sun_p($session);die;
        return $session->get(self::SESSION_PREFIX . strtoupper($key));
    }

    /**
     * 设置cookie
     * @param $key
     * @param $val
     */
    public static function setSession($key, $val)
    {
        $session = \Yii::$app->session;
        $session->set(self::SESSION_PREFIX . strtoupper($key), $val);
    }


    public function get_curr_platform_id()
    {
        $session = \Yii::$app->session;
        $platformId = $session->get('currPlatformId');
        if (empty($platformId)) {
            $platformInfo = MyFunction::init_platform();
            return $platformInfo['platformId'];
        }
        return $platformId;
    }

    //上传文件官方唯一指定方法
    public static function upload_files($files, $param)
    {
        $data = array();
        $tmpName = $files['name'];
        $tmpFile = $files['tmp_name'];
        $tmpType = $files['type'];
        $tmpSize = $files['size'];
//        $ext = substr(strrchr($tmpName, '.'), 1);
//            if($ext == 'png')
//            {
//                return 'false_type';
//            }
//            if ($ext == 'gif' || $ext == 'jpeg' || $ext == 'png' || $ext == 'jpg') {
//            } else {
//                return 'false_type';
//            }
//        if ($tmpSize > self::LIMIT_SIZE) {
//            return 'false_size';
//        }
        $data['file'] = new \CURLFile(realpath($tmpFile), $tmpType, $tmpName);
        $data['name'] = $param['name'];
        $data['fileSize'] = $param['fileSize'];
        $url = HTTP_HOSTS . '/File/UploadFile';
        $result = json_decode(static::dispost_curl($url, $data), true);
        return json_encode($result);
//        if ($result['status'] == 1000 && isset($result['data']['att'])) {
//            return json_encode($result['data']['att']);
//        }
        return false;
    }


    function normalize_files_array($files)
    {

        $arr = [];

        foreach ($files['name'] as $index => $filename) {
            $arr[] = array(
                'name' => $filename,
                'tmp_name' => $files['tmp_name'][$index],
                'error' => $files['error'][$index],
                'size' => $files['size'][$index],
                'type' => $files['type'][$index]
            );
        }

        return $arr;
    }

    //改成指定文件名；拼接‘-large’;
    //* $url;
    //@ return new file name;
    static function rename_file($url)
    {
        $ext = strrchr($url, '.');
        $ads = strpos($url, $ext);
        $str = substr($url, 0, $ads);
        return $str . '-large' . $ext;
    }

    //上传单文件；
    static function dispose_file($files)
    {
        if ($files['fname']['size'] > 0) {
            $tmpName = $files['fname']['name'];
            $tmpFile = $files['fname']['tmp_name'];
            $tmpType = $files['fname']['type'];
//            return '@' . realpath($tmpFile) . ";type=" . $tmpType . ";filename=" . $tmpName;
            return new \CURLFile(realpath($tmpFile), $tmpType, $tmpName);
        }
        return null;
    }

    //膳食jian
    static function dispose_fiie($files)
    {
        if ($files['fmame']['size'] > 0) {
            $tmpName = $files['fmame']['name'];
            $tmpFile = $files['fmame']['tmp_name'];
            $tmpType = $files['fmame']['type'];
//            return '@' . realpath($tmpFile) . ";type=" . $tmpType . ";filename=" . $tmpName;
            return new \CURLFile(realpath($tmpFile), $tmpType, $tmpName);
        }
        return null;
    }


    static function dispose_filesss($files)
    {
        $data = '';
        $files = $files['fname'];
//        return $files;
        $count = count($files['name']);
//        return $count;
//        for ($i = 0; $i < $count; $i++) {
//            $tmpFile = $files['tmp_name'][$i];
//            $tmpType = $files['type'][$i];
//            $tmpName = $files['name'][$i];
//            $data[$i]= new \CURLFile(realpath($tmpFile),$tmpType,$tmpName);
//        }
        foreach ($files as $key => $v) {
            $data[$key] = new \CURLFile(realpath($v['tmp_name']), $v['type'], $v['name']);
            //var_dump($data);
        }
        return json_encode($data);

    }


    static function dispose_files($files)
    {
        $data = array();
        $files = $files['fname'];
        $count = count($files['name']);
        for ($i = 0; $i < $count; $i++) {
            $tmpFile = $files['tmp_name'][$i];
            $tmpType = $files['type'][$i];
            $tmpName = $files['name'][$i];
            $data[$i] = '@' . realpath($tmpFile) . ";type=" . $tmpType . ";filename=" . $tmpName;
        }
//        foreach ($files as $key => $v) {
//            $data[$key] = '@' . realpath($v['tmp_name']) . ";type=" . $v['type'] . ";filename=" . $v['name'];
//        }

        return $data;

    }


    //不带model，上传多图
    public static function upload_images($files, $limit = 20, $projSignImplId, $remark, $name)
    {
        $data = array();
        //$files = $files['files'];

        $count = count($files['name']);

        if ($count > $limit) {
            return 'false_limit';
        }
        if ($count > 0) {
            for ($i = 0; $i < $count; $i++) {
                $tmpName = $files['tmp_name'][$i];
                $tmpType = $files['type'][$i];
                $fileName = $files['name'][$i];
                $tmpSize = $files['size'][$i];
                $img_info = getimagesize($tmpName);
                //防非法图片攻击
                if (!$img_info) {
                    return 'false_illegal';
                }
                //如果上传有错
                if ($files['error'][$i] > 0) {
                    return 'false_error';
                }

                if ($fileName) {

                    $commit = array('gif', 'jpeg', 'jpg', 'png', 'doc', 'docx', 'xls');//允许上传的类型
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);

                    if (!in_array($ext, $commit)) {
                        return 'false_type';
                    }
                }

                if ($tmpSize > self::LIMIT_SIZE) {
                    return 'false_size';
                }
                $data['projSignImplId'] = $projSignImplId;
                $data['remark'] = $remark;
                $data['name'] = $name;
                $data['file1'] = new \CURLFile(realpath($tmpName), $tmpType, $fileName);
                $url = HTTP_HOSTS . '/ProjectExtService/UploadAtt';
                $data = json_encode($data, JSON_UNESCAPED_UNICODE);

                $re = json_decode(static::dispost_curl($url, $data), true);
                $res = json_decode($re['data'], true);
                $files[$i] = $res[0];

                //        return json_encode($re);die;
            }
        }

//        return json_encode($file);
    }

    public static function upload_img($files, $limit = 20, $projSignImplId, $remark, $name)
    {
        $data = array();
//      $files = $files;
        $count = count($files['name']);
        if ($count > $limit) {
            return 'false_limit';
        }
        $tmpName = $files['tmp_name'];
        $tmpType = $files['type'];
        $fileName = $files['name'];
        $tmpSize = $files['size'];

        //如果上传有错
        if ($files['error'] > 0) {
            return 'false_error';
        }

        if ($fileName) {
            $commit = array('gif', 'jpeg', 'jpg', 'png', 'doc', 'docx', 'xls', 'rar', 'zip', 'iso', 'html', 'exe', 'pdf', 'rm', 'avi', 'tmp', 'xls', 'mdf', 'txt', 'xlsx', 'mid');//允许上传的类型
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            if (!in_array($ext, $commit)) {
                return 'false_type';
            }
        }


        if ($tmpSize > self::LIMIT_SIZE) {
            return 'false_size';
        }
        $data['projSignImplId'] = $projSignImplId;
        $data['remark'] = $remark;
        $data['name'] = $name;
        $data['file'] = new \CURLFile(realpath($tmpName), $tmpType, $fileName);
        //$data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $url = HTTP_HOSTS . '/ProjectExtService/UploadAtt';
        $re = json_decode(static::dispost_curl($url, $data), true);
//        $res = $re['data'];
//        $file = $res;
//        }

        return json_encode($re);
        die;
    }

    //
    public static function upload_img_follow($files, $limit = 20, $businessId, $content, $businessName, $userId, $userName, $followDate, $contactId, $contactName, $clientId, $clientName, $followerMpeJson)
    {
        $data = array();
        //$files = $files['files'];
        if (!empty($files['name'])) {
            $tmpName = $files['tmp_name'];
            $tmpType = $files['type'];
            $fileName = $files['name'];
            $tmpSize = $files['size'];

            //如果上传有错
            if ($files['error'] > 0) {
                return 'false_error';
            }

            if ($fileName) {
                $commit = array('gif', 'jpeg', 'jpg', 'png', 'doc', 'docx', 'xls', 'rar', 'zip', 'pdf');//允许上传的类型
                $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                if (!in_array($ext, $commit)) {
                    return 'false_type';
                }
            }


            if ($tmpSize > self::LIMIT_SIZE) {
                return 'false_size';
            }
        }
        $data['businessId'] = $businessId;
        $data['businessName'] = $businessName;
        $data['content'] = $content;
        $data['userId'] = $userId;
        $data['userName'] = $userName;
        $data['followDate'] = $followDate;
        $data['contactId'] = $contactId;
        $data['contactName'] = $contactName;
        $data['clientId'] = $clientId;
        $data['clientName'] = $clientName;
        $data['followerMpeJson'] = $followerMpeJson;
        //$data = json_encode($data, JSON_UNESCAPED_UNICODE);
        if (!empty($files['name'])) {
//            $data['file'] = new \CURLFile(realpath($tmpName), $tmpType, $fileName);
            $data['file'] = '@' . realpath($tmpName);

        }
        //$data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $url = HTTP_HOSTS . '/BusinessService/addFollowUp';
        $re = json_decode(static::dispost_curl($url, $data), true);
//        $res = $re['data'];
//        $file = $res;
//        }

        return json_encode($re);
        die;
    }

    //文件上传,curl处理；
    static function dispost_curl($url, $data)
    {
//        application/x-www-form-urlencoded
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/x-www-form-urlencoded',
        ));
        // curl_getinfo($ch);
        $return_data = curl_exec($ch);
        curl_close($ch);
        return $return_data;
    }

    static function upload_filess($files)
    {
        $data_file = '';
        $files = $files['fname'];
//        return $files;
        $count = count($files['name']);
//        return $count;
        for ($i = 0; $i < $count; $i++) {
            $tmpFile = $files['tmp_name'][$i];
            $tmpType = $files['type'][$i];
            $tmpName = $files['name'][$i];
            $data_file .= '@' . realpath($tmpFile) . ";type=" . $tmpType . ";filename=" . $tmpName;
//            $data_file[$i] = new \CURLFile($tmpFile,$tmpType,$tmpName);
        }
        return $data_file;
//        $ch = curl_init($url);
//        $data['attachFiles'] = $data_file;
//        curl_setopt($ch, CURLOPT_POST,1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//        $return_data = curl_exec($ch);
//        curl_close($ch);
//        return $return_data;
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
                if (empty($data['platformId'])) {
                    $session = \Yii::$app->session;
                    $user_info = $session->get('user_msginfo');
                    if (isset($user_info) && !empty($user_info)) {
                        $user = json_decode($user_info, true);
                        if (is_array($user)) {
                            $data['platformId'] = $user['platformIdStr'];
                        }
                    }
                }
                if (!isset($data['dbStatus']) || empty($data['dbStatus'])) {
                    $data['dbStatus'] = '0';
                }
                $data = json_encode($data, JSON_UNESCAPED_UNICODE);
//                MyFunction::sun_p($data);die;
            } else {
//                die;
            }

            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_HEADER, 0);

            $session = \Yii::$app->session;
            $javaSessionId = $session['javaSessionId'];

            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type:application/json;charset=utf-8',
                'Content-Length:' . strlen($data),
//                'Cookie:sid=' . $javaSessionId
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $res = curl_exec($curl);
            $errorno = curl_errno($curl);
            if ($errorno) {
                return array('error' => false, 'errmsg' => $errorno);
            }
//MyFunction::sun_p($res );DIE;
            curl_close($curl);
//            die;
//            echo 'javasessionid:'.$javaSessionId;
            return json_decode($res, true);
        }
    }

    //get请求
    static function http_get($url, $data = NULL)
    {
        $url = $url . '?' . $data;
        $session = \Yii::$app->session;
        $javaSessionId = $session['javaSessionId'];
        $header = array(
            'Content-Type: application/json',
            'Authorization: token 4e56266f2502936e0378ea6a985dc74a5bec4280',
            'Cookie:sid=' . $javaSessionId
        );
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

    static function sun_download($filename)
    {
//        if (isset($file_name)) {
//            $filename = $file_name . '.' . $suffix;
//        } else {
//            $filename = $_GET['file'] . '.' . $suffix;
//        }

        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment; filename=" . $filename);
        readfile($filename);
    }

    //格式化打印；
    static function sun_p($str)
    {
        echo '<pre>';
        print_r($str);
        echo '</pre>';
    }

    static function sun_jump($msg, $url = '')
    {
        if ($url == '') {
            echo '<script>alert("' . $msg . '");history.go(-1);</script>';
        } else {
            echo '<script>alert("' . $msg . '");location="', $url, '"</script>';
        }
        exit();
    }

    /**
     * 某个元素在一维或二维数组中出现的次数
     * @param $key
     * @param $arr
     * @return int
     */
    static function arrcount($key, $arr)
    {
        $count = 0;

        foreach ($arr as $k => $v) {
            if ($v == array()) {
                foreach ($v as $k1 => $v1) {
                    if ($v1 == $key) {
                        $count++;
                    }
                }
            } else {
                if ($v == $key) {
                    $count++;
                }
            }

        }
        return $count;
    }

    /**
     * 字符串截取，支持中文和其他编码
     * @static
     * @access public
     * @param string $str 需要转换的字符串
     * @param string $length 截取长度
     * @return string
     */
    static function msubstr0($str, $length)
    {
        return self::msubstr($str, 0, $length, "utf-8", true);
    }

    /**
     * 字符串截取，支持中文和其他编码
     * @static
     * @access public
     * @param string $str 需要转换的字符串
     * @param string $start 开始位置
     * @param string $length 截取长度
     * @param string $charset 编码格式
     * @param string $suffix 截断显示字符
     * @return string
     */
    static function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true)
    {
        if (function_exists("mb_substr"))
            $slice = mb_substr($str, $start, $length, $charset);
        elseif (function_exists('iconv_substr')) {
            $slice = iconv_substr($str, $start, $length, $charset);
            if (false === $slice) {
                $slice = '';
            }
        } else {
            $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("", array_slice($match[0], $start, $length));
        }
        if ($suffix && mb_strlen($str, 'utf-8') > $length)
            return $slice . '...';
        return $slice;
    }

    //对象转数组,使用get_object_vars返回对象属性组成的数组
    static function objectToArray($obj)
    {
        $arr = is_object($obj) ? get_object_vars($obj) : $obj;
        if (is_array($arr)) {
            return array_map(__FUNCTION__, $arr);
        } else {
            return $arr;
        }
    }

    //数组转对象
    static function arrayToObject($arr)
    {
        if (is_array($arr)) {
            return (object)array_map(__FUNCTION__, $arr);
        } else {
            return $arr;
        }
    }

    const API_HEAD = 'http://www.baidu.com';

    function api_request($uri, $params, $method = 'GET')
    {
        $apiUrl = API_HEAD . $uri;
        if ($method == 'get') {
            $url = 'http://www.baidu.com';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = json_decode(curl_exec($ch), true);

    }

    //按顺序排列数组；
    static function resort_array($array, $field, $direction = 'SORT_ASC')
    {
        $sort = array(
            'direction' => $direction, //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
            'field' => $field,       //排序字段
        );
        $arrSort = array();
        foreach ($array as $uniqid => $row) {
            foreach ($row as $key => $value) {
                $arrSort[$key][$uniqid] = $value;
            }
        }
        if ($sort['direction']) {
            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $array);
        }
        return $array;
    }

    /**
     * @param $time
     * @return 格式化星期几
     */
    static function print_week($time)
    {
        $day = date('w', $time);
        if (is_numeric($day)) {
            $weekday = array('周日', '周一', '周二', '周三', '周四', '周五', '周六');

            return $weekday[$day];
        }


    }

    static function getFirstCharter($str)
    {
        if (empty($str)) {
            return '';
        }
        $fchar = ord($str{0});
        if ($fchar >= ord('A') && $fchar <= ord('z')) return strtoupper($str{0});
        $s1 = iconv('UTF-8', 'gb2312', $str);
        $s2 = iconv('gb2312', 'UTF-8', $s1);
        $s = $s2 == $str ? $s1 : $str;
        $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
        if ($asc >= -20319 && $asc <= -20284) return 'A';
        if ($asc >= -20283 && $asc <= -19776) return 'B';
        if ($asc >= -19775 && $asc <= -19219) return 'C';
        if ($asc >= -19218 && $asc <= -18711) return 'D';
        if ($asc >= -18710 && $asc <= -18527) return 'E';
        if ($asc >= -18526 && $asc <= -18240) return 'F';
        if ($asc >= -18239 && $asc <= -17923) return 'G';
        if ($asc >= -17922 && $asc <= -17418) return 'H';
        if ($asc >= -17417 && $asc <= -16475) return 'J';
        if ($asc >= -16474 && $asc <= -16213) return 'K';
        if ($asc >= -16212 && $asc <= -15641) return 'L';
        if ($asc >= -15640 && $asc <= -15166) return 'M';
        if ($asc >= -15165 && $asc <= -14923) return 'N';
        if ($asc >= -14922 && $asc <= -14915) return 'O';
        if ($asc >= -14914 && $asc <= -14631) return 'P';
        if ($asc >= -14630 && $asc <= -14150) return 'Q';
        if ($asc >= -14149 && $asc <= -14091) return 'R';
        if ($asc >= -14090 && $asc <= -13319) return 'S';
        if ($asc >= -13318 && $asc <= -12839) return 'T';
        if ($asc >= -12838 && $asc <= -12557) return 'W';
        if ($asc >= -12556 && $asc <= -11848) return 'X';
        if ($asc >= -11847 && $asc <= -11056) return 'Y';
        if ($asc >= -11055 && $asc <= -10247) return 'Z';
        return null;
    }

    static function sortchinesename($result)
    {

        $settlesRes = array();

        //  $sett='';
        foreach ($result['data'] as $v) {
            //$sname = $shopData[$sett['sid']];
            $teacherName = $v['teacherName'];
            $sett['teacherName'] = $teacherName;
            $snameFirstChar = self::getFirstCharter($teacherName);
            //$snameFirstChar = $v['teacherName'];
            if (in_array($snameFirstChar, $settlesRes)) {

                //$sett = array_merge($settlesRes[$snameFirstChar], $sett);

                $settlesRes[$snameFirstChar] = $sett;
            } else {
                $settlesRes[$snameFirstChar] = $sett;//以这个首字母作为key
            }

            ksort($settlesRes); //对数据进行ksort排序，以key的值升序排序
            //return self::sun_p($settlesRes);
        }

    }

    static function datecut($date)
    {
        $shu = explode('/', $date);
        $shu[2] = trim($shu[2]);
        $str = $shu[2] . '-' . $shu[0] . '-' . $shu[1];
        /* foreach($shu as $k=>$v){
          $time[$k]=$v;
         }
         $ti[0]=$time[2];
         $ti[1]=$time[0];
         $ti[2]=$time[1];
         $rr='';
         foreach ($ti as $k=>$v){
             if($k!=2){
                 $rr.=$v."-";
             }else{
                 $rr.=$v;
             }

         }*/

        return $str;
    }


    static function http_sun_post($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return_data = curl_exec($ch);
        curl_close($ch);
        return json_decode($return_data, true);
    }


}

?>
