<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Challan;

/**
 * ChallanSearch represents the model behind the search form of `app\models\Challan`.
 */
class ChallanSearch extends Challan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'plan_id', 'vehicle_id', 'day_wise', 'break_time', 'up_time', 'down_time', 'plan_extra_hours', 'plan_shift_type', 'invoice_id', 'is_processed', 'status', 'created_by', 'updated_by'], 'integer'],
            [['challan_date', 'site_address', 'operator_id', 'helper_id', 'challan_no', 'plan_start_time', 'plan_end_time', 'plan_measure', 'plan_trip', 'from_destination', 'to_destination', 'challan_image', 'created_at', 'updated_at'], 'safe'],
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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'client_id' => $this->client_id,
            'challan_date' => $this->challan_date,
            'plan_id' => $this->plan_id,
            'vehicle_id' => $this->vehicle_id,
            'plan_start_time' => $this->plan_start_time,
            'plan_end_time' => $this->plan_end_time,
            'day_wise' => $this->day_wise,
            'amount' => $this->amount,
            'break_time' => $this->break_time,
            'up_time' => $this->up_time,
            'down_time' => $this->down_time,
            'plan_extra_hours' => $this->plan_extra_hours,
            'plan_shift_type' => $this->plan_shift_type,
            'invoice_id' => $this->invoice_id,
            'is_processed' => $this->is_processed,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'site_address', $this->site_address])
            ->andFilterWhere(['like', 'operator_id', $this->operator_id])
            ->andFilterWhere(['like', 'helper_id', $this->helper_id])
            ->andFilterWhere(['like', 'challan_no', $this->challan_no])
            ->andFilterWhere(['like', 'plan_measure', $this->plan_measure])
            ->andFilterWhere(['like', 'plan_trip', $this->plan_trip])
            ->andFilterWhere(['like', 'from_destination', $this->from_destination])
            ->andFilterWhere(['like', 'to_destination', $this->to_destination])
            ->andFilterWhere(['like', 'challan_image', $this->challan_image]);

        return $dataProvider;
    }
}
