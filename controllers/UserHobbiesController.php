<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\AddHobbyForm;

class UserHobbiesController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	if(Yii::$app->user->isGuest) { // guests are not allowed here
    		$this->redirect("index.php?r=site/login");
    	}

    	$model = new AddHobbyForm();
        return $this->render('index', [
        	'model' => $model,
        ]);
    }

}
