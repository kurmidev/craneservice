<?php

namespace app\models;

use Yii;
use app\components\ConstFunc as F;

/**
 * This is the model class for table "payment_notes".
 *
 * @property int $id
 * @property string $date
 * @property int $invoice_id
 * @property int $client_id
 * @property string $client_type
 * @property string $receipt_no
 * @property string|null $remark
 * @property float $base_amount
 * @property float $tax
 * @property float $total
 * @property int $status
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property InvoiceMaster $invoice
 */
class PaymentNotes extends \app\models\BaseModel
{
    public $tax_applicable;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_notes';
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(){
        return [
            self::SCENARIO_CREATE=>['date', 'invoice_id', 'receipt_no','client_type','client_id','base_amount', 'tax', 'total','tax_applicable'],
            self::SCENARIO_UPDATE=>['date', 'invoice_id', 'receipt_no','client_type','client_id','base_amount', 'tax', 'total','tax_applicable'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'invoice_id','client_type','client_id'], 'required'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['invoice_id', 'status', 'created_by', 'updated_by','client_id','client_type','tax_applicable'], 'integer'],
            [['base_amount', 'tax', 'total'], 'number'],
            [['receipt_no', 'remark'], 'string', 'max' => 255],
            [['receipt_no'], 'unique'],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvoiceMaster::class, 'targetAttribute' => ['invoice_id' => 'id']],
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
            'date' => 'Date',
            'client_id'=>"Client",
            "client_type"=>"Client Type",
            'invoice_id' => 'Invoice No',
            'receipt_no' => 'Receipt No',
            'remark' => 'Remark',
            'base_amount' => 'Base Amount',
            'tax' => 'Tax',
            'total' => 'Total',
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
     * @return PaymentNotesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaymentNotesQuery(get_called_class());
    }

    public function beforeSave($insert){
        $this->receipt_no = !empty($this->receipt_no)?$this->receipt_no:$this->generateSequence("CR","PAYMENTS_CREDIT");
        if(!empty($this->tax_applicable)){
            $this->tax = F::calculateTax($this->base_amount,$this->tax_applicable);
        }
        $this->total  = $this->base_amount + $this->tax;
        return parent::beforeSave($insert);
    }
}
