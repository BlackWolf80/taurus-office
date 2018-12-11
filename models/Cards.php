<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cards".
 *
 * @property integer $id
 * @property integer $username
 * @property string $name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property integer $points
 * @property string $password
 * @property string $auth_key
 */

class Cards extends \yii\db\ActiveRecord
{
    public $button;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cards';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'name', 'last_name', 'password'], 'required'],
            [['username', 'points'], 'integer'],
            [['address'], 'string'],
            [['name', 'last_name', 'password', 'auth_key'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'username' => 'Номер карты',
            'name' => 'Имя владельца',
            'last_name' => 'Фамилия владельца',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'address' => 'Адрес',
            'points' => 'Баллы',
            'password' => 'Пароль',
            'auth_key' => 'Auth Key',
            'button' => 'Печать бланка',
        ];
    }




}
