<?php

use yii\db\Migration;

class M200517222222_CreateDictionaryTables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%dic_notify_sender}}', [
            'id'   => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('название оповещения'),
            'class' => $this->string()->notNull()->comment('название класса'),
        ], $tableOptions);

        $this->addCommentOnTable('{{%dic_notify_sender}}', 'список способов оповещений');

        $this->insert('{{%dic_notify_sender}}',[
            'id'       => 1,
            'name'     => 'E-mail',
            'class'    => 'app\helpers\notify\EmailNotifier',
        ]);
        $this->insert('{{%dic_notify_sender}}',[
            'id'       => 2,
            'name'     => 'Telegram',
            'class'    => 'app\helpers\notify\TelegramNotifier',
        ]);
        //---------------------------------------------------------------------------------------------

        $this->createTable('{{%dic_notify_event}}', [
            'id'    => $this->primaryKey(),
            'name'  => $this->string()->notNull()->comment('название события'),
            'event' => $this->string()->notNull()->comment('события'),
        ], $tableOptions);

        $this->addCommentOnTable('{{%dic_notify_event}}', 'список событий уведомлений пользователей');

        $this->insert('{{%dic_notify_event}}',['id' => 1, 'name' => 'при изменении E-mail адреса','event' => 'email_update']);
        $this->insert('{{%dic_notify_event}}',['id' => 2, 'name' => 'при изменении пароля','event' => 'password_update']);
        $this->insert('{{%dic_notify_event}}',['id' => 3, 'name' => 'при добавлении новости','event' => 'add_news']);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%dic_notify_sender}}');
        $this->dropTable('{{%dic_notify_event}}');
    }

}
