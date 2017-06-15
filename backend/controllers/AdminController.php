<?php
namespace backend\controllers;
use backend\models\Admin;
use backend\models\LoginForm;
use backend\models\NewpsForm;
use yii\web\Controller;

class AdminController extends Controller{
    public function actionIndex()
    {
        $admins = Admin::find()->all();
        return $this->render('index',['admins'=>$admins]);
    }
    public function actionAdd()
    {
        $models=new Admin();
        if($models->load(\Yii::$app->request->post())){
            if($models->validate()){
                $password = \Yii::$app->security->generatePasswordHash($models->password_hash);
                $models->password_hash=$password;
                $models->last_login_ip=$_SERVER["REMOTE_ADDR"];
                $models->save();
                return $this->redirect(['admin/index']);
            }
        }return $this->render('add',['models'=>$models]);
    }
    public function actionEdit($id){
        $models=Admin::findOne(['id'=>$id]);
        if($models->load(\Yii::$app->request->post())){
            if($models->validate()){
                $password = \Yii::$app->security->generatePasswordHash($models->password_hash);
                $models->password_hash=$password;
                $models->last_login_ip=$_SERVER["REMOTE_ADDR"];
                $models->save();
                return $this->redirect(['admin/index']);
            }
        }return $this->render('add',['models'=>$models]);
    }
    public function actionDel($id){
        $model = Admin::findOne(['id'=>$id]);
        $model->delete();
        return $this->redirect(['admin/index']);
    }
    public function actionLogin(){
        $model = new LoginForm();
        $request = \Yii::$app->request;
        if($request->isPost){
            $model->load($request->post());
            if($model->login()){
                $admins = Admin::findOne(['username'=>$model->username]);
                $admins->last_login_time=time();
                $admins->last_login_ip=$_SERVER['REMOTE_ADDR'];
                $admins->save();
                \Yii::$app->session->setFlash('success','登录成功');
                return $this->redirect(['admin/index']);
}
        }
        return $this->render('login',['model'=>$model]);
    }
    public function actionLogout(){
        \Yii::$app->user->logout();
        \Yii::$app->session->setFlash('success','注销成功');
        return $this->redirect(['admin/login']);
    }
//    public function actionNewps(){
//        $newps=new NewpsForm();
//        if($newps->load(\Yii::$app->request->post())){
//            if($newps->validate()){
//
//                //$post_password=\Yii::$app->security->generatePasswordHash($post_password);
//                    if($newps->pscheck()){
//                        $password=\Yii::$app->security->generatePasswordHash($this->password_hash1);
//                        $this->id=\Yii::$app->session->get('id');
//                        $id=$this->id;
//                        var_dump($id);exit;
//                        $admin->password_hash=$password;
//                        $admin->save();
//                }
//            }
//        }
//        return $this->render('newps',['newps'=>$newps]);
//    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'minLength'=>4,
                'maxLength'=>4,

            ],
        ];
    }
}