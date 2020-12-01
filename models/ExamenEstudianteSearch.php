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
    public $apellidoNombre;
    public $legajo;
    public $mail;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idExamenEstudiante', 'idExamen', 'idEstudiante', 'idEstado'], 'integer'],
            [['hash','apellidoNombre','legajo','mail'], 'safe'],
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
        $query->joinWith('idEstudiante0');
        // grid filtering conditions
        $query->andFilterWhere([
            'idExamenEstudiante' => $this->idExamenEstudiante,
            'idExamen' => $this->idExamen,
            'idEstudiante' => $this->idEstudiante,
            'idEstado' => $this->idEstado,
        ]);

        $query->andFilterWhere(['like', 'hash', $this->hash])
                ->andFilterWhere(['like','estudiante.apellidoNombre', $this->apellidoNombre])
                ->andFilterWhere(['like','estudiante.mail', $this->mail])
                ->andFilterWhere(['like','estudiante.legajo', $this->legajo])
                ;

        return $dataProvider;
    }
}
