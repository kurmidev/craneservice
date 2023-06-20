<?php

namespace app\forms;

use app\models\BaseForm;
use app\models\Challan;
use app\components\Constants as C;
use app\models\ClientMaster;
use app\models\ClientPlanMapping;
use app\models\EmployeeMaster;
use app\models\PlanMaster;
use app\models\VehicleMaster;
use app\components\ConstFunc as F;

class ChallanForm extends BaseForm
{

    public $id;
    public $challan_no;
    public $challan_date;
    public $site_address;
    public $helper_id;
    public $operator_id;
    public $plan_id;
    public $vehicle_id;
    public $plan_start_time;
    public $day_wise;
    public $plan_trip;
    public $from_destination;
    public $plan_end_time;
    public $plan_measure;
    public $to_destination;
    public $amount;
    public $break_time;
    public $up_time;
    public $plan_extra_hours;
    public $down_time;
    public $plan_shift_type;
    public $client_type;
    public $client_id;
    public $plan;
    public $client;
    public $customprice;


    public function scenarios()
    {
        return [
            Challan::SCENARIO_CREATE => ["challan_no", "challan_date", "site_address", "helper_id", "operator_id", "plan_id", "vehicle_id", "plan_start_time", "day_wise", "plan_trip", "from_destination", "plan_end_time", "plan_measure", "to_destination", "amount", "break_time", "up_time", "plan_extra_hours", "down_time", "plan_shift_type"],
            Challan::SCENARIO_UPDATE => ["challan_no", "challan_date", "site_address", "helper_id", "operator_id", "plan_id", "vehicle_id", "plan_start_time", "day_wise", "plan_trip", "from_destination", "plan_end_time", "plan_measure", "to_destination", "amount", "break_time", "up_time", "plan_extra_hours", "down_time", "plan_shift_type"]
        ];
    }

    public function rules()
    {
        return [
            [["challan_no", "challan_date", "plan_id", "vehicle_id", 'client_id', "client_type"], "required"],
            [["from_destination", "to_destination", "challan_no",], "string"],
            [["break_time", "up_time", "down_time", "plan_trip",  "plan_measure", "site_address", "helper_id", "operator_id", "plan_id", "vehicle_id"], 'integer'],
            [['amount'], 'double'],
            ['plan_id', 'exist', 'targetClass' => PlanMaster::class, 'targetAttribute' => ['plan_id' => 'id']],
            ['vehicle_id', 'exist', 'targetClass' => VehicleMaster::class, 'targetAttribute' => ['vehicle_id' => 'id']],
            ['helper_id', 'exist', 'targetClass' => EmployeeMaster::class, 'targetAttribute' => ['helper_id' => 'id']],
            ['operator_id', 'exist', 'targetClass' => EmployeeMaster::class, 'targetAttribute' => ['operator_id' => 'id']],
            ['client_id', 'exist', 'targetClass' => ClientMaster::class, 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client',
            'challan_date' => 'Challan Date',
            'site_address' => 'Shipping Address',
            'operator_id' => 'Operator',
            'helper_id' => 'Helper',
            'plan_id' => 'Plan',
            'vehicle_id' => 'Vehicle',
            'challan_no' => 'Challan No',
            'plan_start_time' => 'Plan Start Time',
            'plan_end_time' => 'Plan End Time',
            'day_wise' => 'Day Wise',
            'plan_measure' => 'Plan Measure',
            'plan_trip' => 'Plan Trip',
            'from_destination' => 'From Destination',
            'to_destination' => 'To Destination',
            'base_amount' => 'Base Amount',
            'amount' => 'Amount',
            'extra' => 'Extra Charages',
            'tax' => 'Tax',
            'total' => 'Total',
            'payment_status' => 'Payment Status',
            'amount_paid' => "Amount Paid",
            'break_time' => 'Break Time',
            'up_time' => 'Up Time',
            'down_time' => 'Down Time',
            'plan_extra_hours' => 'Plan Extra Hours',
            'plan_shift_type' => 'Plan Shift Type',
            'challan_image' => 'Challan Image',
            'invoice_id' => 'Invoice',
            'is_processed' => 'Is Processed',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_on' => 'Updated On',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }


    public function beforeValidate()
    {
        $client = ClientMaster::findOne(['id' => $this->client_id]);
        if ($client instanceof ClientMaster) {
            $this->client = $client;
        }

        if (!empty($this->plan_id)) {
            $plan = PlanMaster::findOne(['id' => $this->plan_id]);
            if ($plan instanceof PlanMaster) {
                $this->plan = $plan;
            }
        }
        if (!empty($this->plan_id)) {
            $plan = ClientPlanMapping::findOne(['plan_id' => $this->plan_id, 'client_id' => $this->client_id]);
            if ($plan instanceof ClientPlanMapping) {
                $this->customprice = $plan;
            }
        }

        if ($this->plan instanceof PlanMaster) {
            if ($this->plan->type == C::PACKAGE_WISE_TRIP) {
                if (empty($this->plan_trip)) {
                    $this->addError('plan_trip', "Plan Trip cannot be empty");
                }
                if (empty($this->plan_measure)) {
                    $this->addError('plan_measure', "Plan Measure cannot be empty");
                }
            }

            if ($this->plan->type == C::PACKAGE_WISE_DAY) {
                if (empty($this->day_wise)) {
                    $this->addError('day_wise', "Day wise cannot be empty");
                }
            }

            if (in_array($this->plan->type, [C::PACKAGE_WISE_CHALLAN, C::PACKAGE_WISE_SHIFT, C::PACKAGE_WISE_MONTH])) {
                if (empty($this->plan_start_time)) {
                    $this->addError('plan_start_time', "Plan Start Time cannot be empty");
                }

                if (empty($this->plan_end_time)) {
                    $this->addError('plan_end_time', "Plan End Time cannot be empty");
                }
            }

            if ($this->plan->type == C::PACKAGE_WISE_MONTH) {
                if (empty($this->from_destination)) {
                    $this->addError('from_destination', "From Desstination cannot be empty");
                }

                if (empty($this->to_destination)) {
                    $this->addError('to_destination', "To destination cannot be empty");
                }
            }
        }

        return parent::beforeValidate();
    }

    public function afterValidate()
    {
        parent::afterValidate();
    }

    public function save()
    {  
        if (!$this->hasErrors() && ($this->plan instanceof PlanMaster) && ($this->client instanceof ClientMaster)) {
            $model = new Challan(['scenario' => Challan::SCENARIO_CREATE]);
            if (!empty($this->id)) {
                $model = Challan::findOne(['id' => $this->id]);
                $model->scenario = Challan::SCENARIO_UPDATE;
            }
            $model->client_id = $this->client->id;
            $model->client_type = $this->client->client_type;
            $model->challan_date = $this->challan_date;
            $model->site_address = $this->site_address;
            $model->operator_id = $this->operator_id;
            $model->helper_id =  $this->helper_id;
            $model->plan_id = $this->plan->id;
            $model->plan_type = $this->plan->type;
            $model->vehicle_id = $this->vehicle_id;
            $model->challan_no = $this->challan_no;
            $model->plan_start_time = $this->plan_start_time;
            $model->plan_end_time = $this->plan_end_time;
            $model->day_wise = $this->day_wise;
            $model->plan_measure = $this->plan_measure;
            $model->plan_trip = $this->plan_trip;
            $model->from_destination = $this->from_destination;
            $model->to_destination = $this->to_destination;
            $model->break_time = $this->break_time;
            $model->up_time = $this->up_time;
            $model->down_time = $this->down_time;
            $model->plan_extra_hours = $this->plan_extra_hours;
            $model->plan_shift_type = $this->plan_shift_type;
            $model->invoice_id = null;
            $model->is_processed = C::STATUS_ACTIVE;
            $model->status = C::STATUS_PENDING;
            $model->base_amount = !empty($this->amount) ? $this->amount : (!empty($this->customprice) ? $this->customprice->custome_price : $this->plan->price);
            $model->amount = $model->base_amount;
            $model->extra = 0;
            list($model->extra, $model->amount)  = self::calculateChallanAmount($model);
            $totalAmount = $model->extra + $model->amount;
            $model->tax = F::calculateTax($totalAmount, $this->plan->tax_slot);
            if ($model->validate() && $model->save()) {
                return true;
            }else{
               $this->addErrors($model->errors);
            }
        }
        return false;
    }


    public static function calculateChallanAmount(Challan $challan)
    {
        $extra = $amount = 0;
        $plan = PlanMaster::findOne(['id' => $challan->plan_id]);
        switch ($challan->plan_type) {
            case C::PACKAGE_WISE_SHIFT:
                $totalHrs =  date("H", strtotime($challan->plan_end_time) - strtotime($challan->plan_start_time));
                if ($challan->plan_shift_type == C::PACKAGE_SHIFT_TYPE_HOURS) {
                    $perhrs = $challan->base_amount / $plan->shift_hrs;
                    $extra =  ($totalHrs - $plan->shift_hrs) * $perhrs;
                } else {
                    $extra = ($totalHrs < $plan->shift_hrs) ? 0 : ((($totalHrs - $plan->shift_hrs) > 4 ? $challan->base_amount : ($base_amount / 2)));
                }
                $amount = $challan->base_amount + $extra;
                break;
            case C::PACKAGE_WISE_TRIP:
                $amount = $challan->base_amount *  $challan->plan_trip *  $challan->plan_measure;
                break;
            default:
                $amount = $base_amount;
                break;
        }
        return [$extra, $amount];
    }
}
