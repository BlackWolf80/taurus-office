<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $date
 * @property string $title
 * @property string $spoiler
 * @property string $body
 * @property integer $status
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'title', 'spoiler', 'body'], 'required'],
            [['spoiler', 'body'], 'string'],
            [['status'], 'integer'],
            [['date'], 'string', 'max' => 20],
            [['title'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'title' => 'Заголовок',
            'spoiler' => 'Анонс',
            'body' => 'Подробно',
            'status' => 'Статус',
        ];
    }
}
