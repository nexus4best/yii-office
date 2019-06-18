<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property string $BrnCode
 * @property int $BrnOpen
 * @property string $BrnName
 */

class Branch extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'branch';
    }

    public function rules()
    {
        return [
            [['BrnCode'], 'required'],
            [['BrnOpen'], 'integer'],
            [['BrnCode'], 'string', 'max' => 20],
            [['BrnName'], 'string', 'max' => 100],
            [['BrnCode'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'BrnCode' => 'Brn Code',
            'BrnOpen' => 'Brn Open',
            'BrnName' => 'Brn Name',
        ];
    }
    
}
