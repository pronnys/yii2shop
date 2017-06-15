<?php
namespace backend\models;
use yii\db\ActiveRecord;

class ArticleDetail extends ActiveRecord{
    public function rules(){
        return [
            [['article_id'],'integer'],
            [['content'],'required']
        ];
    }
    public function attributeLabels()
    {
        return [
            'article_id'=>'文章ID',
            'name' => '文章详情',
        ];
    }
}