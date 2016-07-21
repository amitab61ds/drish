<?php
namespace frontend\models;

use common\models\DiscountCode;
use yii\base\Model;
use Yii;

/**
 * ContactForm is the model behind the contact form.
 */
class SearchForm extends Model
{
    public $search;


    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['search'], 'required'],
        ];
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



}
