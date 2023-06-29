<?php

use app\models\EmployeeMaster;
use yii\db\Migration;

/**
 * Class m230629_170420_alter_employee_master_table
 */
class m230629_170420_alter_employee_master_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(EmployeeMaster::tableName(),'username',$this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230629_170420_alter_employee_master_table cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230629_170420_alter_employee_master_table cannot be reverted.\n";

        return false;
    }
    */
}
