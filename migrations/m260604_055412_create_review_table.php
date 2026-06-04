<?php

use yii\db\Migration;


class m260604_055412_create_review_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'consultation_id' => $this->integer()->notNull(),
            'description' => $this->text()->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-review-user_id}}',
            '{{%review}}',
            'user_id'
        );

        $this->addForeignKey(
            '{{%fk-review-user_id}}',
            '{{%review}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-review-consultation_id}}',
            '{{%review}}',
            'consultation_id'
        );

        $this->addForeignKey(
            '{{%fk-review-consultation_id}}',
            '{{%review}}',
            'consultation_id',
            '{{%consultation}}',
            'id',
            'CASCADE'
        );
    }


    public function safeDown()
    {
        $this->dropTable('{{%review}}');
    }
}
