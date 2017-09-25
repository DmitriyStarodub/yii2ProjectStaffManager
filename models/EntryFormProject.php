<?php

namespace app\models;
use app\models\AppModel;

// Модель формы ввода проекта
class EntryFormProject extends AppModel
{
    protected $id = null;
    public $name;
    public $description;
    public $statuses_id;
    public $staff;
    
    public function EntryFormProjectIni($project){
            $this->setId($project->id);
            $this->name = $project->name;
            $this->description = $project->description;
            $this->statuses_id = $project->statuses_id;
            $this->staff = [];
            foreach ($project->staff as $staffProject){ 
                array_push($this->staff, $staffProject->id);
            }
    }
    
    public function attributeLabels()
    {
        return array(
            'name' => 'Имя',
            'description' => 'Описание',
            'staff' => 'Сотрудники',
            'statuses_id' => 'Статус',
        );
    }

    public function rules()
    {
        return [
            [['name', 'staff', 'description', 'statuses_id'], 'required', 'message'=>'{attribute} не может быть пустым'], 
            [['statuses_id'],'number', 'min'=>1, 'tooSmall'=>'Выберите {attribute}'],
        ];
    }
    
}