<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class TblRicoh extends \yii\db\ActiveRecord
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
        return 'tbl_ricoh';
    }

    public function rules()
    {
        return [
            [['OpenJob','OpenJobByName'], 'required'],
            [['id'], 'integer'],
            [['CreatedAt', 'UpdatedAt'], 'safe'],
            [['SendMailIP'], 'string', 'max' => 255],
            [['OpenJob', 'OpenJobByName'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'SendMailIP' => 'Send Mail Ip',
            'OpenJob' => 'Job',
            'OpenJobByName' => 'CTS',
            'CreatedAt' => 'Created At',
            'UpdatedAt' => 'Updated At',
        ];
    }
}
