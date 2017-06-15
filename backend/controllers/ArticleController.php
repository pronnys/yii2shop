<?php
namespace backend\controllers;
use backend\models\Article;
use backend\models\ArticleDetail;
use yii\web\Controller;

class ArticleController extends Controller{
    public function actionIndex(){
        $articles=Article::find()->all();
        return $this->render('index',['articles'=>$articles]);
    }
    public function actionAdd(){
          $model=new Article();
          $content=new ArticleDetail();
        if($model->load(\Yii::$app->request->post())&&$content->load(\Yii::$app->request->post())){
            if($model->validate()&&$content->validate()){
                $time=time();
                $model->create_time=date('Y-m-d H:i:s',$time);
                $model->save();
                $content->save();
                return $this->redirect(['article/index']);
            }
        }return $this->render('add',['model'=>$model,'content'=>$content]);
    }
    public function actionEdit($id){
        $model=Article::findOne(['id'=>$id]);
        $content=ArticleDetail::findOne(['article_id'=>$id]);
        if($model->load(\Yii::$app->request->post())){
            if($model->validate()&&$content->validate()){
//                $time=time();
//                $model->create_time=date('Y-m-d H:i:s',$time);
                //var_dump($model->create_time);exit;
                $model->save();
                $content->save();
                return $this->redirect(['article/index']);
            }
        }return $this->render('add',['model'=>$model,'content'=>$content]);
    }
    public function actionDel($id){
        Article::findOne($id)->delete();
        return $this->redirect(['article/index']);
    }
}