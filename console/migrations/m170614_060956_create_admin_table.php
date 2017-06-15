<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m170614_060956_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username'=>$this->string(50),
            'password_hash'=>$this->string(255),
            'last_login_time'=>$this->string(255),
            'last_login_ip'=>$this->string(255),
            'email'=>$this->string(50)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
