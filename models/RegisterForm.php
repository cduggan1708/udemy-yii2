<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * RegisterForm is the model behind the register form.
 */
class RegisterForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'password_repeat'], 'required'],
            [['username', 'password', 'password_repeat'], 'string', 'max' => 40],
            [['username', 'password', 'password_repeat'], 'string', 'min' => 6],
            [['password_repeat'], 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
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
     * Creates user record
     *
     * @return User|null
     */
    public function insertUser()
    {
        if ($this->_user === false) {
            $this->_user = new User();
            $this->_user->username = $this->username;
            $this->_user->password = md5($this->password);
            $this->_user->create_date = date("Y-m-d H:i:s");
        }

        $this->_user->insert();

        return $this->_user;
    }
}
