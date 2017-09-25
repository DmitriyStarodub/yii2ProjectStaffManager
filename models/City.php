<?php

namespace app\models;
use yii\db\ActiveRecord;

// Модель таблицы городов
class City extends ActiveRecord {
    
    public static function tableName() {
       return 'Cities';
    }
}