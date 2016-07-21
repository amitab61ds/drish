<?php
namespace frontend\models;

use common\models\DiscountCode;
use yii\base\Model;
use Yii;

/**
 * ContactForm is the model behind the contact form.
 */
class DiscountForm extends Model
{
    public $code;


    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
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
            'code'=> Yii::t('app', 'Discount Code'),
        ];
    }



}
