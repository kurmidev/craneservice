<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[QuotationMaster]].
 *
 * @see QuotationMaster
 */
class QuotationMasterQuery extends \app\models\BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return QuotationMaster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return QuotationMaster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
