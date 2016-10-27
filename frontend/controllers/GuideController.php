<?php

namespace frontend\controllers;
use frontend\models\News;
use \yii\web\Controller;
class GuideController extends Controller
{
    public function actionIndex()
    {
        $news = News::findOne(['id'=>1, 'status'=>1]);
        return $this->render('index', ['news'=>$news]);
    }

}
