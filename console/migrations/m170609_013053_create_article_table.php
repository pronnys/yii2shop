<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m170609_013053_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->notNull()->comment('文章名称'),
            'intro'=>$this->text()->comment('文章简介'),
            'article_category_id'=>$this->text()->comment('文章分类id'),
            'sort'=>$this->integer(11)->comment('文章排序'),
            'status'=>$this->integer(2)->comment('文章状态'),
            'create_time'=>$this->integer(11)->comment('创建时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
