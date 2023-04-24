<?php

namespace app\models;

use yii\db\ActiveQuery;
use app\components\Constants as C;

class BaseQuery extends ActiveQuery
{

    public function active()
    {
        return $this->andWhere(['status' => C::STATUS_ACTIVE]);
    }
}
