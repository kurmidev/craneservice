<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ledger_report".
 *
 * @property int $client_id
 * @property int $client_type
 * @property string $date
 * @property string|null $particular
 * @property string|null $invoice_no
 * @property float $debit
 * @property float $credit
 */
class LedgerReport extends \yii\db\ActiveRecord
{

    public static function primaryKey(){
        return ['invoice_no'];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ledger_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'client_type'], 'integer'],
            [['date'], 'safe'],
            [['debit', 'credit'], 'number'],
            [['particular', 'invoice_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'client_id' => 'Client ID',
            'client_type' => 'Client Type',
            'date' => 'Date',
            'particular' => 'Particular',
            'invoice_no' => 'Invoice No',
            'debit' => 'Debit',
            'credit' => 'Credit',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LedgerReportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LedgerReportQuery(get_called_class());
    }
}
