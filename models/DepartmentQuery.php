<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Department]].
 *
 * @see Department
 */
class DepartmentQuery extends BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Department[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Department|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
