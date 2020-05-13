<?php

use yii\db\Migration;

class M200512230616_CreateTableTags extends Migration
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

        $this->createTable('dic_tag', [
            'id'   => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('название тэга'),
        ], $tableOptions);

        $this->addCommentOnTable('dic_tag', 'таблица хэштэг');

        $this->createTable('news_to_tag', [
            'id'      => $this->primaryKey(),
            'news_id' => $this->integer(),
            'tag_id'  => $this->integer(),
        ], $tableOptions);

        $this->addCommentOnTable('news_to_tag', 'таблица сопоставления хэштэгов и новостей');

        $this->addForeignKey(
            "news_to_tag_news_id_fk",
            "news_to_tag",
            "news_id",
            "news",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey(
            "news_to_tag_tag_id_fk",
            "news_to_tag",
            "tag_id",
            "dic_tag",
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
        $this->dropTable('news_to_tag');
        $this->dropTable('dic_tag');
    }
}
