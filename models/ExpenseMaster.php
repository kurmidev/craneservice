<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expense_master".
 *
 * @property int $id
 * @property int $expense_type
 * @property int $company_id
 * @property int|null $vendor_id
 * @property int|null $staff_id
 * @property string $date
 * @property int|null $type
 * @property int $paid_by
 * @property int $passed_by
 * @property int|null $voucher_no
 * @property string $against_bill_no
 * @property int|null $vehicle_id
 * @property string|null $remark
 * @property string|null $file_details
 * @property int $payment_mode
 * @property string|null $instrument_bank
 * @property string|null $instrument_date
 * @property string|null $instrument_number
 * @property float|null $base_amount
 * @property float|null $tax
 * @property float|null $total
 * @property int $status
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property CompanyMaster $company
 * @property ExpenseItems[] $expenseItems
 * @property EmployeeMaster $staff
 * @property ClientMaster $vendor
 */
class ExpenseMaster extends \app\models\BaseModel
{
    public $count;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expense_master';
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return [
            ExpenseMaster::SCENARIO_CREATE => ['expense_type', 'company_id', 'vendor_id', 'staff_id', 'voucher_no', 'date', 'type', 'paid_by', 'passed_by', 'against_bill_no', 'vehicle_id', 'remark', 'file_details ', 'payment_mode', 'instrument_bank', 'instrument_date', 'instrument_number'],
            ExpenseMaster::SCENARIO_UPDATE => ['expense_type', 'company_id', 'vendor_id', 'staff_id', 'date', 'type', 'paid_by', 'passed_by', 'against_bill_no', 'vehicle_id', 'remark', 'file_details ', 'payment_mode', 'instrument_bank', 'instrument_date', 'instrument_number']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['expense_type', 'company_id', 'date', 'paid_by', 'passed_by', 'against_bill_no', 'payment_mode'], 'required'],
            [['expense_type', 'company_id', 'vendor_id', 'staff_id', 'type', 'paid_by', 'passed_by', 'vehicle_id', 'payment_mode', 'status', 'created_by', 'updated_by'], 'integer'],
            [['date', 'file_details', 'instrument_date', 'created_at', 'updated_at'], 'safe'],
            [['remark', 'voucher_no'], 'string'],
            [['base_amount', 'tax', 'total'], 'number'],
            [['against_bill_no', 'instrument_bank', 'instrument_number'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyMaster::class, 'targetAttribute' => ['company_id' => 'id']],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmployeeMaster::class, 'targetAttribute' => ['staff_id' => 'id']],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientMaster::class, 'targetAttribute' => ['vendor_id' => 'id']],
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
            'company_id' => 'Company ID',
            'vendor_id' => 'Vendor ID',
            'staff_id' => 'Staff ID',
            'date' => 'Date',
            'type' => 'Type',
            'paid_by' => 'Paid By',
            'passed_by' => 'Passed By',
            'against_bill_no' => 'Against Bill No',
            'vehicle_id' => 'Vehicle ID',
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
     * Gets query for [[ExpenseItems]].
     *
     * @return \yii\db\ActiveQuery|ExpenseItemsQuery
     */
    public function getExpenseItems()
    {
        return $this->hasMany(ExpenseItems::class, ['expense_id' => 'id'])->with(['category']);
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery|EmployeeMasterQuery
     */
    public function getStaff()
    {
        return $this->hasOne(EmployeeMaster::class, ['id' => 'staff_id']);
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery|EmployeeMasterQuery
     */
    public function getPassed()
    {
        return $this->hasOne(EmployeeMaster::class, ['id' => 'passed_by']);
    }


    /**
     * Gets query for [[Vendor]].
     *
     * @return \yii\db\ActiveQuery|ClientMasterQuery
     */
    public function getVendor()
    {
        return $this->hasOne(ClientMaster::class, ['id' => 'vendor_id']);
    }

    /**
     * {@inheritdoc}
     * @return ExpenseMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExpenseMasterQuery(get_called_class());
    }

    public function getVehicle(){
        return $this->hasOne(VehicleMaster::class,['id'=>'vehicle_id']);
    }

    public function beforeSave($insert){
        
        if(empty($this->voucher_no)){
            $prefix = "QT";
            $this->voucher_no = empty($this->voucher_no)? $this->generateSequence($prefix,"voucher_no"):$this->voucher_no;
        }
        return parent::beforeSave($insert);
    }

    
}
