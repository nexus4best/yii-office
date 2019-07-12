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
class TblFind extends \yii\db\ActiveRecord
{
    public $cntRepair;

    public static function tableName()
    {
        return 'tbl_repair';
    }


    public function rules()
    {
        return [
            [['BrnStatus', 'BrnCode', 'BrnRepair', 'BrnPos', 'BrnCause', 'BrnCreateByName', 'CreatedAt', 'UpdatedAt'], 'required'],
            [['AcceptAt', 'ReciveAt', 'RepairAt', 'CreatedAt', 'UpdatedAt'], 'safe'],
            [['BrnStatus', 'BrnRepair', 'BrnBrand', 'BrnModel', 'BrnSerial', 'BrnCause', 'BrnCreateByName', 'DeleteCause', 'RepairStatus', 'RepairByName'], 'string', 'max' => 255],
            [['BrnCode', 'DeleteIP'], 'string', 'max' => 20],
            [['cntRepair'], 'integer'],
            [['BrnPos'], 'string', 'max' => 30],
            [['AcceptByName', 'DeleteByName', 'RepairReport'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'BrnStatus' => 'Brn Status',
            'BrnCode' => 'Branch',
            'BrnRepair' => 'รายการ',
            'BrnPos' => 'Brn Pos',
            'BrnBrand' => 'Brn Brand',
            'BrnModel' => 'Brn Model',
            'BrnSerial' => 'หมายเลข',
            'BrnCause' => 'สาเหตุ',
            'BrnCreateByName' => 'Brn Create By Name',
            'AcceptAt' => 'Accept At',
            'AcceptByName' => 'Accept By Name',
            'DeleteByName' => 'Delete By Name',
            'DeleteCause' => 'Delete Cause',
            'DeleteIP' => 'Delete Ip',
            'ReciveAt' => 'Recive At',
            'RepairAt' => 'Repair At',
            'RepairStatus' => 'สถานะ',
            'RepairReport' => 'Repair Report',
            'RepairByName' => 'Repair By Name',
            'CreatedAt' => 'Created At',
            'UpdatedAt' => 'Updated At',
            'cntRepair' => 'cntRepair',
        ];
    }

    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['BrnCode' => 'BrnCode']);
    }

    public function getBrnName()
    {
        $model=$this->branch;
        return $model?$model->BrnName:'';
    }

    // public function getSend()
    // {
    //     return $this->hasOne(TblSend::className(), ['id' => 'id']);
    // }

    //     // get Data from Reletion
    //     public function getSendBrand()
    //     {
    //         $model=$this->send;
    //         return $model?$model->SendBrand:'';
    //     }

    //     public function getSendSerial()
    //     {
    //         $model=$this->send;
    //         return $model?$model->SendSerial:'';
    //     }
    
    //     public function getSendByName()
    //     {
    //         $model=$this->send;
    //         return $model?$model->SendByName:'';
    //     }
}
