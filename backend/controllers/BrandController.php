<?php

namespace backend\controllers;
use xj\uploadify\UploadAction;

use backend\models\Brand;
use crazyfd\qiniu\Qiniu;
use yii\data\Pagination;
use yii\web\UploadedFile;

class BrandController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query=Brand::find();
        $total=$query->count();

        $pages=new Pagination([
            'totalCount'=>$total,
            'defaultPageSize'=>2,
        ]);
        $brands=$query->offset($pages->offset)->limit($pages->limit)->all();




        return $this->render('index',['brands'=>$brands,'pages'=>$pages]);
    }
    public function actionAdd(){
        $model=new Brand();
        if($model->load(\Yii::$app->request->post())){
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
//                if($model->imgFile){
//                    $filename='/images/brand/'.uniqid().'.'.$model->imgFile->extension;
//                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$filename,false);
//                    $model->logo=$filename;
//                }
                $model->save();
                \Yii::$app->session->setFlash('success','品牌添加成功');
                return $this->redirect(['brand/index']);
            }

        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionDel($id){
      $model=Brand::findOne(['id'=>$id]);
        $model->updateAttributes(['status'=>-1]);
        \Yii::$app->session->setFlash('success','品牌删除成功');
        return $this->redirect(['brand/index']);
    }
    public function actionEdit($id){
    $model=Brand::findOne(['id'=>$id]);
        if($model->load(\Yii::$app->request->post())){
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
                if($model->imgFile){
                    $filename='/images/brand/'.uniqid().'.'.$model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$filename,false);
                    $model->logo=$filename;
                }
                $model->save();
                return $this->redirect(['brand/index']);
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actions() {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload',
                'baseUrl' => '@web/upload',
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                //BEGIN METHOD
                'format' => [$this, 'methodName'],
                //END METHOD
                //BEGIN CLOSURE BY-HASH
                'overwriteIfExist' => true,
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filename = sha1_file($action->uploadfile->tempName);
                    return "{$filename}.{$fileext}";
                },
                //END CLOSURE BY-HASH
                //BEGIN CLOSURE BY TIME
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filehash = sha1(uniqid() . time());
                    $p1 = substr($filehash, 0, 2);
                    $p2 = substr($filehash, 2, 2);
                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
                },
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'png'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    $action->output['fileUrl'] = $action->getWebUrl();
                    $action->getFilename(); // "image/yyyymmddtimerand.jpg"
                    $action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                    $action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                },
            ],
        ];
    }
    public function actionTest(){
        $ak = 'FSspxOvHRCOEDP_FiraYd4l6C-4sZcGm2h4E-5R4';
        $sk = 'SHIfb_i5ViPSTfNHjkiAAfvxWpxPCjQLjf3lPway';
        $domain = 'http://or9r66jrz.bkt.clouddn.com/';
        $bucket = 'pronnys';
        $qiniu = new Qiniu($ak, $sk,$domain, $bucket);
        $fileName=\Yii::getAlias('@webroot').'/upload/test.png';
        $key ='test.png';
        $qiniu->uploadFile($fileName,$key);
        $url = $qiniu->getLink($key);
        var_dump($url);
    }
}
