<?php

namespace frontend\controllers;

use common\components\FrontendController;
use frontend\models\FrontendCamera;
use frontend\models\RelationsUserPermissionGroup;
use Yii;
use frontend\models\FrontendUser;
use frontend\models\search\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends FrontendController
//class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if( Yii::$app->user->identity->level >= 3){
            $searchModel = new UserSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }else{
            $searchModel = new UserSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andWhere(['id'=>Yii::$app->user->identity->id]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FrontendUser();
        $error= '';
//        print_r(Yii::$app->request->get());exit;
        $data = (Yii::$app->request->get());
        if(!empty($data)){
            $user_name = trim($data['username']);
            $check_exits = FrontendUser::findOne(['username'=>$user_name]);
            if($check_exits){
                $error = 'Tên đăng nhập đã tồn tại, vui lòng chọn tên đăng nhập khác';
                goto return_exit;
            }

            $full_name = $data['name'];
            $email = $data['email'];
            $phone = $data['phone'];
            $occupation = $data['occupation'];
            $password = $data['password'];

            $model->username = $user_name;
            $model->fullname = $full_name;
            $model->email = $email;
            $model->phone = $phone;
            $model->phone = $phone;
            $model->password = md5($password);
            $model->address = $occupation;
            $model->level = $data['level'];
            if(isset($data['gender'])) $model->gender = (int) $data['gender'];
//            $model->birthday = date('Y-m-d', strtotime($data['birthday']));
            $model->created_time = date('Y-m-d H:i:s');
            $model->updated_time = date('Y-m-d H:i:s');
            $model->status = 1;
            $model->permission_group_id =  isset($data['permission']) ? $data['permission'] : 1;
            if ($model->save()) {
                return $this->redirect(['index']);
            }else{
                $error = 'Có lỗi xảy ra, vui lòng liên hệ kỹ thuật';
                goto return_exit;
            }
        }
        return_exit:
        return $this->render('create', [
            'model' => $model,
            'error'=>$error
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $error= '';
        $data = (Yii::$app->request->get());
        if(!empty($data) && !empty($data['username'])){
            $user_name = trim($data['username']);
            $check_exits = FrontendUser::findOne(['username'=>$user_name]);
            if($check_exits && $user_name <>  $model->username){
                $error = 'Tên đăng nhập đã tồn tại, vui lòng chọn tên đăng nhập khác';
                goto return_exit;
            }

            $full_name = $data['name'];
            $email = $data['email'];
            if($check_exits && $email == $check_exits->email && $email <>  $model->email) {
                $error = 'Email đã được sử dụng bởi tài khoản khác, vui lòng nhập email chính xác!';
                goto return_exit;
            }
            $phone = $data['phone'];
            $occupation = $data['occupation'];

            $model->username = $user_name;
            $model->fullname = $full_name;
            $model->email = $email;
            $model->phone = $phone;
            if(isset($data['password']) && $data['password'] != ''){
                $model->password = md5($data['password']);
            }
            $model->address = $occupation;
            if(isset($data['gender'])) $model->gender = (int) $data['gender'];
//            $model->birthday = date('Y-m-d', strtotime($data['birthday']));
            $model->updated_time = date('Y-m-d H:i:s');
            $model->level = $data['level'];
            $model->status = 1;
            $model->permission_group_id = isset($data['permission']) ? $data['permission'] : 1;
            if ($model->save()) {
                return $this->redirect(['index']);
            }else{
                $error = 'Có lỗi xảy ra, vui lòng liên hệ kỹ thuật';
                goto return_exit;
            }
        }
        return_exit:
        return $this->render('update', [
            'model' => $model,
            'error'=>$error,
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FrontendUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGrand(){
        $user_grand_id = Yii::$app->session['user_id'];
        $user_id = Yii::$app->user->identity->id;
        $list_cam = $list_cam_granded = [];
        $granded = 0;
        if(($user_grand_id)){
            $granded = 1;
            $list_cam = FrontendCamera::getAllCamByGrandId($user_grand_id);
            $list_cam_granded = FrontendCamera::getAllCamGranded($user_grand_id, $user_id);
        }

        return $this->render('grand', [
            'list_cam'=>$list_cam,
            'list_cam_granded'=>$list_cam_granded,
            'granded'=>$granded,
        ]);
    }

}
