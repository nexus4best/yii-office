<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tbl_zone".
 *
 * @property string $BrnCode
 * @property int $CtsId
 * @property int $AreaId
 * @property int $SetupId
 */
class TblZone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_zone';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['BrnCode'], 'required'],
            [['CtsId', 'AreaId', 'SetupId'], 'integer'],
            [['BrnCode'], 'string', 'max' => 10],
            [['BrnCode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'BrnCode' => 'Brn Code',
            'CtsId' => 'Cts ID',
            'AreaId' => 'Area ID',
            'SetupId' => 'Setup ID',
        ];
    }
}
