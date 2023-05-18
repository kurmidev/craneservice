<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PaymentNotes]].
 *
 * @see PaymentNotes
 */
class PaymentNotesQuery extends \app\models\BaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PaymentNotes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PaymentNotes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
