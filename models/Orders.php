<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string $name
 * @property string $last_name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $qty
 * @property double $sum
 * @property integer $card_id
 * @property integer $points
 * @property integer $discount
 */
class Orders extends \yii\db\ActiveRecord
{
    public $summary;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'last_name', 'address', 'phone', 'email', 'qty'], 'required'],
            [['address'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['status','qty', 'card_id', 'points', 'discount'], 'integer'],
            [['sum'], 'number'],
            [['name', 'last_name', 'email'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    public function getOrder_products(){
        return $this->hasMany (OrderProducts::className (),['id_order' => 'id']);
    }

    public function getOrderStatus()
    {
        return $this->hasOne(OrderStatus::className(),['id'=>'status']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Заказ',
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
            'status' => 'Статус заказа',
            'qty' => 'Количество',
            'sum' => 'Сумма',
            'card_id' => 'Карта',
            'points' => 'Баллы',
            'discount' => 'Скидка',
            'summary' => 'К оплате',
            'debit' => 'Оплата',
        ];
    }
}
