<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TblRepair;

class TblRepairSearch extends TblRepair
{
    // t_branch
    public $branchBrnName;
    
    // tbl_send
    public $sendCreatedAt;
    public $sendSendByName;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['BrnStatus', 'BrnCode', 'BrnRepair', 'BrnPos', 'BrnBrand', 'BrnModel', 'BrnSerial', 'BrnCause', 
                'branchBrnName', 'sendCreatedAt', 'sendSendByName',
                'BrnCreateByName', 'CreatedAt', 'UpdatedAt', 'AcceptByName', 'AcceptAt'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TblRepair::find()
                    ->where(['IN','tbl_repair.BrnStatus',['แจ้งซ่อม','รับเรื่อง','ส่งของ','เรียบร้อย','ลบ'],])
                    ->andWhere(['NOT IN','tbl_repair.BrnPos',['ADSL','CCTV'],])
                    ->andWhere("tbl_repair.BrnRepair<>'เครื่องพิมพ์เอกสาร-RICOH'");
                    //->orderBy(['tbl_repair.id'=>SORT_DESC]);

        $query->joinWith(['send','branch']);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize'=> 15),
            'sort' => ['attributes' => [
                            'id' => [
                                'asc' => ['id' => SORT_ASC],
                                'desc' => ['id' => SORT_DESC],
                                'default' => SORT_DESC
                            ],
                            'BrnCode' => [
                                'asc' => ['BrnCode' => SORT_ASC],
                                'desc' => ['BrnCode' => SORT_DESC],
                                'default' => SORT_DESC
                            ],
                            'CreatedAt' => [
                                'asc' => ['CreatedAt' => SORT_ASC],
                                'desc' => ['CreatedAt' => SORT_DESC],
                                'default' => SORT_DESC
                            ],
                            'sendCreatedAt' => [
                                'asc' => ['tbl_send.CreatedAt' => SORT_ASC],
                                'desc' => ['tbl_send.CreatedAt' => SORT_DESC],
                                'default' => SORT_DESC
                            ]
                        ],
                    'defaultOrder' => [
                        'id' => SORT_DESC,
                    ]

            ],
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
            //'AcceptAt' => $this->AcceptAt,
        ]);

        $query->andFilterWhere(['like', 'tbl_repair.id', $this->id])
            ->andFilterWhere(['like', 'tbl_repair.BrnStatus', $this->BrnStatus])
            ->andFilterWhere(['like', 'tbl_repair.BrnCode', $this->BrnCode])
            ->andFilterWhere(['like', 'branch.BrnName', $this->branchBrnName])
            ->andFilterWhere(['like', 'tbl_send.CreatedAt', $this->sendCreatedAt])
            ->andFilterWhere(['like', 'tbl_send.SendByName', $this->sendSendByName ])
            ->andFilterWhere(['like', 'tbl_repair.BrnRepair', $this->BrnRepair])
            ->andFilterWhere(['like', 'tbl_repair.BrnPos', $this->BrnPos])
            ->andFilterWhere(['like', 'tbl_repair.CreatedAt', $this->CreatedAt])
            ->andFilterWhere(['like', 'tbl_repair.AcceptByName', $this->AcceptByName]);

        return $dataProvider;
    }
}
