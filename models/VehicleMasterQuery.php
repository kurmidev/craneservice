<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VehicleMaster]].
 *
 * @see VehicleMaster
 */
class VehicleMasterQuery extends BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VehicleMaster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VehicleMaster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
