<?php
namespace frontend\models;

//use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username'], 'required', 'message'=>'Vui lòng nhập tên đăng nhập!'],
            [['password'], 'required', 'message'=>'Vui lòng nhập mật khẩu!'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
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
            if (!$user) {
                $this->addError($attribute, 'Tên đăng nhập hoặc mật khẩu không chính xác!');
            }else{
                if($user->password != md5($this->password)){
//            if(!$user->validatePassword($user, $this->password)){
                    $this->addError($attribute, 'Tên đăng nhập hoặc mật khẩu không chính xác!');
                }
            }

        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), 3600 * 24 * 30);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = FrontendUser::findByUsername($this->username);
        }
        return $this->_user;
    }


}
