<?php

namespace app\models;

use Symfony\Component\BrowserKit\Client;
use Yii;
use app\components\Constants as C;
use app\components\ConstFunc as F;
/**
 * This is the model class for table "invoice_master".
 *
 * @property int $id
 * @property int $client_id
 * @property int $client_type
 * @property string|null $invoice_no
 * @property string $invoice_date
 * @property int $invoice_type
 * @property string|null $work_order_no
 * @property string|null $vendor_no
 * @property string|null $description
 * @property float $base_amount
 * @property float $discount_amount
 * @property float $tax
 * @property float $tds
 * @property float $total
 * @property int $status
 * @property int $payment_id
 * @property string $remark
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class InvoiceMaster extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoice_master';
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['invoice_type', 'status', 'base_amount', 'discount_amount', 'tax', 'tds', 'total', 'invoice_no', 'work_order_no', 'vendor_no', 'description', 'invoice_date','client_type','client_id','payment','remark','payment_id'],
            self::SCENARIO_UPDATE => ['invoice_type', 'status', 'base_amount', 'discount_amount', 'tax', 'tds', 'total', 'invoice_no', 'work_order_no', 'vendor_no', 'description', 'invoice_date','client_type','client_id','payment','remark','payment_id']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invoice_type', 'invoice_date','client_type','client_id'], 'required'],
            [['invoice_type', 'status', 'created_by', 'updated_by'], 'integer'],
            [['base_amount', 'discount_amount', 'tax', 'tds', 'total','payment'], 'number'],
            [['created_at', 'updated_at','payment_id'], 'safe'],
            [['invoice_no', 'work_order_no', 'vendor_no', 'description'], 'string', 'max' => 255],
            [['invoice_no'], 'unique'],
            [['remark'],'string']
        ];
    }


    public function attributes()
    {
        return array_merge(parent::attributes(),['is_tax_applicable']) ;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_no' => 'Invoice No',
            'invoice_type' => 'Invoice Type',
            'invoice_date' => 'Invoice Date',
            'client_type' => "Client Type",
            'client_id' => "Client",
            'work_order_no' => 'Work Order No',
            'vendor_no' => 'Vendor No',
            'description' => 'Description',
            'base_amount' => 'Base Amount',
            'discount_amount' => 'Discount Amount',
            'tax' => 'Tax',
            'tds' => 'Tds',
            'total' => 'Total',
            'status' => 'Status',
            'payment'=>'Payment',
            'remark' => 'Remark',
            'payment_id' =>"Payment",
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return InvoiceMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InvoiceMasterQuery(get_called_class());
    }

    public function getChallans()
    {
        return $this->hasMany(Challan::class, ['invoice_id' => 'id'])->with(['plan']);
    }

    public function getClient(){
        return $this->hasOne(ClientMaster::class,['id'=>'client_id','client_type'=>'client_type']);
    }


    public function getPayment(){
        return $this->hasOne(Payments::class,['id'=>'payment_id']);
    }

    public function beforeSave($insert){
        parent::beforeSave($insert);
        if(!empty($insert) && empty($this->invoice_no)){
            $type = $this->invoice_type==C::INVOICE_TYPE_GST?"INVOICE_GST":"INVOICE_PERFORMA";
            $prefix = $this->invoice_type==C::INVOICE_TYPE_GST?"IN/".F::getFY($this->invoice_date) :"PR";
            $this->invoice_no = $this->generateSequence($prefix,$type);
        }
        return true;
    }

    public function deleteInvoice(){
        $model = Challan::find()->where(['invoice_id'=>$this->id])->all();
        foreach($model as $challan){
            $challan->scenario = Challan::SCENARIO_UPDATE;
            $challan->is_processed=0;
            $challan->invoice_id =null;
            $challan->amount_paid =0;
            $challan->payment_status =0;
            if($challan->validate() && $challan->save()){

            }
        }
    }

    public function getAuditMessage($oldAttr, $newAttr, $changeAttr)
    {
        if (empty($oldAttr)) {
            return "Invoice {$this->invoice_no} has been created by {$this->actionBy} of amount {$this->base_amount}";
        } else if (!empty($changeAttr)) {
            if ($this->status == C::STATUS_DELETED) {
                return "Invoice {$this->invoice_no} has been deleted by {$this->actionBy} on {$this->updated_at}";
            }else if(in_array("payment",array_keys($changeAttr)) && !empty($this->payment)){
                return  "Invoice {$this->invoice_no}, payment done by {$this->actionBy} on {$this->updated_at}";
            } else {
                $listValue = $this->generateText($oldAttr, $newAttr, $changeAttr);
                return  "Invoice {$this->invoice_no} values {$listValue} been changed by {$this->actionBy} on {$this->updated_at}";
            }
        }
        return "";
    }

    public function getIs_tax_applicable(){
        return !empty($this->tax)?1:0;
    }
}
