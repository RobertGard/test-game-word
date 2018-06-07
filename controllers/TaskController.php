<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\StringForm;
use app\components\RegisterMetaData;
use app\models\WordModel;
use yii\helpers\ArrayHelper;
use app\models\StringModel;
use yii\filters\AccessControl;
use app\models\User;
use yii\data\ActiveDataProvider;
/**
 * Description of TaskController
 *
 * @author robert
 */
class TaskController extends Controller{
    
    public function behaviors() {
        return [
            'metaData' => [
                'class' => RegisterMetaData::className(),
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules'=> [
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action){   
                            return User::hasAdmin(\Yii::$app->user->getId());
                        } 
                    ],
                ],
                ]
        ];
    }
    
    public function actionIndex(){

        $this->setMeta('Главная');
        
        // Получаем самое первое задание
        $model = StringModel::find()->orderBy('id ASC')->limit(1)->one();
        
        return $this->render('index', compact('model'));
    }

    /**
     * Создание задания
     * 
     * @return type
     */
    public function actionCreate() {
        $model = new StringForm();
        
        $this->setMeta('Создать задание');
        
            // Получаем текст и загружаем в модель 
            if($model->load(\Yii::$app->request->post())){
               if($model->save()){
                   return $this->refresh();
               } else {
                   Yii::$app->session->setFlash('fail', 'Текст не удалось сохранить !');
                   return $this->render('create', compact('model'));
               }
               return $this->refresh();
            }
        
        return $this->render('create', compact('model'));
    }
    
    /**
     * Детальное отображение одного задания
     * 
     * @param type $id
     */
    public function actionView($id){
        
        $this->setMeta('Отображение задания');
        
        // Если гость , то возврашаем на главную
        if(Yii::$app->user->isGuest){
            return $this->redirect('/user/login');
        }
        
        $model = WordModel::find()->where(['string_id' => $id])->asArray()->all();
        
        //Добавлем рандомные слова
        $result = array_merge(WordModel::getRandWord(3),$model);
        
        // перемешал массив
        shuffle($result);

        
        return $this->render('view', compact('result','id'));
    }
    
    /**
     * Проверка ответа
     * 
     * @param type $id
     * @return type
     */
    public function actionCheckAnswer($id){
        $model = StringModel::findOne($id);
        $user = User::findOne(\Yii::$app->user->getId());
        $this->layout = FALSE;
        
        //Сравнение двух строк
        $result = strcasecmp($model->line, \Yii::$app->request->post('string'));
        
        // Если ответ верный прибавляем к победам, а если нет то к поражениям
        ($result == 0) ? $user->addVictories() : $user->addDefeat();
        
        // Получаем дата провайдер со статисткой пользователя
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->where(['id' => Yii::$app->user->identity->id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        return $this->render('result', [
            'result' => $result,
            'id' => $id,
            'nextUrl' => $model->getNext(), // Для кнопочки «Следующее задание»
            'dataProvider' => $dataProvider,
        ]);
    }
}
