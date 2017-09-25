<?php

namespace app\models;
use yii\db\ActiveRecord;

// Модель таблицы статусов выполнения проектов
class Status extends ActiveRecord {
    
    public static function tableName() {
       return 'Statuses';
    }
}

