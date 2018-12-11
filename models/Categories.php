<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $img
 * @property string $description
 * @property string $keywords
 */
class Categories extends \yii\db\ActiveRecord
{
    public $dir;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }


    public function getCategory(){

        return $this->hasOne(Categories::className(),['id'=>'parent_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['img'], 'string', 'max' => 150],
            [['keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская категория',
            'name' => 'Название',
            'img' => 'Изображение',
            'description' => 'Описание',
            'keywords' => 'META Описание',
        ];
    }

    public function getProducts(){

        return $this->hasMany(Products::className(),['category_id'=>'id']);
    }
}
