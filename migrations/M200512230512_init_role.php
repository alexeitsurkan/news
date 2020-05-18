<?php
use yii\db\Migration;

/**
 * добавление ролей по умолчанию
 * Class M200512230512_init_role
 */
class M200512230512_init_role extends Migration
{
    public function safeUp()
    {
        $this->insert('auth_item',[
            'name' => 'moderator',
            'type' => 1,
            'description' => 'модератор',
            'created_at' => 1581251484,
            'updated_at' => 1581251484,
        ]);
        $this->insert('auth_item',[
            'name' => 'admin',
            'type' => 1,
            'description' => 'администратор',
            'created_at' => 1581251484,
            'updated_at' => 1581251484,
        ]);
        //--------------добавляем наследование ролей--------------------------
        $this->insert('auth_item_child',[
            'parent' => 'admin',
            'child' => 'moderator',
        ]);
        //--------------добаляем  роль admin адимистратору--------------------
        $this->insert('auth_assignment',[
            'item_name' => 'admin',
            'user_id' => 1,
            'created_at' => 1581251484,
        ]);
    }

    public function safeDown()
    {
    }
}
