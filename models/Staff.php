<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\City;
use app\models\Position;
use app\models\StaffProjects;

// Модель таблицы сотрудников
class Staff extends ActiveRecord {

    public static function tableName() {
        return 'Users';
    }

    public function getCity() {
        return $this->hasMany(City::className(), ['id' => 'cities_id']);
    }

    public function getPosition() {
        return $this->hasMany(Position::className(), ['id' => 'positions_id']);
    }

    public function add($entryUser) {
        $newUser = new Staff();
        $newUser->id = $this->getNextId();
        $newUser->name = $entryUser->name;
        $newUser->email = $entryUser->email;
        $newUser->cities_id = $entryUser->cities_id;
        $newUser->positions_id = $entryUser->positions_id;
        $newUser->insert();
    }

    public function deleteStaff($id) {
        if (!empty(StaffProjects::find()->where(['users_id' => $id])->all())) {
            StaffProjects::deleteAll(['users_id' => $id]);
        }
        $staff = $this->find()->where(['id' => $id])->one();
        $staff->delete();
    }

    public function myUpdate($entryUser) {
        $updateUser = Staff::find()->where(['id' => $entryUser->getId()])->one();
        $updateUser->name = $entryUser->name;
        $updateUser->email = $entryUser->email;
        $updateUser->cities_id = $entryUser->cities_id;
        $updateUser->positions_id = $entryUser->positions_id;
        $updateUser->save();
    }

    public function share($entryUser) {
        if ($entryUser->getId() == null) {
            $this->add($entryUser);
        } else if ($this->find($entryUser->getId()) != null) {
            $this->myUpdate($entryUser);
        }
    }

    public function getNextId() {
        $id = $this->find()->select('id')->max('id');
        return ++$id;
    }

}
