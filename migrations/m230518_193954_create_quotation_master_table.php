<?php

use yii\db\Migration;
use app\models\ClientMaster;
/**
 * Handles the creation of table `{{%quotation_master}}`.
 */
class m230518_193954_create_quotation_master_table extends Migration
{
    public $table = "quotation_master";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "quotation_no"=>$this->string()->notNull()->unique(),
            "client_id"=> $this->integer()->notNull(),
            "client_type"=> $this->integer()->notNull(),
            "date"=> $this->date()->notNull(),
            "subject"=> $this->string()->notNull(),
            "terms_and_conditions"=> $this->string()->notNull(),
            "tax_applicable"=> $this->integer()->notNull()->defaultValue(1),
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
