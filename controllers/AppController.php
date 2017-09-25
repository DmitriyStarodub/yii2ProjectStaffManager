<?php

namespace app\controllers;

use yii\web\Controller;

// Базовый класс Контроллера с общими методами
class AppController extends Controller {

    //Метод принимает $table - таблица записей из бд, $title - заголовок для DrobDoun
    //Возвращает список Имен записей таблицы с Заголовком в начале списка
    public function GetItemsDrobDounMain($table, $title = "Выберите") {
        $items = array();
        if (is_string($title)) {
            array_push($items, $title);
        }
        foreach ($table as $tab) {
            array_push($items, $tab->name);
        }
        return $items;
    }

    //Метод принимает $table - таблица записей из бд, $firstName,$secondName - имя столбца 
    //Возвращает список из столбцов таблицы вида  $firstName - $secondName
    public function GetDoubleItemsDrobDounMain($table, $firstName, $secondName) {
        $items = array();
        foreach ($table as $tab) {
            foreach ($tab->$secondName as $tabChild) {
                $items[$tab->id] = $tab->$firstName . ' - ' . mb_strtolower($tabChild->name, "utf-8");
            }
        }
        return $items;
    }

}
