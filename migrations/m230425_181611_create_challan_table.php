<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%challan}}`.
 */
class m230425_181611_create_challan_table extends Migration
{
    public $table = "challan";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "client_id"=> $this->integer()->notNull(),
            "challan_date" =>  $this->date()->notNull(),
            "site_address" => $this->string(),
            "operator_id"=> $this->string(),
            "helper_id" => $this->string(),
            "plan_id"=> $this->integer()->notNull(),
            "vehicle_id"=> $this->integer()->notNull(),
            "challan_no"=> $this->string()->notNull(),
            "plan_start_time"=> $this->time(),
            "plan_end_time"=> $this->time(),
            "day_wise"=> $this->integer(),
            "plan_measure"=> $this->string(),
            "plan_trip"  =>  $this->string(),
            "from_destination" =>  $this->string(),
            "to_destination" => $this->string(),
            "amount" =>  $this->money(),
            "break_time" => $this->integer()->defaultValue(0),
            "up_time" => $this->integer()->defaultValue(0),
            "down_time" => $this->integer()->defaultValue(0),
            "plan_extra_hours" => $this->integer(),
            "plan_shift_type"=> $this->integer(),
            "challan_image" => $this->json(),
            "invoice_id"=> $this->integer(),
            "is_processed" =>  $this->integer()->notNull()->defaultValue(0),
            "status" => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'updated_on' => $this->dateTime()->null(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);

        $this->addForeignKey("fk-{$this->table}-client_id",$this->table,'client_id',"client_master",'id');
        $this->addForeignKey("fk-{$this->table}-vehicle_id",$this->table,'vehicle_id',"vehicle_master",'id');
        $this->addForeignKey("fk-{$this->table}-plan_id",$this->table,'plan_id',"plan_master",'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
