<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property string $product_id
 * @property string $user_name
 * @property string $comment_text
 * @property string $email
 * @property string $comment_date
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment_text'], 'string'],
            [['product_id'], 'string', 'max' => 10],
            [['user_name'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 150],
            [['comment_date'], 'string', 'max' => 20],
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
            'user_name' => 'Автор',
            'comment_text' => 'Комментарий',
            'email' => 'E-mail',
            'comment_date' => 'Дата',
        ];

    }

        public function getProduct(){

        return $this->hasOne(Products::className(),['id'=>'product_id']);
    }

}
