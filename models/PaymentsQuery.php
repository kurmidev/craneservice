<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Payments]].
 *
 * @see Payments
 */
class PaymentsQuery extends \app\models\BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Payments[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Payments|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
