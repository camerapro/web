<?php

namespace frontend\controllers;

use Yii;
use frontend\models\CompanyFrontend;
use frontend\models\search\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyController implements the CRUD actions for CompanyFrontend model.
 */
class CompanyController extends Controller
{
    public $enableCsrfValidation = false;
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
     * Lists all CompanyFrontend models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (Yii::$app->user->identity->level == 3){
            $dataProvider->query->andWhere(['id'=>Yii::$app->user->identity->company_id]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyFrontend model.
     * @param string $id
     * @param string $name
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CompanyFrontend model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $ajax = $this->verifyAjax();
        $model = new CompanyFrontend();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect("/company/index");
        } else {

            return $this->render('create', [
                'model' => $model,'ajax' => $ajax,
            ]);
        }
    }

    /**
     * Updates an existing CompanyFrontend model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @param string $name
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
				 'ajax' => $ajax,
            ]);
        }
    }

    /**
     * Deletes an existing CompanyFrontend model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @param string $name
     * @return mixed
     */
    public function actionDelete($id)
    {

        $enableCsrfValidation = false;
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CompanyFrontend model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @param string $name
     * @return CompanyFrontend the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyFrontend::findOne(['id' => $id])) !== null) {
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
