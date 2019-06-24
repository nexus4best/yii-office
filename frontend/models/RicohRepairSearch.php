<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\RicohRepair;

class RicohRepairSearch extends RicohRepair
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['BrnStatus', 'BrnCode', 'BrnRepair', 'BrnPos', 'BrnBrand', 'BrnModel', 'BrnSerial', 'BrnCause', 
                'BrnUserCreate', 'CreatedAt', 'UpdatedAt', 'UserAccept', 'UserAcceptAt','RicohJob'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = RicohRepair::find()
                //->where(['IN','tbl_repair.BrnStatus',['แจ้งซ่อม','รับเรื่อง','ส่งของ','เรียบร้อย','ลบ'],])
                //->andWhere(['NOT IN','tbl_repair.BrnPos',['ADSL','CCTV'],])
                ->andWhere("tbl_repair.BrnRepair='Laser Ricoh'")
                ->orderBy(['tbl_repair.id'=>SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            //'id' => $this->id,
            //'CreatedAt' => $this->CreatedAt,
            //'UpdatedAt' => $this->UpdatedAt,
            //'UserAcceptAt' => $this->UserAcceptAt,
        ]);

        $query->andFilterWhere(['like', 'BrnStatus', $this->BrnStatus])
            ->andFilterWhere(['like', 'BrnCode', $this->BrnCode])
            ->andFilterWhere(['like', 'BrnSerial', $this->BrnSerial])
            ->andFilterWhere(['like', 'BrnCause', $this->BrnCause])
            ->andFilterWhere(['like', 'RicohJob', $this->RicohJob])
            ->andFilterWhere(['like', 'CreatedAt', $this->CreatedAt])
            ->andFilterWhere(['like', 'UserAcceptAt', $this->UserAcceptAt])
            ->andFilterWhere(['like', 'UserAccept', $this->UserAccept]);

        return $dataProvider;
    }
}
