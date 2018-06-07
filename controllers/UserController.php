<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SignupForm;
use app\models\LoginForm;
use app\models\User;
use yii\data\ActiveDataProvider;
use app\components\RegisterMetaData;
/**
 * Description of UserController
 *
 * @author robert
 */
class UserController extends Controller{
    
    public function behaviors() {
        return [
            'metaData' => [
                'class' => RegisterMetaData::className(),
            ],
        ];
    }
    
    /**
     * Отображение статистики пользователя
     * 
     * @return type
     */
    public function actionIndex(){
        
        $this->setMeta('Статистика пользователя');
        
        // Если пользовать гость то редиректи на авторизацию
        if(Yii::$app->user->isGuest){
            return $this->redirect('/user/login');
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->where(['id' => Yii::$app->user->identity->id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        
        return $this->render('index', compact('dataProvider'));
    }

    /**
     * Регистрация пользователя
     * 
     * @return type
     */
    public function actionSignup(){
        
        // Если пользовать уже авторизовался 
        // редиректим на главную
        if(!\Yii::$app->user->isGuest){
            return $this->goHome();
        }
        
        $model = new SignupForm();
        
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            if($model->save()){
                return $this->goHome();
            }
        }
        
        return $this->render('signup', compact('model'));
    }
    
    /**
     * Авторизация пользователя.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        // Если пользовать уже авторизовался 
        // редиректим на главную
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Выход пользователя.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
