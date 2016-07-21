<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\DropdownValues;
/**
 * This is the model class for table "product_images".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $main_image
 * @property string $flip_image
 * @property string $video
 * @property string $home_image
 * @property string $other_image
 * @property string $flip_image1
 * @property string $color
 * @property integer $default
 *
 * @property Product $product
 */
class ProductImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'color'], 'required'],
            [['product_id', 'default'], 'integer'],
            [['other_image'], 'string'],
            [['main_image', 'flip_image', 'video', 'home_image'], 'string', 'max' => 100],
            [['flip_image1'], 'string', 'max' => 250],
            [['color'], 'string', 'max' => 200],
			['color', 'unique', 'targetAttribute' => ['color', 'product_id'],'message' => 'Color must be unique.'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'main_image' => 'Main Image',
            'flip_image' => 'Flip Image',
            'video' => 'Video',
            'home_image' => 'Home Image',
            'other_image' => 'Other Image',
            'flip_image1' => 'Flip Image1',
            'color' => 'Color',
            'default' => 'Default',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
	public function getData($id){
		return $this->findOne($id);
	}
	public function getColorName($color){
		 $group = DropdownValues::find()->where(['id' => $color])->one();
		 $colo = $group['displayname'];
		 return  $colo;
	}
	public function getColor()
    {
        $group = DropdownValues::find()->where(['attribute_id' => 1])->orderBy('displayname')->all();
        return ArrayHelper::map($group,'id','displayname');
    }
}
