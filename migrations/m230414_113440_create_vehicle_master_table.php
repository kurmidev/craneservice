<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vehicle_master}}`.
 */
class m230414_113440_create_vehicle_master_table extends Migration
{
    public $table = "vehicle_master";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "name" => $this->string(),
            "vehicle_no" =>  $this->string()->unique(),
            "book_no" => $this->string(),
            "start_date" => $this->date(),
            "end_date" => $this->date(),
            "vehicle_type" => $this->string(),
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
