<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments_details".
 *
 * @property int $id
 * @property int $client_id
 * @property int $client_type
 * @property int $payment_id
 * @property int $invoice_id
 * @property int $challan_id
 * @property int $status
 * @property float $amount_adjsuted
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property InvoiceMaster $invoice
 * @property Payments $payment
 */
class PaymentsDetails extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments_details';
    }


    public function scenarios(){
        return [
            self::SCENARIO_CREATE=>['payment_id', 'invoice_id', 'challan_id', 'amount_adjsuted','status','client_id','payment_id'],
            self::SCENARIO_UPDATE=>['payment_id', 'invoice_id', 'challan_id', 'amount_adjsuted','status','client_id','payment_id'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_id', 'invoice_id', 'challan_id', 'amount_adjsuted','status'], 'required'],
            [['payment_id', 'invoice_id', 'challan_id', 'created_by', 'updated_by','status'], 'integer'],
            [['amount_adjsuted'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientMaster::class, 'targetAttribute' => ['client_id' => 'id']],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Payments::class, 'targetAttribute' => ['payment_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_id' => 'Payment',
            'invoice_id' => 'Invoice',
            'client_id' => 'Client',
            'client_type' => 'Client Type',
            'challan_id' => 'Challan',
            'amount_adjsuted' => 'Amount Adjsuted',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Invoice]].
     *
     * @return \yii\db\ActiveQuery|InvoiceMasterQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(InvoiceMaster::class, ['id' => 'invoice_id']);
    }

    public function getChallan()
    {
        return $this->hasOne(Challan::class, ['id' => 'challan_id']);
    }

    /**
     * Gets query for [[Payment]].
     *
     * @return \yii\db\ActiveQuery|PaymentsQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Payments::class, ['id' => 'payment_id']);
    }

    /**
     * {@inheritdoc}
     * @return PaymentsDetailsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaymentsDetailsQuery(get_called_class());
    }
}
