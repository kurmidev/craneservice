<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expense_items".
 *
 * @property int $id
 * @property int $expense_type
 * @property int $expense_id
 * @property int $category_id
 * @property int $quantity
 * @property float $amount
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property ExpenseMaster $expense
 */
class ExpenseItems extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expense_items';
    }

    public function scenarios(){
        return [
            self::SCENARIO_CREATE=>['expense_type', 'expense_id', 'category_id', 'quantity', 'amount'],
            self::SCENARIO_UPDATE=>['expense_type', 'expense_id', 'category_id', 'quantity', 'amount'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['expense_type', 'expense_id', 'category_id', 'quantity', 'amount'], 'required'],
            [['expense_type', 'expense_id', 'category_id', 'quantity', 'created_by', 'updated_by'], 'integer'],
            [['amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['expense_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExpenseMaster::class, 'targetAttribute' => ['expense_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'expense_type' => 'Expense Type',
            'expense_id' => 'Expense ID',
            'category_id' => 'Category ID',
            'quantity' => 'Quantity',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Expense]].
     *
     * @return \yii\db\ActiveQuery|ExpenseMasterQuery
     */
    public function getExpense()
    {
        return $this->hasOne(ExpenseMaster::class, ['id' => 'expense_id']);
    }

    /**
     * Gets query for [[ExpenseCategory]].
     *
     * @return \yii\db\ActiveQuery|ExpenseCategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ExpenseCategory::class, ['id' => 'category_id']);
    }


    /**
     * {@inheritdoc}
     * @return ExpenseItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExpenseItemsQuery(get_called_class());
    }
}
