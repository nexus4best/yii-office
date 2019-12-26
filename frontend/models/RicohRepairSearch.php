<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\RicohRepair;

class RicohRepairSearch extends RicohRepair
{
    // tbl_ricoh
    public $OpenJob;
    //public $OpenJobByName;
    public $OpenJobAt;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['BrnStatus', 'BrnCode', 'BrnRepair', 'BrnPos', 'BrnBrand', 'BrnModel', 'BrnSerial', 'BrnCause', 
                'OpenJob', 'OpenJobAt', 'BrnUserCreate', 'CreatedAt', 'UpdatedAt'], 'safe'],
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
                ->andWhere("tbl_repair.BrnRepair='เครื่องพิมพ์เอกสาร-RICOH'")
                ->orderBy(['tbl_repair.id'=>SORT_DESC]);

        $query->joinWith(['ricoh']);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize'=> 10),
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

        $query->andFilterWhere(['like', 'tbl_repair.BrnStatus', $this->BrnStatus])
            ->andFilterWhere(['like', 'tbl_repair.id', $this->id])
            ->andFilterWhere(['like', 'tbl_repair.BrnCode', $this->BrnCode])
            ->andFilterWhere(['like', 'tbl_repair.BrnSerial', $this->BrnSerial])
            ->andFilterWhere(['like', 'tbl_repair.BrnCause', $this->BrnCause])
            ->andFilterWhere(['like', 'tbl_ricoh.OpenJob', $this->OpenJob])
            ->andFilterWhere(['like', 'tbl_ricoh.UpdatedAt', $this->OpenJobAt])
            ->andFilterWhere(['like', 'tbl_repair.CreatedAt', $this->CreatedAt]);

        return $dataProvider;
    }
}
