<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public $authKey;
    public $accessToken;
    
    
    public function attributeLabels() {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль пользователя',
            'victories' => 'Количество побед',
            'defeat' => 'Количество поражений',
            'role' => 'Роль',
        ];
    }

    /**
     * Идентификация
     * 
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }
    
    /**
     * Проверяем, админ ли пользователь
     * 
     * @param type $id
     * @return type
     */
    public static function hasAdmin($id){
        $user = self::findOne($id);
        
        return (!empty($user) && $user->role == 'admin') ? TRUE : FALSE;
        
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
    
    /**
     * Поиск пользователя по логину
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    /**
     * Получить id
     * 
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

   
    /**
     * Валидация пароля
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }
    
    /**
     * Обновление счётчика побед
     */
    public function addVictories(){
        $this->updateCounters(['victories' => 1]);
    }
    
    /**
     * Обновление счётчика поражений
     */
    public function addDefeat(){
        $this->updateCounters(['defeat' => 1]);
    }
}
