<?php

namespace frontend\controllers;

use Yii;
use frontend\models\RicohRepair;
use frontend\models\RicohRepairSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\helpers\Json;


class RicohController extends Controller
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
                        'actions' => ['update'],
                        'allow' => true,
                        'verbs' => ['POST'],
                    ],
                    [
                        'actions' => ['index','view'],
                        'allow' => true,
                      ],
                    [
                        'actions' => ['sendmail','update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new RicohRepairSearch();
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

    public function actionSendmail()
    {
        $data_email = RicohRepair::find()
            ->where('BrnRepair = "Laser Ricoh"')
            ->andWhere('BrnStatus = "แจ้งซ่อม"')
            ->joinWith('branch')->all();

        $session = Yii::$app->session;
        $session->set('data_email', $data_email);

        if(!empty($data_email)){

            Yii::$app->mailer->compose('@app/mail/repair/ricoh',[
                'fullname' => 'แจ้งซ่อม ONLINE'
            ])
            ->setFrom([
                'repairing@se-ed.com' => 'แจ้งซ่อม ONLINE'
            ])
            ->setTo('thanee@se-ed.com')
            ->setSubject('Ricoh')
            ->send(); 

            Yii::$app->db->createCommand('UPDATE tbl_repair SET BrnStatus="SendMail" WHERE BrnRepair="Laser Ricoh" AND BrnStatus="แจ้งซ่อม"')->execute();

            $response = Yii::$app->session->setFlash('success', 'ส่ง Email เรียบร้อย');

        } else {
            $response = Yii::$app->session->setFlash('danger', 'ไม่มีรายการแจ้งซ่อม');
        }

        return $this->redirect(['index'], ['response' => $response]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }        

        if($model->BrnStatus == 'แจ้งซ่อม'){
            $model->scenario = 'ricoh_serial';
            if($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->save();
                return $this->redirect(['index']);
            }
        }elseif($model->BrnStatus == 'SendMail' || $model->BrnStatus == 'ส่งของ'){
            $model->scenario = 'ricoh_job';
            if($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->BrnStatus = 'ส่งของ';
                $model->UserAcceptAt = date('Y-m-d H:i:s');
                $model->save();
                return $this->redirect(['index']);
            }
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = RicohRepair::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
