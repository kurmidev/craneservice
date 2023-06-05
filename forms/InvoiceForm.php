<?php

namespace app\forms;

use app\models\BaseForm;
use app\models\Challan;
use app\models\InvoiceMaster;
use yii\helpers\ArrayHelper;
use app\components\ConstFunc as F;
use app\components\Constants as C;

class InvoiceForm extends BaseForm
{

    public $id;
    public $invoice_no;
    public $invoice_date;
    public $invoice_type;
    public $work_order_no;
    public $vendor_no;
    public $description;
    public $base_amount;
    public $discount_amount;
    public $tax;
    public $tds;
    public $total;
    public $status;
    public $challan_ids;
    public $is_tax_applicable;
    public $client_id;
    public $client_type;
    public $remark;

    public function scenarios()
    {
        return [
            InvoiceMaster::SCENARIO_CREATE => ['invoice_type', 'status', 'base_amount', 'discount_amount', 'tax', 'tds', 'total', 'invoice_no', 'work_order_no', 'vendor_no', 'description', 'challan_ids', 'is_tax_applicable', 'clinet_id', 'client_type', 'invoice_date', 'remark'],
            InvoiceMaster::SCENARIO_UPDATE => ['invoice_type', 'status', 'base_amount', 'discount_amount', 'tax', 'tds', 'total', 'invoice_no', 'work_order_no', 'vendor_no', 'description', 'challan_ids', 'is_tax_applicable', 'clinet_id', 'client_type', 'invoice_date', 'remark'],
        ];
    }

    public function rules()
    {
        return [
            [["invoice_type", "challan_ids", "is_tax_applicable", 'clinet_id', 'client_type', 'invoice_date'], "required"],
            ['challan_ids', 'each', 'rule' => ['integer']],
            [["remark"], "string"],
            [['base_amount', 'discount_amount', 'tax', 'tds', 'total'], "number"],
        ];
    }

    public function save()
    {

        if (!$this->hasErrors()) {
            if (empty($this->id)) {
                return  $this->create();
            } else {
                return $this->update($this->id);
            }
        }
        return false;
    }

    public function create()
    {
        $model = new InvoiceMaster(['scenario' => InvoiceMaster::SCENARIO_CREATE]);
        $model->client_type = $this->client_type;
        $model->client_id = $this->client_id;
        $model->invoice_type = $this->invoice_type;
        $model->work_order_no = $this->work_order_no;
        $model->vendor_no = $this->vendor_no;
        $model->description = $this->description;
        $model->invoice_date = $this->invoice_date;
        $model->remark = $this->remark;
        $model->status = C::STATUS_ACTIVE;
        if ($model->validate() && $model->save()) {
            $this->mapChallans($this->challan_ids, $model->id);
            return true;
        } else {
            echo "<pre>";
            print_r($model->errors);
            exit;
        }
        return false;
    }

    public function update($id)
    {
        $model = InvoiceMaster::findOne(['id' => $id]);
        if ($model instanceof InvoiceMaster) {
            $model->client_type = $this->client_type;
            $model->client_id = $this->client_id;
            $model->invoice_type = $this->invoice_type;
            $model->work_order_no = $this->work_order_no;
            $model->vendor_no = $this->vendor_no;
            $model->description = $this->description;
            $model->invoice_date = $this->invoice_date;
            $model->remark = $this->remark;
            if ($model->validate() && $model->save()) {
                $this->mapChallans($this->challan_ids, $model->id);
                return true;
            }
        }
        return false;
    }

    public function mapChallans($challan_ids, $id)
    {
        $challanIds = [];
        foreach ($challan_ids as $ids => $istrue) {
            if ($istrue) {
                $challanIds[] = $ids;
            }
        }

        Challan::updateAll(['is_processed' => 0, "invoice_id" => null], ['invoice_id' => $id]);
        $base_amount = $tax_amount = 0;
        $challans = Challan::find()->where(['id' => $challanIds, 'is_processed' => 0, "invoice_id" => null])->all();
        foreach ($challans as $challan) {
            $challan->scenario = Challan::SCENARIO_UPDATE;
            $challan->invoice_id = $id;
            $challan->is_processed = 1;
            if ($challan->validate() && $challan->save()) {
                $base_amount += $challan->base_amount;
                $tax_amount +=  ($this->is_tax_applicable)? F::calculateTax($challan->base_amount, $challan->plan->tax_slot):0;
            }
        }
        $discountAmount = is_null($this->discount_amount) ? 0 : $this->discount_amount;
       $recods  =  InvoiceMaster::updateAll(
            [
                'base_amount' => $base_amount,
                'discount_amount' => $discountAmount,
                'tax' => $tax_amount,
                'tds' => is_null($this->tds) ? 0 : $this->tds,
                'total' => ($base_amount - $discountAmount  + $tax_amount)
            ],
            ['id' => $id]
        );
    }
}
