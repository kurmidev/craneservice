<?php

use app\models\InvoiceMaster;
use yii\db\Migration;

/**
 * Class m230617_111527_alter_invoice_master_table
 */
class m230617_111527_alter_invoice_master_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(InvoiceMaster::tableName(),'payment_id',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230617_111527_alter_invoice_master_table cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230617_111527_alter_invoice_master_table cannot be reverted.\n";

        return false;
    }
    */
}
