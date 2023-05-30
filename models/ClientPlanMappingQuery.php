<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ClientPlanMapping]].
 *
 * @see ClientPlanMapping
 */
class ClientPlanMappingQuery extends \app\models\BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ClientPlanMapping[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ClientPlanMapping|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
