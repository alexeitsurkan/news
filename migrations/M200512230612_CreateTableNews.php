<?php

use yii\db\Migration;

class M200512230612_CreateTableNews extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%news}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string()->notNull()->comment('название новости'),
            'body'        => $this->text()->notNull()->comment('текст новости'),
            'views'       => $this->integer()->defaultValue(0)->comment('количество лайков'),
            'likes'       => $this->integer()->defaultValue(0)->comment('количество просмотров'),
            'created_at'  => $this->timestamp()->defaultValue(new \yii\db\Expression('NOW()'))->notNull()->comment('дата создания'),
            'updated_at'  => $this->timestamp()->defaultValue(new \yii\db\Expression('NOW()'))->notNull()->comment('дата обновления'),
            'user_id'     => $this->integer()->notNull()->comment('id пользователя'),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%news}}');
    }
}
