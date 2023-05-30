<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client_plan_mapping}}`.
 */
class m230530_140718_create_client_plan_mapping_table extends Migration
{
    public $table = "client_plan_mapping";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "client_id"=> $this->integer()->notNull(),
            "client_type"=> $this->integer()->notNull(),
            "plan_id"=> $this->integer()->notNull(),
            "custom_price" => $this->money()->notNull(),
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
