<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_products".
 *
 * @property integer $id
 * @property string $id_order
 * @property integer $id_product
 * @property string $prod
 * @property string $name
 * @property string $img
 * @property integer $qty
 * @property string $price
 */
class OrderProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_order', 'id_product', 'qty', 'price'], 'required'],
            [['id_product', 'qty'], 'integer'],
            [['id_order'], 'string', 'max' => 15],
            [['prod', 'name', 'img'], 'string', 'max' => 100],
            [['price'], 'string', 'max' => 20],
        ];
    }

    public function getOrders(){
        return $this->hasOne (Orders::className (),['id' => 'id_order']);
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_order' => 'Id Order',
            'id_product' => 'Id Product',
            'prod' => 'Prod',
            'name' => 'Name',
            'img' => 'Img',
            'qty' => 'Qty',
            'price' => 'Price',
        ];
    }
}
