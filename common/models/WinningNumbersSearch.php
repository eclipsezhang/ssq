<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WinningNumbers;

/**
 * WinningNumbersSearch represents the model behind the search form about `common\models\WinningNumbers`.
 */
class WinningNumbersSearch extends WinningNumbers {
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['datenumber', 'red1', 'red2', 'red3', 'red4', 'red5', 'red6', 'blue', 'bonus', 'goldnum', 'goldamount', 'goldnum2', 'goldamount2', 'sumamount', 'date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = WinningNumbers::find()->orderBy('id desc');

        // add conditions that should always apply here

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
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'datenumber', $this->datenumber])
            ->andFilterWhere(['like', 'red1', $this->red1])
            ->andFilterWhere(['like', 'red2', $this->red2])
            ->andFilterWhere(['like', 'red3', $this->red3])
            ->andFilterWhere(['like', 'red4', $this->red4])
            ->andFilterWhere(['like', 'red5', $this->red5])
            ->andFilterWhere(['like', 'red6', $this->red6])
            ->andFilterWhere(['like', 'blue', $this->blue])
            ->andFilterWhere(['like', 'bonus', $this->bonus])
            ->andFilterWhere(['like', 'goldnum', $this->goldnum])
            ->andFilterWhere(['like', 'goldamount', $this->goldamount])
            ->andFilterWhere(['like', 'goldnum2', $this->goldnum2])
            ->andFilterWhere(['like', 'goldamount2', $this->goldamount2])
            ->andFilterWhere(['like', 'sumamount', $this->sumamount])
            ->andFilterWhere(['like', 'date', $this->date]);

        return $dataProvider;
    }
}
