<?php

namespace app\forms;

use app\models\BaseForm;
use app\models\ExpenseItems;
use app\models\ExpenseMaster;
use yii\base\DynamicModel;
use yii\helpers\ArrayHelper;

class ExpenseForm extends BaseForm
{

    public $expense_type;
    public $company_id;
    public $vendor_id;
    public $staff_id;
    public $voucher_no;
    public $date;
    public $type;
    public $paid_by;
    public $passed_by;
    public $against_bill_no;
    public $vehicle_id;
    public $remark;
    public $file_details;
    public $payment_mode;
    public $instrument_bank;
    public $instrument_date;
    public $instrument_number;
    public $expense_items;

    public $id;
    public function scenarios()
    {
        return [
            ExpenseMaster::SCENARIO_CREATE => ['id','expense_type', 'company_id', 'vendor_id', 'staff_id', 'voucher_id', 'date', 'type', 'paid_by', 'passed_by', 'against_bill_no', 'vehicle_id', 'remark', 'file_details ', 'payment_mode', 'instrument_bank', 'instrument_date', 'instrument_number', 'expense_items'],
            ExpenseMaster::SCENARIO_UPDATE => ['id','expense_type', 'company_id', 'vendor_id', 'staff_id', 'voucher_id', 'date', 'type', 'paid_by', 'passed_by', 'against_bill_no', 'vehicle_id', 'remark', 'file_details ', 'payment_mode', 'instrument_bank', 'instrument_date', 'instrument_number', 'expense_items']
        ];
    }

    public function rules()
    {
        $itemModel = (new DynamicModel(["category_id", "quantity", "amount"]))
            ->addRule(["category_id", "quantity", "amount"], "required")
            ->addRule(["category_id", "quantity"], "integer")
            ->addRule(["amount"], "number");


        return [
            [['expense_type', 'company_id', 'date', 'paid_by', 'passed_by', 'against_bill_no', 'payment_mode'], 'required'],
            [['expense_type', 'company_id', 'vendor_id', 'staff_id', 'type', 'paid_by', 'passed_by', 'vehicle_id', 'payment_mode', 'status', 'created_by', 'updated_by'], 'integer'],
            [['date', 'file_details', 'instrument_date'], 'safe'],
            [['remark', 'voucher_no'], 'string'],
            [['against_bill_no', 'instrument_bank', 'instrument_number'], 'string', 'max' => 255],
            [['expense_items'], 'ValidateMulti', 'params' => ['isMulti' => TRUE, 'ValidationModel' => $itemModel, 'allowEmpty' => true]],
        ];
    }

      /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'expense_type' => 'Expense Type',
            'company_id' => 'Company',
            'vendor_id' => 'Vendor',
            'staff_id' => 'Staff',
            'date' => 'Date',
            'type' => 'Type',
            'paid_by' => 'Paid By',
            'passed_by' => 'Passed By',
            'against_bill_no' => 'Against Bill No',
            'vehicle_id' => 'Vehicle',
            'remark' => 'Remark',
            'voucher_no' => 'Voucher No',
            'file_details' => 'File Details',
            'payment_mode' => 'Payment Mode',
            'instrument_bank' => 'Instrument Bank',
            'instrument_date' => 'Instrument Date',
            'instrument_number' => 'Instrument Number',
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

    public function save()
    {

        if (!$this->hasErrors()) {
            if (!empty($this->id)) {
                return $this->update($this->id);
            } else {
                return $this->create();
            }
        }
        return false;
    }

    public function create()
    {
        $model = new ExpenseMaster(['scenario' => ExpenseMaster::SCENARIO_CREATE]);
        $model->expense_type =  $this->expense_type;
        $model->company_id = $this->company_id;
        $model->vendor_id = $this->vendor_id;
        $model->staff_id = $this->staff_id;
        $model->voucher_no = $this->voucher_no;
        $model->date = $this->date;
        $model->type = $this->type;
        $model->paid_by = $this->paid_by;
        $model->passed_by = $this->passed_by;
        $model->against_bill_no =  $this->against_bill_no;
        $model->vehicle_id = $this->vehicle_id;
        $model->remark = $this->remark;
        $model->payment_mode = $this->payment_mode;
        $model->instrument_bank = $this->instrument_bank;
        $model->instrument_date = $this->instrument_date;
        $model->instrument_number = $this->instrument_number;
        if ($model->validate() && $model->save()) {
            $this->saveExpenseItems($this->expense_items,$model);
            return true;
        } else {
            $this->addErrors($model->errors);
        }
        return false;
    }

    public function update($id)
    {
        $model = ExpenseMaster::findOne(['id'=>$id]);
        if($model instanceof ExpenseMaster){
            $model->scenario = ExpenseMaster::SCENARIO_UPDATE;
            $model->company_id = $this->company_id;
            $model->vendor_id = $this->vendor_id;
            $model->staff_id = $this->staff_id;
            $model->voucher_no = $this->voucher_no;
            $model->date = $this->date;
            $model->type = $this->type;
            $model->paid_by = $this->paid_by;
            $model->passed_by = $this->passed_by;
            $model->against_bill_no =  $this->against_bill_no;
            $model->vehicle_id = $this->vehicle_id;
            $model->remark = $this->remark;
            $model->payment_mode = $this->payment_mode;
            $model->instrument_bank = $this->instrument_bank;
            $model->instrument_date = $this->instrument_date;
            $model->instrument_number = $this->instrument_number;
            if ($model->validate() && $model->save()) {
                $this->saveExpenseItems($this->expense_items,$model);
                return true;
            } else {
                print_r($model->errors);
                exit;
                $this->addErrors($model->errors);
            }
        }

        return false;
    }



    public function saveExpenseItems($items, ExpenseMaster $em)
    {
        $base_amount = $tax = $quantity = 0;
        ExpenseItems::deleteAll(['expense_id' => $em->id]);
        if (!empty($items)) {
            foreach ($items as $item) {
                $model = new ExpenseItems(['scenario' => ExpenseItems::SCENARIO_CREATE]);
                $model->expense_type = $em->expense_type;
                $model->expense_id = $em->id;
                $model->category_id = $item['category_id'];
                $model->quantity = $item['quantity'];
                $model->amount = $item['amount'];
                if ($model->validate() && $model->save()) {
                    $base_amount += $model->amount * $model->quantity;
                    $quantity += $model->quantity;
                    $tax +=  0;
                }
            }
            ExpenseMaster::updateAll(["quantity" => $quantity, "base_amount" => $base_amount, "total" => ($base_amount + $tax)], ["id" => $em->id]);
            return true;
        }
        return false;
    }
}
