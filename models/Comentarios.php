<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_comentarios".
 *
 * @property integer $id
 * @property string $comentario
 * @property integer $user_id
 * @property integer $articulo_id
 * @property integer $aprobado
 * @property string $fec_creacion
 * @property string $fec_modificacion
 *
 * @property TblArticulo $articulo
 * @property TblUsuario $user
 */
class Comentarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_comentarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'comentario', 'user_id', 'articulo_id', 'aprobado'], 'required'],
            [['id', 'user_id', 'articulo_id', 'aprobado'], 'integer'],
            [['fec_creacion', 'fec_modificacion'], 'safe'],
            [['comentario'], 'string', 'max' => 2000],
            [['articulo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['articulo_id' => 'idArticulo']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'comentario' => Yii::t('app', 'Comentario'),
            'user_id' => Yii::t('app', 'User ID'),
            'articulo_id' => Yii::t('app', 'Articulo ID'),
            'aprobado' => Yii::t('app', 'Aprobado'),
            'fec_creacion' => Yii::t('app', 'Fec Creacion'),
            'fec_modificacion' => Yii::t('app', 'Fec Modificacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticulo()
    {
        return $this->hasOne(Articulo::className(), ['idArticulo' => 'articulo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return ComentariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ComentariosQuery(get_called_class());
    }
}
