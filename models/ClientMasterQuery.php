<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ClientMaster]].
 *
 * @see ClientMaster
 */
class ClientMasterQuery extends BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ClientMaster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ClientMaster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
