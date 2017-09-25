<?php

namespace app\models;

use yii\db\ActiveRecord;

// Модель таблицы-связи сотрудники-проекты
class StaffProjects extends ActiveRecord {

    public static function tableName() {
        return 'Users_Projects';
    }

    public function getNextId() {
        $id = $this->find()->select('id')->max('id');
        return ++$id;
    }

    public function add($projectId, $arrStaffId) {
        if (!empty($projectId) && !empty($arrStaffId)) {
            foreach ($arrStaffId as $staffId) {
                $staffProject = new StaffProjects();
                $staffProject->id = $staffProject->getNextId();
                $staffProject->users_id = $staffId;
                $staffProject->projects_id = $projectId;
                $staffProject->insert();
            }
        }
    }

}
