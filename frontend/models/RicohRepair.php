<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tbl_repair".
 *
 * @property int $id
 * @property string $BrnStatus
 * @property string $BrnCode
 * @property string $BrnRepair
 * @property string $BrnPos
 * @property string $BrnBrand
 * @property string $BrnModel
 * @property string $BrnSerial
 * @property string $BrnCause
 * @property string $BrnUserCreate
 * @property string $CreatedAt
 * @property string $UpdatedAt
 * @property string $UserAccept
 * @property string $UserAcceptAt
 */
class RicohRepair extends \yii\db\ActiveRecord
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
            [['BrnSerial'],'required', 'message' => 'โปรดระบุ{attribute}', 'on' => 'ricoh_serial'],
            [['RicohJob','UserAccept'],'required', 'message' => 'โปรดระบุ{attribute}', 'on' => 'ricoh_job'],
            [['CreatedAt', 'UpdatedAt', 'UserAcceptAt'], 'safe'],
            [['RicohJob'], 'string', 'max' => 10],
            [['BrnStatus', 'BrnCode', 'BrnPos', 'UserAccept'], 'string', 'max' => 100],
            [['BrnRepair', 'BrnBrand', 'BrnModel', 'BrnSerial', 'BrnCause', 'BrnUserCreate'], 'string', 'max' => 255],
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
            'BrnUserCreate' => 'ผู้จัดทำ',
            'CreatedAt ' => 'วันที่สร้าง',
            'UpdatedAt ' => 'UpdatedAt',
            'UserAccept' => 'ผู้รับเรื่อง',
            'UserAcceptAt' => 'User Accept At',
            'RicohJob' => 'Job',
        ];
    }

    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['BrnCode' => 'BrnCode']);
    }
    
}
