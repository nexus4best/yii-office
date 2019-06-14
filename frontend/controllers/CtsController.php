<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TblRepair;
use frontend\models\TblRepairSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\helpers\Json;

class CtsController extends Controller
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
            
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                //'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['useraccept'],
                        'allow' => true,
                        'verbs' => ['POST'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                      ],
                    [
                        'actions' => ['useraccept'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        
        ];
    }

    public function actionIndex()
    {
        $searchModel = new TblRepairSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUseraccept($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $userAccept = explode(" ", $model->UserAccept);
            $model->UserAccept = $userAccept[0];
            $model->BrnStatus = 'รับเรื่อง';
            $model->UserAcceptAt = date('Y-m-d H:i:s');
            
            $model->save();
            Yii::$app->session->setFlash('success', 'รับเรื่องแจ้งซ่อม '.'<b>'.$model->BrnRepair.' </b>เลขที่<b> '.$model->id.' </b>เรียบร้อย');
            return $this->redirect(['index']);

        } else {
            return $this->renderAjax('_form_user_accept', [
                'model' => $model,
            ]);
        }

    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new TblRepair();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

/*
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
*/
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = TblRepair::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
