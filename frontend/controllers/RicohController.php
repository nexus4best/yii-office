<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TblRicoh;
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
                        'actions' => ['update','undelete','openjob'],
                        'allow' => true,
                        'verbs' => ['POST'],
                    ],
                    [
                        'actions' => ['index','view'],
                        'allow' => true,
                      ],
                    [
                        'actions' => ['sendmail','update','undelete','openjob'],
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
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    // อย่าลืมเปลี่ยน Email
    public function actionSendmail()
    {
        $data_email = RicohRepair::find()
            ->joinWith('zone')
            ->where('BrnRepair = "เครื่องพิมพ์เอกสาร-RICOH"')
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
            
            /* update ricoh all status SendMail */
            $update_date = date('Y-m-d H:i:s');

            Yii::$app->db->createCommand("UPDATE tbl_repair SET BrnStatus='SendMail' , AcceptAt ='$update_date' WHERE BrnRepair='เครื่องพิมพ์เอกสาร-RICOH' AND BrnStatus='แจ้งซ่อม'")->execute();

            $response = Yii::$app->session->setFlash('success', 'ส่ง Email เรียบร้อย');

        } else {
            $response = Yii::$app->session->setFlash('danger', 'ไม่มีรายการแจ้งซ่อม');
        }

        return $this->redirect(['index'], ['response' => $response]);
    }

    public function actionOpenjob($id)
    {
        $model = $this->findModel($id);
        $new_ricoh = new TblRicoh;

        if(Yii::$app->request->isAjax && $new_ricoh->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($new_ricoh);
        }   
        
        if($new_ricoh->load(Yii::$app->request->post()) && $new_ricoh->validate()) {

            $model->BrnStatus = 'ส่งของ';
            $model->save();

            $new_ricoh->id = $model->id;
            $new_ricoh->save();

            return $this->redirect(['index']);
        }else{
            return $this->renderAjax('openjob', [
                'model' => $model,
                'new_ricoh' => $new_ricoh,
            ]);
        }    

    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'ricoh_serial';

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }   
        
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->redirect(['index']);
        }else{
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }    

    }

    public function actionUndelete($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'undelete';

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->BrnStatus = 'ลบ';
            $model->DeleteIP = Yii::$app->getRequest()->getUserIP();
            
            $model->save();
            
            Yii::$app->session->setFlash('danger', 'ลบแจ้งซ่อม '.'<b>'.$model->BrnRepair.' </b>เลขที่<b> '.$model->id.' </b>เรียบร้อย');
            //return $this->redirect([Yii::$app->session->get('__returnUrl')]);
            return $this->redirect(array('index'));

        } else {
            return $this->renderAjax('_form_undelete', [
                'model' => $model,
            ]);
        }

    }

    protected function findModel($id)
    {
        if (($model = RicohRepair::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
