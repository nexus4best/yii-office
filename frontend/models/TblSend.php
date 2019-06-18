<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\Session;

/**
 * This is the model class for table "tbl_send".
 *
 * @property int $id
 * @property string $BrnCode
 * @property string $SendRepair
 * @property string $SendPos
 * @property string $SendBrand
 * @property string $SendModel
 * @property string $SendSerial
 * @property string $SendByName
 * @property string $SendForm
 * @property string $SendNumber
 * @property string $SendIP
 * @property string $SendStatus
 * @property string $SendNavision
 * @property string $CreatedAt
 * @property string $UpdatedAt
 */

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
            [['SendBrand', 'SendModel', 'SendSerial', 'SendByName', 'SendForm', 'SendNumber'], 'required'],
            [['CreatedAt', 'UpdatedAt'], 'safe'],
            [['BrnCode', 'SendPos'], 'string', 'max' => 20],
            [['SendRepair', 'SendBrand', 'SendModel', 'SendSerial'], 'string', 'max' => 255],
            [['SendByName', 'SendForm', 'SendNumber', 'SendNavision'], 'string', 'max' => 100],
            [['SendIP', 'SendStatus'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'BrnCode' => 'Brn Code',
            'SendRepair' => 'Send Repair',
            'SendPos' => 'Send Pos',
            'SendBrand' => 'ยี่ห้อ',
            'SendModel' => 'รุ่น',
            'SendSerial' => 'หมายเลข',
            'SendByName' => 'ผู้จัดส่ง',
            'SendForm' => 'ขนส่งโดย',
            'SendNumber' => 'หมายเลข',
            'SendIP' => 'Send Ip',
            'SendStatus' => 'Send Status',
            'SendNavision' => 'Send Navision',
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

}
