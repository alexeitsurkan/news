<?php

use yii\db\Migration;

class M200512230610_CreateTableUser extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id'         => $this->primaryKey(),
            'username'   => $this->string()->notNull()->unique(),
            'auth_key'   => $this->string(32)->notNull(),
            'password'   => $this->string()->notNull(),
            'email'      => $this->string()->notNull()->unique(),
            'created_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('NOW()'))->notNull(),
            'updated_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('NOW()'))->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
