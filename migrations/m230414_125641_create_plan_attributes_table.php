<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%plan_attributes}}`.
 */
class m230414_125641_create_plan_attributes_table extends Migration
{
    protected $table = "plan_attributes";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "name"=> $this->string(200)->notNull(),
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
