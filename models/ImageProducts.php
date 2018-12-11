<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image_products".
 *
 * @property integer $id
 * @property string $id_prod
 * @property string $name
 * @property string $img
 * @property string $price
 * @property integer $avalible
 * @property integer $reserv
 * @property integer $discount
 * @property integer $status
 * @property string $date
 * @property integer $new
 * @property integer $hit
 * @property integer $sales
 */
class ImageProducts extends \yii\db\ActiveRecord
{
    public $dir;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_prod', 'name', 'discount','avalible', 'reserv', 'discount'], 'required'],
            [['avalible', 'reserv', 'discount', 'status', 'new', 'hit', 'sales'], 'integer'],
            [['date'], 'safe'],
            [['id_prod', 'price'], 'string', 'max' => 10],
            [['name', 'img'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_prod' => 'Продукт',
            'name' => 'Вид',
            'img' => 'Изображение',
            'price' => 'Цена',
            'avalible' => 'Наличие',
            'reserv' => 'Резерв',
            'discount' => 'Скидка',
            'status' => 'Статус',
            'date' => 'Дата',
            'new' => 'Новинка',
            'hit' => 'Хит',
            'sales' => 'Распродажа',
        ];
    }

    public function getProducts(){
        return $this->hasOne(Products::className(),['id'=>'id_prod']);
    }

}
