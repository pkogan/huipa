<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "examenEstudianteInstancia".
 *
 * @property int $idExamenEstudianteInstancia
 * @property int $idExamenEstudiante
 * @property int $idInstanciaEnunciado
 *
 * @property ExamenEstudiante $idExamenEstudiante0
 * @property InstanciaEnunciado $idInstanciaEnunciado0
 */
class ExamenEstudianteInstancia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'examenEstudianteInstancia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idExamenEstudiante', 'idInstanciaEnunciado'], 'required'],
            [['idExamenEstudiante', 'idInstanciaEnunciado'], 'integer'],
            [['idExamenEstudiante'], 'exist', 'skipOnError' => true, 'targetClass' => ExamenEstudiante::className(), 'targetAttribute' => ['idExamenEstudiante' => 'idExamenEstudiante']],
            [['idInstanciaEnunciado'], 'exist', 'skipOnError' => true, 'targetClass' => InstanciaEnunciado::className(), 'targetAttribute' => ['idInstanciaEnunciado' => 'idInstanciaEnunciado']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idExamenEstudianteInstancia' => 'Id Examen Estudiante Instancia',
            'idExamenEstudiante' => 'Id Examen Estudiante',
            'idInstanciaEnunciado' => 'Id Instancia Enunciado',
        ];
    }

    /**
     * Gets query for [[IdExamenEstudiante0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdExamenEstudiante0()
    {
        return $this->hasOne(ExamenEstudiante::className(), ['idExamenEstudiante' => 'idExamenEstudiante']);
    }

    /**
     * Gets query for [[IdInstanciaEnunciado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdInstanciaEnunciado0()
    {
        return $this->hasOne(InstanciaEnunciado::className(), ['idInstanciaEnunciado' => 'idInstanciaEnunciado']);
    }
}
