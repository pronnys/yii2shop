<?php

use yii\db\Migration;

/**
 * Handles the creation of table `articlecategory`.
 */
class m170608_115617_create_articleCategory_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('articlecategory', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->notNull()->comment('分类名称'),
            'intro'=>$this->text()->comment('分类描述'),
            'sort'=>$this->integer(11)->comment('分类排序'),
            'status'=>$this->integer(2)->comment('分类状态'),
            'is_help'=>$this->integer(1)->comment('分类类型'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('articlecategory');
    }
}
