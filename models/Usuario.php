<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $idUsuario
 * @property string $nombreUsuario
 * @property string $clave
 * @property int $idRol
 *
 * @property Rol $idRol0
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

/**************************************************/
    private $username;

    public function getUsername() {
        return $this->nombreUsuario;
    }

    public static function findByUsername($username) {
        return self::findOne(['nombreUsuario' => $username]);
    }

    public function validatePassword($password) {

        return $this->clave === $password;
    }

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId() {
        return $this->idUsuario;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey() {
        return $this->idUsuario;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    
    /*     * ******************************************************* */    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombreUsuario', 'clave', 'idRol'], 'required'],
            [['idRol'], 'integer'],
            [['nombreUsuario', 'clave'], 'string', 'max' => 100],
            [['nombreUsuario'], 'unique'],
            [['idRol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['idRol' => 'idRol']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUsuario' => 'Id Usuario',
            'nombreUsuario' => 'Nombre Usuario',
            'clave' => 'Clave',
            'idRol' => 'Id Rol',
        ];
    }

    /**
     * Gets query for [[IdRol0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdRol0()
    {
        return $this->hasOne(Rol::className(), ['idRol' => 'idRol']);
    }
}
