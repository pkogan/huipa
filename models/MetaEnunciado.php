<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "metaEnunciado".
 *
 * @property int $idMetaEnunciado
 * @property string $nombre
 * @property string $enunciado
 *
 * @property ExamenEnunciado[] $examenEnunciados
 * @property InstanciaEnunciado[] $instanciaEnunciados
 */
class MetaEnunciado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metaEnunciado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'enunciado'], 'required'],
            [['enunciado'], 'string'],
            [['nombre'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idMetaEnunciado' => 'Id Meta Enunciado',
            'nombre' => 'Nombre',
            'enunciado' => 'Enunciado',
        ];
    }

    /**
     * Gets query for [[ExamenEnunciados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExamenEnunciados()
    {
        return $this->hasMany(ExamenEnunciado::className(), ['idMetaEnunciado' => 'idMetaEnunciado']);
    }

    /**
     * Gets query for [[InstanciaEnunciados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstanciaEnunciados()
    {
        return $this->hasMany(InstanciaEnunciado::className(), ['idMetaEnunciado' => 'idMetaEnunciado']);
    }
}
