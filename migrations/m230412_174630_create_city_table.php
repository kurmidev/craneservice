<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city}}`.
 */
class m230412_174630_create_city_table extends Migration
{
    protected $table = "city";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "name"=>$this->string(250)->notNull(),
            "state_id"=> $this->integer()->notNull(),
            "status"=>$this->integer(1)->notNull()->defaultValue(1),
            "created_at"=>$this->dateTime()->notNull()->defaultExpression("now()"),
            "created_by"=>$this->integer(),
            "updated_at"=>$this->dateTime(),
            "updated_by"=>$this->integer()
        ]);
        $this->addForeignKey("fk-{$this->table}-state_id",$this->table,"state_id","state","id");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
