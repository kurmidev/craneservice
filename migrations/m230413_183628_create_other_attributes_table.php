<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%other_attributes}}`.
 */
class m230413_183628_create_other_attributes_table extends Migration
{
    protected $table = "other_attributes";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "attr_for" => $this->integer(),
            "attr_name"=>$this->string(),
            "attr_value" => $this->string(),
            "bind_with" => $this->json(),
            "status" => $this->integer()->defaultValue(1),
            "created_at" => $this->dateTime()->notNull()->defaultExpression("now()"),
            "created_by" => $this->integer(),
            "updated_at" => $this->dateTime(),
            "updated_by" => $this->integer()
        ]);

        $this->createIndex("ix-{$this->table}-attr_for-attr_name",$this->table,["attr_for","attr_name"],1);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
