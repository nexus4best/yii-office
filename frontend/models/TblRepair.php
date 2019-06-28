<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\Session;

/**
 * This is the model class for table "tbl_repair".
 *
 * @property int $id
 * // AcceptByName @property string $BrnStatus
 * @property string $BrnCode
 * @property string $BrnRepair
 * @property string $BrnPos
 * @property string $BrnBrand
 * @property string $BrnModel
 * @property string $BrnSerial
 * @property string $BrnCause
 * @property string $BrnCreateByName
 * @property string $CreatedAt
 * @property string $UpdatedAt
 * // AcceptByName @property string $AcceptByName
 * // AcceptByName @property string $AcceptAt
 */

class TblRepair extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                //'createdAtAttribute' => 'CreatedAt',
                'updatedAtAttribute' => 'UpdatedAt',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function tableName()
    {
        return 'tbl_repair';
    }

    public function rules()
    {
        return [
            [['AcceptByName'], 'required', 'message' => '', 'on' => 'accept'],
            [['DeleteByName','DeleteCause'], 'required', 'message' => '', 'on' => 'undelete'],
            [['CreatedAt', 'UpdatedAt', 'AcceptAt'], 'safe'],
            [['BrnStatus', 'BrnCode', 'BrnPos', 'AcceptByName','DeleteIP','DeleteByName','DeleteCause'], 'string', 'max' => 100],
            [['BrnRepair', 'BrnBrand', 'BrnModel', 'BrnSerial', 'BrnCause', 'BrnCreateByName'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'เลขที่',
            'BrnCode' => 'รหัสสาขา',
            'BrnStatus' => 'สถานะ',
            'BrnRepair' => 'รายการ',
            'BrnPos' => 'เครื่อง',
            'BrnBrand' => 'ยี่ห้อ',
            'BrnModel' => 'รุ่น',
            'BrnSerial' => 'หมายเลข',
            'BrnCause' => 'สาเหตุ',
            'BrnCreateByName' => 'ผู้จัดทำ',
            'AcceptByName' => 'ผู้รับเรื่อง',
            'AcceptAt' => 'User Accept At',
            'DeleteIP' => 'DeleteIP',
            'DeleteByName' => 'CTS',
            'DeleteCause' => 'สาเหตุที่ลบ',
            'CreatedAt ' => 'วันที่สร้าง',
            'UpdatedAt ' => 'UpdatedAt',
        ];
    }

    // sendMail
    public function sendMail()
    {
        $mail_to = 'thanee@se-ed.com';
        $mail_subject = 'ส่งของเรียบร้อย';

        Yii::$app->mailer->compose('@app/mail/repair/accept',[
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
            // new record
        } else {
            //update record
            $this->BrnStatus = 'ส่งของ';
            //$chg_status = $this->BrnStatus;
            if($this->BrnStatus != $changedAttributes['BrnStatus']){
                //update check field
               //$this->sendMail();
            }
        }
        
    }

    // relation db
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['BrnCode' => 'BrnCode']);
    }

    public function getSend()
    {
        return $this->hasOne(TblSend::className(), ['id' => 'id']);
    }

    public function getComment()
    {
        return $this->hasOne(TblComment::className(), ['id' => 'id']);
    }

    // get Data from Reletion
    public function getSendCreatedAt()
    {
        $model=$this->send;
        return $model?$model->CreatedAt:'';
    }

    public function getSendByName()
    {
        $model=$this->send;
        return $model?$model->SendByName:'';
    }

}
