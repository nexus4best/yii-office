<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TblFind;
use frontend\models\TblSend;

class TblFindSearch extends TblFind
{
    public $findSerial;
    public $dateStart;
    public $dateStop;
    public $cntRepair;

    public function rules()
    {
        return [
            [['id','cntRepair'], 'integer'],
            [['BrnStatus', 'BrnCode', 'BrnRepair', 'BrnPos', 'BrnBrand', 'BrnModel', 'BrnSerial', 'BrnCause', 
                'findSerial', 'dateStart', 'dateStop', 'cntRepair',
            'BrnCreateByName', 'AcceptAt', 'AcceptByName', 'DeleteByName', 'DeleteCause', 'DeleteIP', 'ReciveAt', 'RepairAt', 'RepairStatus', 'RepairReport', 'RepairByName', 'CreatedAt', 'UpdatedAt'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function searchSend($params)
    {
        $query = TblSend::find();

        $dataProviderSend = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProviderSend;
        }

        $query->andFilterWhere([
        ]);

        $query->andFilterWhere(['like', 'tbl_send.SendSerial', $this->findSerial]);

        return $dataProviderSend;
    }

    public function search($params)
    {
        $query = TblFind::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            // 'id' => $this->id,
            // 'AcceptAt' => $this->AcceptAt,
            // 'ReciveAt' => $this->ReciveAt,
            // 'RepairAt' => $this->RepairAt,
            // 'CreatedAt' => $this->CreatedAt,
            // 'UpdatedAt' => $this->UpdatedAt,
        ]);

        $query->andFilterWhere(['like', 'tbl_repair.BrnSerial', $this->findSerial]);

        return $dataProvider;
    }

    public function searchRecive($params)
    {
        $query = TblFind::find()
            ->where(['NOT IN','tbl_repair.BrnPos',['ADSL','CCTV'],])
            ->orderBy(['tbl_repair.BrnRepair'=>SORT_DESC]);

        $dataProviderRecive = new ActiveDataProvider([
            'query' => $query,
            'sort'  => false,
            'pagination' => array('pageSize'=> 9999),
        ]);

        $this->load($params);

        if (!$this->validate()) {

            return $dataProviderRecive;
        }

        // grid filtering conditions
        $query->andFilterWhere([

        ]);

        $query->andFilterWhere(
            ['between', 'tbl_repair.ReciveAt', $this->dateStart.' 00:00:01', $this->dateStop.' 23:59:59']
        );

        return $dataProviderRecive;
    }

    public function searchCount($params)
    {
        $query = TblFind::find()
        ->select(['tbl_repair.BrnRepair','COUNT(*) AS cntRepair'])
        ->where(['NOT IN','tbl_repair.BrnPos',['ADSL','CCTV'],])
        ->groupBy(['tbl_repair.BrnRepair'])
        ->orderBy(['cntRepair'=> SORT_DESC]);

        $dataProviderCount = new ActiveDataProvider([
            'query' => $query,
            'sort'  => false,
            'pagination' => array('pageSize'=> 9999),
        ]);

        $this->load($params);

        if (!$this->validate()) {

            return $dataProviderCount;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'cntRepair' => $this->cntRepair,
        ]);

        $query->andFilterWhere(
            ['between', 'tbl_repair.ReciveAt', $this->dateStart.' 00:00:01', $this->dateStop.' 23:59:59']
        );

        return $dataProviderCount;
    }
        

}
