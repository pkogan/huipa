<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ImportarInstanciaForm extends Model
{
    public $archivo;
    

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['archivo', ], 'required'],
            
        ];
    }
     public function attributeLabels()
    {
        return [
            'archivo' => 'Archivo'
            
        ];
    }
   
}


