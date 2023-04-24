<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PlanAttributes]].
 *
 * @see PlanAttributes
 */
class PlanAttributesQuery extends BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PlanAttributes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PlanAttributes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
