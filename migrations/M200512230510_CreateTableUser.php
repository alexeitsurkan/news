<?php

use yii\db\Migration;

class M200512230510_CreateTableUser extends Migration
{
    public $tableName = '{{%user}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'verification_token' => $this->string()->defaultValue(null),
            'status' => $this->smallInteger()->notNull()->defaultValue(9),
        ], $tableOptions);

        $this->insert($this->tableName, [
            'id' => 1,
            'username' => 'admin',
            'email' => 'email@email.com',
            'auth_key' => 'OsPQgcmhlo5wAlsvDPSrow-Dh5H6L2qk',
            'password' => '$2y$13$F/6PI29KjnOxBA6L798zwubM.d7zoXM4ryjyGTFo7h.c6f85KMHcq',
            'created_at' => 1581250127,
            'updated_at' => 1581250127,
            'status' => 10,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
