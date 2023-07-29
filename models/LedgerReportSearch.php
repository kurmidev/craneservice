<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LedgerReport;

/**
 * LedgerReportSearch represents the model behind the search form of `app\models\LedgerReport`.
 */
class LedgerReportSearch extends LedgerReport
{
    public $date_start;
    public $date_end;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'client_type'], 'integer'],
            [['date', 'particular', 'invoice_no','date_start','date_end'], 'safe'],
            [['debit', 'credit'], 'number'],
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
        $query = LedgerReport::find();

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

        if (!empty($this->date_start) && !empty($this->date_end)) {
            $query->andWhere(["between", $query->alias . "date", date("Y-m-d 00:00:00", strtotime($this->date_start)), date("Y-m-d 23:59:59", strtotime($this->date_end))]);
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'client_id' => $this->client_id,
            'client_type' => $this->client_type,
            'date' => $this->date,
            'debit' => $this->debit,
            'credit' => $this->credit,
        ]);

        $query->andFilterWhere(['like', 'particular', $this->particular])
            ->andFilterWhere(['like', 'invoice_no', $this->invoice_no]);

        return $dataProvider;
    }
}
