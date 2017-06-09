<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_categoria".
 *
 * @property integer $idCategoria
 * @property string $nombre
 *
 * @property TblArticulo[] $tblArticulos
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_categoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCategoria' => Yii::t('app', 'Id Categoria'),
            'nombre' => Yii::t('app', 'Nombre'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblArticulos()
    {
        return $this->hasMany(Articulo::className(), ['idCategoria' => 'idCategoria']);
    }

    /**
     * @inheritdoc
     * @return CategoriaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoriaQuery(get_called_class());
    }
}
