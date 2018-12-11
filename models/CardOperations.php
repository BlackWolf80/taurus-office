<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "card_operations".
 *
 * @property int $id
 * @property int $card_number
 * @property string $date
 * @property int $summ
 * @property int $operation_type
 * @property int $note
 */
class CardOperations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card_operations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_number', 'operation_type', 'note'], 'required'],
            [['card_number', 'summ'], 'integer'],
            [['note', 'operation_type'], 'string', 'max' => 50],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'card_number' => 'Номер карты',
            'date' => 'Дата',
            'summ' => 'Сумма',
            'operation_type' => 'Операция',
            'note' => 'Примечание',
        ];
    }

    public function getCard(){
        return $this->hasOne(Cards::className(),['username'=>'card_number']);
    }
}
