<?php

use app\models\CompanyPrefix;
use yii\db\Migration;

/**
 * Class m230629_155938_alter_company_prefix_table
 */
class m230629_155938_alter_company_prefix_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(CompanyPrefix::tableName(),'post_prefix',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230629_155938_alter_company_prefix_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230629_155938_alter_company_prefix_table cannot be reverted.\n";

        return false;
    }
    */
}
