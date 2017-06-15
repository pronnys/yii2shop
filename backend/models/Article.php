<?php
namespace backend\models;
use yii\db\ActiveRecord;

class Article extends ActiveRecord{
    static public $status=['0'=>'隐藏','1'=>'显示','-1'=>'删除'];
    public static function tableName()
    {
        return 'article';
    }
    public function rules(){
        return [
            [['id'], 'integer'],
            [['name'], 'required'],
            [['intro'], 'string'],
            [['sort', 'status','article_category_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '文章名称',
            'intro' => '文章简介',
            'sort' => '文章排序',
            'status' => '文章状态',
        ];
    }
    public function getArticleCategory(){
            return $this->hasOne(ArticleCategory::className(),['id'=>'article_category_id']);
    }
}