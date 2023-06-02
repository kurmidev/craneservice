<?php

use app\models\PaymentsDetails;
use yii\db\Migration;

/**
 * Class m230601_160829_alter_payment_details_table
 */
class m230601_160829_alter_payment_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(PaymentsDetails::tableName(),'amount_paid',$this->money());
        $this->addColumn(PaymentsDetails::tableName(),'deduction_amount',$this->money());
        $this->addColumn(PaymentsDetails::tableName(),'deduction_number',$this->integer());
        $this->addColumn(PaymentsDetails::tableName(),'tds_amount',$this->money());
        $this->addColumn(PaymentsDetails::tableName(),'tds_number',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230601_160829_alter_payment_details_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230601_160829_alter_payment_details_table cannot be reverted.\n";

        return false;
    }
    */
}
