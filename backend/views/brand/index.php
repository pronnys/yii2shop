<?=\yii\bootstrap\Html::a('添加品牌',['brand/add'],['class'=>'btn btn-info'])?>
<table class="table table-striped table-hover">
    <tr>
        <th>id</th>
        <th>商品名称</th>
        <th>商品描述</th>
        <th>商品排序</th>
        <th>商品状态</th>
        <th>商品图片</th>
        <th>操作</th>
    </tr>
      <?php foreach($brands as $brand):?>
    <tr>
        <td><?= $brand->id?></td>
        <td><?= $brand->name?></td>
        <td><?= $brand->intro?></td>
        <td><?= $brand->sort?></td>
        <td><?=\backend\models\Brand::$status[$brand->status]?></td>
        <td><?=\yii\bootstrap\Html::img('@web'.$brand->logo,['width'=>50]) ?></td>
        <td><?=\yii\bootstrap\Html::a('修改',['brand/edit','id'=>$brand->id],['class'=>'btn btn-info btn-sm'])?>
            <?=\yii\bootstrap\Html::a('删除',['brand/del','id'=>$brand->id],['class'=>'btn btn-warning btn-sm'])?></td>
    </tr>
    <?php endforeach;?>
</table>
<?php
echo \yii\widgets\LinkPager::widget([
    'pagination'=>$pages,
    'nextPageLabel'=>'下一页',
    'prevPageLabel'=>'下一页',

]);