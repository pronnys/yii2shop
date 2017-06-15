<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $sort
 * @property integer $status
 * @property string $logo
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imgFile;
    static public $status=['0'=>'隐藏','1'=>'显示','-1'=>'删除'];
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['intro'], 'string'],
            [['sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['logo'], 'string', 'max' => 255],
            ['imgFile','file','extensions'=>['jpg','png','gif']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'intro' => '商品简介',
            'sort' => '商品排序',
            'status' => '商品状态',
            'logo' => '商品图片',
        ];
    }
}
