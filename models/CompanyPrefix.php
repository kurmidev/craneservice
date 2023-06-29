<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company_prefix".
 *
 * @property int $id
 * @property int $company_id
 * @property int $prefix_for
 * @property string $prefix
 * @property int $post_prefix
 * @property int $status
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class CompanyPrefix extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_prefix';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'prefix_for', 'prefix', 'status','post_prefix'], 'required'],
            [['company_id', 'prefix_for', 'status', 'created_by', 'updated_by','post_prefix'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['prefix'], 'string', 'max' => 10],
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['company_id', 'prefix_for', 'prefix', 'status','post_prefix'],
            self::SCENARIO_UPDATE => ['company_id', 'prefix_for', 'prefix', 'status','post_prefix']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'prefix_for' => 'Prefix For',
            'prefix' => 'Prefix',
            'post_prefix'=>'Post Prefix',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CompanyPrefixQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanyPrefixQuery(get_called_class());
    }
}
