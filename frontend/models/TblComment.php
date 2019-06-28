<?php

namespace frontend\models;

use Yii;

class TblComment extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'tbl_comment';
    }

    public function rules()
    {
        return [
            [['id', 'Message', 'MessageByName', 'CreatedAt', 'UpdatedAt'], 'required'],
            [['id'], 'integer'],
            [['CreatedAt', 'UpdatedAt'], 'safe'],
            [['Message'], 'string', 'max' => 255],
            [['MessageByName'], 'string', 'max' => 100],
            [['id'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Message' => 'Message',
            'MessageByName' => 'Message By Name',
            'CreatedAt' => 'Created At',
            'UpdatedAt' => 'Updated At',
        ];
    }
}
