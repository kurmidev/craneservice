<?php

namespace app\forms;

use app\models\BaseForm;
use app\models\CompanyBank;
use yii\base\Model;
use app\models\CompanyMaster;
use yii\base\DynamicModel;
use yii\web\UploadedFile;
use app\components\Constants as C;
use app\models\CompanyPrefix;

class CompanyForm extends BaseForm
{

    public $id;
    public $name;
    public $code;
    public $mobile_no;
    public $email;
    public $phone_no;
    public $billing_address;
    public $city_id;
    public $pincode;
    public $gst_in;
    public $pan_no;
    public $supply_place;
    public $state_code;
    public $status;
    public $banks;
    public $prefix;
    public $kyc_details;
    public $message;
    public $prefix_data;



    public function scenarios()
    {
        return [
            CompanyMaster::SCENARIO_CREATE => ["name", "mobile_no", "email", "phone_no", "billing_address", "city_id", "pincode", "gst_in", "pan_no", "supply_place", "state_code", "status", "banks", 'kyc_details', 'code', 'prefix'],
            CompanyMaster::SCENARIO_UPDATE => ["id", "name", "mobile_no", "email", "phone_no", "billing_address", "city_id", "pincode", "gst_in", "pan_no", "supply_place", "state_code", "status", "banks", 'kyc_details', 'code', 'prefix'],
        ];
    }

    public function rules()
    {
        $bankModel = (new DynamicModel(["account_number", "bank_name", "ifsc_code", "account_name"]))
            ->addRule(["account_number", "bank_name", "ifsc_code", "account_name"], "required");
        //->addRule(["ifsc_code"], 'match', ['pattern' => "^[A-Z]{4}0[A-Z0-9]{6}$"]);

        $kycValidations = (new DynamicModel(['value', 'doc']))
            ->addRule(['value'], 'string')
            ->addRule(['doc'], 'file');

        $prefixValidations = (new DynamicModel(['prefix_for', 'prefix', 'post_prefix']))
            ->addRule(['prefix'], 'string')
            ->addRule(['prefix_for', 'post_prefix'], 'integer');

        return [
            [["name", "mobile_no", "billing_address", "city_id", "pincode", "gst_in", "pan_no"], "required"],
            [["state_code", "status", "city_id"], "integer"],
            [["logo", "kyc_details", "banks", 'code'], "safe"],
            [['banks'], 'ValidateMulti', 'params' => ['isMulti' => TRUE, 'ValidationModel' => $bankModel, 'allowEmpty' => false]],
            [['kyc_details'], 'ValidateMulti', 'params' => ['isMulti' => TRUE, 'ValidationModel' => $kycValidations, 'allowEmpty' => true]],
            [['prefix'], 'ValidateMulti', 'params' => ['isMulti' => TRUE, 'ValidationModel' => $prefixValidations, 'allowEmpty' => true]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'mobile_no' => 'Mobile No',
            'phone_no' => 'Phone No',
            'email' => 'Email',
            'billing_address' => 'Billing Addresss',
            'city_id' => 'City',
            'pincode' => 'Pincode',
            'gst_in' => 'GST',
            'pan_no' => 'PAN No',
            'supply_place' => 'Supply Place',
            'state_code' => 'State Code',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Update By',
        ];
    }

    public function save()
    {
        if (!$this->hasErrors()) {
            if (empty($this->id)) {
                return $this->create();
            } else {
                return $this->update();
            }
        }
        return false;
    }

    public function create()
    {
        $model = new CompanyMaster(['scenario' => CompanyMaster::SCENARIO_CREATE]);
        $model->name = $this->name;
        $model->code = $this->code;
        $model->mobile_no = $this->mobile_no;
        $model->email = $this->email;
        $model->phone_no = $this->phone_no;
        $model->billing_address = $this->billing_address;
        $model->city_id = $this->city_id;
        $model->pincode = $this->pincode;
        $model->gst_in = strtoupper($this->gst_in);
        $model->pan_no = strtoupper($this->pan_no);
        $model->supply_place = $this->supply_place;
        $model->state_code = $this->state_code;
        $model->status = $this->status;
        if ($model->validate() && $model->save()) {
            $this->message = "Company registeration complete. ";
            $this->saveBank($model->id);
            $this->addPrefix($model->id);
            $this->uploadDocs($model->id, C::DOCUMENT_FOR_COMPANY, $this->kyc_details);
            return $model;
        } else {
            $this->message = "Company registeration failed. ";
            $this->addErrors($model->errors);
        }
        return false;
    }

    public function update()
    {
        $model = CompanyMaster::findOne(['id' => $this->id]);
        if ($model instanceof CompanyMaster) {
            $model->scenario = CompanyMaster::SCENARIO_UPDATE;
            $model->name = $this->name;
            $model->code = $this->code;
            $model->mobile_no = $this->mobile_no;
            $model->email = $this->email;
            $model->phone_no = $this->phone_no;
            $model->billing_address = $this->billing_address;
            $model->city_id = $this->city_id;
            $model->pincode = $this->pincode;
            $model->gst_in = $this->gst_in;
            $model->pan_no = $this->pan_no;
            $model->supply_place = $this->supply_place;
            $model->state_code = $this->state_code;
            $model->status = $this->status;
            if ($model->validate() && $model->save()) {
                $this->saveBank($model->id);
                $this->addPrefix($model->id);
                $this->uploadDocs($model->id, C::DOCUMENT_FOR_COMPANY, $this->kyc_details);
                return $model;
            } else {
                $this->addErrors($model->errors);
            }
        }
        return false;
    }

    public function saveBank($company_id)
    {
        $is_valid =  true;
        if (!empty($this->banks)) {
            foreach ($this->banks as $type => $bank) {
                if(!empty($bank['account_number'])){
                    CompanyBank::deleteAll(['is_taxable' => $type, 'company_id' => $company_id]);    
                    $model = new CompanyBank(['scenario' => CompanyBank::SCENARIO_CREATE]);
                    $model->company_id = $company_id;
                    $model->account_number = $bank['account_number'];
                    $model->ifsc_code = $bank['ifsc_code'];
                    $model->name = $bank['name'];
                    $model->is_taxable = $type;
                    $model->bank_name = $bank['bank_name'];
                    $model->status = C::STATUS_ACTIVE;
                    if ($model->validate() && $model->save()) {
                        $is_valid = $is_valid && true;
                        $this->message .= $model->account_number  . " details added successfully. ";
                    } else {
                        $is_valid = $is_valid && false;
                        $this->message .= $bank['account_number'] . " details addition failed. ";
                    }
                }
            }
        }
        return $is_valid;
    }

    public function uploadDocs($id, $doumentFor, $kyc_details)
    {
        if (!empty($kyc_details)) {
            $documents = [];
            foreach ($kyc_details as $key => $data) {
                $file = UploadedFile::getInstance($this, 'kyc_details[' . $key . '][doc]');
                if (!empty($file)) {
                    $documents[] = [
                        "document_name" => $file->name,
                        "document_type" => $key,
                        "other_details" => $data['value'],
                        "documents" => [
                            "content" => base64_encode(file_get_contents($file->tempName)),
                            "extension" => $file->extension
                        ]
                    ];
                }
            }

            if (!empty($documents)) {
                $this->saveProofs($id, $doumentFor, $documents);
            }
        }
    }

    public function addPrefix($company_id)
    {
        if (!empty($this->prefix)) {
            foreach ($this->prefix as $prefix_for => $pref) {
                if (!empty($pref['prefix'])) {
                    $model = CompanyPrefix::findOne(['company_id' => $company_id, 'prefix_for' => $prefix_for]);
                    if (!$model instanceof CompanyPrefix) {
                        $model = new CompanyPrefix(['scenario' => CompanyPrefix::SCENARIO_CREATE]);
                        $model->company_id  = $company_id;
                        $model->prefix_for = strtoupper($prefix_for);
                        $model->status = C::STATUS_ACTIVE;
                    } else {
                        $model->scenario = CompanyPrefix::SCENARIO_UPDATE;
                    }
                    $model->prefix = $pref['prefix'];
                    if(!empty($pref['post_prefix']) && is_numeric($pref['post_prefix'])){
                        $model->post_prefix =  $pref['post_prefix'];
                    }else{
                        $model->post_prefix = !empty($model->post_prefix) && is_numeric($model->post_prefix)?$model->post_prefix:1;
                    }
                    if ($model->validate() && $model->save()) {
                        $this->message .= " Prefix " . $model->prefix . " added successfully.";
                    } else {
                        $this->message .= " Prefix " . $pref['prefix'] . " addition failed.";
                    }
                }
            }
        }
    }

    public function getPrefixData()
    {
        $res = [];
        if (!empty($this->id) && !empty($this->prefix_data)) {
            foreach ($this->prefix_data as $prefix_for => $prefix) {
                $res[$prefix_for] = $prefix;
            }
        }
        return $res;
    }
}
