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
 * @property string $RicohJob
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
            [['BrnSerial','BrnCause'],'required', 'message' => 'โปรดระบุ{attribute}', 'on' => 'ricoh_serial'],
            [['DeleteByName','DeleteCause'], 'required', 'message' => '', 'on' => 'undelete'],
            [['CreatedAt', 'UpdatedAt'], 'safe'],
            [['BrnStatus', 'BrnCode', 'BrnPos', 'DeleteIP','DeleteByName','DeleteCause'], 'string', 'max' => 100],
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
            'CreatedAt' => 'วันที่สร้าง',
            'UpdatedAt' => 'UpdatedAt',
            'DeleteIP' => 'DeleteIP',
            'DeleteByName' => 'CTS',
            'DeleteCause' => 'สาเหตุที่ลบ',
        ];
    }

    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['BrnCode' => 'BrnCode']);
    }

    public function getRicoh()
    {
        return $this->hasOne(TblRicoh::className(), ['id' => 'id']);
    }

    public function getComment()
    {
        return $this->hasOne(TblComment::className(), ['id' => 'id']);
    }
    
/*
    public function getZone()
    {
        return $this->hasOne(TblZone::className(), ['BrnCode' => 'BrnCode']);
    }
*/
}
