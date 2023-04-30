<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ClientSite]].
 *
 * @see ClientSite
 */
class ClientSiteQuery extends \app\models\BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ClientSite[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ClientSite|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
