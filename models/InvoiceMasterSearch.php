<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InvoiceMaster;

/**
 * InvoiceMasterSearch represents the model behind the search form of `app\models\InvoiceMaster`.
 */
class InvoiceMasterSearch extends InvoiceMaster
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'invoice_type', 'status', 'created_by', 'updated_by'], 'integer'],
            [['invoice_no', 'work_order_no', 'vendor_no', 'description', 'created_at', 'updated_at'], 'safe'],
            [['base_amount', 'discount_amount', 'tax', 'tds', 'total'], 'number'],
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
        $query = InvoiceMaster::find();

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
            'invoice_type' => $this->invoice_type,
            'base_amount' => $this->base_amount,
            'discount_amount' => $this->discount_amount,
            'tax' => $this->tax,
            'tds' => $this->tds,
            'total' => $this->total,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'invoice_no', $this->invoice_no])
            ->andFilterWhere(['like', 'work_order_no', $this->work_order_no])
            ->andFilterWhere(['like', 'vendor_no', $this->vendor_no])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
