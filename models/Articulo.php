<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_articulo".
 *
 * @property integer $idArticulo
 * @property string $titulo
 * @property string $contenido
 * @property string $fec_creacion
 * @property string $fec_modificacion
 * @property string $fuente
 * @property integer $user_id
 * @property integer $idCategoria
 * @property integer $aprobado
 *
 * @property TblUsuario $user
 * @property TblCategoria $idCategoria0
 * @property TblComentarios[] $tblComentarios
 * @property TblUsuario $tblUsuario
 */
class Articulo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_articulo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'contenido', 'user_id', 'idCategoria', 'aprobado'], 'required'],
            [['fec_creacion', 'fec_modificacion'], 'safe'],
            [['user_id', 'idCategoria', 'aprobado'], 'integer'],
            [['titulo'], 'string', 'max' => 500],
            [['contenido'], 'string', 'max' => 5000],
            [['fuente'], 'string', 'max' => 150],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['idCategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['idCategoria' => 'idCategoria']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idArticulo' => Yii::t('app', 'Id Articulo'),
            'titulo' => Yii::t('app', 'Titulo'),
            'contenido' => Yii::t('app', 'Contenido'),
            'fec_creacion' => Yii::t('app', 'Fec Creacion'),
            'fec_modificacion' => Yii::t('app', 'Fec Modificacion'),
            'fuente' => Yii::t('app', 'Fuente'),
            'user_id' => Yii::t('app', 'User ID'),
            'idCategoria' => Yii::t('app', 'Id Categoria'),
            'aprobado' => Yii::t('app', 'Aprobado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategoria0()
    {
        return $this->hasOne(Categoria::className(), ['idCategoria' => 'idCategoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['articulo_id' => 'idArticulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return ArticuloQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArticuloQuery(get_called_class());
    }
}
