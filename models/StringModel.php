<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "string".
 *
 * @property int $id
 * @property string $line
 */
class StringModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'string';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['line'], 'required'],
            [['line'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'line' => 'Line',
        ];
    }
    
    /**
     * Получить Url следуещего задания
     * 
     * @return type
     */
    public function getNext() {
        $next = $this->find()->where(['>', 'id', $this->id])->orderBy('id')->one();
        if (isset($next))
            return Url::toRoute(['/task/view', 'id' => $next->id]); // абсолютный роут вне зависимости от текущего контроллера 
        else return null;
    }
}
