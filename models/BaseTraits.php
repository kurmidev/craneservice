<?php

namespace app\models;

use app\components\Constants as C;
use app\models\UploadDocument;

trait BaseTraits
{
    public function ValidateMulti($attribute, $params)
    {
        $input = $this->$attribute;
        $isMulti = isset($params['isMulti']) ? $params['isMulti'] : false;

        if (!empty($input)) {
            if ($isMulti) {
                // if (!\yii\helpers\ArrayHelper::isAssociative($input)) {
                //     $this->addError($attribute, "$attribute need to be an array of objects");
                //     return;
                // }
            }
            if (!\yii\helpers\ArrayHelper::isTraversable($input)) {
                $this->addError($attribute, "$attribute need to be an array");
                return;
            }
            $ValidationModel = isset($params['ValidationModel']) ? $params['ValidationModel'] : false;
            if ($ValidationModel) {
                if (!($ValidationModel instanceof \yii\base\DynamicModel)) {
                    $this->addError($attribute, "Invalid ValidationModel passed has to be instance of \yii\base\DynamicModel");
                    return;
                }
            } else {
                $this->addError($attribute, "Invalid ValidationModel passed has to be instance of \yii\base\DynamicModel");
                return;
            }
            $format = $ValidationModel->attributes();

            if (!$isMulti) {
                $input = [$input];
            }
            foreach ($input as $i => $data) {
                $model = $ValidationModel;
                if (is_array($data)) {
                    //                    $missingKeys = array_diff($format,array_keys($data));
                    $missingKeys = [];
                    if (!empty($missingKeys)) {
                        $this->addError($attribute, "Following keys missing " . implode(',', $missingKeys) . ' at ' . $i . " index of $attribute input");
                        return false;
                    } else {
                        if ($model) {
                            $model->load($data, '');
                            if (!$model->validate()) {
                                foreach ($model->errors as $name => $error) {
                                    $this->addError("{$attribute}_{$i}_{$name}", $error[0]);
                                }
                            }
                        }
                    }
                } else {
                    $this->addError($attribute, "Has to be any array of objects with keys " . implode(',', $format));
                }
            }
        } else {
            if (isset($params['allowEmpty']) && $params['allowEmpty'] != false) {
                $this->addError($attribute, "Has to be any array of objects  cannot be Empty");
            }
        }
    }

    public function saveProofs($reference_id, $doc_for, $doc_details)
    {
        $isvalid = true;
        if (!empty($doc_details)) {
            foreach ($doc_details as $doc_detail) {

                $model = UploadDocument::findOne(['document_reference_id' => $reference_id, 'document_for' => $doc_for,"document_type"=>$doc_detail['document_type']]);
                
                if (!$model instanceof UploadDocument) {
                    $model = new UploadDocument(['scenario' => UploadDocument::SCENARIO_CREATE]);
                }else{
                    $model->scenario = UploadDocument::SCENARIO_UPDATE;
                }
                $model->document_reference_id = $reference_id;
                $model->document_for = $doc_for;
                $model->document_name = $doc_detail['document_name'];
                $model->document_type = $doc_detail['document_type'];
                $model->documents = $doc_detail["documents"];
                $model->other_details = !empty($doc_detail["other_details"]) ? $doc_detail["other_details"] : "";
                $model->status = C::STATUS_ACTIVE;
                if ($model->validate() && $model->save()) {
                    $isvalid = $isvalid && true;
                } else {
                    $isvalid = $isvalid && false;
                }
            }
        } else {
            $isvalid = $isvalid && false;
        }
        return $isvalid;
    }
}
