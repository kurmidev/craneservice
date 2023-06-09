<?php

namespace app\forms;

use app\models\BaseForm;
use app\models\Challan;
use app\models\ClientMaster;
use app\models\PlanMaster;
use app\models\VehicleMaster;
use yii\base\DynamicModel;
use app\components\Constants as C;
use app\components\ConstFunc as F;
use yii\helpers\ArrayHelper;

class ChallanForm extends BaseForm
{

    public $id;
    public $client_id;
    public $challan_date;
    public $items;
    public $client_type;


    public function scenarios()
    {
        return [
            Challan::SCENARIO_CREATE => ["items", "client_type", "client_id"],
            Challan::SCENARIO_UPDATE => ["id", "items", "client_type", "client_id"],
        ];
    }

    public function rules()
    {

        $valid = (new DynamicModel(['plan_id', 'vehicle_id', 'challan_no', 'plan_start_time', 'day_wise', 'plan_trip', 'from_destination', 'plan_end_time', 'plan_measure', 'to_destination', 'amount', 'break_time', 'up_time', 'remark', 'operator_id', 'helper_id', 'site_address', 'challan_date']))
            ->addRule(['plan_id', 'vehicle_id', 'challan_date'], 'required')
            ->addRule(['challan_no', 'from_destination', 'to_destination', 'remark'], "string")
            ->addRule(['plan_id', 'vehicle_id', 'plan_measure', 'break_time', 'up_time', 'plan_trip', 'operator_id', 'helper_id', 'site_address'], 'integer')
            ->addRule(['amount', 'extra', 'tax', 'total', 'base_amount', 'payment_status', 'amount_paid'], 'number')
            ->addRule(['plan_start_time', 'day_wise', 'from_destination', 'plan_end_time', 'to_destination', 'remark'], 'safe');

        return [
            [["challan_date", 'client_id'], 'required'],
            [["items"], 'safe'],
            [['items'], 'ValidateMulti', 'params' => ['isMulti' => TRUE, 'ValidationModel' => $valid, 'allowEmpty' => true]],
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
        $is_valid = true;

        if (!empty($this->items)) {

            foreach ($this->items as $item) {
                $plan_id = !empty($item['plan_id']) ? $item['plan_id'] : null;
                if (!empty($plan_id)) {
                    $plan = PlanMaster::findOne(['id' => $plan_id]);
                    $model = new Challan(['scenario' => Challan::SCENARIO_CREATE]);
                    $model->client_id = $this->client_id;
                    $model->client_type = $this->client_type;
                    $model->challan_date = !empty($item['challan_date']) ? $item['challan_date'] : null;
                    $model->site_address = !empty($item['site_address']) ? $item['site_address'] : null;
                    $model->operator_id =  !empty($item['operator_id']) ? $item['operator_id'] : null;
                    $model->helper_id =  !empty($item['helper_id']) ? $item['helper_id'] : null;
                    $model->plan_id = $plan_id;
                    $model->vehicle_id = !empty($item['vehicle_id']) ? $item['vehicle_id'] : null;
                    $model->challan_no = !empty($item['challan_no']) ? $item['challan_no'] : null;
                    $model->plan_start_time = !empty($item['plan_start_time']) ? $item['plan_start_time'] : null;
                    $model->plan_end_time = !empty($item['plan_end_time']) ? $item['plan_end_time'] : null;
                    $model->day_wise = !empty($item['day_wise']) ? $item['day_wise'] : null;
                    $model->plan_measure = !empty($item['plan_measure']) ? $item['plan_measure'] : null;
                    $model->plan_trip = !empty($item['plan_trip']) ? $item['plan_trip'] : null;
                    $model->from_destination = !empty($item['from_destination']) ? $item['from_destination'] : null;
                    $model->to_destination = !empty($item['to_destination']) ? $item['to_destination'] : null;
                    $model->break_time = !empty($item['break_time']) ? $item['break_time'] : null;
                    $model->up_time = !empty($item['up_time']) ? $item['up_time'] : null;
                    $model->down_time = !empty($item['down_time']) ? $item['down_time'] : null;
                    $model->plan_extra_hours = !empty($item['plan_extra_hours']) && $item['plan_extra_hours'] != 'NaN' ? $item['plan_extra_hours'] : null;
                    $model->plan_shift_type = !empty($item['plan_shift_type']) ? $item['plan_shift_type'] : null;
                    $model->challan_image = !empty($item['challan_image']) ? $item['challan_image'] : null;
                    $model->invoice_id = null;
                    $model->is_processed = C::STATUS_INACTIVE;
                    $model->status = C::STATUS_ACTIVE;
                    $model->base_amount = (!empty($item['amount']) ? $item['amount'] : $plan->price);
                    $model->amount = (!empty($item['amount']) ? $item['amount'] : $plan->price);
                    $model->extra = 0;
                    if ($plan->type == C::PACKAGE_WISE_SHIFT) {
                        $totalHrs =  date("H", strtotime($model->plan_end_time) - strtotime($model->plan_start_time));
                        if ($item['plan_shift_type'] == C::PACKAGE_SHIFT_TYPE_HOURS) {
                            $perhrs = (!empty($item['amount']) ? $item['amount'] : $plan->price) / $plan->shift_hrs;
                            $model->extra =  ($totalHrs - $plan->shift_hrs) * $perhrs;
                        } else {
                            $model->extra = ($totalHrs < $plan->shift_hrs) ? 0 : ((($totalHrs - $plan->shift_hrs) > 4 ? (!empty($item['amount']) ? $item['amount'] : $plan->price) : ((!empty($item['amount']) ? $item['amount'] : $plan->price) / 2)));
                        }
                    } else if ($plan->type == C::PACKAGE_WISE_TRIP) {
                        $model->amount = (!empty($item['amount']) ? $item['amount'] : $plan->price) * $item['plan_trip'] * $item['plan_measure'];
                    } else if ($plan->type == C::PACKAGE_WISE_CHALLAN) {
                        $totalMinutes = (strtotime($model->plan_end_time) - strtotime($model->plan_start_time)) / 60;
                        $model->amount =  ((!empty($item['amount']) ? $item['amount'] : $plan->price) / 60) * $totalMinutes;
                    } else if ($plan->type == C::PACKAGE_WISE_DESTINATION) {
                    } else if ($plan->type == C::PACKAGE_WISE_MONTH) {
                        //do nothings
                    } else if ($plan->type == C::PACKAGE_WISE_DAY) {
                        //do nothings
                    }
                    $totalAmount = $model->amount + $model->extra;
                    $model->tax = F::calculateTax($totalAmount, $plan->tax_slot);
                    $model->total = $totalAmount + $model->tax;
                    if ($model->validate() && $model->save()) {
                        $is_valid = $is_valid &&  true;
                    } else {
                        $is_valid = $is_valid && false;
                    }
                }
            }
        }
        return $is_valid;
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


    public function update($id)
    {
        $is_valid = true;
        if (!empty($this->items)) {
            foreach ($this->items as $item) {
                $plan_id = !empty($item['plan_id']) ? $item['plan_id'] : null;
                if (!empty($plan_id)) {
                    $plan = PlanMaster::findOne(['id' => $plan_id]);
                    $model = Challan::findOne(['id' => $this->id]);
                    if ($model instanceof Challan) {
                        $model->scenario = Challan::SCENARIO_UPDATE;
                        $model->challan_date = !empty($item['challan_date']) ? $item['challan_date'] : null;
                        $model->site_address = !empty($item['site_address']) ? $item['site_address'] : null;
                        $model->operator_id =  !empty($item['operator_id']) ? $item['operator_id'] : null;
                        $model->helper_id =  !empty($item['helper_id']) ? $item['helper_id'] : null;
                        $model->plan_id = $plan_id;
                        $model->vehicle_id = !empty($item['vehicle_id']) ? $item['vehicle_id'] : null;
                        $model->challan_no = !empty($item['challan_no']) ? $item['challan_no'] : null;
                        $model->plan_start_time = !empty($item['plan_start_time']) ? $item['plan_start_time'] : null;
                        $model->plan_end_time = !empty($item['plan_end_time']) ? $item['plan_end_time'] : null;
                        $model->day_wise = !empty($item['day_wise']) ? $item['day_wise'] : null;
                        $model->plan_measure = !empty($item['plan_measure']) ? $item['plan_measure'] : null;
                        $model->plan_trip = !empty($item['plan_trip']) ? $item['plan_trip'] : null;
                        $model->from_destination = !empty($item['from_destination']) ? $item['from_destination'] : null;
                        $model->to_destination = !empty($item['to_destination']) ? $item['to_destination'] : null;
                        $model->break_time = !empty($item['break_time']) ? $item['break_time'] : null;
                        $model->up_time = !empty($item['up_time']) ? $item['up_time'] : null;
                        $model->down_time = !empty($item['down_time']) ? $item['down_time'] : null;
                        $model->plan_extra_hours = !empty($item['plan_extra_hours']) && $item['plan_extra_hours'] != 'NaN' ? $item['plan_extra_hours'] : null;
                        $model->plan_shift_type = !empty($item['plan_shift_type']) ? $item['plan_shift_type'] : null;
                        $model->challan_image = !empty($item['challan_image']) ? $item['challan_image'] : null;
                        $model->invoice_id = null;
                        $model->is_processed = C::STATUS_INACTIVE;
                        $model->status = C::STATUS_ACTIVE;
                        $model->base_amount = (!empty($item['amount']) ? $item['amount'] : $plan->price);
                        $model->amount = (!empty($item['amount']) ? $item['amount'] : $plan->price);
                        $model->extra = 0;
                        if ($plan->type == C::PACKAGE_WISE_SHIFT) {
                            $totalHrs =  date("H", strtotime($model->plan_end_time) - strtotime($model->plan_start_time));
                            if ($item['plan_shift_type'] == C::PACKAGE_SHIFT_TYPE_HOURS) {
                                $perhrs = (!empty($item['amount']) ? $item['amount'] : $plan->price) / $plan->shift_hrs;
                                $model->extra =  ($totalHrs - $plan->shift_hrs) * $perhrs;
                            } else {
                                $model->extra = ($totalHrs < $plan->shift_hrs) ? 0 : ((($totalHrs - $plan->shift_hrs) > 4 ? (!empty($item['amount']) ? $item['amount'] : $plan->price) : ((!empty($item['amount']) ? $item['amount'] : $plan->price) / 2)));
                            }
                        } else if ($plan->type == C::PACKAGE_WISE_TRIP) {
                            $model->amount = (!empty($item['amount']) ? $item['amount'] : $plan->price) * $item['plan_trip'] * $item['plan_measure'];
                        } else if ($plan->type == C::PACKAGE_WISE_CHALLAN) {
                            $totalMinutes = (strtotime($model->plan_end_time) - strtotime($model->plan_start_time)) / 60;
                            $model->amount =  ((!empty($item['amount']) ? $item['amount'] : $plan->price) / 60) * $totalMinutes;
                        } else if ($plan->type == C::PACKAGE_WISE_DESTINATION) {
                        } else if ($plan->type == C::PACKAGE_WISE_MONTH) {
                            //do nothings
                        } else if ($plan->type == C::PACKAGE_WISE_DAY) {
                            //do nothings
                        }
                        $totalAmount = $model->amount + $model->extra;
                        $model->tax = F::calculateTax($totalAmount, $plan->tax_slot);
                        $model->total = $totalAmount + $model->tax;
                        if ($model->validate() && $model->save()) {
                            $is_valid = $is_valid &&  true;
                        } else {
                            $is_valid = $is_valid && false;
                        }
                    } else {
                        $is_valid = $is_valid && false;
                    }
                }
            }
        }
        return $is_valid;
    }
}
