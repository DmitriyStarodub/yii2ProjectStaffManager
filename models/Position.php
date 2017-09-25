<?php

namespace app\models;
use yii\db\ActiveRecord;

// Модель таблицы должностей
class Position extends ActiveRecord {
    
    public static function tableName() {
       return 'Positions';
    }
}