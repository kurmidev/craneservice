<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[EmployeeCompanyMapping]].
 *
 * @see EmployeeCompanyMapping
 */
class EmployeeCompanyMappingQuery extends \app\models\BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EmployeeCompanyMapping[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EmployeeCompanyMapping|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
