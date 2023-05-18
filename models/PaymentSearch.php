<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Payments;

/**
 * PaymentSearch represents the model behind the search form of `app\models\Payments`.
 */
class PaymentSearch extends Payments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id','client_type', 'payment_mode', 'created_by', 'updated_by'], 'integer'],
            [['payment_date', 'intrument_no', 'instrument_date', 'remark', 'created_at', 'updated_at'], 'safe'],
            [['amount_paid'], 'number'],
            [['intrument_no', 'remark', 'receipt_no'], 'string', 'max' => 255],
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
        $query = Payments::find();

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
            'receipt_no' => $this->receipt_no,
            'client_id'=>$this->client_id,
            'payment_date' => $this->payment_date,
            'amount_paid' => $this->amount_paid,
            'payment_mode' => $this->payment_mode,
            'instrument_date' => $this->instrument_date,
            'intrument_no' => $this->intrument_no,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'intrument_no', $this->intrument_no])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
