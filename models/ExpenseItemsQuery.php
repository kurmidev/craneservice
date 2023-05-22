<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ExpenseItems]].
 *
 * @see ExpenseItems
 */
class ExpenseItemsQuery extends \app\models\BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ExpenseItems[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ExpenseItems|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
