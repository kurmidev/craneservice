<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee_company_mapping}}`.
 */
class m230425_150959_create_employee_company_mapping_table extends Migration
{
    public $table = "employee_company_mapping";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "company_id"=> $this->integer()->notNull(),
            "employee_id"=>$this->integer()->notNull(),
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
