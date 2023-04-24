<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee_master}}`.
 */
class m230414_130353_create_employee_master_table extends Migration
{
    protected $table = "employee_master";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "name"=> $this->string(150)->notNull(),
            "company_id"=> $this->integer()->notNull(),
            "department_id"=> $this->integer()->notNull(),
            "email"=> $this->string(200),
            "phone_no" => $this->string(10)->notNull(),
            "status" =>  $this->integer()->notNull()->defaultValue(1),
            "start_time" => $this->time(),
            "end_time" => $this->time(),
            "salary"=> $this->money(),
            "overtime_salary" => $this->money(),
            "address" => $this->string(250),
            "city_id" => $this->integer()->notNull(),
            "pincode" => $this->string()->notNull(),
            "created_at"=>$this->dateTime()->notNull()->defaultExpression("now()"),
            "created_by"=>$this->integer(),
            "updated_at"=>$this->dateTime(),
            "updated_by"=>$this->integer()
        ]);

        $this->addForeignKey("fk-{$this->table}-company_id",$this->table,"company_id",'company_master','id');
        $this->addForeignKey("fk-{$this->table}-department_id",$this->table,"department_id",'department','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employee_master}}');
    }
}
