<?php

namespace app\models;

use Yii;
use app\components\Constants as C;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "payments".
 *
 * @property int $id
 * @property int $invoice_id
 * @property int $client_id
 * @property int $client_type
 * @property string $receipt_no
 * @property string $payment_date
 * @property float $amount_paid
 * @property int $payment_mode
 * @property string|null $intrument_no
 * @property string|null $instrument_date
 * @property string|null $remark
 * @property int $status
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property InvoiceMaster $invoice
 * @property PaymentsDetails[] $paymentsDetails
 */
class Payments extends \app\models\BaseModel
{
    public $challans;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }


    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['client_id', 'client_type', 'payment_date', 'amount_paid', 'payment_mode', 'receipt_no', 'intrument_no', 'remark', 'instrument_date', 'status', 'challans'],
            self::SCENARIO_UPDATE => ['client_id', 'client_type', 'payment_date', 'amount_paid', 'payment_mode', 'receipt_no', 'intrument_no', 'remark', 'instrument_date', 'status', 'challans']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'client_type', 'payment_date', 'amount_paid', 'payment_mode', 'status'], 'required'],
            [['client_id', 'client_type', 'payment_mode', 'created_by', 'updated_by'], 'integer'],
            [['payment_date', 'instrument_date', 'created_at', 'updated_at', 'invoice_id', 'receipt_no'], 'safe'],
            [['amount_paid'], 'number'],
            [['intrument_no', 'remark', 'receipt_no'], 'string', 'max' => 255],
            [['challans'], 'required', 'when' => function () {
                return PAYMENT_METHOD == C::PAYMENT_INVOICEWISE && $this->scenario==self::SCENARIO_CREATE;
            }]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Company',
            'status' => "Status",
            "client_type" => "Client Type",
            'payment_date' => 'Payment Date',
            'amount_paid' => 'Amount Paid',
            'payment_mode' => 'Payment Mode',
            'intrument_no' => 'Intrument No',
            'instrument_date' => 'Instrument Date',
            'remark' => 'Remark',
            'receipt_no' => 'Receipt No',
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
    public function getClient()
    {
        return $this->hasOne(ClientMaster::class, ['id' => 'client_id', "client_type" => "client_type"]);
    }

    /**
     * Gets query for [[PaymentsDetails]].
     *
     * @return \yii\db\ActiveQuery|PaymentsDetailsQuery
     */
    public function getPaymentsDetails()
    {
        return $this->hasMany(PaymentsDetails::class, ['payment_id' => 'id', 'client_id' => 'client_id', "client_type" => "client_type"]);
    }

    /**
     * {@inheritdoc}
     * @return PaymentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaymentsQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        $this->receipt_no = !empty($this->receipt_no) ? $this->receipt_no : $this->generateSequence("BHP", "PAYMENTS");
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (!empty($insert)) {
            $this->adjustPayment();
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function adjustPayment()
    {
        if (PAYMENT_METHOD == C::PAYMENT_IR_RESPECTIVE_INVOICE) {
            $this->adjustPaymentModeIrrespectiveOfInvoice();
        } else if (PAYMENT_METHOD == C::PAYMENT_INVOICEWISE) {
            $this->adjustPaymentInvoiceWise();
        }
    }

    public function adjustPaymentInvoiceWise()
    {
        $amount_received  = 0;
        if (!empty($this->challans)) {
            $challan_ids = array_keys($this->challans);
            $chalanObj = Challan::find()->active()->andWhere(['id' => $challan_ids, 'client_id' => $this->client_id])->all();
            foreach ($chalanObj as $challan) {
                $paymentDetails = new PaymentsDetails(['scenario' => PaymentsDetails::SCENARIO_CREATE]);
                $paymentDetails->payment_id = $this->id;
                $paymentDetails->client_id = $this->client_id;
                $paymentDetails->client_type = $this->client_type;
                $paymentDetails->invoice_id = $challan->invoice_id;
                $paymentDetails->challan_id = $challan->id;
                $paymentDetails->status = C::STATUS_ACTIVE;
                $paymentDetails->deduction_amount = !empty($this->challans[$challan->id]['deduction_amount']) ? $this->challans[$challan->id]['deduction_amount'] : 0;
                $paymentDetails->deduction_number = !empty($this->challans[$challan->id]['deduction_number']) ? $this->challans[$challan->id]['deduction_number'] : 0;
                $paymentDetails->tds_amount = !empty($this->challans[$challan->id]['tds_amount']) ? $this->challans[$challan->id]['tds_amount'] : 0;
                $paymentDetails->tds_number = !empty($this->challans[$challan->id]['tds_number']) ? $this->challans[$challan->id]['tds_number'] : 0;
                $paymentDetails->amount_paid = !empty($this->challans[$challan->id]['amount_paid']) ? $this->challans[$challan->id]['amount_paid'] : 0;
                $paymentDetails->amount_adjsuted = $paymentDetails->amount_paid - $paymentDetails->deduction_amount - $paymentDetails->tds_number;
                if ($paymentDetails->validate() && $paymentDetails->save()) {
                    $amount_paid = $challan->amount_paid + $paymentDetails->amount_adjsuted; 
                    $payment_staus = ($amount_paid>=$challan->total)?C::PAYMENT_STAUS_FULLY_PAID: C::PAYMENT_STATUS_HALF_PAID;
                    Challan::updateAll(["payment_status" => $payment_staus, 'amount_paid' => $amount_paid], ["id" => $challan->id]);
                    $amount_received+=$paymentDetails->amount_adjsuted;
                }
            }
            if ($amount_received > 0) {
                Payments::updateAll(["amount_paid" => $amount_received], ['id' => $this->id]);
            }
        }
    }

    public function adjustPaymentModeIrrespectiveOfInvoice()
    {
        $amount_received  = $this->amount_paid;
        $challans = Challan::find()
            ->where(['client_id' => $this->client_id, 'payment_status' => [C::PAYMENT_STATUS_HALF_PAID, C::PAYMENT_STATUS_NOT_PAID]])
            ->andwhere("(total-amount_paid)>0")->all();
        foreach ($challans as $challan) {
            $remaing_amount = $challan->total - $challan->amount_paid;
            $challan_paid_amount =  $challan->amount_paid;
            $amount_paid = 0;
            $payment_staus = C::PAYMENT_STATUS_NOT_PAID;
            if ($remaing_amount > $amount_received) {
                $amount_paid = $amount_received;
                $challan_paid_amount += $amount_received;
                $payment_staus = C::PAYMENT_STATUS_HALF_PAID;
                $amount_received = 0;
            } else if ($remaing_amount < $amount_received) {
                $amount_received = $amount_received - $remaing_amount;
                $challan_paid_amount += $remaing_amount;
                $payment_staus = C::PAYMENT_STAUS_FULLY_PAID;
                $amount_paid = $remaing_amount;
            }
            Challan::updateAll(["payment_status" => $payment_staus, 'amount_paid' => $challan_paid_amount], ["id" => $challan->id]);
            $this->markPayments($challan, $amount_paid);
            if ($amount_received <= 0) {
                break;
            }
        }
    }

    public function markPayments(Challan $challan, $amount_paid)
    {
        $model = new PaymentsDetails(['scenario' => PaymentsDetails::SCENARIO_CREATE]);
        $model->payment_id = $this->id;
        $model->client_id = $this->client_id;
        $model->client_type = $this->client_type;
        $model->invoice_id = $challan->invoice_id;
        $model->challan_id = $challan->id;
        $model->amount_paid = $amount_paid;
        $model->amount_adjsuted = $amount_paid;
        $model->status = C::STATUS_ACTIVE;
        if ($model->validate() && $model->save()) {
            return $model;
        } else {
            print_r($model->errors);
            exit;
        }
        return false;
    }

    public function getInvoice_list()
    {
        if (!empty($this->paymentsDetails)) {
            return implode(",", ArrayHelper::getColumn($this->paymentsDetails, 'invoice.invoice_no'));
        }
        return "";
    }

    public function deletePayment(){
        $model = PaymentsDetails::find()->where(['payment_id' => $this->id])->all();
        foreach($model as $m){
            $m->scenario = PaymentsDetails::SCENARIO_UPDATE;
            $m->status = C::STATUS_DELETED;
            if($m->validate() && $m->save()){
                Challan::updateAll(['amount_paid'=>0,"payment_status"=>0],['id'=>$m->challan_id]);
                InvoiceMaster::updateAll(["payment"=>0],["id"=>$m->invoice_id]);
            }
        }
    }
}
