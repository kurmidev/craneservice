<?php

use yii\db\Migration;
use app\models\ClientMaster;

/**
 * Handles the creation of table `{{%quotation_items}}`.
 */
class m230518_194516_create_quotation_items_table extends Migration
{
    public $table = "quotation_items";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "quotation_id"=> $this->integer()->notNull(),
            "client_id"=> $this->integer()->notNull(),
            "client_type"=> $this->integer()->notNull(),
            "type"=> $this->integer()->notNull(),
            "vehicle_id"=> $this->integer()->notNull(),
            "plan_id"=> $this->integer()->notNull(),
            "quantity"=> $this->integer()->notNull(),
            "amount"=> $this->money()->notNull(),
            "status"=> $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'updated_at' => $this->dateTime()->null(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);
        $this->addForeignKey("fk-{$this->table}-client_id",$this->table,"client_id",ClientMaster::tableName(),'id');
        $this->addForeignKey("fk-{$this->table}-quotation_id",$this->table,"quotation_id",'quotation_master','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
