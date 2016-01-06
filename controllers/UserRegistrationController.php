<?php

namespace app\controllers;

use Yii;
use app\models\RegisterForm;

class UserRegistrationController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$model = new RegisterForm();
    	if ($model->load(Yii::$app->request->post()) && $model->insertUser()) {
    		return $this->redirect("index.php?r=user-hobbies/index");
    	}
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
