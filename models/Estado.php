<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado".
 *
 * @property int $idEstado
 * @property string $estado
 *
 * @property ExamenEstudiante[] $examenEstudiantes
 */
class Estado extends \yii\db\ActiveRecord
{
    const ESTADO_INICIAL = 1;
    const ESTADO_ASIGNADO = 2;
    const ESTADO_ENVIADO = 3;
    const ESTADO_RECIBIDO = 4;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'required'],
            [['estado'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEstado' => 'Id Estado',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[ExamenEstudiantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExamenEstudiantes()
    {
        return $this->hasMany(ExamenEstudiante::className(), ['idEstado' => 'idEstado']);
    }
}
