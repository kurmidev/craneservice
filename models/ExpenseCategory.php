<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expense_category".
 *
 * @property int $id
 * @property string $name
 * @property string|null $remark
 * @property int $status
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class ExpenseCategory extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expense_category';
    }


    /**
     * {@inheritdoc}
     */
    public function scenarios(){
        return [
            self::SCENARIO_CREATE => ["name","status","remark"],
            self::SCENARIO_UPDATE => ["name","status","remark"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'remark'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
            'remark' => 'Remark',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ExpenseCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExpenseCategoryQuery(get_called_class());
    }
}
