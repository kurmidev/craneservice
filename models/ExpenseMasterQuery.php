<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ExpenseMaster]].
 *
 * @see ExpenseMaster
 */
class ExpenseMasterQuery extends \app\models\BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ExpenseMaster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ExpenseMaster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
