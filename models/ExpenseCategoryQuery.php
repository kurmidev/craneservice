<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ExpenseCategory]].
 *
 * @see ExpenseCategory
 */
class ExpenseCategoryQuery extends \app\models\BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ExpenseCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ExpenseCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
