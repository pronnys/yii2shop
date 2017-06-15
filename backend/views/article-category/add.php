<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'sort');
echo $form->field($model,'status')->radioList([1=>'显示',0=>'隐藏',2=>'删除']);
echo $form->field($model,'is_help')->radioList([1=>'帮助',0=>'查看']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();