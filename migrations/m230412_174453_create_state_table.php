<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%state}}`.
 */
class m230412_174453_create_state_table extends Migration
{
    protected $table = "state";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "name"=>$this->string(250)->notNull(),
            "status"=>$this->integer(1)->notNull()->defaultValue(1),
            "created_at"=>$this->dateTime()->notNull()->defaultExpression("now()"),
            "created_by"=>$this->integer(),
            "updated_at"=>$this->dateTime(),
            "updated_by"=>$this->integer()
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
