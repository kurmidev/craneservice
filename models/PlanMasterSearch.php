<?php

namespace app\models;

use yii\base\Html;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PlanMaster;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;

/**
 * PlanMasterSearch represents the model behind the search form of `app\models\PlanMaster`.
 */
class PlanMasterSearch extends PlanMaster
{
    public $challan_date_start;
    public $challan_date_end;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'attribute_id', 'type', 'shift_hrs', 'tax_slot', 'status', 'created_by', 'updated_by'], 'integer'],
            [['name', 'code', 'created_at', 'updated_at','challan_date_start','challan_date_end'], 'safe'],
            [['price'], 'number'],
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
        $query = PlanMaster::find();

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

        if(!empty($this->challan_date_start) && !empty($this->challan_date_end)){
            $query->andWhere(["between",$query->alias."c.created_at",date("Y-m-d 00:00:00",strtotime($this->challan_date_start)),date("Y-m-d 23:59:59",strtotime($this->challan_date_end))]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'attribute_id' => $this->attribute_id,
            'type' => $this->type,
            'shift_hrs' => $this->shift_hrs,
            'tax_slot' => $this->tax_slot,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }

    public function advanceSearch($type = "summary")
    {
        switch ($type) {
            case "summary":
                return [
                    ["label" => "Plan Name", "attribute" => "name", "type" => "text"],
                    ["label" => "Date", "attribute" => "challan_date", "type" => "date_range"],
                ];
            default:
                return [
                    ["label" => "Plan Name", "attribute" => "name", "type" => "text"],
                    ["label" => "Attribute", "attribute" => "attribute_id", "type" => "dropdown", "list" => ArrayHelper::map(PlanAttributes::find()->active()->asArray()->all(), "id", "name")],
                    ["label" => "Shift Hrs", "attribute" => "shift_hrs", "type" => "text"],
                    ["label" => "Tax Slot", "attribute" => "tax_slot", "type" => "dropdown", "list" => C::PACKAGE_TAX],
                ];
        }
    }

    public  function displayColumn($type = "")
    {
        switch ($type) {
            case "summary":
                return [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'total_challan',
                    'challan_amount',
                    'total_invoice',
                    'invoice_amount'
                ];
            default:
                return [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'code',
                    'price',
                    [
                        'attribute' => 'type', 'label' => 'Plan Wise',
                        'content' => function ($model) {
                            return !empty(C::PACKAGE_WISE[$model->type]) ? C::PACKAGE_WISE[$model->type] : "";
                        },
                        'filter' => C::PACKAGE_WISE,
                    ],
                    //'type',
                    //'shift_hrs',
                    //'tax_slot',
                    [
                        'attribute' => 'attrbute_id', 'label' => 'Attributes',
                        'content' => function ($model) {
                            return !empty($model->attr) ? $model->attr->name : "";
                        },
                        'filter' => ArrayHelper::map(PlanAttributes::find()->active()->all(), 'id', 'name'),
                    ],
                    [
                        'attribute' => 'status', 'label' => 'Status',
                        'content' => function ($model) {
                            return F::getLabels(C::LABEL_STATUS, $model->status);
                        },
                        'filter' => C::LABEL_STATUS,
                    ],
                    'actionOn',
                    'actionBy',
                    [
                        "label" => "Action",
                        "content" => function ($data) {
                            return Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), \Yii::$app->urlManager->createUrl(['plan/edit-plan', 'id' => $data['id']]), ['title' => 'Update ' . $data['name'], 'class' => 'btn btn-primary-alt']);
                        }
                    ]
                ];
        }
    }
}
