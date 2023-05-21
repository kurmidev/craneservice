<?php

namespace app\forms;

use app\components\ConstFunc;
use app\models\BaseForm;
use app\models\QuotationMaster;
use yii\base\DynamicModel;
use app\components\Constants as C;
use app\models\PlanMaster;
use app\models\QuotationItems;
use yii\helpers\ArrayHelper;
use app\components\ConstFunc as F;

class QuotationForm extends BaseForm
{

    public $id;
    public $client_id;
    public $client_type;
    public $date;
    public $subject;
    public $terms_and_conditions;
    public $tax_applicable;
    public $remark;
    public $quotation_items;

    public function scenarios()
    {
        return [
            QuotationMaster::SCENARIO_CREATE => ["id", "client_id", "client_type", "date", "subject", "terms_and_conditions", "tax_applicable", "remark", "quotation_items"],
            QuotationMaster::SCENARIO_UPDATE => ["id", "client_id", "client_type", "date", "subject", "terms_and_conditions", "tax_applicable", "remark", "quotation_items"],
        ];
    }

    public function rules()
    {
        $itemModel = (new DynamicModel(["vehicle_id", "plan_id", "quantity", "amount"]))
            ->addRule(["vehicle_id", "plan_id", "quantity", "amount"], "required")
            ->addRule(["vehicle_id", "plan_id", "quantity"], "integer")
            ->addRule(["amount"], "number");

        return [
            [["client_id", "client_type", "date", "subject", "terms_and_conditions", "tax_applicable", "remark", "quotation_items"], "required"],
            [["client_id", "client_type", "tax_applicable", "id"], "integer"],
            [["subject", "terms_and_conditions", "remark"], "string"],
            [['quotation_items'], 'ValidateMulti', 'params' => ['isMulti' => TRUE, 'ValidationModel' => $itemModel, 'allowEmpty' => true]],
        ];
    }

    public function save()
    {

        if (!$this->hasErrors()) {
            if (!empty($this->id)) {
                return $this->update($this->id);
            } else {
                return $this->create();
            }
        }
        return false;
    }

    public function create()
    {
        $model = new QuotationMaster(['scenario' => QuotationMaster::SCENARIO_CREATE]);
        $model->client_id = $this->client_id;
        $model->client_type = $this->client_type;
        $model->date = $this->date;
        $model->subject = $this->subject;
        $model->terms_and_conditions =  $this->terms_and_conditions;
        $model->tax_applicable = $this->tax_applicable;
        $model->remark = $this->remark;
        $model->base_amount = $model->tax = $model->total = 0;
        $model->status = C::STATUS_ACTIVE;
        if ($model->validate() && $model->save()) {
            $this->saveQuotationItems($this->quotation_items, $model->id);
            return true;
        } else {
            $this->addErrors($model->errors);
        }
        return false;
    }

    public function update($id)
    {
        $model =  QuotationMaster::findOne(['id' => $id]);
        if ($model instanceof QuotationMaster) {
            $model->scenario = QuotationMaster::SCENARIO_UPDATE;
            $model->client_id = $this->client_id;
            $model->client_type = $this->client_type;
            $model->date = $this->date;
            $model->subject = $this->subject;
            $model->terms_and_conditions =  $this->terms_and_conditions;
            $model->tax_applicable = $this->tax_applicable;
            $model->remark = $this->remark;
            $model->base_amount = $model->tax = $model->total = 0;
            $model->status = C::STATUS_ACTIVE;
            if ($model->validate() && $model->save()) {
                $this->saveQuotationItems($this->quotation_items, $model->id);
                return true;
            } else {
                $this->addErrors($model->errors);
                print_r($model->errors);
                exit;
            }
        }
        return false;
    }

    public function saveQuotationItems($items, $id)
    {
        $base_amount = $tax = $total = 0;
        QuotationItems::deleteAll(['quotation_id' => $id]);
        if (!empty($items)) {
            $plan_ids = ArrayHelper::getColumn($items, "plan_id");
            $planData = PlanMaster::find()->where(['id' => $plan_ids])->indexBy("id")->asArray()->all();
            if (!empty($planData)) {
                foreach ($items as $item) {
                    $model = new QuotationItems(['scenario' => QuotationItems::SCENARIO_CREATE]);
                    $model->quotation_id = $id;
                    $model->client_id = $this->client_id;
                    $model->client_type = $this->client_type;
                    $model->type = C::QUOTATION_TYPE_MAIN;
                    $model->vehicle_id = $item['vehicle_id'];
                    $model->plan_id = $item['plan_id'];
                    $model->quantity = $item['quantity'];
                    $model->amount = $item['amount'];
                    $model->status = C::STATUS_ACTIVE;
                    if ($model->validate() && $model->save()) {
                        $base_amount += $model->amount * $model->quantity;
                        $tax += $this->tax_applicable ? F::calculateTax(($model->amount * $model->quantity), $this->tax_applicable) : 0;
                    }
                }
                QuotationMaster::updateAll(["base_amount" => $base_amount, "tax" => $tax, "total" => ($base_amount + $tax)], ["id" => $id]);
            }
        }

        return false;
    }
}
