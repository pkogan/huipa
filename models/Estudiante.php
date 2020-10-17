<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estudiante".
 *
 * @property int $idEstudiante
 * @property string $apellidoNombre
 * @property string|null $mail
 * @property string|null $dni
 * @property string|null $legajo
 *
 * @property ExamenEstudiante[] $examenEstudiantes
 */
class Estudiante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estudiante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apellidoNombre'], 'required'],
            [['apellidoNombre', 'mail'], 'string', 'max' => 200],
            [['dni', 'legajo'], 'string', 'max' => 20],
            [['dni'], 'unique'],
            [['legajo'], 'unique'],
            [['mail'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEstudiante' => 'Id Estudiante',
            'apellidoNombre' => 'Apellido Nombre',
            'mail' => 'Mail',
            'dni' => 'Dni',
            'legajo' => 'Legajo',
        ];
    }

    /**
     * Gets query for [[ExamenEstudiantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExamenEstudiantes()
    {
        return $this->hasMany(ExamenEstudiante::className(), ['idEstudiante' => 'idEstudiante']);
    }
}
