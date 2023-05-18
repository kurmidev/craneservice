<?php

use app\models\ClientMaster;
use app\models\InvoiceMaster;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%payment_notes}}`.
 */
class m230518_183436_create_payment_notes_table extends Migration
{
    public $table = "payment_notes";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "client_id"=> $this->integer()->notNull(),
            "client_type"=> $this->integer()->notNull(),
            "date"=> $this->date()->notNull(),
            "invoice_id"=>$this->integer()->notNull(),
            "receipt_no"=>$this->string()->notNull()->unique(),
            "remark"=> $this->string()->null(),
            "base_amount"=> $this->money()->notNull()->defaultValue(0),
            "tax"=> $this->money()->notNull()->defaultValue(0),
            "total"=> $this->money()->notNull()->defaultValue(0),
            "status"=> $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'updated_at' => $this->dateTime()->null(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);

        $this->addForeignKey("fk-{$this->table}-invoice_id",$this->table,"invoice_id",InvoiceMaster::tableName(),'id');
        $this->addForeignKey("fk-{$this->table}-client_id",$this->table,"client_id",ClientMaster::tableName(),'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
