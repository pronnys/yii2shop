<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($newps,'password_hash')->passwordInput();;
echo $form->field($newps,'password_hash1')->passwordInput();
echo $form->field($newps,'password_hash2')->passwordInput();;
echo \yii\bootstrap\Html::submitButton('提交');
\yii\bootstrap\ActiveForm::end();