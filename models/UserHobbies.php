<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "udemy_automation.user_hobbies".
 *
 * @property integer $user_id
 * @property string $hobby
 * @property string $create_date
 *
 * @property UdemyAutomationUsers $user
 */
class UserHobbies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'udemy_automation.user_hobbies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'hobby'], 'required'],
            [['user_id'], 'integer'],
            [['create_date'], 'safe'],
            [['hobby'], 'string', 'max' => 255],
            [['hobby', 'user_id'], 'unique', 'targetAttribute' => ['hobby', 'user_id'], 'message' => 'The combination of User ID and Hobby has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'hobby' => 'Hobby',
            'create_date' => 'Create Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UdemyAutomationUsers::className(), ['id' => 'user_id']);
    }
}
