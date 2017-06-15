<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($models,'username');
echo $form->field($models,'password_hash')->passwordInput();
echo $form->field($models,'email');
echo \yii\bootstrap\Html::submitButton('提交');
\yii\bootstrap\ActiveForm::end();
