<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "audit_logs".
 *
 * @property int $id
 * @property int $client_id
 * @property int $client_type
 * @property string|null $table_name
 * @property string|null $old_value
 * @property string|null $new_value
 * @property string|null $changed_value
 * @property int|null $primary_id
 * @property int|null $action_taken
 * @property string|null $remark
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class AuditLogs extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'audit_logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['old_value', 'new_value', 'changed_value', 'created_at', 'updated_at'], 'safe'],
            [['primary_id', 'action_taken', 'created_by', 'updated_by','client_id',"client_type"], 'integer'],
            [['table_name', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_name' => 'Table Name',
            'old_value' => 'Old Value',
            'new_value' => 'New Value',
            'changed_value' => 'Changed Value',
            'primary_id' => 'Primary ID',
            'action_taken' => 'Action Taken',
            'remark' => 'Remark',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AuditLogsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuditLogsQuery(get_called_class());
    }
}
