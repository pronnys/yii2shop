<?php
namespace backend\models;
use yii\db\ActiveRecord;

class GoodsIntro extends ActiveRecord{
public function rules()
{
    return [
        ['content','required'],
    ];
}
    public function attributeLabels()
    {
        return [
            'goods_id'=>'商品ID',
            'content'=>'商品详情'
        ];
    }
}