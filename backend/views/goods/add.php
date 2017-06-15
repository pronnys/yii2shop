<?php
use yii\web\JsExpression;
use xj\uploadify\Uploadify;
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($models,'name');
echo $form->field($models,'imgFile')->fileInput();
echo $form->field($content,'content')->widget('kucha\ueditor\UEditor',[]);
echo $form->field($models,'goods_category_id')->hiddenInput(['id'=>'goods_category_id']);
echo '<ul id="treeDemo" class="ztree"></ul>';
//echo $form->field($models,'goods_category_id')->textInput();
$this->registerCssFile('@web/zTree/css/zTreeStyle/zTreeStyle.css');
$this->registerJsFile('@web/zTree/js/jquery.ztree.core.js',['depends'=>\yii\web\JqueryAsset::className()]);
$zNodes = \yii\helpers\Json::encode($cates);
$js = new \yii\web\JsExpression(
    <<<JS
var zTreeObj;
    // zTree 的参数配置，深入使用请参考 API 文档（setting 配置详解）
    var setting = {
        data: {
            simpleData: {
                enable: true,
                idKey: "id",
                pIdKey: "parent_id",
                rootPId: 0
            }
        },
        callback: {
		    onClick: function(event, treeId, treeNode) {
                //将选中节点的id赋值给表单parent_id
                $("#goods_category_id").val(treeNode.id);
            }
	    }
    };
    // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
    var zNodes = {$zNodes};

    zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    zTreeObj.expandAll(true);//展开所有节点

JS
);
$this->registerJs($js);

echo $form->field($models,'brand_id')->dropDownList(\backend\models\Goods::getBrandOptions());
echo $form->field($models,'market_price');
echo $form->field($models,'shop_price');
echo $form->field($models,'stock');
echo $form->field($models,'status')->radioList([1=>'正常',0=>'回收站']);
echo $form->field($models,'is_on_sale')->radioList([1=>'在售',0=>'下架']);
echo $form->field($models,'sort');
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();