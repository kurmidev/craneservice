<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_master".
 *
 * @property int $id
 * @property string $name
 * @property int $company_id
 * @property int $department_id
 * @property string|null $email
 * @property string $phone_no
 * @property int $status
 * @property string|null $start_time
 * @property string|null $end_time
 * @property float|null $salary
 * @property float|null $overtime_salary
 * @property string|null $address
 * @property int $city_id
 * @property string $pincode
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
            self::SCENARIO_CREATE => ['name', 'company_id', 'department_id', 'phone_no', 'city_id', 'pincode', 'status', 'start_time', 'end_time','salary','overtime_salary','address','email'],
            self::SCENARIO_UPDATE => ['name', 'company_id', 'department_id', 'phone_no', 'city_id', 'pincode', 'status', 'start_time', 'end_time','salary','overtime_salary','address','email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'company_id', 'department_id', 'phone_no', 'city_id', 'pincode'], 'required'],
            [['company_id', 'department_id', 'status', 'city_id', 'created_by', 'updated_by'], 'integer'],
            [['start_time', 'end_time', 'created_at', 'updated_at'], 'safe'],
            [['salary', 'overtime_salary'], 'number'],
            [['name'], 'string', 'max' => 150],
            [['email'], 'string', 'max' => 200],
            [['phone_no'], 'string', 'max' => 10],
            [['address'], 'string', 'max' => 250],
            [['pincode'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyMaster::class, 'targetAttribute' => ['company_id' => 'id']],
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
            'company_id' => 'Company ID',
            'department_id' => 'Department ID',
            'email' => 'Email',
            'phone_no' => 'Phone No',
            'status' => 'Status',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'salary' => 'Salary',
            'overtime_salary' => 'Overtime Salary',
            'address' => 'Address',
            'city_id' => 'City ID',
            'pincode' => 'Pincode',
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
    public function getCompany()
    {
        return $this->hasOne(CompanyMaster::class, ['id' => 'company_id']);
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
     * {@inheritdoc}
     * @return EmployeeMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeMasterQuery(get_called_class());
    }
}
