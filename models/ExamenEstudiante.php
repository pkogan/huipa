<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "examenEstudiante".
 *
 * @property int $idExamenEstudiante
 * @property int $idExamen
 * @property int $idEstudiante
 * @property string $hash
 * @property int $idEstado 
 *
 * @property Estudiante $idEstudiante0
 * @property Examen $idExamen0
 * @property Estado $idEstado0 
 * @property ExamenEstudianteInstancia[] $examenEstudianteInstancias
 */
class ExamenEstudiante extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'examenEstudiante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['idExamen', 'idEstudiante', 'hash'], 'required'],
            [['idExamen', 'idEstudiante', 'idEstado'], 'integer'],
            [['idEstudiante'],'unique','targetAttribute' =>['idExamen', 'idEstudiante']],
            [['hash'], 'string', 'max' => 32],
            [['hash'], 'unique'],
            [['idEstudiante'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiante::className(), 'targetAttribute' => ['idEstudiante' => 'idEstudiante']],
            [['idExamen'], 'exist', 'skipOnError' => true, 'targetClass' => Examen::className(), 'targetAttribute' => ['idExamen' => 'idExamen']],
            [['idEstado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['idEstado' => 'idEstado']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'idExamenEstudiante' => 'Id Examen Estudiante',
            'idExamen' => 'Id Examen',
            'idEstudiante' => 'Estudiante',
            'hash' => 'Hash',
        ];
    }

    /**
     * Gets query for [[IdEstudiante0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstudiante0() {
        return $this->hasOne(Estudiante::className(), ['idEstudiante' => 'idEstudiante']);
    }

    /**
     * Gets query for [[IdExamen0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdExamen0() {
        return $this->hasOne(Examen::className(), ['idExamen' => 'idExamen']);
    }

    /**
     * Gets query for [[IdEstado0]]. 
     * 
     * @return \yii\db\ActiveQuery 
     */
    public function getIdEstado0() {
        return $this->hasOne(Estado::className(), ['idEstado' => 'idEstado']);
    }

    /**
     * Gets query for [[ExamenEstudianteInstancias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExamenEstudianteInstancias() {
        return $this->hasMany(ExamenEstudianteInstancia::className(), ['idExamenEstudiante' => 'idExamenEstudiante']);
    }

    public function getLink() {
        return \yii\helpers\Url::base('http') . '/examen-estudiante/view?hash=' . $this->hash;
    }
    public function getLinkpdf() {
        return $this->getLink().'&pdf=true';
    }

}
