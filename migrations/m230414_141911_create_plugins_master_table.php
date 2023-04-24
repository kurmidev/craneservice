<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%plugins_master}}`.
 */
class m230414_141911_create_plugins_master_table extends Migration
{
    protected $table=  "plugins_master";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "name" => $this->string()->notNull(),
            "plugin_type" => $this->integer()->notNull(),
            "plugin_url" => $this->string()->notNull(),
            "meta_data" => $this->json(),
            "description" => $this->string(),
            "status" => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'updated_on' => $this->dateTime()->null(),
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
