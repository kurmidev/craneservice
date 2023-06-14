<?php

namespace app\models;

use Yii;
use app\components\Constants as C;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "company_master".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $mobile_no
 * @property string|null $phone_no
 * @property string|null $email
 * @property string|null $billing_address
 * @property int|null $city_id
 * @property int|null $pincode
 * @property string|null $gst_in
 * @property string|null $pan_no
 * @property string|null $supply_place
 * @property int|null $state_code
 * @property int $status
 * @property string $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property ClientMaster[] $clientMasters
 * @property CompanyBank[] $companyBanks
 * @property EmployeeMaster[] $employeeMasters
 */
class CompanyMaster extends \app\models\BaseModel
{
    public $kyc_details;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'mobile_no'], 'required'],
            [['city_id', 'pincode', 'state_code', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'code'], 'safe'],
            [['name', 'billing_address'], 'string', 'max' => 250],
            [['mobile_no'], 'string', 'max' => 10, 'min' => 10],
            [['phone_no'], 'string', 'max' => 15, 'min' => 10],
            [['email'], 'string', 'max' => 150],
            [['gst_in'], 'string', 'max' => 100],
            [['pan_no'], 'string', 'max' => 10],
            [['supply_place'], 'string', 'max' => 200],
            [['name'], 'unique'],
            [['code'], 'unique'],
            //['pan_no', 'match', 'pattern' => "[A-Z]{5}[0-9]{4}[A-Z]{1}$"],
            //['gst_in', 'match', 'pattern' => "[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$"],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ["name", "mobile_no", "city_id", "pincode", "state_code", "status", "billing_address", "phone_no", "email", "gst_in", "pan_no", "supply_place", "code"],
            self::SCENARIO_UPDATE => ["name", "mobile_no", "city_id", "pincode", "state_code", "status", "billing_address", "phone_no", "email", "gst_in", "pan_no", "supply_place", "code"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => "Code",
            'mobile_no' => 'Mobile No',
            'phone_no' => 'Phone No',
            'email' => 'Email',
            'billing_address' => 'Billing Addresss',
            'city_id' => 'City',
            'pincode' => 'Pincode',
            'gst_in' => 'Gst',
            'pan_no' => 'Pan No',
            'supply_place' => 'Supply Place',
            'state_code' => 'State Code',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Update By',
        ];
    }

    /**
     * Gets query for [[ClientMasters]].
     *
     * @return \yii\db\ActiveQuery|ClientMasterQuery
     */
    public function getClientMasters()
    {
        return $this->hasMany(ClientMaster::class, ['company_id' => 'id']);
    }

    /**
     * Gets query for [[CompanyBanks]].
     *
     * @return \yii\db\ActiveQuery|CompanyBankQuery
     */
    public function getCompanyBanks()
    {
        return $this->hasMany(CompanyBank::class, ['company_id' => 'id']);
    }

    /**
     * Gets query for [[EmployeeMasters]].
     *
     * @return \yii\db\ActiveQuery|EmployeeMasterQuery
     */
    public function getEmployeeMasters()
    {
        return $this->hasMany(EmployeeMaster::class, ['company_id' => 'id']);
    }


    /**
     * Gets query for [[CompanyBank]].
     *
     * @return \yii\db\ActiveQuery|CompanyBankQuery
     */
    public function getTaxBank()
    {
        return $this->hasOne(CompanyBank::class, ['company_id' => 'id'])->andWhere(['is_taxable' => C::STATUS_ACTIVE]);
    }

    /**
     * Gets query for [[CompanyBank]].
     *
     * @return \yii\db\ActiveQuery|CompanyBankQuery
     */
    public function getNonTaxBank()
    {
        return $this->hasOne(CompanyBank::class, ['company_id' => 'id'])->andWhere(['is_taxable' => C::STATUS_INACTIVE]);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery|CityQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    public function getBankDetails()
    {
        return $this->hasMany(CompanyBank::class, ['company_id' => 'id']);
    }

    public function getBanks()
    {
        $bank = $this->bankDetails;

        if (!empty($bank)) {
            $bank = ArrayHelper::index($bank, "is_taxable");
        }
        return $bank;
    }

    public function getDocuments()
    {
        return $this->hasMany(UploadDocument::class, ["document_reference_id" => 'id'])->onCondition(["document_for" => C::DOCUMENT_FOR_VEHICLE]);
    }


    /**
     * {@inheritdoc}
     * @return CompanyMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanyMasterQuery(get_called_class());
    }
}
