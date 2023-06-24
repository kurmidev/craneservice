<?php

namespace app\models;

use app\components\Constants as C;
/**
 * This is the ActiveQuery class for [[InvoiceMaster]].
 *
 * @see InvoiceMaster
 */
class InvoiceMasterQuery extends \app\models\BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InvoiceMaster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InvoiceMaster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active(){
        return $this->andWhere(['status'=>[C::STATUS_ACTIVE]]);
    }
}
