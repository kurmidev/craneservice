<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[EmployeeMaster]].
 *
 * @see EmployeeMaster
 */
class EmployeeMasterQuery extends BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EmployeeMaster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EmployeeMaster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
