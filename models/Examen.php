<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "examen".
 *
 * @property int $idExamen
 * @property string $nombre
 * @property string $descripcion
 * @property string $fecha
 * @property int $idTemplate
 * @property string|null $cco
 *
 * @property ExamenEnunciado[] $examenEnunciados
 * @property ExamenEstudiante[] $examenEstudiantes
 */
class Examen extends \yii\db\ActiveRecord
{
    const TOPE_MAIL_LOTE=50;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'examen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'fecha', 'idTemplate'], 'required'],
            [['descripcion'], 'string'],
            [['fecha'], 'safe'],
            [['idTemplate'], 'integer'],
            [['nombre'], 'string', 'max' => 200],
            [['cco'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idExamen' => 'Id Examen',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'fecha' => 'Fecha',
            'idTemplate' => 'Id Template',
            'cco' => 'Cco',
        ];
    }

    /**
     * Gets query for [[ExamenEnunciados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExamenEnunciados()
    {
        return $this->hasMany(ExamenEnunciado::className(), ['idExamen' => 'idExamen']);
    }

    /**
     * Gets query for [[ExamenEstudiantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExamenEstudiantes()
    {
        return $this->hasMany(ExamenEstudiante::className(), ['idExamen' => 'idExamen']);
    }
    
     public function getExamenesEstudiantesEstado($idEstado=null){
         if($idEstado==null){
            return $this->getCertificados();
        }else{
            return $this->hasMany(ExamenEstudiante::className(), ['idExamen' => 'idExamen'])
                    ->andOnCondition(['examenEstudiante.idEstado'=>$idEstado]);
        }
    }
    
    public function getCountExamenesEstudiantes($idEstado=null)
    {
        if($idEstado==null){
            return $this->getExamenEstudiantes()->count();
        }else{
            return $this->getExamenesEstudiantesEstado($idEstado)->count();
        }
        
    }
    
    
}
