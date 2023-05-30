<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_plan_mapping".
 *
 * @property int $id
 * @property int $client_id
 * @property int $client_type
 * @property int $plan_id
 * @property float $custome_price
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class ClientPlanMapping extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_plan_mapping';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan_id', 'custom_price','client_id','client_type'], 'required'],
            [['plan_id', 'created_by', 'updated_by','client_id','client_type'], 'integer'],
            [['custom_price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function scenarios(){
        return [
            self::SCENARIO_CREATE=>["plan_id","custom_price",'client_id','client_type'],
            self::SCENARIO_UPDATE=>["plan_id","custom_price",'client_id','client_type'],
        ];
    }

    public function getPlan(){
        return $this->hasOne(PlanMaster::class,["id"=>"plan_id"]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plan_id' => 'Plan',
            'client_id'=> 'Client',
            'client_type'=>"Client Type",
            'custome_price' => 'Custome Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ClientPlanMappingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientPlanMappingQuery(get_called_class());
    }
}
