<?php

namespace app\models;

use yii\db\ActiveQuery;
use app\components\Constants as C;

class BaseQuery extends ActiveQuery
{

    public $alias;


    public function setAlias($alias="")
    {
        
        if(empty($alias)){
            list($t,$a) = $this->getTableNameAndAlias();
            $alias = $a;
        }
        
        $this->alias($alias);
        $this->alias = $alias . ".";
    }

    public function active()
    {

        return $this->andWhere([$this->alias . 'status' => C::STATUS_ACTIVE]);
    }

    public function onlyActive()
    {
        return $this->andWhere([$this->alias . 'status' => [C::STATUS_ACTIVE, C::STATUS_INACTIVE]]);
    }
}
