<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ExamenEstudiante;

/**
 * ExamenEstudianteSearch represents the model behind the search form of `app\models\ExamenEstudiante`.
 */
class ExamenEstudianteSearch extends ExamenEstudiante
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idExamenEstudiante', 'idExamen', 'idEstudiante', 'idEstado'], 'integer'],
            [['hash'], 'safe'],
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
        $query = ExamenEstudiante::find();

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
            'idExamenEstudiante' => $this->idExamenEstudiante,
            'idExamen' => $this->idExamen,
            'idEstudiante' => $this->idEstudiante,
            'idEstado' => $this->idEstado,
        ]);

        $query->andFilterWhere(['like', 'hash', $this->hash]);

        return $dataProvider;
    }
}
