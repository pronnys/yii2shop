<?=\yii\bootstrap\Html::a('添加商品',['goods/add'],['class'=>'btn btn-info'])?>
<?php $form = \yii\bootstrap\ActiveForm::begin(
    [   'method'=>'get',
        'action'=>\yii\helpers\Url::to(['goods/index'])
    ]
);
echo $form->field($model,'name');
echo $form->field($model,'sn');
echo \yii\bootstrap\Html::submitButton('搜索',['class'=>'btn btn-btn']);
\yii\bootstrap\ActiveForm::end();?>
<table class="table table-striped table-hover">
    <tr>
        <th>id</th>
        <th>商品名称</th>
        <th>商品货号</th>
        <th>商品logo</th>
        <th>商品分类</th>
        <th>商品品牌</th>
<!--        <th>文章状态</th>-->
        <th>市场售价</th>
        <th>本店售价</th>
        <th>商品库存</th>
        <th>是否上架</th>
        <th>商品状态</th>
        <th>商品排序</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    <?php foreach($goods as $good):?>
        <tr>
            <td><?= $good->id?></td>
            <td><?= $good->name?></td>
            <td><?= $good->sn?></td>
            <td><?= \yii\bootstrap\Html::img('@web'.$good->logo,['width'=>40])?></td>
            <td><?= $good->goodsCategory->name?></td>
            <td><?= $good->brand->name?></td>
            <td><?= $good->market_price?></td>
            <td><?= $good->shop_price?></td>
            <td><?= $good->stock?></td>
            <td><?=\backend\models\Goods::$is_on_sale[$good->is_on_sale]?></td>
            <td><?=\backend\models\Goods::$status[$good->status]?></td>

            <td><?= $good->sort?></td>
            <td><?= $good->create_time?></td>
            <td>
                 <?= \yii\bootstrap\Html::a('修改',['goods/edit','id'=>$good->id],['class'=>'btn btn-info btn-sm'])?>
                 <?=\yii\bootstrap\Html::a('删除',['goods/del','id'=>$good->id],['class'=>'btn btn-warning btn-sm'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>

