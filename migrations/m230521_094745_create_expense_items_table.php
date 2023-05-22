<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%expense_items}}`.
 */
class m230521_094745_create_expense_items_table extends Migration
{
    public $table = "expense_items";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "expense_type"=> $this->integer()->notNull(),
            "expense_id"=> $this->integer()->notNull(),
            "category_id"=> $this->integer()->notNull(),
            "quantity"=> $this->integer()->notNull(),
            "amount"=> $this->money()->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'updated_at' => $this->dateTime()->null(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);

        $this->addForeignKey("fk-{$this->table}-expense_id",$this->table,"expense_id","expense_master",'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
