<?php

use app\models\CompanyMaster;
use yii\db\Migration;

/**
 * Class m230614_140257_alter_company_master_table
 */
class m230614_140257_alter_company_master_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(CompanyMaster::tableName(),'code',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230614_140257_alter_company_master_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230614_140257_alter_company_master_table cannot be reverted.\n";

        return false;
    }
    */
}
