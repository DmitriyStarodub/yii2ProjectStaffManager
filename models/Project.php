<?php

namespace app\models;
use yii\db\ActiveRecord;
use app\models\Status;
use app\models\Staff;
use app\models\StaffProjects;

// Модель таблицы проектов
class Project extends ActiveRecord {
    
    public static function tableName() {
       return 'Projects';
    }
    
     public function getStatus()
    {
        return $this->hasMany(Status::className(), ['id' => 'statuses_id']);
    }
    
    public function getStaff()
    {
        return $this->hasMany(Staff::className(), ['id' => 'users_id'])
            ->viaTable('Users_Projects', ['projects_id' => 'id']);
    }
    
    public function add($entryProject) {
        $newProject = new Project();
        $newProject->id = $this->getNextId();
        $newProject->name = $entryProject->name;
        $newProject->description = $entryProject->description;
        $newProject->statuses_id = $entryProject->statuses_id;
        $newProject->insert();
        if(!empty($entryProject->staff)){
        (new StaffProjects())->add($newProject->id, $entryProject->staff);
        }
    }

    public function myUpdate($entryProject) {
        $newProject = Project::find()->with('staff')->where(['id' => $entryProject->getId()])->one();
        $newProject->name = $entryProject->name;
        $newProject->description = $entryProject->description;
        if(!empty($entryProject->staff)){
           StaffProjects::deleteAll(['projects_id' => $newProject->id]);
           (new StaffProjects())->add($newProject->id, $entryProject->staff);
        }
        $newProject->statuses_id = $entryProject->statuses_id;
        $newProject->save();
    }
    
    public function deleteProject($id) {
        if (!empty(StaffProjects::find()->where(['projects_id' => $id])->all())) {
            StaffProjects::deleteAll(['projects_id' => $id]);
        }
            $project = $this->find()->where(['id' => $id])->one();
            $project->delete();
    }

    public function share($entryProject) {
        if ($entryProject->getId() == null) {
            $this->add($entryProject);
        } else if (Project::find($entryProject->getId()) != null) {
            $this->myUpdate($entryProject);
        }
    }

    public function getNextId() {
        $id = $this->find()->select('id')->max('id');
        return ++$id;
    }
    
}