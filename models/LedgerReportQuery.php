<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LedgerReport]].
 *
 * @see LedgerReport
 */
class LedgerReportQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LedgerReport[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LedgerReport|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
