<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PlanMaster]].
 *
 * @see PlanMaster
 */
class PlanMasterQuery extends BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PlanMaster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PlanMaster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
