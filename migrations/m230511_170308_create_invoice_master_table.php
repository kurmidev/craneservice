<?php

use app\models\ClientMaster;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%invoice_master}}`.
 */
class m230511_170308_create_invoice_master_table extends Migration
{
    public $table = "invoice_master";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try{
            $this->dropTable($this->table);
            $this->dropForeignKey("fk-{$this->table}-client_id",$this->table);
        }catch(Exception $ex){

        }
        

        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "client_type"=> $this->integer()->notNull(),
            "client_id"=> $this->integer()->notNull(),
            "invoice_no"=> $this->string()->unique(),
            "invoice_date"=> $this->dateTime()->notNull()->defaultExpression('now()'),
            "invoice_type"=> $this->integer()->notNull(),
            "work_order_no" => $this->string()->null(),
            "vendor_no" => $this->string()->null(),
            "description"=> $this->string()->null(),
            "base_amount" => $this->money()->notNull()->defaultValue(0),
            "discount_amount" => $this->money()->notNull()->defaultValue(0),
            "tax"=> $this->money()->notNull()->defaultValue(0),
            "tds"=> $this->money()->notNull()->defaultValue(0),
            "total"=> $this->money()->notNull()->defaultValue(0),
            "payment"=> $this->money()->null()->defaultValue(0),
            "status" => $this->integer()->notNull()->defaultValue(1),
            "remark" => $this->string()->null(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'updated_at' => $this->dateTime()->null(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);

        
        $this->addForeignKey("fk-{$this->table}-client_id",$this->table,"client_id",ClientMaster::tableName(),'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
        $this->dropForeignKey("fk-{$this->table}-client_id",$this->table);
    }
}
