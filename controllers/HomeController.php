<?php

namespace app\controllers;
use app\models\Project;

// Контроллер домашней страницы
class HomeController extends AppController
{
     public function actionIndex()
    {
        return $this->render('index');
    }
}

