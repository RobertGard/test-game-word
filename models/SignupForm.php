<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model{
 
    public $username;
    public $password;

    public function rules() 
    {
       return [
          [['username', 'password'], 'required', 'message' => 'Заполните поле'],
          ['username', 'unique', 'targetClass' => User::className(), 'message' => 'Этот логин уже занят']
       ];
    }

    public function attributeLabels() 
    {
       return [
           'username' => 'Логин',
           'password' => 'Пароль',
       ];
    }

    /**
     * Сохранение нового пользователя
     * 
     * @return type
     */
    public function save(){
        $user = new User();
        $user->username = $this->username;
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        return $user->save();
    }
 
}