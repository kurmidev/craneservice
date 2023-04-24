<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company_bank".
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $name
 * @property string|null $account_number
 * @property string|null $bank_name
 * @property string|null $ifsc_code
 * @property int|null $is_taxable
 * @property int|null $status
 * @property string $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $update_by
 *
 * @property CompanyMaster $company
 */
class CompanyBank extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'status', 'created_by', 'update_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'account_number', 'bank_name', 'ifsc_code'], 'string', 'max' => 255],
          //  ['ifsc_code', 'match', 'pattern' => "^[A-Z]{4}0[A-Z0-9]{6}$"],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyMaster::class, 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ["company_id", "status", "account_number", "bank_name", "ifsc_code"],
            self::SCENARIO_UPDATE => ["company_id", "status", "account_number", "bank_name", "ifsc_code"],
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
            'name' => 'Name',
            'account_number' => 'Account Number',
            'bank_name' => 'Bank Name',
            'ifsc_code' => 'Ifsc Code',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'update_by' => 'Update By',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery|CompanyMasterQuery
     */
    public function getCompany()
    {
        return $this->hasOne(CompanyMaster::class, ['id' => 'company_id']);
    }

    /**
     * {@inheritdoc}
     * @return CompanyBankQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanyBankQuery(get_called_class());
    }
}
