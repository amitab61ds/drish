<?php
namespace frontend\models;

use common\models\DiscountCode;
use common\models\DropdownValues;
use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;
/**
 * ContactForm is the model behind the contact form.
 */
class SortForm extends Model
{
    public $color;
    public $width;
    public $size;
    public $sort_by;
    public $brand;


    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Returns the attribute labels.
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'search'=> Yii::t('app', 'Search...'),
        ];
    }

	public function getAttrValues($id=0){		
		$attrvalues = DropdownValues::find()->where(['attribute_id' => $id])->orderBy(['displayname'=>SORT_ASC])->all();
		$arr = array();
		foreach($attrvalues as $val){
			$values[] = ['id'=>$val->id,'name'=>$val->displayname];
		}
		$attrvalues = ArrayHelper::map($values,'id','name');
		
		return $attrvalues;		
	}

}
