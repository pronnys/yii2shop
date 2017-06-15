<?php
namespace backend\models;
use yii\db\ActiveRecord;

class GoodsDayCount extends ActiveRecord{
 public function rules(){
     return  [
         ['day','required'],
         ['count','integer']
     ];
 }
    public function attributeLabels(){
        return [
            ['day','Day'],
            ['count','Count']
        ];

    }
}