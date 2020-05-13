<?php

use yii\db\Migration;

class M200512230614_CreateTableProfile extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('profile', [
            'id'          => $this->primaryKey(),
            'user_id'     => $this->integer()->notNull()->comment('id пользователя'),
            'first_name'  => $this->string(50)->notNull()->comment('Имя'),
            'last_name'   => $this->string(50)->notNull()->comment('Фамилия'),
            'middle_name' => $this->string(50)->notNull()->comment('Отчество'),
            'photo'       => $this->string()->comment('фото'),
        ], $tableOptions);

        $this->addCommentOnTable('profile', 'Профиль пользователя');

        $this->addForeignKey(
            "profile_user_id_fk",
            "profile",
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
        $this->dropTable('profile');
    }

}
