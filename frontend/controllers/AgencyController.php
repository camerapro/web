<?php

namespace frontend\controllers;

use Yii;
use common\models\Agency;
use frontend\models\search\AgencySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\FrontendUser;

/**
 * AgencyController implements the CRUD actions for Agency model.
 */
class AgencyController extends Controller
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
     * Lists all Agency models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AgencySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Agency model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Agency model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Agency();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
            //create user 
			$data = Yii::$app->request->post();
			$user_data = $data['User'];
			$user_name = $user_data['username'];
            $user = FrontendUser::findOne(['username'=>$user_name]);
            if(!$user){
                 $user = new FrontendUser();
            }
            $user->username = $user_data['username'];
            $user->fullname = $user_data['fullname'];
            $user->email = $user_data['email'];
            $user->phone = $user_data['phone'];
      
            $user->password = md5($user_data['password']);
            $user->address = $user_data['address'];
            $user->level = $data['level'];
     
            $user->expired_time = date('Y-m-d', strtotime($user_data['expired_time']));
            $user->created_time = date('Y-m-d H:i:s');
            $user->updated_time = date('Y-m-d H:i:s');
            $user->status = 1;
            $user->company_id = $model->id;
            if(isset($user_data['status']) && $user_data['status'] == 1){
                $user->status = 0;
            }
            $user->permission_group_id =  isset($data['permission']) ? $data['permission'] : 1;
            if ($user->save(false)) {
                 return $this->redirect("/agency/index");
            }else{
                $error = 'Có lỗi xảy ra, vui lòng liên hệ kỹ thuật';
                return;
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Agency model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Agency model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Agency model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Agency the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Agency::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
