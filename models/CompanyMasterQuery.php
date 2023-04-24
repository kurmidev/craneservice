<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CompanyMaster]].
 *
 * @see CompanyMaster
 */
class CompanyMasterQuery extends BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CompanyMaster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CompanyMaster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
