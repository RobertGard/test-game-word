<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "word".
 *
 * @property int $id
 * @property string $syllable
 * @property int $string_id
 */
class WordModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'word';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['syllable', 'string_id'], 'required'],
            [['string_id'], 'integer'],
            [['syllable'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'syllable' => 'Syllable',
            'string_id' => 'String ID',
        ];
    }
    
    /**
     * Получение рандомных слов
     * 
     * @param type $limit - Лимит
     * @return type
     */
    public static function getRandWord($limit = 1){
        return Yii::$app->db->createCommand('SELECT * FROM `word` ORDER BY RAND() LIMIT :limit')
                ->bindValues([':limit' => $limit])
                ->queryAll();
    }
}
