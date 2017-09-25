<?php

namespace app\models;

use yii\base\Model;

// Базовый класс Модели с общими методами
class AppModel extends Model
{
    
    public function getId(){
    $id = $this->id;
        return $id;
    }
    
    public function setId($newId){
           $this->id = $newId; 
    }
}

