<?php

namespace app\controllers;

use app\models\UserHobbies;

class UserHobbiesController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$model = new UserHobbies();
        return $this->render('index', [
        	'model' => $model,
        ]);
    }

}
