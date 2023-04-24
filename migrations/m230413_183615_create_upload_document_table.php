<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%upload_document}}`.
 */
class m230413_183615_create_upload_document_table extends Migration
{

    public $table = "upload_documents";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            "document_reference_id" => $this->integer(),
            "document_for" =>  $this->integer(),
            "document_name" => $this->string(),
            "document_type" => $this->string(),
            "documents" => $this->json(),
            "other_details" => $this->string(),
            "status" => $this->integer(),
            "created_at" => $this->dateTime()->notNull()->defaultExpression("now()"),
            "created_by" => $this->integer(),
            "updated_at" => $this->dateTime(),
            "updated_by" => $this->integer()
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
