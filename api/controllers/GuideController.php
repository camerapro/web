<?php

namespace frontend\controllers;
use common\components\FrontendController;
use frontend\models\News;
use Yii;
class GuideController extends FrontendController
{
    public function actionIndex()
    {
        $guide_id = isset(Yii::$app->request->get()['id']) ? Yii::$app->request->get()['id'] : 1;
        $news = News::findOne(['id'=>$guide_id, 'status'=>1]);
        return $this->render('index', ['news'=>$news]);
    }

}
