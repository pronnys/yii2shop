<?php
namespace backend\controllers;

use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsDayCount;
use backend\models\GoodsIntro;
use xj\uploadify\Uploadify;
use yii\web\Controller;
use yii\web\UploadedFile;
use backend\models\GoodsSearchForm;

class GoodsController extends Controller
{
    public function actionAdd()
    {
        $models = new Goods();
        $content = new GoodsIntro();
        $cates = GoodsCategory::find()->all();
        if ($models->load(\Yii::$app->request->post())
            && $content->load(\Yii::$app->request->post())
            ) {
            $models->imgFile = UploadedFile::getInstance($models, 'imgFile');
            if ($models->validate() && $content->validate()) {
                if ($models->imgFile) {
                    $filename = '/images/goods/' . uniqid() . '.' . $models->imgFile->extension;
                    $models->imgFile->saveAs(\Yii::getAlias('@webroot') . $filename, false);
                    $models->logo = $filename;
                  }
//                $models->sn=date('Y-m-d',time()).'000'.$models->id;
                $days = new GoodsDayCount();
                $days->day=date('Ymd',time());
                $list=$days->findOne(['day'=>$days->day]);
                //var_dump($list);exit;
                //$list=$days->count;
                if($list){
                    $list->count+=1;
                    $list->save();
                    $models->sn=date('Ymd',time()).str_pad("$list->count",4,0,STR_PAD_LEFT);
                }else{
                    $list->count=1;
                    $days->save();
                    $models->sn=date('Ymd',time()).str_pad("$days->count",4,0,STR_PAD_LEFT);
                }
                $models->create_time = date('Y-m-d H:i:s', time());
                $models->save();
                $content->goods_id = $models->id;
                $content->save();
            } return $this->redirect('index');
        }
        return $this->render('add', ['models' => $models, 'cates' => $cates, 'content' => $content]);
    }
public function actionEdit($id)
{
    $model = Goods::findOne(['id' => $id]);
    $content = GoodsIntro::findOne(['goods_id' => $id]);
    $cates = GoodsCategory::find()->all();
    if ($model->load(\Yii::$app->request->post())
        && $content->load(\Yii::$app->request->post())
    ) {
        $model->imgFile = UploadedFile::getInstance($model, 'imgFile');
        if ($model->validate() && $content->validate()) {
            if ($model->imgFile) {
                $filename = '/images/goods/' . uniqid() . '.' . $model->imgFile->extension;
                $model->imgFile->saveAs(\Yii::getAlias('@webroot') . $filename, false);
                $model->logo = $filename;
            }
            $model->create_time = date('Y-m-d H:i:s', time());
            $model->save();
            $content->goods_id = $model->id;
            $content->save();
        }
        return $this->redirect('index');
    }
    return $this->render('add', ['models' => $model, 'cates' => $cates, 'content' => $content]);

}
//    public function actionIndex()
//    {
//        $goods = Goods::find()->all();
//        return $this->render('index', ['goods' => $goods]);
//    }
    public function actionIndex()
    {
        $goods = Goods::find();
        $model = new GoodsSearchForm();
        if($model->load(\Yii::$app->request->get()) && $model->validate()){
            if($model->name){
                $goods->andWhere(['like','name',$model->name]);
            }
            if($model->sn){
                $goods->andWhere(['like','sn',$model->sn]);
            }
        }
        $goods=$goods->all();
        return $this->render('index',['goods'=>$goods,'model'=>$model]);
    }
    public function actionDel($id){
        Goods::findOne(['id'=>$id])->delete();
        GoodsIntro::findOne(['goods_id'=>$id])->delete();
        return $this->redirect('index');

    }
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
//                'config' => [
//                    "imageUrlPrefix"  => "",//图片访问路径前缀
//                    "imagePathFormat" => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}", //上传保存路径
//                    "imageRoot" => \Yii::getAlias("@webroot"),
//                ]
            ],
        ];
    }
}