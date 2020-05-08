<?php

namespace app\models;

use Yii;
use yii\base\Model;
use common\models\MyFunction;
use app\core\back\BaseBackModel;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends BaseBackModel
{
    public $username;
    public $password;
    public $lng;
    public $lat;
    public $address;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
//             ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'rememberMe' => '记住账户',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login1()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser());
        } else {
            return false;
        }
    }

    //登录验证；
    public function login()
    {
        $user = LoginForm::getUser();
        if ($user !== NULL) {
            $url = HTTP_HOSTS . '/AccountService/login';
            //用户输入的数据;
            $data = \Yii::$app->request->post();
            if (isset($data['lng'])) {
                return 0;
            }
            $users = array(
                'account' => $data['username'],
                'password' => $data['password'],
                'lng' => $data['lng'],
                'lat' => $data['lat'],
                'address' => $data['address'],
            );

            $res = MyFunction::http_post($url, $users);
            if (!empty($res['data'])) {
                $user_mess = json_encode($res['data']);
                $session = \Yii::$app->session;
                $session->set('user_mess', $user_mess);
            }

            if (!empty($res['status'])) {
                if ($res['status'] == '1000') {
                    //登录成功；设置session用户名；设置session的生命周期；
                    $lifetime = 3600 * 6 * 4;
                    session_set_cookie_params($lifetime);
                    $session = \Yii::$app->session;
                    $user_mess = json_decode($session->get('user_mess'), true);
                    $username = $user_mess['user']['name'];
                    $cellphone = $user_mess['user']['cellphone'];
                    $session->set('pre_username', $username);
                    $post = \Yii::$app->request->post();
                    $post = $post['LoginForm']['rememberMe'];
                    if ($post == '1') {
                        $cookies = \Yii::$app->response->cookies;
                        $cookies->add(new \yii\web\Cookie([
                            'name' => 'pre_username',
                            'value' => $cellphone,
                            'expire' => time() + 3600,
                        ]));
                    }
                    return true;
                }
            } else {
                return false;
            }
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {   //用户输入的username;
        $_user = \Yii::$app->request->post('username');
        return $_user;

    }
}

?>