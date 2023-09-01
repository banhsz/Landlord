<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Titkos;

/**
 * TitkosSearch represents the model behind the search form of `backend\models\Titkos`.
 */
class TitkosSearch extends Titkos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['a1', 'a2', 'a3', 'a4', 'a5', 'b1', 'b2', 'sorsolas', 'nyeremeny'], 'integer'],
            [['talalat'], 'string'],
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
        $query = Titkos::find();

        $query->orderBy(["id" => SORT_DESC]);
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
            'a1' => $this->a1,
            'a2' => $this->a2,
            'a3' => $this->a3,
            'a4' => $this->a4,
            'a5' => $this->a5,
            'b1' => $this->b1,
            'b2' => $this->b2,
            'sorsolas' => $this->sorsolas,
            'talalat' => $this->talalat,
            'nyeremeny' => $this->nyeremeny,
        ]);

        return $dataProvider;
    }
}
