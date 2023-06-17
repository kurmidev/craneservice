<?php

namespace app\forms;

use app\models\BaseForm;
use app\models\BaseModel;
use app\models\Challan;
use app\models\ClientMaster;
use app\models\InvoiceMaster;
use app\models\Payments;
use app\components\Constants as C;
use yii\helpers\ArrayHelper;

class SearchForm extends BaseForm
{

    const SEARCH_TYPE_CHALLAN = 1;
    const SEARCH_TYPE_INVOICE = 2;
    const SEARCH_TYPE_PAYMENT = 3;
    const SEARCH_TYPE_CLIENT = 4;

    const SEARCH_TYPE_LIST = [
        self::SEARCH_TYPE_PAYMENT => "Payments",
        self::SEARCH_TYPE_CHALLAN => "Challan",
        self::SEARCH_TYPE_INVOICE => "Invoice",
        self::SEARCH_TYPE_CLIENT => "Customer/Vendor"
    ];

    public $search_type;
    public $search_value;
    public $current_page;

    public function scenarios()
    {
        return [
            "default" => ["search_type", "search_value", "current_page"],
        ];
    }

    public function rules()
    {
        return [
            [["search_value", "search_type"], "required"],
            [["search_type"], "integer"],
            [["search_value", "current_page"], "string"]
        ];
    }

    public function save()
    {
        $search =  $pg = $query = null;
        switch ($this->search_type) {
            case self::SEARCH_TYPE_CHALLAN:
                $query = Challan::find()->active()->andWhere(['like', 'challan_no', "%{$this->search_value}%", false]);
                $search = "ChallanSearch[challan_no]";
                break;
            case self::SEARCH_TYPE_INVOICE:
                $query = InvoiceMaster::find()->active()->andWhere(['like', 'invoice_no', "%{$this->search_value}%", false]);
                $pg = "pending-invoice";
                $search = "InvoiceMasterSearch[invoice_no]";
                break;
            case self::SEARCH_TYPE_CLIENT:
                $query = ClientMaster::find()->active()->andWhere(['like', 'invoice_no', "%{$this->search_value}%", false]);
                $pg = "";
                break;
            case self::SEARCH_TYPE_PAYMENT:
                $query = Payments::find()->active()->andWhere(['like', 'receipt_no', "%{$this->search_value}%", false]);
                $pg = "payment";
                $search = "PaymentSearch[receipt_no]";
                break;
            default:
                break;
        }
        $model = $query->one();
        if ($model instanceof BaseModel) {
            $redirectUrl = ($model->client_type == C::CLIENT_TYPE_CUSTOMER ? "customer" : "vendor") . "/view-customer";
            $urlData = [
                $redirectUrl,
            ];
            if (!empty($pg)) {
                $pg = ($model instanceof Challan) ? ($model->invoice_id == 0 ? "challan-list" : "pending-challan") : $pg;
                $urlData = ArrayHelper::merge($urlData, ["pg"=>$pg]);
            };
            if (!empty($model->id)) {
                $urlData = ArrayHelper::merge($urlData, ["id" => $model->id]);
            }

            if($model instanceof Challan){
                $urlData[$search] = $model->challan_no;
                $urlData['id'] = $model->client_id;
            }else if($model instanceof InvoiceMaster){
                $urlData[$search] = $model->invoice_no;
                $urlData['id'] = $model->client_id;
            }else if($model instanceof Payments){
                $urlData[$search] = $model->receipt_no;
                $urlData['id'] = $model->client_id;
            }
            print_r($model->attributes);
            exit;
            return ["url" => $urlData, "status" => true];
        } else {
            return ["url" => $this->current_page, "status" => false];
        }
    }
}
