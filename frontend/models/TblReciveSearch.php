<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TblRecive;

class TblReciveSearch extends TblRecive
{
    // t_branch
    public $branchBrnName;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['BrnStatus', 'BrnCode', 'BrnRepair', 'BrnPos', 'BrnBrand', 'BrnModel', 'BrnSerial', 'BrnCause', 
                'branchBrnName', 'BrnCreateByName', 'AcceptAt', 'AcceptByName', 'DeleteByName', 'DeleteCause', 'DeleteIP', 
                'ReciveAt', 'RepairAt', 'RepairStatus', 'RepairReport', 'RepairByName', 'CreatedAt', 'UpdatedAt'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TblRecive::find()
            //->where(['IN','tbl_repair.BrnStatus',['แจ้งซ่อม','รับเรื่อง','ส่งของ','เรียบร้อย','ลบ'],])
            //->andWhere(['NOT IN','tbl_repair.BrnPos',['ADSL','CCTV'],])
            ->where("tbl_repair.BrnRepair <> 'Laser Ricoh'")
            ->orderBy([
               'id'=> SORT_DESC, 
            ]);

        $query->joinWith(['branch']);

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
            //'AcceptAt' => $this->AcceptAt,
            //'ReciveAt' => $this->ReciveAt,
            //'RepairAt' => $this->RepairAt,
            //'CreatedAt' => $this->CreatedAt,
            //'UpdatedAt' => $this->UpdatedAt,
        ]);

        $query->andFilterWhere(['like', 'tbl_repair.BrnCode', $this->BrnCode])
            ->andFilterWhere(['like', 'branch.BrnName', $this->branchBrnName])
            ->andFilterWhere(['like', 'tbl_repair.BrnRepair', $this->BrnRepair])
            ->andFilterWhere(['like', 'tbl_repair.BrnPos', $this->BrnPos])
            ->andFilterWhere(['like', 'tbl_repair.id', $this->id])
            ->andFilterWhere(['like', 'BrnBrand', $this->BrnBrand])
            ->andFilterWhere(['like', 'BrnModel', $this->BrnModel])
            ->andFilterWhere(['like', 'tbl_repair.BrnSerial', $this->BrnSerial])
            ->andFilterWhere(['like', 'tbl_repair.CreatedAt', $this->CreatedAt])
            ->andFilterWhere(['like', 'tbl_repair.ReciveAt', $this->ReciveAt])
            ->andFilterWhere(['like', 'tbl_repair.RepairStatus', $this->RepairStatus])
            ->andFilterWhere(['like', 'tbl_repair.RepairAt', $this->RepairAt])
            ->andFilterWhere(['like', 'tbl_repair.RepairByName', $this->RepairByName]);

        return $dataProvider;
    }
}
