<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $name
 * @property int $state_id
 * @property int $status
 * @property string $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property ClientMaster[] $clientMasters
 * @property State $state
 */
class City extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }


    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ["name","state_id","status"],
            self::SCENARIO_UPDATE => ["name","state_id","status"],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'state_id'], 'required'],
            [['state_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 250],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::class, 'targetAttribute' => ['state_id' => 'id']],
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
            'state_id' => 'State ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[ClientMasters]].
     *
     * @return \yii\db\ActiveQuery|ClientMasterQuery
     */
    public function getClientMasters()
    {
        return $this->hasMany(ClientMaster::class, ['city_id' => 'id']);
    }

    /**
     * Gets query for [[State]].
     *
     * @return \yii\db\ActiveQuery|StateQuery
     */
    public function getState()
    {
        return $this->hasOne(State::class, ['id' => 'state_id']);
    }

    /**
     * {@inheritdoc}
     * @return CityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CityQuery(get_called_class());
    }
}
