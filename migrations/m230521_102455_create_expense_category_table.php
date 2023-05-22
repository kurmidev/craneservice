<?php

use yii\db\Migration;
use app\components\Constants as C;
/**
 * Handles the creation of table `{{%expense_category}}`.
 */
class m230521_102455_create_expense_category_table extends Migration
{
    public $table = "expense_category";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "name"=> $this->string()->unique()->notNull(),
            "remark"=> $this->string(),
            "status"=> $this->integer()->notNull()->defaultValue(C::STATUS_ACTIVE),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'updated_at' => $this->dateTime()->null(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
