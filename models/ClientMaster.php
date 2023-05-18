<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_master".
 *
 * @property int $id
 * @property int|null $client_type
 * @property int $company_id
 * @property string|null $company_name
 * @property string $first_name
 * @property string $last_name
 * @property string|null $email
 * @property string|null $mobile_no
 * @property string|null $phone_no
 * @property string|null $address
 * @property int|null $city_id
 * @property string|null $pincode
 * @property string|null $site_address
 * @property int|null $site_city_id
 * @property string|null $site_pincode
 * @property int|null $type
 * @property int|null $status
 * @property string $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property City $city
 * @property CompanyMaster $company
 */
class ClientMaster extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_master';
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => [
                "client_type", "company_id", "company_name", "first_name", "last_name", "email", "mobile_no", "phone_no", "address", "city_id",
                "pincode", "site_address", "site_city_id", "site_pincode", "type", "status"
            ],
            self::SCENARIO_UPDATE => [
                "client_type", "company_id", "company_name", "first_name", "last_name", "email", "mobile_no", "phone_no", "address", "city_id",
                "pincode", "site_address", "site_city_id", "site_pincode", "type", "status"
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_type', 'company_id', 'city_id', 'site_city_id', 'type', 'status'], 'integer'],
            [['company_id', 'first_name', 'last_name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['company_name', 'email'], 'string', 'max' => 250],
            [['first_name', 'last_name'], 'string', 'max' => 150],
            [['mobile_no'], 'string', 'max' => 10],
            [['phone_no'], 'string', 'max' => 15],
            [['address', 'pincode', 'site_address', 'site_pincode'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyMaster::class, 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_type' => 'Client Type',
            'company_id' => 'Company ID',
            'company_name' => 'Company Name',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'mobile_no' => 'Mobile No',
            'phone_no' => 'Phone No',
            'address' => 'Address',
            'city_id' => 'City ID',
            'pincode' => 'Pincode',
            'site_address' => 'Site Address',
            'site_city_id' => 'Site City ID',
            'site_pincode' => 'Site Pincode',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
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
     * @return ClientMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientMasterQuery(get_called_class());
    }

    public function getPayments()
    {
        return $this->hasMany(Payments::class, ['client_id' => 'id', 'client_type' => 'client_type']);
    }


    public function getChallan()
    {
        return $this->hasMany(Challan::class, ['client_id' => 'id']);
    }

    public function getChallanAmount(){
        return $this->hasMany(Challan::class,['client_id' => 'id'])->sum("total");
    }


    public function getPaymentAmount(){
        return $this->hasMany(Payments::class,['client_id' => 'id','client_type'=>'client_type'])->sum("amount_paid");
    }

    public function getBalance(){
        return $this->challanAmount - $this->paymentAmount;
    }
}
