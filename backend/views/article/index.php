<?=\yii\bootstrap\Html::a('添加文章',['article/add'],['class'=>'btn btn-info'])?>
<table class="table table-striped table-hover">
    <tr>
        <th>id</th>
        <th>文章名称</th>
        <th>文章描述</th>
        <th>文章分类id</th>
        <th>文章排序</th>
<!--        <th>文章状态</th>-->
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    <?php foreach($articles as $article):?>
        <tr>
            <td><?= $article->id?></td>
            <td><?= $article->name?></td>
            <td><?= $article->intro?></td>
            <td><?= $article->articleCategory->name?></td>
            <td><?= $article->sort?></td>
<!--            <td>--><?//=\backend\models\Article::$status[$article->status]?><!--</td>-->
            <td><?= $article->create_time?></td>
            <td><?=\yii\bootstrap\Html::a('修改',['article/edit','id'=>$article->id],['class'=>'btn btn-info btn-sm'])?>
                <?=\yii\bootstrap\Html::a('删除',['article/del','id'=>$article->id],['class'=>'btn btn-warning btn-sm'])?></td>
        </tr>
    <?php endforeach;?>
</table>
<?php
