<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use app\components\Constants as C;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property int|null $designation_id
 * @property int $status
 * @property string|null $last_login_at
 * @property string $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $update_by
 */
class User extends BaseModel implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }


    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ["name", "username", "password", "desgination_id", "status", "last_login_at", "access_token", "auth_key", "password_reset_token"],
            self::SCENARIO_UPDATE => ["name", "username", "password", "desgination_id", "status", "last_login_at", "access_token", "auth_key", "password_reset_token"],
            self::SCENARIO_DELETE => ["status"],
            self::SCENARIO_LOGIN => ["username", "password", "last_login_at"]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'username', 'password'], 'required'],
            [['designation_id', 'status', 'created_by', 'update_by'], 'integer'],
            [['last_login_at', 'created_at', 'updated_at', "auth_key", "password_reset_token"], 'safe'],
            [['name', 'username', 'password'], 'string', 'max' => 250],
            [['username'], 'unique'],
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
            'username' => 'Username',
            'password' => 'Password',
            'designation_id' => 'Designation ID',
            'status' => 'Status',
            'last_login_at' => 'Last Login At',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'update_by' => 'Update By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public static function findIdentity($id)
    {
        return static::findOne(["id" => $id, 'status' => C::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => C::STATUS_ACTIVE]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function afterValidate()
    {
        if (in_array($this->scenario, [self::SCENARIO_CREATE, self::SCENARIO_UPDATE])) {
            $this->auth_key = !empty($this->auth_key) ? $this->auth_key : Yii::$app->security->generateRandomString();
            $this->password_hash = !empty($this->password_hash) ? $this->password_hash : Yii::$app->getSecurity()->generatePasswordHash($this->username . $this->password);
        }

        return parent::afterValidate();
    }
}
