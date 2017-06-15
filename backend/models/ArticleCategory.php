<?php
namespace backend\models;
use yii\db\ActiveRecord;

class ArticleCategory extends ActiveRecord{
    static public $status=['0'=>'隐藏','1'=>'显示','2'=>'删除'];
    static public $is_help=['0'=>'查看','1'=>'帮助'];
    public static function tableName()
    {
        return 'articlecategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['intro'], 'string'],
            [['sort','is_help','status'], 'integer'],
            [['name'], 'string', 'max' => 50],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '文章分类名称',
            'intro' => '文章分类简介',
            'sort' => '文章分类排序',
            'status' => '文章分类状态',
            'is_help'=>'文章分类类型'
        ];
    }
}