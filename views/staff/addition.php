<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<ol class="breadcrumb">
    <li><a href="/home/index">Home</a></li>
    <li><a href="/staff/index">Staff</a></li>
    <li class="active">Addition</li>
</ol>
<h1 align="center">Добавить Сотрудника</h1>
<br/><br/><br/>
<?php
$form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => '<div class="row"><div class="col-sm-4 col-md-3">{label}</div><div class="col-sm-4 col-md-4 col-md-offset-0 col-sm-offset-1">{input}</div>{hint}{error}</div></br>',
                'labelOptions' => ['class' => 'control-label textSize']
            ],
        ]);
?>

<?= $form->field($entryUser, 'name') ?>

<?= $form->field($entryUser, 'email') ?>

<?php
$optionsCities = ['value' => $entryUser->cities_id, 'class' => 'btn  dropdown-toggle dropdown-my btn-lg', id => 'dropdownCities'];
$optionsPosition = ['value' => $entryUser->positions_id, 'class' => 'btn  dropdown-toggle dropdown-my btn-lg', id => 'dropdownPosition'];
?>

<?= $form->field($entryUser, 'cities_id')->dropDownList($itemsCities, $optionsCities); ?>

<?= $form->field($entryUser, 'positions_id')->dropDownList($itemsPositions, $optionsPosition); ?>

<div class="row">
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn myBtn btn-primary col-xs-4 col-sm-2 col-md-2 col-md-offset-3 col-sm-offset-5']) ?>
<?= Html::button('Отмена', [ 'type' => 'reset', 'class' => 'btn myBtn btn-primary col-xs-4 col-sm-2 col-md-2 col-md-offset-2 col-sm-offset-2  col-xs-offset-1']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>




