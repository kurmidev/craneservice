<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "code_sequence".
 *
 * @property int $id
 * @property string $name
 * @property string|null $sequence_for
 * @property int $value
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class CodeSequence extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'code_sequence';
    }

    public function scenarios(){
        return [
            self::SCENARIO_CREATE=>["name","value","sequence_for"],
            self::SCENARIO_UPDATE=>["name","value","sequence_for"]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['value', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'sequence_for'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'sequence_for' => 'Sequence For',
            'value' => 'Value',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CodeSequenceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CodeSequenceQuery(get_called_class());
    }

    public static function getNextSequnce($type,$typeFor=""){
        $model = CodeSequence::findOne(['name'=>$type,"sequence_for"=>$typeFor]);
        if(!$model instanceof CodeSequence ){
            $model = new CodeSequence(['scenario'=>CodeSequence::SCENARIO_CREATE]);
            $model->name = $type;
            $model->sequence_for = $typeFor;
            $model->value = 1;
            if($model->validate() && $model->save()){
                return $model->value;
            }
        }
        $model->updateCounters(['value'=>1]);
        return  $model->value;
    }
  
}
