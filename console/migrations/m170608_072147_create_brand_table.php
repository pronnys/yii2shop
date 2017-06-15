<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m170608_072147_create_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->notNull()->comment('商品名称'),
            'intro'=>$this->text()->comment('商品描述'),
            'sort'=>$this->integer()->comment('商品排序'),
            'status'=>$this->integer(1),
            'logo'=>$this->string(255),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('brand');
    }
}
