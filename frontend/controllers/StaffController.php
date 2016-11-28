<?php

namespace frontend\controllers;

use Yii;
use frontend\models\StaffFrontend;
use frontend\models\search\StaffSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * StaffController implements the CRUD actions for StaffFrontend model.
 */
class StaffController extends Controller
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
     * Lists all StaffFrontend models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (Yii::$app->user->identity->level == 3){
            $dataProvider->query->andWhere(['company_id'=>Yii::$app->user->identity->company_id]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StaffFrontend model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StaffFrontend model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
            $model = new StaffFrontend();
        if ($model->load(Yii::$app->request->post()) ) {
            $data = Yii::$app->request->post('StaffFrontend');
			
			$image =  $_FILES['StaffFrontend']['tmp_name']['imageFile'];
			
			
            unset($data['imageFile']);
            $model->name =$data['name'];
            $model->phone =$data['phone'];
            $model->card_code =$data['card_code'];
            $model->card_id =$data['card_id'];
            $model->department_id =$data['department_id'];
            $model->created_time = isset($data['created_time'])?$data['created_time'] : date('Y-m-d H:i:s');
            $model->status = isset($data['status'])?$data['status']:1;
            $model->created_by = Yii::$app->user->identity->id;
            $model->company_id = $data['company_id'];
            if($model->save()){
				if($image){
					die('ưerwer');
					$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
					$model->image_name = $model->id;
					$model->save_path = Yii::$app->params['images']['staff']['path'].'/'. $model->company_id;
					if ($model->upload()) {

					}
					else{

					}
				}
                
            }
            return $this->redirect("/staff/index");
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StaffFrontend model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
          $data = Yii::$app->request->post('StaffFrontend');
			$image =  $_FILES['StaffFrontend']['tmp_name']['imageFile'];
            unset($data['imageFile']);
            $model->name =$data['name'];
            $model->phone =$data['phone'];
            $model->card_code =$data['card_code'];
            $model->card_id =$data['card_id'];
            $model->department_id =$data['department_id'];
            $model->created_time = isset($data['created_time'])?$data['created_time'] : date('Y-m-d H:i:s');
            $model->status = isset($data['status'])?$data['status']:1;
            $model->created_by = Yii::$app->user->identity->id;
            $model->company_id = $data['company_id'];
            if($model->save()){
				if($image){
					
					$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
					$model->image_name = $model->id;
					$model->save_path = Yii::$app->params['images']['staff']['path'].'/'. $model->company_id;
					if ($model->upload()) {
							//die('ddd');
					}
					else{
						die('dddcvcvc');
					}
				}
            }
            return $this->redirect("/staff/index");
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StaffFrontend model.
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
     * Finds the StaffFrontend model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StaffFrontend the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StaffFrontend::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
