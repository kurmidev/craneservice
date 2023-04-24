<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UploadDocument]].
 *
 * @see UploadDocument
 */
class UploadDocumentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UploadDocument[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UploadDocument|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
