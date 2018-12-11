<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property string $id
 * @property integer $category_id
 * @property string $name
 * @property string $img
 * @property string $description
 * @property string $keywords
 * @property integer $status
 */
class Products extends \yii\db\ActiveRecord
{
    public $dir;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'name', 'description'], 'required'],
            [['category_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['id'], 'string', 'max' => 10],
            [['name', 'img', 'keywords'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID товара',
            'category_id' => 'Категория',
            'name' => 'Название',
            'img' => 'Изображение',
            'description' => 'Описание',
            'keywords' => 'Ключи',
            'status' => 'Статус',
        ];
    }


    public function getCategory(){

        return $this->hasOne(Categories::className(),['id'=>'category_id']);
    }

    public function getImageProducts(){
        return $this->hasMany(ImageProducts::className(),['id_prod'=>'id']);
    }

    public function getComments(){
        return $this->hasMany(Comments::className(),['product_id'=>'id']);
    }

    public function getProperty(){
        return $this->hasMany(Property::className(),['product_id'=>'id']);
    }

}
