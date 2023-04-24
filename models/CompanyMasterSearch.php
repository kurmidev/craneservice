<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CompanyMaster;

/**
 * CompanyMasterSearch represents the model behind the search form of `app\models\CompanyMaster`.
 */
class CompanyMasterSearch extends CompanyMaster
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'pincode', 'state_code', 'status', 'created_by', 'updated_by'], 'integer'],
            [['name', 'mobile_no', 'phone_no', 'email', 'billing_address', 'gst_in', 'pan_no', 'supply_place', 'created_at', 'updated_at'], 'safe'],
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
        $query = CompanyMaster::find();

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
            'city_id' => $this->city_id,
            'pincode' => $this->pincode,
            'state_code' => $this->state_code,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
            ->andFilterWhere(['like', 'phone_no', $this->phone_no])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'billing_address', $this->billing_address])
            ->andFilterWhere(['like', 'gst_in', $this->gst_in])
            ->andFilterWhere(['like', 'pan_no', $this->pan_no])
            ->andFilterWhere(['like', 'supply_place', $this->supply_place]);

        return $dataProvider;
    }
}
