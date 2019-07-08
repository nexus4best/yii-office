<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TblRecheck;

class TblRecheckSearch extends TblRecheck
{

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['BrnStatus', 'BrnCode', 'BrnRepair', 'BrnPos', 'BrnBrand', 'BrnModel', 'BrnSerial', 'BrnCause', 'BrnCreateByName', 'AcceptAt', 'AcceptByName', 'DeleteByName', 'DeleteCause', 'DeleteIP', 'ReciveAt', 'RepairAt', 'RepairStatus', 'RepairReport', 'RepairByName', 'CreatedAt', 'UpdatedAt'], 'safe'],
        ];
    }


    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TblRecheck::find()            
            ->where(['IN','tbl_repair.RepairStatus',['รอตรวจซ่อมจากช่าง','อยู่ระหว่างตรวจซ่อม','ตรวจสอบแล้ว รออะไหล่','ส่งเคลมอยู่ในประกัน'],])
        //->andWhere(['NOT IN','tbl_repair.BrnPos',['ADSL','CCTV'],])
        //->where("tbl_repair.BrnRepair <> 'Laser Ricoh'")
        ->orderBy([
           'id'=> SORT_DESC, 
        ]);

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
            'id' => $this->id,
            'AcceptAt' => $this->AcceptAt,
            'ReciveAt' => $this->ReciveAt,
            'RepairAt' => $this->RepairAt,
            'CreatedAt' => $this->CreatedAt,
            'UpdatedAt' => $this->UpdatedAt,
        ]);

        $query->andFilterWhere(['like', 'BrnStatus', $this->BrnStatus])
            ->andFilterWhere(['like', 'BrnCode', $this->BrnCode])
            ->andFilterWhere(['like', 'BrnRepair', $this->BrnRepair])
            ->andFilterWhere(['like', 'BrnPos', $this->BrnPos])
            ->andFilterWhere(['like', 'BrnBrand', $this->BrnBrand])
            ->andFilterWhere(['like', 'BrnModel', $this->BrnModel])
            ->andFilterWhere(['like', 'BrnSerial', $this->BrnSerial])
            ->andFilterWhere(['like', 'BrnCause', $this->BrnCause])
            ->andFilterWhere(['like', 'BrnCreateByName', $this->BrnCreateByName])
            ->andFilterWhere(['like', 'AcceptByName', $this->AcceptByName])
            ->andFilterWhere(['like', 'DeleteByName', $this->DeleteByName])
            ->andFilterWhere(['like', 'DeleteCause', $this->DeleteCause])
            ->andFilterWhere(['like', 'DeleteIP', $this->DeleteIP])
            ->andFilterWhere(['like', 'RepairStatus', $this->RepairStatus])
            ->andFilterWhere(['like', 'RepairReport', $this->RepairReport])
            ->andFilterWhere(['like', 'RepairByName', $this->RepairByName]);

        return $dataProvider;
    }
}
