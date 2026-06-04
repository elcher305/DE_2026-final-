<?php

use yii\db\Migration;

class m260604_055333_create_consultation_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%consultation}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'consultation_name' => "ENUM('civil', 'criminal', 'administrative', 'legal') NOT NULL",
            'start_date' => $this->date()->notNull(),
            'start_time' => $this->time()->notNull(),
            'payment_method' => "ENUM('QR code', 'cash', 'transaction') NOT NULL",
            'status'=> "ENUM('new', 'denied', 'approved') NOT NULL default 'new'",
        ]);

        $this->createIndex(
            '{{%idx-consultation-user_id}}',
            '{{%consultation}}',
            'user_id'
        );

        $this->addForeignKey(
            '{{%fk-consultation-user_id}}',
            '{{%consultation}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%consultation}}');
    }
}
