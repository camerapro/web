<?php
/**
 * NvThaoVn
 * 4/2015
 * */
 
namespace api\components;
use Yii;
use yii\web\Controller;
use api\helpers\ApiHelper;
use api\models\User;
class ApiController extends Controller{    
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';
    
    const ERROR_API = 'API exception';
    const ERROR_AUTH = 'Authentication failure';
    const ERROR_SERVER = 'Server exception';
    
    const TOKEN_BEARER_HEADER_NAME = 'Bearer';
    const TOKEN_PARAM_NAME = 'access_token';
    
    public $method = self::METHOD_POST;
    public $debug = false;
    
    /*Nhung API duoc khai bao trong mang nay se khong duoc validate token*/
    public $safeApi = array(
                           //etc: 'login','register' 
                        );
    
    
    /*Khởi tạo môi trường*/
    public function beforeAction($action)
    {
		
		\Yii::$app->response->format = 'json';
		if(Yii::$app->user->isGuest)
		{
			echo  json_encode(['error_code'=>1,'message'=>'No Login']);
			exit();
		}
		return parent::beforeAction($action);
        
    }

}