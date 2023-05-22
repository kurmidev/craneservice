<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ExpenseMaster;

/**
 * ExpenseMasterSearch represents the model behind the search form of `app\models\ExpenseMaster`.
 */
class ExpenseMasterSearch extends ExpenseMaster
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'expense_type', 'company_id', 'vendor_id', 'staff_id', 'type', 'paid_by', 'passed_by', 'vehicle_id', 'payment_mode', 'status', 'created_by', 'updated_by'], 'integer'],
            [['date', 'against_bill_no', 'remark', 'file_details', 'instrument_bank', 'instrument_date', 'instrument_number', 'created_at', 'updated_at','voucher_no'], 'safe'],
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
        $query = ExpenseMaster::find();

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
            'expense_type' => $this->expense_type,
            'company_id' => $this->company_id,
            'vendor_id' => $this->vendor_id,
            'staff_id' => $this->staff_id,
            'date' => $this->date,
            'type' => $this->type,
            'voucher_no' =>  $this->voucher_no,
            'paid_by' => $this->paid_by,
            'passed_by' => $this->passed_by,
            'vehicle_id' => $this->vehicle_id,
            'payment_mode' => $this->payment_mode,
            'instrument_date' => $this->instrument_date,
            'base_amount' => $this->base_amount,
            'tax' => $this->tax,
            'total' => $this->total,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'against_bill_no', $this->against_bill_no])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'file_details', $this->file_details])
            ->andFilterWhere(['like', 'instrument_bank', $this->instrument_bank])
            ->andFilterWhere(['like', 'instrument_number', $this->instrument_number]);

        return $dataProvider;
    }
}
