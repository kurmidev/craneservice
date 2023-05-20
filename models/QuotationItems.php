<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quotation_items".
 *
 * @property int $id
 * @property int $quotation_id
 * @property int $client_id
 * @property int $client_type
 * @property int $type
 * @property int $vehicle_id
 * @property int $plan_id
 * @property int $quantity
 * @property float $amount
 * @property int $status
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property ClientMaster $client
 * @property QuotationMaster $quotation
 */
class QuotationItems extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quotation_items';
    }

    public function scenarios(){
        return [
            self::SCENARIO_CREATE=>['quotation_id', 'client_id', 'client_type', 'type', 'vehicle_id', 'plan_id', 'quantity', 'amount','status'],
            self::SCENARIO_UPDATE=>['quotation_id', 'client_id', 'client_type', 'type', 'vehicle_id', 'plan_id', 'quantity', 'amount','status'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quotation_id', 'client_id', 'client_type', 'type', 'vehicle_id', 'plan_id', 'quantity', 'amount'], 'required'],
            [['quotation_id', 'client_id', 'client_type', 'type', 'vehicle_id', 'plan_id', 'quantity', 'status', 'created_by', 'updated_by'], 'integer'],
            [['amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientMaster::class, 'targetAttribute' => ['client_id' => 'id']],
            [['quotation_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuotationMaster::class, 'targetAttribute' => ['quotation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quotation_id' => 'Quotation ID',
            'client_id' => 'Client ID',
            'client_type' => 'Client Type',
            'type' => 'Type',
            'vehicle_id' => 'Vehicle ID',
            'plan_id' => 'Plan ID',
            'quantity' => 'Quantity',
            'amount' => 'Amount',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
     * Gets query for [[Quotation]].
     *
     * @return \yii\db\ActiveQuery|QuotationMasterQuery
     */
    public function getQuotation()
    {
        return $this->hasOne(QuotationMaster::class, ['id' => 'quotation_id']);
    }

    /**
     * {@inheritdoc}
     * @return QuotationItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QuotationItemsQuery(get_called_class());
    }
}
