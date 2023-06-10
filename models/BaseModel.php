<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;
use yii\db\Expression;
use app\components\Constants as C;

class BaseModel extends ActiveRecord
{

    use BaseTraits;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_DELETE = 'delete';
    const SCENARIO_LOGIN = "login";

    private $_oldData = array();
    private $_newData = array();
    private $_changedata = array();

    public $audit_message;
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
        return empty($this->updated_at) ?
            Yii::$app->formatter->asDatetime($this->created_at, 'php:d M Y H:i') :
            Yii::$app->formatter->asDatetime($this->updated_at, 'php:d M Y H:i');
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

    public function generateSequence($prefix, $type, $typeFor = null)
    {
        $seq = CodeSequence::getNextSequnce($type, $typeFor);
        return $prefix . "/" . $seq;
    }

    /** 
     * function to capture the coloumns whose value has been changed 
     *  @return array 
     * */
    public function removeTrackingValue()
    {
        $tableCols = $this->attributes;
        unset($tableCols['created_at'], $tableCols['updated_at'], $tableCols['created_by'], $tableCols['updated_by']);
        return $tableCols;
    }


    /*
     * function to set capture the old values
     * @param string $insert
     * @return boolean
     */

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        $this->_oldData = $this->getOldAttributes();
        return TRUE;
    }


    /**
     *  function to do the logging of the data changes 
     *  @param array $insert 
     *  @param array $changedAttributes 
     *  @return boolean 
     * */
    public function afterSave($insert, $changedAttributes)
    {
        try {
            if (!empty($this->_oldData)) {
                $tableColoumns = $this->removeTrackingValue();
                foreach ($tableColoumns as $key => $val) {
                    if (isset($this->_oldData[$key])) {
                        if ($this->_oldData[$key] != $val) {
                            $this->_changedata[$key] = $val;
                        }
                    }
                }
            } else {
                $this->_changedata = $this->attributes;
            }
            if (!empty($this->_changedata)) {
                $auditTrails = new AuditLogs();
                $auditTrails->table_name = $this->tableName();
                $auditTrails->client_id = !empty($this->client_id) ? $this->client_id : null;
                $auditTrails->client_type = !empty($this->client_type) ? $this->client_type : null;
                $this->_newData = $this->attributes;
                $auditTrails->old_value = json_encode($this->_oldData);
                $auditTrails->changed_value = json_encode($this->_changedata);
                $auditTrails->new_value = json_encode($this->_newData);
                $auditTrails->primary_id = $this->id;
                $auditTrails->action_taken = !empty($this->status) ? $this->status : 1;
                $auditTrails->created_by = \Yii::$app->user->getId();
                $auditTrails->created_at = date("Y-m-d H:i:s");
                $auditTrails->remark = $this->getAuditMessage($this->_oldData,$this->_newData,$this->_changedata);
                if ($auditTrails->validate() && $auditTrails->save()) {
                    //       return true;
                }
            }
        } catch (Exception $e) {
            print_r($tableColoumns);
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function getAuditMessage($oldAttr, $newAttr, $changeAttr)
    {
        return "";
    }

    public function generateText($oldAttr, $newAttr, $changeAttr)
    {
        $str = "";
        if (!empty($changeAttr)) {
            foreach($oldAttr as $key=>$value){
                if(!empty($oldAttr[$key]) && !empty($newAttr[$key])){
                    $str.= $key.":".$oldAttr[$key]." to ". $newAttr[$key]; 
                }
            }
        }
        return $str;
    }
}
