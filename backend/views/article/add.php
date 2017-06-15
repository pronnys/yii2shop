<?php
$form=\yii\bootstrap\ActiveForm::begin();
$data=\backend\models\ArticleCategory::find()->all();
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($content,'content')->textarea();
$data=\yii\helpers\ArrayHelper::map($data,'id','name');
echo $form->field($model,'article_category_id')->dropDownList($data,['prompt'=>'选择分类']);
echo $form->field($model,'sort');
echo $form->field($model,'status')->radioList([1=>'显示',0=>'隐藏',2=>'删除']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();