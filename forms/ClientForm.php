<?php

namespace app\forms;

use app\models\BaseForm;
use app\models\ClientMaster;
use yii\base\DynamicModel;
use app\components\Constants as C;
use yii\web\UploadedFile;

class ClientForm extends BaseForm
{

    public $id;
    public $client_type;
    public $company_id;
    public $company_name;
    public $first_name;
    public $last_name;
    public $email;
    public $mobile_no;
    public $phone_no;
    public $address;
    public $city_id;
    public $pincode;
    public $site_address;
    public $site_city_id;
    public $site_pincode;
    public $type;
    public $status;
    public $kyc_details;


    public function scenarios()
    {
        return [
            ClientMaster::SCENARIO_CREATE => ['id', 'client_type', 'company_id', 'company_name', 'first_name', 'last_name', 'email', 'mobile_no', 'phone_no', 'address', 'city_id', 'pincode', 'site_address', 'site_city_id', 'site_pincode', 'type', 'status', 'kyc_details'],
            ClientMaster::SCENARIO_UPDATE => ['id', 'client_type', 'company_id', 'company_name', 'first_name', 'last_name', 'email', 'mobile_no', 'phone_no', 'address', 'city_id', 'pincode', 'site_address', 'site_city_id', 'site_pincode', 'type', 'status', 'kyc_details']
        ];
    }

    public function rules()
    {
        $kycValidations = (new DynamicModel(['value', 'doc']))
            ->addRule(['value'], 'string')
            ->addRule(['doc'], 'file');

        return [
            [["company_name"], "required", "when" => function () {
                return $this->client_type == C::CLIENT_IS_COMPANY;
            }],
            [['company_id', 'city_id', 'pincode', 'site_city_id', 'site_pincode', 'type', 'status', 'first_name', 'last_name'],"required"],
            [['client_type', 'company_id', 'city_id', 'pincode', 'site_city_id', 'site_pincode', 'type', 'status'], 'integer'],
            [['client_type', 'company_name', 'first_name', 'last_name', 'email', 'mobile_no', 'phone_no', 'address', 'site_address','mobile_no'], "string"],
            [['kyc_details'], 'ValidateMulti', 'params' => ['isMulti' => TRUE, 'ValidationModel' => $kycValidations, 'allowEmpty' => true]],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_type' => 'Client Type',
            'company_id' => 'Company',
            'company_name' => 'Company Name',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'mobile_no' => 'Mobile No',
            'phone_no' => 'Phone No',
            'address' => 'Address',
            'city_id' => 'City',
            'pincode' => 'Pincode',
            'site_address' => 'Site Address',
            'site_city_id' => 'Site City',
            'site_pincode' => 'Site Pincode',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
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
        $model = new ClientMaster(['scenario' => ClientMaster::SCENARIO_CREATE]);
        $model->client_type = $this->client_type;
        $model->company_id = $this->company_id;
        $model->company_name = $this->company_name;
        $model->first_name  = $this->first_name;
        $model->last_name  = $this->last_name;
        $model->email = $this->email;
        $model->mobile_no = $this->mobile_no;
        $model->phone_no = $this->phone_no;
        $model->address = $this->address;
        $model->city_id = $this->city_id;
        $model->pincode = $this->pincode;
        $model->site_address = $this->site_address;
        $model->site_city_id = $this->site_city_id;
        $model->site_pincode = $this->site_pincode;
        $model->type = $this->type;
        $model->status = $this->status;
        if ($model->validate() && $model->save()) {
            $this->uploadDocs($model->id, C::DOCUMENT_FOR_COMPANY, $this->kyc_details);
            return $model;
        } else{
            $this->addErrors($model->errors);
        }
        return false;
    }

    public function update($id)
    {
        $model = ClientMaster::findOne(['id' => $id]);
        if ($model instanceof ClientMaster) {
            $model->scenario = ClientMaster::SCENARIO_UPDATE;
            $model->client_type = $this->client_type;
            $model->company_id = $this->company_id;
            $model->company_name = $this->company_name;
            $model->first_name  = $this->first_name;
            $model->last_name  = $this->last_name;
            $model->email = $this->email;
            $model->mobile_no = $this->mobile_no;
            $model->phone_no = $this->phone_no;
            $model->address = $this->address;
            $model->city_id = $this->city_id;
            $model->pincode = $this->pincode;
            $model->site_address = $this->site_address;
            $model->site_city_id = $this->site_city_id;
            $model->site_pincode = $this->site_pincode;
            $model->type = $this->type;
            $model->status = $this->status;
            if ($model->validate() && $model->save()) {
                $this->uploadDocs($model->id, C::DOCUMENT_FOR_COMPANY, $this->kyc_details);
                return $model;
            }else{
                $this->addErrors($model->errors);
            }
        }
        return false;
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
}
