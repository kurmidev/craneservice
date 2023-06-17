<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_site".
 *
 * @property int $id
 * @property string $address
 * @property int $client_id
 * @property int $status
 * @property int $site_city_id
 * @property string $site_pincode
 * @property string $created_at
 * @property string|null $updated_on
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property ClientMaster $client
 */
class ClientSite extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_site';
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(){
        return [
            self::SCENARIO_CREATE=>["address","client_id","status",'is_default','site_city_id','site_pincode'],
            self::SCENARIO_UPDATE=>["address","client_id","status",'is_default','site_city_id','site_pincode'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'client_id'], 'required'],
            [['client_id', 'status', 'created_by', 'updated_by','is_default'], 'integer'],
            [['created_at', 'updated_on','site_city_id','site_pincode'], 'safe'],
            [['address'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientMaster::class, 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Address',
            'client_id' => 'Client ID',
            'status' => 'Status',
            'site_city_id'=>'City',
            'site_pincode'=>'Pincode',
            'is_default'=>'Is Default',
            'created_at' => 'Created At',
            'updated_on' => 'Updated On',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery|ClientMasterQuery
     */
    public function getClient()
    {
        return $this->hasOne(ClientMaster::class, ['id' => 'client_id']);
    }

    /**
     * {@inheritdoc}
     * @return ClientSiteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientSiteQuery(get_called_class());
    }
}
