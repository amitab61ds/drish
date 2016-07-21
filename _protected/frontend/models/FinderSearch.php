<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Finder;
use frontend\components\SearchResult;
use yii\helpers\Url;
use common\models\Product;
use common\models\Cart;
use common\models\ProductImages;
use common\models\ProductPageSetting;
use common\models\ProductDropdownValues;
use common\models\Category;
use common\models\ProductTextValues;
use common\models\ProductDescValues;
use common\models\DropdownValues;
use common\models\Attributes;

/**
 * FinderSearch represents the model behind the search form about `app\models\Finder`.
 */
class FinderSearch extends Finder
{
      /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'quantity', 'price', 'market_price', 'status', 'soldout', 'created_at', 'updated_at'], 'integer'],
            [['name', 'descr', 'short_descr', 'meta_title', 'meta_description', 'meta_keyword'], 'safe'],
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
    public function search($params)
    {
        $query = Product::find();

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
            'category_id' => $this->category_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'market_price' => $this->market_price,
            'status' => $this->status,
            'soldout' => $this->soldout,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'descr', $this->descr])
            ->andFilterWhere(['like', 'short_descr', $this->short_descr])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'meta_keyword', $this->meta_keyword]);

        return $dataProvider;
    }
    public function getSuggestProduct($searchquery)
    {

        $baseurl = Yii::$app->homeUrl;
        $query = Product::find()->innerJoinWith('uniType')->innerJoinWith('city')->innerJoinWith('state')->innerJoinWith('country');

        if($searchquery != ""){

            $query->andFilterWhere(['or',
                ['like','Product.name',$searchquery],
                ['like','uni_type.name',$searchquery],
                ['like','cities.name',$searchquery],
                ['like','states.name',$searchquery],
                ['like','countries.name',$searchquery],
                ['like','sname',$searchquery]]);
        }

        $search_res = $query->distinct()->limit(9)->all();
		
        $result = "";
		foreach($search_res as $key=>$res){
			$url = Url::to(['university/index', 'slug' => $res->slug]);
			$result[$key]->name = $res->name;	
			$result[$key]->url = $url;	
			$result[$key]->id = $res->id;	
		}	

        return $result;

    }
	
    public function getSuggestProgram($searchquery)
    {
		$query = Program::find()->where(['status'=>1]);

        if($searchquery != ""){
            $query->andFilterWhere(['or',
                ['like','name',$searchquery]]);
			$search_res = $query->distinct()->limit(10)->all();
        }
       
		
        $result = "";
		if(count($search_res) > 0){
			foreach($search_res as $key => $res){
				//$url = Url::to(['university/index', 'slug' => $res->slug]);			
				$result[$key]->name = $res->name;	
				//$result[$key]->url = $url;	
				$result[$key]->id = $res->id;		
			}	
		}

        return $result;

    }	
}
