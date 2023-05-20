<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\QuotationMaster;

/**
 * QuotationMasterSearch represents the model behind the search form of `app\models\QuotationMaster`.
 */
class QuotationMasterSearch extends QuotationMaster
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'client_type', 'tax_applicable', 'status', 'created_by', 'updated_by'], 'integer'],
            [['quotation_no', 'date', 'subject', 'terms_and_conditions', 'remark', 'created_at', 'updated_at'], 'safe'],
            [['base_amount', 'tax', 'total'], 'number'],
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
        $query = QuotationMaster::find();

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
            'client_type' => $this->client_type,
            'date' => $this->date,
            'tax_applicable' => $this->tax_applicable,
            'base_amount' => $this->base_amount,
            'tax' => $this->tax,
            'total' => $this->total,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'quotation_no', $this->quotation_no])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'terms_and_conditions', $this->terms_and_conditions])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
