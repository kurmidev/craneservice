<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plan_attributes".
 *
 * @property int $id
 * @property string $name
 * @property int|null $status
 * @property string $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 */
class PlanAttributes extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan_attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ["name","status"],
            self::SCENARIO_UPDATE => ["name","status"]
        ];
    }
    

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','status'], 'required'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 200],
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
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Update By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return PlanAttributesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlanAttributesQuery(get_called_class());
    }
}
