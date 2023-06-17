<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_prefix}}`.
 */
class m230617_052341_create_company_prefix_table extends Migration
{
    public $table  = "company_prefix";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "company_id"=> $this->integer()->notNull(),
            "prefix_for"=> $this->integer()->notNull(),
            "prefix"=> $this->string(10)->notNull(),
            "status"=> $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'updated_at' => $this->dateTime()->null(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
