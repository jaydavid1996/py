<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
Use yii\helpers\Url;


class PlayertController extends Controller
{
    /**
     * Lists all Location models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}
