<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TblFind;
use frontend\models\TblFindSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class FindController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $searchModel = new TblFindSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProviderSend = $searchModel->searchSend(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderSend' => $dataProviderSend,
        ]);
    }

    public function actionRecive()
    {
        $searchModel = new TblFindSearch();
        $dataProviderRecive = $searchModel->searchRecive(Yii::$app->request->queryParams);
        $dataProviderCount = $searchModel->searchCount(Yii::$app->request->queryParams);

        return $this->render('recive', [
            'searchModel' => $searchModel,
            'dataProviderRecive' => $dataProviderRecive,
            'dataProviderCount' => $dataProviderCount,
        ]);
    }



    protected function findModel($id)
    {
        if (($model = TblFind::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
