<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use common\models\Apple;
use common\service\FruitService;
use common\models\FruitRepository;

class AppleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow'   => true,
                    ],
                    [
                        'actions' => [
                            'logout',
                            'index',
                            'generate',
                            'get-list',
                            'drop',
                            'eat',
                            'rot',
                        ],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Apples list
     *
     * @return string
     */
    public function actionGetList()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->request->isAjax) {
            return FruitRepository::getList();
        }
    }

    /**
     * Falling to the ground
     *
     * @return string
     */
    public function actionDrop($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->request->isAjax) {
            FruitService::drop($id);
            return FruitRepository::getList();
        }
    }

    /**
     * Eating current apple
     *
     * @return string
     */
    public function actionEat($id, $eat = 0)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->request->isAjax) {
            $status = FruitService::eat($id, $eat);
            return ['status' => $status];
        }
    }

    /**
     * Generate apples
     *
     * @return string
     */
    public function actionGenerate()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->request->isAjax) {
            FruitRepository::generate();
            return FruitRepository::getList();
        }
    }

    /**
     * Spoiled
     * Maybe cron job
     *
     * @return null
     */
    public function actionSpoiled($id)
    {
        FruitService::spoiler();
    }

}
