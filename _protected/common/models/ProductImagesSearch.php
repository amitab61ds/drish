<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductImages;

/**
 * ProductImagesSearch represents the model behind the search form about `common\models\ProductImages`.
 */
class ProductImagesSearch extends ProductImages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'default'], 'integer'],
            [['main_image', 'flip_image', 'video', 'home_image', 'other_image', 'flip_image1', 'color'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params,$product_id=0)
    {
        $query = ProductImages::find();
		if($product_id){
			$query->where(['product_id' => $product_id]);	
		}
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
            'product_id' => $this->product_id,
            'default' => $this->default,
        ]);

        $query->andFilterWhere(['like', 'main_image', $this->main_image])
            ->andFilterWhere(['like', 'flip_image', $this->flip_image])
            ->andFilterWhere(['like', 'video', $this->video])
            ->andFilterWhere(['like', 'home_image', $this->home_image])
            ->andFilterWhere(['like', 'other_image', $this->other_image])
            ->andFilterWhere(['like', 'flip_image1', $this->flip_image1])
            ->andFilterWhere(['like', 'color', $this->color]);

        return $dataProvider;
    }
}
