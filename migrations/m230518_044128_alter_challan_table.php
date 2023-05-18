<?php

use app\models\Challan;
use yii\db\Migration;

/**
 * Class m230518_044128_alter_challan_table
 */
class m230518_044128_alter_challan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Challan::tableName(),"amount_paid",$this->money()->notNull()->defaultValue(0));
        $this->addColumn(Challan::tableName(),"payment_status",$this->integer()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230518_044128_alter_challan_table cannot be reverted.\n";
        $this->dropColumn(Challan::tableName(),"amount_paid");
        $this->dropColumn(Challan::tableName(),"payment_status");
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230518_044128_alter_challan_table cannot be reverted.\n";

        return false;
    }
    */
}
