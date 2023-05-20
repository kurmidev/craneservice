<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quotation_master".
 *
 * @property int $id
 * @property string $quotation_no
 * @property int $client_id
 * @property int $client_type
 * @property string $date
 * @property string $subject
 * @property string $terms_and_conditions
 * @property int $tax_applicable
 * @property string|null $remark
 * @property float $base_amount
 * @property float $tax
 * @property float $total
 * @property int $status
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property ClientMaster $client
 * @property QuotationItems[] $quotationItems
 */
class QuotationMaster extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quotation_master';
    }

    public function scenarios(){
        return [
            self::SCENARIO_CREATE=>['quotation_no', 'client_id', 'client_type', 'date', 'subject', 'terms_and_conditions','base_amount', 'tax', 'total'],
            self::SCENARIO_UPDATE=>['quotation_no', 'client_id', 'client_type', 'date', 'subject', 'terms_and_conditions','base_amount', 'tax', 'total'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'client_id', 'client_type', 'date', 'subject', 'terms_and_conditions'], 'required'],
            [['client_id', 'client_type', 'tax_applicable', 'status', 'created_by', 'updated_by'], 'integer'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['base_amount', 'tax', 'total'], 'number'],
            [['quotation_no', 'subject', 'terms_and_conditions', 'remark'], 'string'],
            [['quotation_no'], 'unique'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientMaster::class, 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quotation_no' => 'Quotation No',
            'client_id' => 'Client ID',
            'client_type' => 'Client Type',
            'date' => 'Date',
            'subject' => 'Subject',
            'terms_and_conditions' => 'Terms And Conditions',
            'tax_applicable' => 'Tax Applicable',
            'remark' => 'Remark',
            'base_amount' => 'Base Amount',
            'tax' => 'Tax',
            'total' => 'Total',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery|ClientMasterQuery
     */
    public function getClient()
    {
        return $this->hasOne(ClientMaster::class, ['id' => 'client_id']);
    }

    /**
     * Gets query for [[QuotationItems]].
     *
     * @return \yii\db\ActiveQuery|QuotationItemsQuery
     */
    public function getQuotationItems()
    {
        return $this->hasMany(QuotationItems::class, ['quotation_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return QuotationMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QuotationMasterQuery(get_called_class());
    }
    public function beforeSave($insert){
        
        if(!empty($insert) && empty($this->invoice_no)){
            $prefix = "QT";
            $this->quotation_no = $this->generateSequence($prefix,"quotations");
        }
        return parent::beforeSave($insert);
    }

}
