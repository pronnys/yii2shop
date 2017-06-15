<?php
namespace backend\models;
use yii\base\Model;

class NewpsForm extends Model{
    public $username;
    public $password_hash;
    public $password_hash1;
    public $password_hash2;
    public function rules(){
        return [
            ['password_hash', 'required'],
            ['password_hash1', 'required'],
            ['password_hash2', 'required'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'password_hash' => '密码:',
            'password_hash1'=>'新密码:',
            'password_hash2'=>'再次输入新密码:'
        ];
    }
//    public function pscheck(){
//            $id=\Yii::$app->user->id;
//            $admin=Admin::findOne(['id'=>$id]);
//
//        //\Yii::$app->security->validatePassword($this->password_hash, $admin->password_hash;
//        if (\Yii::$app->security->validatePassword($this->password_hash, $admin->password_hash)) {
//            //var_dump($admin);exit;
//            return true;
//        }else{
//            return $this->addError('password_hash','密码不对');
//        }
//
//    }

}