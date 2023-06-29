<?php

namespace app\models;

use Yii;
use yii\base\DynamicModel;
use yii\web\UploadedFile;
use app\components\Constants as C;

/**
 * This is the model class for table "vehicle_master".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $vehicle_no
 * @property string|null $book_no
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $vehicle_type
 * @property string $serial_applicable
 * @property int|null $status
 * @property string $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 */
class VehicleMaster extends \app\models\BaseModel
{
    public $sales_amount;
    public $expenses;

    public $profit_loss;

    public static $maintenance = [
        "mv_tax" => "MV Tax",
        "insurance_date" => "Insurance Date",
        "permit" => "Permit",
        "fitness" => "fitness",
        "env_tax" => "ENV Tax",
        "puc" => "PUC",
        "rc" => "RC",
        "form_11" => "Form 11"
    ];

    public $maintenance_data;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicle_master';
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['name', 'vehicle_no', 'book_no', 'vehicle_type', 'start_date', 'end_date', 'maintenance_data', 'serial_applicable'],
            self::SCENARIO_UPDATE => ['name', 'vehicle_no', 'book_no', 'vehicle_type', 'start_date', 'end_date', 'maintenance_data', 'serial_applicable'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $maintenanceValidation = (new DynamicModel(['value', 'doc']))
            ->addRule(['value'], 'string')
            ->addRule(['doc'], 'file');

        return [
            [['start_date', 'end_date', 'created_at', 'updated_at', 'maintenance_data'], 'safe'],
            [['status', 'created_by', 'updated_by', 'serial_applicable'], 'integer'],
            [['name', 'vehicle_no', 'book_no', 'vehicle_type'], 'string', 'max' => 255],
            [['vehicle_no'], 'unique'],
            [['maintenance_data'], 'ValidateMulti', 'params' => ['isMulti' => TRUE, 'ValidationModel' => $maintenanceValidation, 'allowEmpty' => true]],
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
            'vehicle_no' => 'Vehicle No',
            'book_no' => 'Book No',
            'start_date' => 'Start',
            'end_date' => 'End',
            'vehicle_type' => 'Vehicle Type',
            'status' => 'Status',
            'serial_applicable' => 'Serial Applicable',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return VehicleMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VehicleMasterQuery(get_called_class());
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (!empty($this->maintenance_data)) {
            $this->uploadDocs();
        }
    }

    public function getDocuments()
    {
        return $this->hasMany(UploadDocument::class, ["document_reference_id" => 'id'])->onCondition(["document_for" => C::DOCUMENT_FOR_VEHICLE]);
    }

    public function uploadDocs()
    {
        if (!empty($this->maintenance_data)) {
            $documents = [];
            foreach ($this->maintenance_data as $key => $data) {
                $file = UploadedFile::getInstance($this, 'maintenance_data[' . $key . '][doc]');
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
                $this->saveProofs($this->id, C::DOCUMENT_FOR_VEHICLE, $documents);
            }
        }
    }
}
