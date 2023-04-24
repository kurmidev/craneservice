<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_bank}}`.
 */
class m230413_183556_create_company_bank_table extends Migration
{
    protected $table = "company_bank";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "company_id" => $this->integer(),
            "name" => $this->string(),
            "account_number" => $this->string(),
            "bank_name" => $this->string(),
            "ifsc_code" => $this->string(),
            "is_taxable" => $this->integer(),
            "status" => $this->integer()->defaultValue(1),
            "created_at" => $this->dateTime()->notNull()->defaultExpression("now()"),
            "created_by" => $this->integer(),
            "updated_at" => $this->dateTime(),
            "updated_by" => $this->integer()
        ]);

        $this->createIndex("ui-{$this->table}-account_number-status",$this->table,["account_number","status"]);
        $this->addForeignKey("fk-{$this->table}-company_id", $this->table, "company_id", 'company_master', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
