<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Challan]].
 *
 * @see Challan
 */
class ChallanQuery extends \app\models\BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Challan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Challan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
