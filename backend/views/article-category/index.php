<?=\yii\bootstrap\Html::a('添加文章分类',['article-category/add'],['class'=>'btn btn-info'])?>
<table class="table table-striped table-hover">
    <tr>
        <th>id</th>
        <th>文章分类名称</th>
        <th>文章分类描述</th>
        <th>文章分类排序</th>
        <th>文章分类状态</th>
        <th>文章分类类型</th>
        <th>操作</th>
    </tr>
      <?php foreach($articlecategorys as $articlecategory):?>
    <tr>
        <td><?= $articlecategory->id?></td>
        <td><?= $articlecategory->name?></td>
        <td><?= $articlecategory->intro?></td>
        <td><?= $articlecategory->sort?></td>
        <td><?=\backend\models\ArticleCategory::$status[$articlecategory->status]?></td>
        <td><?=\backend\models\ArticleCategory::$is_help[$articlecategory->is_help]?></td>
        <td><?=\yii\bootstrap\Html::a('修改',['article-category/edit','id'=>$articlecategory->id],['class'=>'btn btn-info btn-sm'])?>
            <?=\yii\bootstrap\Html::a('删除',['article-category/del','id'=>$articlecategory->id],['class'=>'btn btn-warning btn-sm'])?></td>
    </tr>
    <?php endforeach;?>
</table>
