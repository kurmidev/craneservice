<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InvoiceMaster;
use app\components\Constants as C;
use yii\helpers\ArrayHelper;
/**
 * InvoiceMasterSearch represents the model behind the search form of `app\models\InvoiceMaster`.
 */
class InvoiceMasterSearch extends InvoiceMaster
{
    public $invoice_status;
    public $company_id;
    public $invoice_date_start;
    public $invoice_date_end;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'invoice_type', 'status', 'created_by', 'updated_by'], 'integer'],
            [['invoice_no', 'work_order_no', 'vendor_no', 'description', 'created_at', 'updated_at','invoice_status','company_id','invoice_date_start','invoice_date_end'], 'safe'],
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

        if(!empty($this->invoice_status)){
            switch($this->invoice_status){
                case C::INVOICE_PENDING:
                    $query->andWhere($query->alias."payment<".$query->alias."total");
                    break;
                case C::INVOICE_PAID:
                    $query->andWhere($query->alias."payment=".$query->alias."total");
                    break;
                case C::INVOICE_CANCEL:
                    $query->andWhere([$query->alias."status"=>C::STATUS_DELETED]);
                    break;
            }
        }

        if(!empty($this->invoice_date_start) && !empty($this->invoice_date_end)){
            $query->andWhere(["between",$query->alias."invoice_date",date("Y-m-d 00:00:00",strtotime($this->invoice_date_start)),date("Y-m-d 23:59:59",strtotime($this->invoice_date_end))]);
        }

        if(!empty($this->company_id)){
            $query->andWhere(["c.company_id"=>$this->company_id]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            $query->alias.'id' => $this->id,
            $query->alias.'invoice_type' => $this->invoice_type,
            $query->alias.'base_amount' => $this->base_amount,
            $query->alias.'discount_amount' => $this->discount_amount,
            $query->alias.'tax' => $this->tax,
            $query->alias.'tds' => $this->tds,
            $query->alias.'total' => $this->total,
            $query->alias.'status' => $this->status,
            $query->alias.'created_at' => $this->created_at,
            $query->alias.'updated_at' => $this->updated_at,
            $query->alias.'created_by' => $this->created_by,
            $query->alias.'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', $query->alias.'invoice_no', $this->invoice_no])
            ->andFilterWhere(['like', $query->alias.'work_order_no', $this->work_order_no])
            ->andFilterWhere(['like', $query->alias.'vendor_no', $this->vendor_no])
            ->andFilterWhere(['like', $query->alias.'description', $this->description]);

        return $dataProvider;
    }


    public function advanceSearch($type = "")
    {
        return [
            ["label" => "Invoice No", "attribute" => "invoice_no", "type" => "text"],
            ["label" => "Company", "attribute" => "company_id", "type" => "dropdown", "list" => ArrayHelper::map(CompanyMaster::find()->onlyActive()->asArray()->all(), "id", "name")],
            ["label" => "Invoice Date", "attribute" => "invoice_date", "type" => "date_range"],
            ["label" => "Status", "attribute" => "invoice_status", "type" => "dropdown", "list" => C::INVOICE_STATUS ],
        ];
    }

    public function displayColumn(){
        return [
            ['class' => 'yii\grid\SerialColumn'],
            'invoice_date',
            'invoice_no',
            'client.company_name',
            'client.mobile_no',
            'client.phone_no',
            'client.email',
            'client.city.name',
            "total",
            "payment",
             [
                "attribute"=>"","label"=>"Pending Amount",
                'content' => function($model){
                    return $model->total>$model->payment?($model->total-$model->payment):($model->payment-$model->total);
                }
            ],
            [
                "attribute"=>"","label"=>"Status",
                'content' => function($model){
                    return $model->total==$model->payment?"Paid":"Pending";
                }
            ],
        ];
    }
}
