<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%plan_master}}`.
 */
class m230414_124235_create_plan_master_table extends Migration
{
    protected $table = "plan_master";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "name" => $this->string()->unique(),
            "code" => $this->string()->unique(),
            "price" => $this->money()->notNull(),
            "attribute_id" => $this->integer(),
            "type" => $this->integer()->notNull(),
            "shift_hrs" => $this->integer()->defaultValue(0),
            "tax_slot" => $this->integer(),
            "status" => $this->integer()->defaultValue(1),
            "created_at" => $this->dateTime()->notNull()->defaultExpression("now()"),
            "created_by" => $this->integer(),
            "updated_at" => $this->dateTime(),
            "updated_by" => $this->integer()
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
