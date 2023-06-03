<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%audit_logs}}`.
 */
class m230603_112640_create_audit_logs_table extends Migration
{

    public $table = "audit_logs";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "client_id"=> $this->integer(),
            "client_type" => $this->integer(),
            "table_name"=> $this->string(),
            "old_value"=> $this->json(),
            "new_value"=> $this->json(),
            "changed_value"=> $this->json(),
            "primary_id"=> $this->integer(),
            "action_taken"=> $this->integer(),
            "remark"=>$this->string(),
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
