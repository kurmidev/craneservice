<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EmployeeMaster;

/**
 * EmployeeMasterSearch represents the model behind the search form of `app\models\EmployeeMaster`.
 */
class EmployeeMasterSearch extends EmployeeMaster
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'department_id', 'status', 'city_id', 'created_by', 'updated_by'], 'integer'],
            [['name', 'email', 'phone_no', 'start_time', 'end_time', 'address', 'pincode', 'created_at', 'updated_at'], 'safe'],
            [['salary', 'overtime_salary'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = EmployeeMaster::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'company_id' => $this->company_id,
            'department_id' => $this->department_id,
            'status' => $this->status,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'salary' => $this->salary,
            'overtime_salary' => $this->overtime_salary,
            'city_id' => $this->city_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone_no', $this->phone_no])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'pincode', $this->pincode]);

        return $dataProvider;
    }
}
