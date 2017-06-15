<?php
namespace backend\controllers;
use backend\models\ArticleCategory;
use yii\web\Controller;

class ArticleCategoryController extends Controller{
    public function actionIndex(){
        $articlecategorys=ArticleCategory::find()->all();
        return $this->render('index',['articlecategorys'=>$articlecategorys]);
    }
    public function actionAdd(){
        $model=new ArticleCategory();
        if($model->load(\Yii::$app->request->post())){
            if($model->validate()){

                $model->save();
                return $this->redirect(['article-category/index']);
            }
        }return $this->render('add',['model'=>$model]);
    }
    public function actionEdit($id){
        $model=ArticleCategory::findOne(['id'=>$id]);
        if($model->load(\Yii::$app->request->post())){
            if($model->validate()){
                $model->save();
                return $this->redirect(['article-category/index']);
            }
        }return $this->render('add',['model'=>$model]);
    }
    public function actionDel($id){
        ArticleCategory::findOne($id)->delete();
        return $this->redirect(['article-category/index']);
    }
}