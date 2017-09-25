<?php

namespace app\controllers;
use app\models\Staff;
use app\models\EntryFormStaff;
use Yii;

// Контроллер 
class StaffController extends AppController
{
     public function actionIndex()
    {
         $query = Staff::find()->with('city', 'position');
          $pages = new \yii\data\Pagination(
                    ['totalCount' => $query->count(),
                'pageSize' => 8,
                'pageSizeParam' => false,
                'forcePageParam' => false]
            );
          $users = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', compact('users', 'pages'));
    }
    
    public function actionRemove($id = null){
        (new Staff())->deleteStaff($id);
    }
    
    public function actionAddition($id = null)
    {
        $entryUser = new EntryFormStaff();
        if($id){
            $user = Staff::find()->where(['id' => $id])->one();
            $entryUser->EntryFormStaffIni($user);
        }
        $cities = \app\models\City::find()->all();
        $positions = \app\models\Position::find()->all();
        $itemsCities = $this->GetItemsDrobDounMain($cities, 'Выберите город');
        $itemsPositions = $this->GetItemsDrobDounMain($positions, 'Выберите должность    ');
        if ($entryUser->load(Yii::$app->request->post()) && $entryUser->validate()) {
            // данные в $entryUser удачно проверены
            (new Staff())->share($entryUser);
             return $this->redirect(array('additionconfirm','user'=>$entryUser->name));
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('addition', compact('itemsCities', 'itemsPositions', 'entryUser'));
        }
    }
    
    public function actionAdditionconfirm($user = 'Гость'){
        return $this->render('additionconfirm', compact('user'));
    }
    
    
}


