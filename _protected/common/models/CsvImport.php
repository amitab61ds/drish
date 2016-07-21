<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CsvImport extends Model{
	
    public $file;
    public $imagefile;
    
    public function rules(){
        return [
            [['file','imagefile'],'file','extensions'=>'csv','maxSize'=>1024 * 1024 * 24],
        ];
    }
    
    public function attributeLabels(){
        return [
            'file'=>'Select Product File',
            'imagefile'=>'Select Image File',
        ];
    }
		
}