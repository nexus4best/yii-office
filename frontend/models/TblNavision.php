<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


class TblNavision extends \yii\db\ActiveRecord
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
            [['SendBrand', 'SendNavision','SendModel','SendSerial'], 'required'],
            [['id'], 'integer'],
            [['SendNavisionAt', 'CreatedAt', 'UpdatedAt'], 'safe'],
            [['SendBrand', 'SendModel', 'SendSerial', 'SendNavision'], 'string', 'max' => 255],
            [['SendByName'], 'string', 'max' => 100],
            [['SendFrom', 'SendNumber'], 'string', 'max' => 50],
            [['SendIP'], 'string', 'max' => 30],
            [['id'], 'unique'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'SendBrand' => 'ยี่ห้อ',
            'SendModel' => 'รุ่น',
            'SendSerial' => 'หมายเลข',
            'SendByName' => 'ผู้จัดส่ง',
            'SendFrom' => 'Send From',
            'SendNumber' => 'Send Number',
            'SendIP' => 'Send Ip',
            'SendNavision' => 'Navision',
            'SendNavisionAt' => 'Send Navision At',
            'CreatedAt' => 'Created At',
            'UpdatedAt' => 'Updated At',
        ];
    }

    public function getRepair()
    {
        return $this->hasOne(TblRepair::className(), ['id' => 'id']);
    }

    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['BrnCode' => 'BrnCode']);
    }

    // get Data from Reletion
    public function getBrnCode()
    {
        $model=$this->repair;
        return $model?$model->BrnCode:'';
    }

    public function getBrnPos()
    {
        $model=$this->repair;
        return $model?$model->BrnPos:'';
    }

    public function getBrnRepair()
    {
        $model=$this->repair;
        return $model?$model->BrnRepair:'';
    }

    public function getBrnName()
    {
        $model=$this->branch;
        return $model?$model->BrnName:'';
    }

}
