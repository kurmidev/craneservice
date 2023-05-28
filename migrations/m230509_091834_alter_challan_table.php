<?php

use app\models\Challan;
use yii\db\Migration;

/**
 * Class m230509_091834_alter_challan_table
 */
class m230509_091834_alter_challan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Challan::tableName(),'base_amount',$this->money()->notNull()->defaultValue(0));
        $this->addColumn(Challan::tableName(),'base_amount',$this->money()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230509_091834_alter_challan_table cannot be reverted.\n";
        $this->dropColumn(Challan::tableName(), 'base_amount');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230509_091834_alter_challan_table cannot be reverted.\n";

        return false;
    }
    */
}
