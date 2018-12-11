<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "property".
 *
 * @property integer $id
 * @property string $product_id
 * @property string $name
 * @property string $value
 * @property string $unit
 */
class Property extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'property';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id'], 'string', 'max' => 10],
            [['name', 'value'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'ID продукта',
            'name' => 'Наименование',
            'value' => 'Величина',
            'unit' => 'Ед.измерения',
        ];
    }
    public function getProduct(){

        return $this->hasOne(Products::className(),['id'=>'product_id']);
    }
}
