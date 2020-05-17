<?php

use yii\db\Migration;

class M200512230614_CreateTableProfile extends Migration
{
    public $tableName = '{{%profile}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id'          => $this->primaryKey(),
            'user_id'     => $this->integer()->notNull()->comment('id пользователя'),
            'first_name'  => $this->string(50)->notNull()->comment('Имя'),
            'last_name'   => $this->string(50)->comment('Фамилия'),
            'middle_name' => $this->string(50)->comment('Отчество'),
            'avatar'      => $this->string()->comment('фото'),
        ], $tableOptions);

        $this->addCommentOnTable($this->tableName, 'Профиль пользователя');

        $this->addForeignKey(
            "profile_user_id_fk",
            $this->tableName,
            "user_id",
            "user",
            "id",
            "CASCADE",
            "CASCADE"
        );

        $this->insert('profile',[
            'user_id'     => 1,
            'first_name'  => 'Администратор',
            'last_name'   => '',
            'middle_name' => '',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }

}
