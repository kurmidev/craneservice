<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Payments;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;

/**
 * PaymentSearch represents the model behind the search form of `app\models\Payments`.
 */
class PaymentSearch extends Payments
{
    public $payment_date_start;
    public $payment_date_end;
    public $company_id;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id','client_type', 'payment_mode', 'created_by', 'updated_by'], 'integer'],
            [['payment_date', 'intrument_no', 'instrument_date', 'remark', 'created_at', 'updated_at','payment_date_end','payment_date_start','company_id'], 'safe'],
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


        if(!empty($this->payment_date_end) && !empty($this->payment_date_start)){
            $query->andWhere(["between",$query->alias."payment_date",date("Y-m-d 00:00:00",strtotime($this->payment_date_start)),date("Y-m-d 23:59:59",strtotime($this->payment_date_end))]);
        }

        if(!empty($this->company_id)){
            $query->andWhere(["c.company_id"=>$this->company_id]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            $query->alias.'id' => $this->id,
            $query->alias.'receipt_no' => $this->receipt_no,
            $query->alias.'client_id'=>$this->client_id,
            $query->alias.'payment_date' => $this->payment_date,
            $query->alias.'amount_paid' => $this->amount_paid,
            $query->alias.'payment_mode' => $this->payment_mode,
            $query->alias.'instrument_date' => $this->instrument_date,
            $query->alias.'intrument_no' => $this->intrument_no,
            $query->alias.'created_at' => $this->created_at,
            $query->alias.'updated_at' => $this->updated_at,
            $query->alias.'created_by' => $this->created_by,
            $query->alias.'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', $query->alias.'intrument_no', $this->intrument_no])
            ->andFilterWhere(['like', $query->alias.'remark', $this->remark]);

        return $dataProvider;
    }

    public function advanceSearch($type = "")
    {
        return [
            ["label" => "Receipt No", "attribute" => "receipt_no", "type" => "text"],
            ["label" => "Company", "attribute" => "company_id", "type" => "dropdown", "list" => ArrayHelper::map(CompanyMaster::find()->onlyActive()->asArray()->all(), "id", "name")],
            ["label" => "Payment Date", "attribute" => "payment_date", "type" => "date_range"],
            ["label" => "Payment Mode", "attribute" => "payment_mode", "type" => "dropdown", "list" => C::PAYMENT_MODE_LIST ],
        ];
    }

    public function displayColumn(){
        return [
            ['class' => 'yii\grid\SerialColumn'],
            'payment_date',
            'receipt_no',
            'client.company_name',
            'client.mobile_no',
            'client.phone_no',
            'client.email',
            'client.city.name',
            "amount_paid",
             [
                "attribute"=>"payment_mode","label"=>"Payment Mode",
                'content' => function($model){
                    return !empty(C::PAYMENT_MODE_LIST[$model->payment_mode])?C::PAYMENT_MODE_LIST[$model->payment_mode]:"";
                }
            ],
        ];
    }
}
