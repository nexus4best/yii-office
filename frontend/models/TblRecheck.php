<?php

namespace frontend\models;


use Yii;

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
 * @property string $BrnCreateByName
 * @property string $AcceptAt
 * @property string $AcceptByName
 * @property string $DeleteByName
 * @property string $DeleteCause
 * @property string $DeleteIP
 * @property string $ReciveAt
 * @property string $RepairAt
 * @property string $RepairStatus
 * @property string $RepairReport
 * @property string $RepairByName
 * @property string $CreatedAt
 * @property string $UpdatedAt
 */
class TblRecheck extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_repair';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RepairReport', 'RepairStatus', 'BrnSerial', 'BrnCause', 'RepairByName'], 'required'],
            [['id'], 'integer'],
            [['AcceptAt', 'ReciveAt', 'RepairAt', 'CreatedAt', 'UpdatedAt'], 'safe'],
            [['BrnStatus', 'BrnPos', 'AcceptByName', 'DeleteByName', 'DeleteIP'], 'string', 'max' => 50],
            [['BrnCode'], 'string', 'max' => 20],
            [['BrnRepair', 'BrnBrand', 'BrnModel', 'BrnSerial', 'BrnCause', 'BrnCreateByName', 'DeleteCause'], 'string', 'max' => 255],
            [['RepairStatus', 'RepairByName'], 'string', 'max' => 100],
            [['RepairReport'], 'string', 'max' => 150],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'เลขที่',
            'BrnStatus' => 'Brn Status',
            'BrnCode' => 'รหัสสาขา',
            'BrnRepair' => 'รายการ',
            'BrnPos' => 'เครื่อง',
            'BrnBrand' => 'ยี่ห้อ',
            'BrnModel' => 'รุ่น',
            'BrnSerial' => 'หมายเลข',
            'BrnCause' => 'สาเหตุ',
            'BrnCreateByName' => 'Brn Create By Name',
            'AcceptAt' => 'Accept At',
            'AcceptByName' => 'Accept By Name',
            'DeleteByName' => 'Delete By Name',
            'DeleteCause' => 'Delete Cause',
            'DeleteIP' => 'Delete Ip',
            'ReciveAt' => 'วันที่รับของ',
            'RepairAt' => 'Repair At',
            'RepairStatus' => 'สถานะซ่อม',
            'RepairReport' => 'สรุปการซ่อม',
            'RepairByName' => 'ซ่อมโดย',
            'CreatedAt' => 'Created At',
            'UpdatedAt' => 'Updated At',
        ];
    }

    // relation db
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['BrnCode' => 'BrnCode']);
    }

}
