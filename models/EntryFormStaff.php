<?php

namespace app\models;
use app\models\AppModel;

// Модель формы ввода сотрудника
class EntryFormStaff extends AppModel
{
    protected $id = null;
    public $name;
    public $email;
    public $cities_id;
    public $positions_id;
    
    public function EntryFormStaffIni($user){
            $this->setId($user->id);
            $this->name = $user->name;
            $this->email = $user->email;
            $this->cities_id = $user->cities_id;
            $this->positions_id = $user->positions_id;
    }
    
    public function attributeLabels()
    {
        return array(
            'name' => 'Имя',
            'email' => 'Электронная почта',
            'cities_id' => 'Город',
            'positions_id' => 'Должность',
        );
    }

    public function rules()
    {
        return [
            [['name', 'email', 'cities_id', 'positions_id'], 'required', 'message'=>'{attribute} не может быть пустым'], 
            [['email'], 'email', 'message'=>'{attribute} введена неверно'],
            [['cities_id', 'positions_id'],'number', 'min'=>1, 'tooSmall'=>'Выберите {attribute}'],
        ];
    }
}