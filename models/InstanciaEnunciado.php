<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "instanciaEnunciado".
 *
 * @property int $idInstanciaEnunciado
 * @property int $idMetaEnunciado
 * @property string $c1
 * @property string|null $c2
 * @property string|null $c3
 * @property string|null $c4
 * @property string|null $c5
 * @property string|null $c6
 * @property string|null $c7
 * @property string|null $c8
 * @property string|null $c9
 * @property string|null $c10
 * @property string|null $respuesta
 *
 * @property ExamenEstudianteInstancia[] $examenEstudianteInstancias
 * @property MetaEnunciado $idMetaEnunciado0
 */
class InstanciaEnunciado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'instanciaEnunciado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idMetaEnunciado', 'c1'], 'required'],
            [['idMetaEnunciado'], 'integer'],
            [['c1', 'c2', 'c3', 'c4', 'c5', 'c6', 'c7', 'c8', 'c9', 'c10', 'respuesta'], 'string'],
            [['c1'],'unique', 'targetAttribute' =>['idMetaEnunciado','c1', 'c2', 'c3', 'c4', 'c5', 'c6', 'c7', 'c8', 'c9', 'c10']],
            [['idMetaEnunciado'], 'exist', 'skipOnError' => true, 'targetClass' => MetaEnunciado::className(), 'targetAttribute' => ['idMetaEnunciado' => 'idMetaEnunciado']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idInstanciaEnunciado' => 'Id Instancia Enunciado',
            'idMetaEnunciado' => 'Id Meta Enunciado',
            'c1' => 'C1',
            'c2' => 'C2',
            'c3' => 'C3',
            'c4' => 'C4',
            'c5' => 'C5',
            'c6' => 'C6',
            'c7' => 'C7',
            'c8' => 'C8',
            'c9' => 'C9',
            'c10' => 'C10',
            'respuesta' => 'Respuesta',
        ];
    }

    /**
     * Gets query for [[ExamenEstudianteInstancias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExamenEstudianteInstancias()
    {
        return $this->hasMany(ExamenEstudianteInstancia::className(), ['idInstanciaEnunciado' => 'idInstanciaEnunciado']);
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
    
    public function getInstancia(){
         $enunciado=str_replace("<1>", $this->c1, $this->idMetaEnunciado0->enunciado);
         $enunciado=str_replace("<2>", $this->c2, $enunciado);
         $enunciado=str_replace("<3>", $this->c3, $enunciado);
         $enunciado=str_replace("<4>", $this->c4, $enunciado);
         $enunciado=str_replace("<5>", $this->c5, $enunciado);
         $enunciado=str_replace("<6>", $this->c6, $enunciado);
         $enunciado=str_replace("<7>", $this->c7, $enunciado);
         $enunciado=str_replace("<8>", $this->c8, $enunciado);
         $enunciado=str_replace("<9>", $this->c9, $enunciado);
         $enunciado=str_replace("<10>", $this->c10, $enunciado);
         
         return $enunciado;
    }
    
    public function getCantidadInstancias(){
        return $this->getExamenEstudianteInstancias()->count();
    }
}
