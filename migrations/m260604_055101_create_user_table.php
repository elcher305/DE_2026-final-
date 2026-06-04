<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m260604_055101_create_user_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'full_name' => $this->string()->notNull(),
            'date_birth' => $this->date()->notNull(),
            'phone' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'role'=> 'enum("admin","user") NOT NULL DEFAULT "user"',
        ]);

        $this->insert('{{%user}}', [
            'username' => 'Admin22',
            'password' => md5('Admin22'),
            'full_name' => 'Admin',
            'date_birth' => '1990-01-01',
            'phone' => '+7(495)123-45-67',
            'email'=> 'admin@loc.ru',
            'role' => 'admin',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
