<?php

namespace app\models;
use app\components\Constants as C;

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

    public function isVendor(){
        return $this->andWhere(['client_type'=>C::CLIENT_TYPE_VENDOR]);
    }


    public function isCustomer(){
        return $this->andWhere(['client_type'=>C::CLIENT_TYPE_CUSTOMER]);
    }
}
