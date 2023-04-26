<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "challan".
 *
 * @property int $id
 * @property int $client_id
 * @property string $challan_date
 * @property string|null $site_address
 * @property string|null $operator_id
 * @property string|null $helper_id
 * @property int $plan_id
 * @property int $vehicle_id
 * @property string $challan_no
 * @property string|null $plan_start_time
 * @property string|null $plan_end_time
 * @property int|null $day_wise
 * @property string|null $plan_measure
 * @property string|null $plan_trip
 * @property string|null $from_destination
 * @property string|null $to_destination
 * @property float|null $amount
 * @property int|null $break_time
 * @property int|null $up_time
 * @property int|null $down_time
 * @property int|null $plan_extra_hours
 * @property int|null $plan_shift_type
 * @property string|null $challan_image
 * @property int|null $invoice_id
 * @property int $is_processed
 * @property int $status
 * @property string $created_at
 * @property string|null $updated_on
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property ClientMaster $client
 * @property PlanMaster $plan
 * @property VehicleMaster $vehicle
 */
class Challan extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'challan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'challan_date', 'plan_id', 'vehicle_id', 'challan_no'], 'required'],
            [['client_id', 'plan_id', 'vehicle_id', 'day_wise', 'break_time', 'up_time', 'down_time', 'plan_extra_hours', 'plan_shift_type', 'invoice_id', 'is_processed', 'status', 'created_by', 'updated_by'], 'integer'],
            [['challan_date', 'plan_start_time', 'plan_end_time', 'challan_image', 'created_at', 'updated_on'], 'safe'],
            [['amount'], 'number'],
            [['site_address', 'operator_id', 'helper_id', 'challan_no', 'plan_measure', 'plan_trip', 'from_destination', 'to_destination'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientMaster::class, 'targetAttribute' => ['client_id' => 'id']],
            [['plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanMaster::class, 'targetAttribute' => ['plan_id' => 'id']],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => VehicleMaster::class, 'targetAttribute' => ['vehicle_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'challan_date' => 'Challan Date',
            'site_address' => 'Site Address',
            'operator_id' => 'Operator ID',
            'helper_id' => 'Helper ID',
            'plan_id' => 'Plan ID',
            'vehicle_id' => 'Vehicle ID',
            'challan_no' => 'Challan No',
            'plan_start_time' => 'Plan Start Time',
            'plan_end_time' => 'Plan End Time',
            'day_wise' => 'Day Wise',
            'plan_measure' => 'Plan Measure',
            'plan_trip' => 'Plan Trip',
            'from_destination' => 'From Destination',
            'to_destination' => 'To Destination',
            'amount' => 'Amount',
            'break_time' => 'Break Time',
            'up_time' => 'Up Time',
            'down_time' => 'Down Time',
            'plan_extra_hours' => 'Plan Extra Hours',
            'plan_shift_type' => 'Plan Shift Type',
            'challan_image' => 'Challan Image',
            'invoice_id' => 'Invoice ID',
            'is_processed' => 'Is Processed',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_on' => 'Updated On',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
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
     * Gets query for [[Plan]].
     *
     * @return \yii\db\ActiveQuery|PlanMasterQuery
     */
    public function getPlan()
    {
        return $this->hasOne(PlanMaster::class, ['id' => 'plan_id']);
    }

    /**
     * Gets query for [[Vehicle]].
     *
     * @return \yii\db\ActiveQuery|VehicleMasterQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(VehicleMaster::class, ['id' => 'vehicle_id']);
    }

    /**
     * {@inheritdoc}
     * @return ChallanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChallanQuery(get_called_class());
    }
}
