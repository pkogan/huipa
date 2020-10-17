<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Estudiante;

/**
 * EstudianteSearch represents the model behind the search form of `app\models\Estudiante`.
 */
class EstudianteSearch extends Estudiante
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEstudiante'], 'integer'],
            [['apellidoNombre', 'mail', 'dni', 'legajo'], 'safe'],
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
        $query = Estudiante::find();

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
            'idEstudiante' => $this->idEstudiante,
        ]);

        $query->andFilterWhere(['like', 'apellidoNombre', $this->apellidoNombre])
            ->andFilterWhere(['like', 'mail', $this->mail])
            ->andFilterWhere(['like', 'dni', $this->dni])
            ->andFilterWhere(['like', 'legajo', $this->legajo]);

        return $dataProvider;
    }
}
