<h1>管理员 管理
<?=\yii\bootstrap\Html::a('注销',['admin/logout'],['class'=>'btn btn-danger']);?></h1>
<!--//=\yii\bootstrap\Html::a('修改密码',['admin/newps'],['class'=>'btn btn-danger'])<!--</td>-->-->

<table class="table table-bordered table-hover">
    <tr>
        <td>ID</td>
        <td>用户名</td>
        <td>邮箱</td>
        <td>最后登录时间</td>
        <td>最后登录IP</td>
        <td>操作</td>
    </tr>
    <?php foreach($admins as $admin):?>
        <tr>
            <td><?=$admin->id?></td>
            <td><?=$admin->username?></td>
            <td><?=$admin->email?></td>
            <td><?=date('Y-m-d H:i:s',$admin->last_login_time)?></td>
            <td><?=$admin->last_login_ip?></td>
            <td><?=\yii\bootstrap\Html::a('编辑',['admin/edit','id'=>$admin->id],['class'=>'btn btn-info'])?>
                <?=\yii\bootstrap\Html::a('删除',['admin/del','id'=>$admin->id],['class'=>'btn btn-danger'])?>
        </tr>
    <?php endforeach;?>
</table>