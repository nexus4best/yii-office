<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TblNavision;

class TblNavisionSearch extends TblNavision
{
    public $BrnCode;
    public $BrnPos;
    public $BrnRepair;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['SendBrand', 'SendModel', 'SendSerial', 'SendByName', 'SendFrom', 'SendNumber', 'SendIP', 'SendNavision', 
                'BrnCode','BrnPos', 'BrnRepair',
            'SendNavisionAt', 'CreatedAt', 'UpdatedAt'], 'safe'],
        ];
    }


    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TblNavision::find()
            ->orderBy(['tbl_send.id'=>SORT_DESC]);

        $query->joinWith(['repair']);

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
            //'SendNavisionAt' => $this->SendNavisionAt,
            //'CreatedAt' => $this->CreatedAt,
            //'UpdatedAt' => $this->UpdatedAt,
        ]);

        $query
            ->andFilterWhere(['like', 'tbl_send.id', $this->id])
            ->andFilterWhere(['like', 'tbl_send.SendBrand', $this->SendBrand])
            ->andFilterWhere(['like', 'tbl_send.SendModel', $this->SendModel])
            ->andFilterWhere(['like', 'tbl_send.SendSerial', $this->SendSerial])
            ->andFilterWhere(['like', 'tbl_repair.BrnCode', $this->BrnCode])
            ->andFilterWhere(['like', 'tbl_repair.BrnPos', $this->BrnPos])
            ->andFilterWhere(['like', 'tbl_repair.BrnRepair', $this->BrnRepair])
            ->andFilterWhere(['like', 'tbl_send.SendByName', $this->SendByName])
            ->andFilterWhere(['like', 'tbl_send.CreatedAt', $this->CreatedAt])
            ->andFilterWhere(['like', 'tbl_send.SendNavision', $this->SendNavision]);

        return $dataProvider;
    }
}
