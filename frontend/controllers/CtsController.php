<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TblSend;
use frontend\models\TblRepair;
use frontend\models\TblRepairSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\helpers\Json;
use yii\web\Session;

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
                        'actions' => ['index','view'],
                        'allow' => true,
                      ],
                    [
                        'actions' => ['useraccept','send'],
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

    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }    

    public function actionSend($id)
    {
        $model = $this->findModel($id);
        $new_send = new TblSend;

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()) && $new_send->load(Yii::$app->request->post()) && $new_send->validate()) {

            // tbl_repair
            $model->BrnStatus = 'ส่งของ';
            $model->save();

            // tbl_send
            $new_send->id = $model->id;
            $new_send->SendStatus = 'ส่งของ';
            $new_send->SendIP = Yii::$app->getRequest()->getUserIP();
            $new_send->BrnCode = $model->BrnCode;
            $new_send->SendPos = $model->BrnPos;
            $new_send->SendRepair = $model->BrnRepair;
            $new_send->save();
            
            Yii::$app->session->setFlash('success', 'ส่งของแจ้งซ่อม '.'<b>'.$model->BrnRepair.' </b>เลขที่<b> '.$model->id.' </b>เรียบร้อย');
            return $this->redirect([Yii::$app->session->get('__returnUrl')]);
            //return $this->redirect(array('index'));

        } else {
            return $this->renderAjax('_form_send', [
                'model' => $model,
                'new_send' => $new_send,
            ]);
        }        
    }

    public function actionUseraccept($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->BrnStatus = 'รับเรื่อง';
            $model->UserAcceptAt = date('Y-m-d H:i:s');
            
            $model->save();
            
            Yii::$app->session->setFlash('info', 'รับเรื่องแจ้งซ่อม '.'<b>'.$model->BrnRepair.' </b>เลขที่<b> '.$model->id.' </b>เรียบร้อย');
            return $this->redirect([Yii::$app->session->get('__returnUrl')]);
            //return $this->redirect(array('index'));

        } else {
            return $this->renderAjax('_form_user_accept', [
                'model' => $model,
            ]);
        }

    }

/*    
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
*/

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

/*
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
*/

    protected function findModel($id)
    {
        if (($model = TblRepair::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
