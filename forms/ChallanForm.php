<?php

namespace app\forms;

use app\models\BaseForm;
use app\models\Challan;

class ChallanForm extends BaseForm
{

    public $client_id;
    public $challan_date;
    public $site_address;
    public $operator_id;
    public $helper_id;
    public $plan_id;
    public $vehicle_id;
    public $challan_no;
    public $plan_start_time;
    public $plan_end_time;
    public $day_wise;
    public $plan_measure;
    public $plan_trip;
    public $from_destination;
    public $to_destination;
    public $amount;
    public $break_time;
    public $up_time;
    public $down_time;
    public $plan_extra_hours;
    public $plan_shift_type;
    public $challan_image;
    public $invoice_id;
    public $is_processed;
    public $status;


    public function scenarios()
    {
        return [
            Challan::SCENARIO_CREATE=>['client_id','challan_date','site_address','operator_id','helper_id','plan_id','vehicle_id','challan_no','plan_start_time','plan_end_time','day_wise','plan_measure','plan_trip','from_destination','to_destination','amount','break_time','up_time','down_time','plan_extra_hours','plan_shift_type','challan_image','invoice_id','is_processed','status'],
            Challan::SCENARIO_UPDATE=>['client_id','challan_date','site_address','operator_id','helper_id','plan_id','vehicle_id','challan_no','plan_start_time','plan_end_time','day_wise','plan_measure','plan_trip','from_destination','to_destination','amount','break_time','up_time','down_time','plan_extra_hours','plan_shift_type','challan_image','invoice_id','is_processed','status']
        ];
    }

    public function rules()
    {
        return [
            [['client_id', 'challan_date', 'plan_id', 'vehicle_id', 'challan_no'], 'required'],
            [['client_id', 'plan_id', 'vehicle_id', 'day_wise', 'break_time', 'up_time', 'down_time', 'plan_extra_hours', 'plan_shift_type', 'invoice_id', 'is_processed', 'status', 'created_by', 'updated_by'], 'integer'],
            [['challan_date', 'plan_start_time', 'plan_end_time', 'challan_image', 'created_at', 'updated_on'], 'safe'],
            [['amount','tax','total'], 'number'],
            [['site_address', 'operator_id', 'helper_id', 'challan_no', 'plan_measure', 'plan_trip', 'from_destination', 'to_destination'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientMaster::class, 'targetAttribute' => ['client_id' => 'id']],
            [['plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanMaster::class, 'targetAttribute' => ['plan_id' => 'id']],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => VehicleMaster::class, 'targetAttribute' => ['vehicle_id' => 'id']],
        ];
    }
}
