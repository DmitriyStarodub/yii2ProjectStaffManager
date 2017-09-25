<?php

namespace app\controllers;

use app\models\Project;
use app\models\EntryFormProject;
use app\models\Position;
use app\models\Staff;
use Yii;

// Контроллер проектов
class ProjectController extends AppController {

    public function actionIndex() {
        $position = Position::find()->all();
        $query = Project::find()->with('status', 'staff');
        $pages = new \yii\data\Pagination(
                ['totalCount' => $query->count(),
            'pageSize' => 8,
            'pageSizeParam' => false,
            'forcePageParam' => false]
        );
        $model = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', compact('pages', 'model', 'position'));
    }

    public function actionRemove($id = null) {
        (new Project())->deleteProject($id);
    }

    public function actionAddition($id = null) {
        $staff = Staff::find()->with('position')->all();
        $itemsStaff = $this->GetDoubleItemsDrobDounMain($staff, "name", "position");
        $entryProject = new EntryFormProject();
        if ($id) {
            $project = Project::find()->with('staff')->where(['id' => $id])->one();
            $entryProject->EntryFormProjectIni($project);
        }
        $statuses = \app\models\Status::find()->all();
        $itemsStatuses = $this->GetItemsDrobDounMain($statuses, 'Выберите статус');
        if ($entryProject->load(Yii::$app->request->post()) && $entryProject->validate()) {
            // данные в $entryProject удачно проверены
            (new Project())->share($entryProject);
            return $this->redirect(array('additionconfirm', 'project' => $entryProject->name));
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('addition', compact('itemsStatuses', 'entryProject', 'itemsStaff', 'staff'));
        }
    }

    public function actionAdditionconfirm($project = 'Проект') {
        return $this->render('additionconfirm', compact('project'));
    }

}
