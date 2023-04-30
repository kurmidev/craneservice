<?php

namespace app\forms;

use app\models\BaseForm;
use app\models\Challan;
use app\models\ClientMaster;
use app\models\PlanMaster;
use app\models\VehicleMaster;
use yii\base\DynamicModel;
use app\components\Constants as C;

class ChallanForm extends BaseForm
{

    public $id;
    public $client_id;
    public $challan_date;
    public $items;
    public $client_type;
    public $challan_image;
    public $operator_id;
    public $helper_id;
    public $site_address;

    public function scenarios()
    {
        return [
            Challan::SCENARIO_CREATE => ["challan_date", "challan_image", "items", "client_type", "client_id","site_address","helper_id","operator_id"],
            Challan::SCENARIO_UPDATE => ["challan_date", "challan_image", "items", "client_type", "client_id","site_address","helper_id","operator_id"],
        ];
    }

    public function rules()
    {

        $valid = (new DynamicModel(['plan_id', 'vehicle_id', 'challan_no', 'plan_start_time', 'day_wise', 'plan_trip', 'from_destination', 'plan_end_time', 'plan_measure', 'to_destination', 'amount', 'break_time', 'up_time', 'remark']))
            ->addRule(['plan_id', 'vehicle_id'], 'required')
            ->addRule(['challan_no', 'from_destination', 'to_destination', 'remark'], "string")
            ->addRule(['plan_id', 'vehicle_id', 'plan_measure', 'break_time', 'up_time'], 'integer')
            ->addRule(['plan_start_time', 'day_wise', 'plan_trip', 'from_destination', 'plan_end_time', 'plan_measure', 'to_destination', 'amount', 'break_time', 'up_time', 'remark'], 'safe');

        return [
            [["challan_date", 'client_id'], 'required'],
            [["items", "challan_image"], 'safe'],
            [["site_address","helper_id","operator_id"],"required","when"=>function(){
                return $this->client_type==C::CLIENT_TYPE_CUSTOMER;
            }],
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
                $model = new Challan(['scenario' => Challan::SCENARIO_CREATE]);
                $model->client_id = $this->client_id;
                $model->challan_date = $this->challan_date;
                $model->site_address = !empty($this->site_address) ? $this->site_address : null;
                $model->operator_id =  !empty($this->operator_id) ? $this->operator_id : null;
                $model->helper_id =  !empty($this->helper_id) ? $this->helper_id : null;
                $model->plan_id = !empty($item['plan_id']) ? $item['plan_id'] : null;
                $model->vehicle_id = !empty($item['vehicle_id']) ? $item['vehicle_id'] : null;
                $model->challan_no = !empty($item['challan_no']) ? $item['challan_no'] : null;
                $model->plan_start_time = !empty($item['plan_start_time']) ? $item['plan_start_time'] : null;
                $model->plan_end_time = !empty($item['plan_end_time']) ? $item['plan_end_time'] : null;
                $model->day_wise = !empty($item['day_wise']) ? $item['day_wise'] : null;
                $model->plan_measure = !empty($item['plan_measure']) ? $item['plan_measure'] : null;
                $model->plan_trip = !empty($item['plan_trip']) ? $item['plan_trip'] : null;
                $model->from_destination = !empty($item['from_destination']) ? $item['from_destination'] : null;
                $model->to_destination = !empty($item['to_destination']) ? $item['to_destination'] : null;
                $model->amount = !empty($item['amount']) ? $item['amount'] : null;
                $model->break_time = !empty($item['break_time']) ? $item['break_time'] : null;
                $model->up_time = !empty($item['up_time']) ? $item['up_time'] : null;
                $model->down_time = !empty($item['down_time']) ? $item['down_time'] : null;
                $model->plan_extra_hours = !empty($item['plan_extra_hours']) ? $item['plan_extra_hours'] : null;
                $model->plan_shift_type = !empty($item['plan_shift_type']) ? $item['plan_shift_type'] : null;
                $model->challan_image = !empty($item['challan_image']) ? $item['challan_image'] : null;
                $model->invoice_id = null;
                $model->is_processed = "1";
                $model->status = C::STATUS_ACTIVE;

                if ($model->validate() && $model->save()) {
                    $is_valid = $is_valid &&  true;
                } else {
                    print_R($model->errors);
                    $is_valid = $is_valid && false;
                }
            }
        }
        return $is_valid;
    }
}
