<?php

namespace frontend\controllers;

use Yii;
use frontend\models\CompanyFrontend;
use frontend\models\search\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\FrontendUser;

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
        $type = isset(Yii::$app->request->get()['type']) ? Yii::$app->request->get()['type'] : '';
        if($type == 'perlist')
        {
            $this->layout = false;
            $id = isset(Yii::$app->request->get()['id']) ? Yii::$app->request->get()['id'] : '';
            return $this->render('permission_list',['id'=>$id]);
        }
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
		
        if ($model->load(Yii::$app->request->post())) {
			$model->expired_time = date('Y-m-d', strtotime($user_data['expired_time']));
			$model->created_time = date('Y-m-d H:i:s');
			if($model->save()){
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
                 return $this->redirect("/company/index");
            }else{
                $error = 'Có lỗi xảy ra, vui lòng liên hệ kỹ thuật';
                return;
            }
			}
			
           
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
