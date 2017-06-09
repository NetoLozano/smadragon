<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_usuario".
 *
 * @property integer $id
 * @property string $nombres
 * @property string $a_paterno
 * @property string $a_materno
 * @property string $fec_nacimiento
 * @property string $correo
 * @property string $contra
 * @property string $nickname
 * @property string $fec_creacion
 * @property string $fec_modificacion
 * @property integer $rol
 * @property integer $suspendido
 *
 * @property TblArticulo[] $tblArticulos
 * @property TblComentarios[] $tblComentarios
 * @property TblArticulo $id0
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombres', 'a_paterno', 'a_materno', 'fec_nacimiento', 'correo', 'contra', 'rol', 'suspendido'], 'required'],
            [['fec_nacimiento', 'fec_creacion', 'fec_modificacion'], 'safe'],
            [['rol', 'suspendido'], 'integer'],
            [['nombres', 'a_paterno', 'a_materno'], 'string', 'max' => 50],
            [['correo'], 'string', 'max' => 300],
            [['contra'], 'string', 'max' => 16],
            [['nickname'], 'string', 'max' => 200],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => 
            Articulo::className(), 'targetAttribute' => ['id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombres' => Yii::t('app', 'Nombres'),
            'a_paterno' => Yii::t('app', 'A Paterno'),
            'a_materno' => Yii::t('app', 'A Materno'),
            'fec_nacimiento' => Yii::t('app', 'Fec Nacimiento'),
            'correo' => Yii::t('app', 'Correo'),
            'contra' => Yii::t('app', 'Contra'),
            'nickname' => Yii::t('app', 'Nickname'),
            'fec_creacion' => Yii::t('app', 'Fec Creacion'),
            'fec_modificacion' => Yii::t('app', 'Fec Modificacion'),
            'rol' => Yii::t('app', 'Rol'),
            'suspendido' => Yii::t('app', 'Suspendido'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblArticulos()
    {
        return $this->hasMany(Articulo::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Articulo::className(), ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UsuarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuarioQuery(get_called_class());
    }
}
