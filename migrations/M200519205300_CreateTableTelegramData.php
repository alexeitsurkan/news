<?php

use yii\db\Migration;

class M200519205300_CreateTableTelegramData extends Migration
{
    public $tableName = '{{%telegram_data}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id'      => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('id пользователя'),
            'chat_id' => $this->string(50)->notNull()->comment('id чата'),
        ], $tableOptions);

        $this->addCommentOnTable($this->tableName, 'Данные для телеграмм уведомлений');

        $this->addForeignKey(
            "telegram_user_id_fk",
            $this->tableName,
            "user_id",
            "user",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }

}
