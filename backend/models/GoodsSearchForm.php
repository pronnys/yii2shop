<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/3 0003
 * Time: ���� 1:58
 */

namespace backend\models;


use yii\base\Model;

class GoodsSearchForm extends Model
{
    public $name;
    public $sn;

    public function rules(){
        return [
            ['name','string','max'=>50],
            [['sn'],'string'],
        ];
    }

}