<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * AddHobbyForm is the model behind the add hobby form.
 */
class AddHobbyForm extends Model
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
        ];
    }

    public function getUserHobbies()
    {
        return UserHobbies::find()->where(['user_id' => Yii::$app->user->getId()])->all();
    }

    public function insertUserHobby($hobby_name)
    {
        $hobby = new UserHobbies();
        $hobby->user_id = Yii::$app->user->getId();
        $hobby->hobby = $hobby_name;
        return $hobby->insert();
    }
}