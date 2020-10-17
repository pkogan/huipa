<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InstanciaEnunciado;

/**
 * InstanciaEnunciadoSearch represents the model behind the search form of `app\models\InstanciaEnunciado`.
 */
class InstanciaEnunciadoSearch extends InstanciaEnunciado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idInstanciaEnunciado', 'idMetaEnunciado'], 'integer'],
            [['c1', 'c2', 'c3', 'c4', 'c5', 'c6', 'c7', 'c8', 'c9', 'c10', 'respuesta'], 'safe'],
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
        $query = InstanciaEnunciado::find();

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
            'idInstanciaEnunciado' => $this->idInstanciaEnunciado,
            'idMetaEnunciado' => $this->idMetaEnunciado,
        ]);

        $query->andFilterWhere(['like', 'c1', $this->c1])
            ->andFilterWhere(['like', 'c2', $this->c2])
            ->andFilterWhere(['like', 'c3', $this->c3])
            ->andFilterWhere(['like', 'c4', $this->c4])
            ->andFilterWhere(['like', 'c5', $this->c5])
            ->andFilterWhere(['like', 'c6', $this->c6])
            ->andFilterWhere(['like', 'c7', $this->c7])
            ->andFilterWhere(['like', 'c8', $this->c8])
            ->andFilterWhere(['like', 'c9', $this->c9])
            ->andFilterWhere(['like', 'c10', $this->c10])
            ->andFilterWhere(['like', 'respuesta', $this->respuesta]);

        return $dataProvider;
    }
}
