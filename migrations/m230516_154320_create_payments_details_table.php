<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payments_details}}`.
 */
class m230516_154320_create_payments_details_table extends Migration
{
    protected $table = "payments_details";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try{
            $this->dropTable($this->table);
        }catch(Exception $ex){

        }

        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "payment_id"=> $this->integer()->notNull(),
            "client_id"=> $this->integer()->notNull(),
            "client_type"=> $this->integer()->notNull(),
            "invoice_id"=> $this->integer()->notNull(),
            "challan_id"=> $this->integer()->notNull(),
            "amount_adjsuted"=> $this->money()->notNull(),
            "status"=> $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'updated_at' => $this->dateTime()->null(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);

        $this->addForeignKey("fk-{$this->table}-client_id",$this->table,"client_id","client_master","id");
        $this->addForeignKey("fk-{$this->table}-invoice_id",$this->table,"invoice_id","invoice_master","id");
        $this->addForeignKey("fk-{$this->table}-payment_id",$this->table,"payment_id","payments","id");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
