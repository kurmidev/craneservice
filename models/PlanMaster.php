<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plan_master".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $code
 * @property float $price
 * @property int|null $attribute_id
 * @property int $type
 * @property int|null $shift_hrs
 * @property int|null $tax_slot
 * @property int|null $status
 * @property string $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $update_by
 */
class PlanMaster extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'type'], 'required'],
            [['price'], 'number'],
            [['attribute_id', 'type', 'shift_hrs', 'tax_slot', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'code'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['code'], 'unique'],
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
            'price' => 'Price',
            'attribute_id' => 'Attribute ID',
            'type' => 'Type',
            'shift_hrs' => 'Shift Hrs',
            'tax_slot' => 'Tax Slot',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Update By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return PlanMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlanMasterQuery(get_called_class());
    }

    public function getAttr()
    {
        return $this->hasOne(PlanAttributes::class, ['id' => 'attribute_id']);
    }
}
