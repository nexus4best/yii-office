<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TblRecive;
use frontend\models\TblReciveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\helpers\Json;

class ReciveController extends Controller
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
        $searchModel = new TblReciveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()) && $model->validate()) {

            if($model->RepairStatus == 'รอตรวจซ่อมจากช่าง'){
                $model->RepairByName = '';
                $model->ReciveAt = date('Y-m-d H:i:s');            
                $model->save();      
                return $this->redirect(array('index'));        
            }else{
                $model->RepairByName = 'อรรคเดช';
                $model->RepairAt = date('Y-m-d H:i:s');
                $model->ReciveAt = date('Y-m-d H:i:s');            
                $model->save();
                return $this->redirect(array('index'));
            }

        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = TblRecive::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
