<?php
namespace backend\models;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use creocoder\nestedsets\NestedSetsQueryBehavior;
class GoodsCategoryQuery extends ActiveQuery{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}