<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_master".
 *
 * @property int $id
 * @property string $name
 * @property array $company_id
 * @property int $department_id
 * @property string|null $email
 * @property string $phone_no
 * @property string $mobile_no
 * @property int $status
 * @property string|null $start_time
 * @property string|null $end_time
 * @property float|null $salary
 * @property float|null $overtime_salary
 * @property string|null $address
 * @property int $city_id
 * @property string $pincode
 * @property string $username
 * @property string $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property CompanyMaster $company
 * @property Department $department
 */
class EmployeeMaster extends \app\models\BaseModel
{

    public $password;
    public $confirm_password;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_master';
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['name', 'company_id', 'department_id', 'phone_no', 'city_id', 'pincode', 'status', 'start_time', 'end_time', 'salary', 'overtime_salary', 'address', 'email', 'password', 'mobile_no','username','password'],
            self::SCENARIO_UPDATE => ['name', 'company_id', 'department_id', 'phone_no', 'city_id', 'pincode', 'status', 'start_time', 'end_time', 'salary', 'overtime_salary', 'address', 'email', 'password', 'mobile_no','username','password'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'company_id', 'department_id', 'mobile_no', 'city_id', 'pincode'], 'required'],
            [['department_id', 'status', 'city_id', 'created_by', 'updated_by'], 'integer'],
            [['start_time', 'end_time', 'created_at', 'updated_at', 'password','confirm_password'], 'safe'],
            [['salary', 'overtime_salary'], 'number'],
            [['name'], 'string', 'max' => 150],
            [['email'], 'string', 'max' => 200],
            [['phone_no', 'mobile_no'], 'string', 'max' => 10],
            [['address'], 'string', 'max' => 250],
            [['pincode'], 'string', 'max' => 255],
            // [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyMaster::class, 'targetAttribute' => ['company_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department_id' => 'id']],
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
            'company_id' => 'Company',
            'department_id' => 'Department',
            'email' => 'Email',
            'phone_no' => 'Phone No',
            'mobile_no' => "Mobile No",
            'status' => 'Status',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'salary' => 'Salary',
            'overtime_salary' => 'Overtime Salary',
            'address' => 'Address',
            'city_id' => 'City',
            'pincode' => 'Pincode',
            'password' => 'Password',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery|CompanyMasterQuery
     */
    public function getCompanyMapping()
    {
        return $this->hasMany(EmployeeCompanyMapping::class, ['employee_id' => 'id'])->with('company');
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery|DepartmentQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }


    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery|DepartmentQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

        /**
     * Gets query for [[CompanyMapping]].
     *
     * @return \yii\db\ActiveQuery|DepartmentQuery
     */
    public function getCompany()
    {
        return $this->hasMany(EmployeeCompanyMapping::class, ['employee_id' => 'id'])->with(['company']);
    }

    
    /**
     * {@inheritdoc}
     * @return EmployeeMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeMasterQuery(get_called_class());
    }

    public function beforeSave($insert){
        if(in_array($this->scenario,[self::SCENARIO_CREATE,self::SCENARIO_UPDATE])){
            $this->start_time = date("H:m:s",strtotime($this->start_time));
            $this->end_time = date("H:m:s",strtotime($this->end_time));
        }
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        print_r($insert);
            
        if ($insert || in_array('company_id', array_keys($changedAttributes))) {
            $this->saveCompanyMapping();
        }
        if (!empty($this->password)) {
            $this->userCredentials();
        }
    }

    public function saveCompanyMapping()
    {
        $is_valid = true;
        if (!empty($this->company_id)) {
            EmployeeCompanyMapping::deleteAll(['employee_id' => $this->id]);
            foreach ($this->company_id as $company) {
                $model = new EmployeeCompanyMapping(['scenario' => EmployeeCompanyMapping::SCENARIO_CREATE]);
                $model->company_id  = $company;
                $model->employee_id = $this->id;
                if ($model->validate() && $model->save()) {
                    $is_valid = $is_valid && true;
                } else {
                    $is_valid = $is_valid && false;
                }
            }
        } else {
            $is_valid = $is_valid && false;
        }

        return $is_valid;
    }

    public function userCredentials()
    {
        $model = User::findOne(['username' => $this->username]);
        if (!$model instanceof User) {
            $model = new User(['scenario' => User::SCENARIO_CREATE]);
            $model->name = $this->name;
            $model->username = $this->username;
        } else {
            $model->scenario = User::SCENARIO_UPDATE;
        }
        $model->password = md5($this->password);
        $model->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
        $model->auth_key = \Yii::$app->security->generateRandomString();
        $model->status = $this->status;
        if ($model->validate() && $model->save()) {
            return true;
        }
        return false;
    }
}
