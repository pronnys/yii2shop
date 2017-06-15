<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/27 0027
 * Time: 涓婂崍 10:05
 */

namespace backend\models;

use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password_hash;
    public $remember;
    public $code;

    public function rules()
    {
        return [
            [['username', 'password_hash'], 'required'],
            ['remember', 'boolean'],
            ['code','captcha','captchaAction'=>'admin/captcha']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名:',
            'password_hash' => '密码:',
            'remember' => '记住我',
            'code'=>'验证码'
        ];
    }

    public function login()
    {
        if ($this->validate()) {
            $admin = Admin::findOne(['username' => $this->username]);

            if ($admin) {
                if (\Yii::$app->security->validatePassword($this->password_hash, $admin->password_hash)) {
                    //var_dump($admin);exit;
                    \Yii::$app->user->login($admin,$this->remember?1440:0);
                    return true;
                }else {
                    $this->addError('password_hash', '密码不对');
                }
                }else{
                    $this->addError('username','用户名不存在');
                }
            }
            return false;
        }
}