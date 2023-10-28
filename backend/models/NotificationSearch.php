<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Notification;

/**
 * NotificationSearch represents the model behind the search form of `backend\models\Notification`.
 */
class NotificationSearch extends Notification
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'message', 'source_class', 'source_entity', 'read'], 'integer'],
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
        $query = Notification::find();

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
            'message' => $this->message,
            'source_class' => $this->source_class,
            'source_entity' => $this->source_entity,
            'read' => $this->read,
        ]);

        return $dataProvider;
    }
}
