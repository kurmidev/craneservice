<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "upload_documents".
 *
 * @property int $id
 * @property int|null $document_reference_id
 * @property int|null $document_for
 * @property string|null $document_name
 * @property string|null $document_type
 * @property string|null $documents
 * @property string|null $other_details
 * @property int|null $status
 * @property string $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $update_by
 */
class UploadDocument extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'upload_documents';
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(){
        return [
            self::SCENARIO_CREATE => ['document_reference_id', 'document_for', 'status','documents','other_details','document_name', 'document_type'],
            self::SCENARIO_UPDATE => ['document_reference_id', 'document_for', 'status','documents','other_details','document_name', 'document_type'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document_reference_id', 'document_for', 'status', 'created_by', 'update_by'], 'integer'],
            [['documents', 'created_at', 'updated_at','other_details'], 'safe'],
            [['document_name', 'document_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'document_reference_id' => 'Document Reference ID',
            'document_for' => 'Document For',
            'document_name' => 'Document Name',
            'document_type' => 'Document Type',
            'documents' => 'Documents',
            'other_details' => 'Other Details',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'update_by' => 'Update By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UploadDocumentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UploadDocumentQuery(get_called_class());
    }
}
