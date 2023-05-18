<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PaymentsDetails;

/**
 * PaymentsDetailsSearch represents the model behind the search form of `app\models\PaymentsDetails`.
 */
class PaymentsDetailsSearch extends PaymentsDetails
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'payment_id', 'client_id', 'client_type', 'invoice_id', 'challan_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['amount_adjsuted'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
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
        $query = PaymentsDetails::find();

        // add conditions that should always apply here

        $query->with(['invoice','payment','challan']);
        
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
            'payment_id' => $this->payment_id,
            'client_id' => $this->client_id,
            'client_type' => $this->client_type,
            'invoice_id' => $this->invoice_id,
            'challan_id' => $this->challan_id,
            'amount_adjsuted' => $this->amount_adjsuted,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
