<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Challan;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;
use yii\helpers\Html;
/**
 * ChallanSearch represents the model behind the search form of `app\models\Challan`.
 */
class ChallanSearch extends Challan
{

    public $withEnable;
    public $challan_created_start;
    public $challan_created_end;

    public $challan_status;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'plan_id', 'vehicle_id', 'day_wise', 'break_time', 'up_time', 'down_time', 'plan_extra_hours', 'plan_shift_type', 'invoice_id', 'is_processed', 'status', 'created_by', 'updated_by'], 'integer'],
            [['challan_date', 'site_address', 'operator_id', 'helper_id', 'challan_no', 'plan_start_time', 'plan_end_time', 'plan_measure', 'plan_trip', 'from_destination', 'to_destination', 'challan_image', 'created_at', 'updated_at','challan_created_start','challan_created_end','challan_status'], 'safe'],
            [['amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Challan::find();
    
        $query->setAlias();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if(!empty($this->challan_status)){
            if($this->challan_status==C::CHALLAN_PAID){
                $query->andWhere(['>',$query->alias.'invoice_id',0]);
            }else if($this->challan_status==C::CHALLAN_UNPAID){
                $query->andWhere(['invoice_id'=>null]);
            }
        }

        if(!empty($this->challan_created_start) && !empty($this->challan_created_end)){
            $query->andWhere(["between",$query->alias."created_at",date("Y-m-d 00:00:00",strtotime($this->challan_created_start)),date("Y-m-d 23:59:59",strtotime($this->challan_created_end))]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            $query->alias.'id' => $this->id,
            $query->alias.'client_id' => $this->client_id,
            $query->alias.'challan_date' => $this->challan_date,
            $query->alias.'plan_id' => $this->plan_id,
            $query->alias.'vehicle_id' => $this->vehicle_id,
            $query->alias.'plan_start_time' => $this->plan_start_time,
            $query->alias.'plan_end_time' => $this->plan_end_time,
            $query->alias.'day_wise' => $this->day_wise,
            $query->alias.'amount' => $this->amount,
            $query->alias.'break_time' => $this->break_time,
            $query->alias.'up_time' => $this->up_time,
            $query->alias.'down_time' => $this->down_time,
            $query->alias.'plan_extra_hours' => $this->plan_extra_hours,
            $query->alias.'plan_shift_type' => $this->plan_shift_type,
            $query->alias.'invoice_id' => $this->invoice_id,
            $query->alias.'is_processed' => $this->is_processed,
            $query->alias.'operator_id' => $this->operator_id,
            $query->alias.'helper_id' => $this->helper_id,
            $query->alias.'status' => $this->status,
            $query->alias.'created_at' => $this->created_at,
            $query->alias.'updated_at' => $this->updated_at,
            $query->alias.'created_by' => $this->created_by,
            $query->alias.'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', $query->alias.'site_address', $this->site_address])
            //->andFilterWhere(['like', 'operator_id', $this->operator_id])
            //->andFilterWhere(['like', 'helper_id', $this->helper_id])
            ->andFilterWhere(['like', $query->alias.'challan_no', $this->challan_no])
            ->andFilterWhere(['like', $query->alias.'plan_measure', $this->plan_measure])
            ->andFilterWhere(['like', $query->alias.'plan_trip', $this->plan_trip])
            ->andFilterWhere(['like', $query->alias.'from_destination', $this->from_destination])
            ->andFilterWhere(['like', $query->alias.'to_destination', $this->to_destination])
            ->andFilterWhere(['like', $query->alias.'challan_image', $this->challan_image]);

        return $dataProvider;
    }

    public function advanceSearch($type = "")
    {
        return [
            ["label" => "Challan No", "attribute" => "challan_no", "type" => "text"],
            ["label" => "Operator", "attribute" => "operator_id", "type" => "dropdown", "list" => ArrayHelper::map(EmployeeMaster::find()->onlyActive()->asArray()->all(), "id", "name")],
            ["label" => "Helper", "attribute" => "helper_id", "type" => "dropdown", "list" => ArrayHelper::map(EmployeeMaster::find()->onlyActive()->asArray()->all(), "id", "name")],
            ["label" => "Challan Date", "attribute" => "challan_created", "type" => "date_range"],
            ["label" => "Status", "attribute" => "challan_status", "type" => "dropdown", "list" => C::CHALLAN_STATUS ],
        ];
    }

    public function displayColumn(){
        return [
            ['class' => 'yii\grid\SerialColumn'],
            'challan_date',
            [
                "attribute" => "challan_no", "label" => "Challan No",
                "content" => function ($model) {
                    $base_controller  = $model->client_type==C::CLIENT_TYPE_CUSTOMER?"customer":"vendor"; 
                    return  Html::a($model->challan_no, \Yii::$app->urlManager->createUrl(["{$base_controller}/print-challan", 'id' => $model->id]), ['title' => 'Print ' . $model->challan_no,]);
                },
            ],
            [
                "attribute" => "client_id", "label" => "Company Name",
                "content" => function ($model) {
                    $base_controller  = $model->client_type==C::CLIENT_TYPE_CUSTOMER?"customer/view-customer":"vendor/view-vendor"; 
                    return  Html::a($model->client->company_name, \Yii::$app->urlManager->createUrl(["{$base_controller}", 'id' => $model->client_id]), ['title' => 'View ' . $model->client->company_name,]);
                },
            ],
            'client.mobile_no',
            'client.phone_no',
            'plan.name',
            [
                'attribute' => 'id', 'label' => 'D/C No',
                'content' => function ($model) {
                    return $model->id;
                },
            ],
            [
                "attribute"=>"","label"=>"Total Hours/Qty",
                'content' => function($model){
                    return $model->plan->type==C::PACKAGE_WISE_TRIP?$model->plan_trip:date('H:i', mktime(0, (strtotime($model->plan_end_time) - strtotime($model->plan_start_time)) / 60));
                }
            ],
            "plan_start_time",
            "plan_end_time",
            "break_time",
            "up_time",
            "down_time",
            "amount",
            "total",
            [
                'attribute' => 'invoice_id', 'label' => 'Is Invoice Generated',
                'content' => function ($model) {
                    return !empty($model->invoice_id) ? "Yes" : "No";
                },
            ],
        ];
    }
}
