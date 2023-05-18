<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PaymentsDetails]].
 *
 * @see PaymentsDetails
 */
class PaymentsDetailsQuery extends \app\models\BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PaymentsDetails[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PaymentsDetails|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
