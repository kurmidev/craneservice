<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payments}}`.
 */
class m230516_154311_create_payments_table extends Migration
{

    public $table = "payments";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "receipt_no"=> $this->string()->notNull()->unique(),
            "client_id"=> $this->integer()->notNull(),
            "client_type"=> $this->integer()->notNull(),
            "payment_date"=> $this->date()->notNull(),
            "amount_paid"=> $this->money()->notNull(),
            "payment_mode"=> $this->integer()->notNull(),
            "intrument_no"=> $this->string()->null(),
            "instrument_date"=> $this->date(),
            "remark"=> $this->string()->null(),
            "status"=> $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'updated_at' => $this->dateTime()->null(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);

        $this->addForeignKey("fk-{$this->table}-client_id",$this->table,"client_id","client_master","id");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
