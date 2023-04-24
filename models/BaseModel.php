<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

class BaseModel extends ActiveRecord
{

    use BaseTraits;
    
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_DELETE = 'delete';
    const SCENARIO_LOGIN = "login";

    public function behaviors()
    {

        return [
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }


    /*
     * function to get the latest change done
     * @return datetime
     */

    public function getActionOn()
    {
        return is_null($this->updated_on) ?
            Yii::$app->formatter->asDatetime($this->created_at, 'php:d M Y H:i') :
            Yii::$app->formatter->asDatetime($this->updated_on, 'php:d M Y H:i');
    }

    /*
     * function to get the user details
     * @return string
     */

    public function getActionBy()
    {
        $actiontaker = empty($this->updated_by) ? $this->created_by : $this->updated_by;
        $crdObj = User::findOne(['id' => $actiontaker]);
        if ($crdObj instanceof User) {
            return $crdObj->name;
        }
        return null;
    }
}
