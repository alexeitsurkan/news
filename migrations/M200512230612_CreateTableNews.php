<?php

use yii\db\Migration;

class M200512230612_CreateTableNews extends Migration
{
    public $tableName = '{{%news}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id'          => $this->primaryKey(),
            'image_id'    => $this->integer()->comment('фото'),
            'title'       => $this->string()->notNull()->comment('название новости'),
            'description' => $this->text()->notNull()->comment('описание'),
            'body'        => $this->text()->notNull()->comment('текст новости'),
            'views'       => $this->integer()->defaultValue(0)->comment('количество лайков'),
            'likes'       => $this->integer()->defaultValue(0)->comment('количество просмотров'),
            'created_at'  => $this->timestamp()->defaultValue(new \yii\db\Expression('NOW()'))->notNull()->comment('дата создания'),
            'updated_at'  => $this->timestamp()->defaultValue(new \yii\db\Expression('NOW()'))->notNull()->comment('дата обновления'),
            'user_id'     => $this->integer()->comment('id пользователя'),
        ], $tableOptions);

        $this->addCommentOnTable($this->tableName, 'Новости');

        $this->addForeignKey(
            "news_image_id_fk",
            $this->tableName,
            "image_id",
            "image",
            "id",
            "SET NULL",
            "SET NULL"
        );

        $this->addForeignKey(
            "news_user_id_fk",
            $this->tableName,
            "user_id",
            "user",
            "id",
            "CASCADE",
            "CASCADE"
        );

    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
