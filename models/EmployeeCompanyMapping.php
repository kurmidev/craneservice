<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_company_mapping".
 *
 * @property int $id
 * @property int $company_id
 * @property int $employee_id
 * @property string $created_at
 * @property string|null $updated_on
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class EmployeeCompanyMapping extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_company_mapping';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'employee_id'], 'required'],
            [['company_id', 'employee_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_on'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'employee_id' => 'Employee ID',
            'created_at' => 'Created At',
            'updated_on' => 'Updated On',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return EmployeeCompanyMappingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeCompanyMappingQuery(get_called_class());
    }
}
