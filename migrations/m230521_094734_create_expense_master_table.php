<?php

use app\models\ClientMaster;
use app\models\CompanyMaster;
use app\models\EmployeeMaster;
use app\components\Constants as C;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%expense_master}}`.
 */
class m230521_094734_create_expense_master_table extends Migration
{
    protected $table = "expense_master";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "expense_type"=> $this->integer()->notNull(),
            "company_id"=> $this->integer()->notNull(),
            "vendor_id"=> $this->integer(),
            "staff_id"=> $this->integer(),
            "voucher_no" =>  $this->string()->notNull()->unique(),
            "date"=> $this->date()->notNull(),
            "type"=> $this->integer(2),
            "paid_by"=>$this->integer()->notNull(),
            "passed_by"=> $this->integer()->notNull(),
            "against_bill_no"=> $this->string()->notNull(),
            "vehicle_id"=> $this->integer(),
            "remark"=> $this->text(),
            "file_details"=> $this->json()->null(),
            "payment_mode"=> $this->integer()->notNull(),
            "instrument_bank"=> $this->string(),
            "instrument_date"=> $this->date()->null(),
            "instrument_number"=> $this->string(),
            "quantity"=> $this->integer()->defaultValue(0),
            "base_amount"=> $this->money(),
            "tax"=> $this->money(),
            "total"=> $this->money(),
            "status"=> $this->integer()->notNull()->defaultValue(C::STATUS_ACTIVE),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'updated_at' => $this->dateTime()->null(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);

        $this->addForeignKey("fk-{$this->table}-company_id",$this->table,"company_id",CompanyMaster::tableName(),'id');
        $this->addForeignKey("fk-{$this->table}-vendor_id",$this->table,"vendor_id",ClientMaster::tableName(),'id');
        $this->addForeignKey("fk-{$this->table}-staff_id",$this->table,"staff_id",EmployeeMaster::tableName(),'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
