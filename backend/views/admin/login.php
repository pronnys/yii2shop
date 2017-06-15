<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username');
echo $form->field($model,'password_hash')->passwordInput();
echo $form->field($model,'code')->widget(\yii\captcha\Captcha::className(),[
    'captchaAction'=>'admin/captcha',
    'template'=>'<div class="row"><div class="col-lg-2">{input}</div><div class="col-lg-1">{image}</div></div>'
]);
echo $form->field($model,'remember')->checkbox();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();