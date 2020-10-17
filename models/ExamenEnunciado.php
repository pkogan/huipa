<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "examenEnunciado".
 *
 * @property int $idExamenEnunciado
 * @property int $idExamen
 * @property int $idMetaEnunciado
 *
 * @property Examen $idExamen0
 * @property MetaEnunciado $idMetaEnunciado0
 */
class ExamenEnunciado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'examenEnunciado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idExamen', 'idMetaEnunciado'], 'required'],
            [['idExamen', 'idMetaEnunciado'], 'integer'],
            [['idMetaEnunciado'], 'unique','targetAttribute' =>['idExamen', 'idMetaEnunciado']],

            [['idExamen'], 'exist', 'skipOnError' => true, 'targetClass' => Examen::className(), 'targetAttribute' => ['idExamen' => 'idExamen']],
            [['idMetaEnunciado'], 'exist', 'skipOnError' => true, 'targetClass' => MetaEnunciado::className(), 'targetAttribute' => ['idMetaEnunciado' => 'idMetaEnunciado']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idExamenEnunciado' => 'Examen Enunciado',
            'idExamen' => 'Id Examen',
            'idMetaEnunciado' => 'Meta Enunciado',
        ];
    }

    /**
     * Gets query for [[IdExamen0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdExamen0()
    {
        return $this->hasOne(Examen::className(), ['idExamen' => 'idExamen']);
    }

    /**
     * Gets query for [[IdMetaEnunciado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdMetaEnunciado0()
    {
        return $this->hasOne(MetaEnunciado::className(), ['idMetaEnunciado' => 'idMetaEnunciado']);
    }
}
