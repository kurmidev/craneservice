<?php

use yii\db\Migration;

/**
 * Class m230611_151354_alter_payments_details_table
 */
class m230611_151354_alter_payments_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('payments_details', 'deduction_number', $this->string());
        $this->alterColumn('payments_details', 'tds_number', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230611_151354_alter_payments_details_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230611_151354_alter_payments_details_table cannot be reverted.\n";

        return false;
    }
    */
}
