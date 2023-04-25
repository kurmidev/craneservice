<?php

namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

class BaseController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            if (in_array($action->id, ['accessdenied', 'data', 'logout', 'error']))
                                return true;

                            $name = implode("-", [$action->controller->id, $action->id]);
                            return true; //\Yii::$app->user->can($name);
                        }
                    ],
                ],
                'denyCallback' => function () {
                    if (\Yii::$app->user->isGuest) {
                        return \Yii::$app->response->redirect(['site/login']);
                    } else {
                        return \Yii::$app->response->redirect(['site/accessdenied']);
                    }
                }
            ],
        ];
    }
}
