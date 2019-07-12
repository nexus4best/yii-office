<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\Session;

class TblSend extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'CreatedAt',
                'updatedAtAttribute' => 'UpdatedAt',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function tableName()
    {
        return 'tbl_send';
    }

    public function rules()
    {
        return [
            [['SendBrand', 'SendModel', 'SendSerial', 'SendByName', 'SendFrom', 'SendNumber'], 'required'],
            [['CreatedAt', 'UpdatedAt','SendNavisionAt'], 'safe'],
            [['SendBrand', 'SendModel', 'SendSerial'], 'string', 'max' => 255],
            [['SendByName', 'SendFrom', 'SendNumber', 'SendNavision'], 'string', 'max' => 100],
            [['SendIP'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'SendBrand' => 'ยี่ห้อ',
            'SendModel' => 'รุ่น',
            'SendSerial' => 'หมายเลข',
            'SendByName' => 'ผู้จัดส่ง',
            'SendFrom' => 'ขนส่งโดย',
            'SendNumber' => 'หมายเลข',
            'SendIP' => 'Send Ip',
            'SendNavision' => 'Send Navision',
            'SendNavisionAt' => 'Send Navision At',
            'CreatedAt' => 'Created At',
            'UpdatedAt' => 'Updated At',
        ];
    }

    /*
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['BrnCode' => 'BrnCode']);
    }
    */

    public function sendMail()
    {
        $mail_to = 'thanee@se-ed.com';
        $mail_subject = 'ส่งของเรียบร้อย';

        Yii::$app->mailer->compose('@app/mail/repair/send',[
            'fullname' => 'แจ้งซ่อม ONLINE'
        ])
        ->setFrom([
            'repairing@se-ed.com' => 'แจ้งซ่อม ONLINE'
        ])
        ->setTo(array($mail_to))
        ->setSubject($mail_subject)
        ->send();
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if($insert){
            // new record send
            $this->sendMail();
        } 
        /*
        else {
            //update record
            $this->BrnStatus = 'ส่งของ';
            //$chg_status = $this->BrnStatus;
            if($this->BrnStatus != $changedAttributes['BrnStatus']){
                //update check field
               //$this->sendMail();
            }
        }
        */
        
    }

    public function getRepair()
    {
        return $this->hasOne(TblRepair::className(), ['id' => 'id']);
    }

    // get Data from Reletion
    public function getBrnCode()
    {
        $model=$this->repair;
        return $model?$model->BrnCode:'';
    }


}
