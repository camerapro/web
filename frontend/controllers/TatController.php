<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TatFrontend;
use frontend\models\search\TatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TatController implements the CRUD actions for TatFrontend model.
 */
class TatController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TatFrontend models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TatFrontend model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
	    $ajax= $this->verifyAjax();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TatFrontend model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$ajax= $this->verifyAjax();
        $model = new TatFrontend();

        if ($model->load(Yii::$app->request->post()) ) {
			$model->user_id = Yii::$app->user->identity->id;
			if($model->save())
            return $this->redirect(['index']); 
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TatFrontend model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		$ajax= $this->verifyAjax();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TatFrontend model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TatFrontend model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TatFrontend the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TatFrontend::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	private function verifyAjax(){
        if(Yii::$app->request->isAjax){
			$this->layout = false;
            return true;
        }
		return false;
    }
}
