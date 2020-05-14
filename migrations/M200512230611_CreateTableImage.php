<?php

use yii\db\Migration;

class M200512230611_CreateTableImage extends Migration
{
    public $tableName = '{{%image}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id'    => $this->primaryKey(),
            'image' => $this->string(),
        ], $tableOptions);

        $this->addCommentOnTable($this->tableName, 'изображения');
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
