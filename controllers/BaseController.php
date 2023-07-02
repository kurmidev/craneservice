<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\components\ConstFunc as F;

class BaseController extends Controller
{

    public $is_pdf = false;
    public $is_csv = false;

    public function init()
    {
        parent::init();
        $this->is_pdf = Yii::$app->request->get('is_pdf');
        $this->is_csv = Yii::$app->request->get('is_csv');
    }


    public function setReportRender($content = null, $filename, $dataProvider = null, $gridColumns = null)
    {
        if ($this->is_pdf) {
            return  F::printPdf($content, $filename);
        } else if ($this->is_csv) {
            return F::printCsv($dataProvider, $gridColumns, $filename);
        }
        return $content;
    }

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
