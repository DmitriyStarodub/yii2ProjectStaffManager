<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<ol class="breadcrumb">
    <li><a href="/home/index">Home</a></li>
    <li><a href="/project/index">Projects</a></li>
    <li class="active">Addition</li>
</ol>
<h1 align="center">Добавить Проект</h1>
<br/><br/><br/>
<?php
$form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => '<div class="row"><div class="col-sm-4 col-md-3">{label}</div><div class="col-sm-4 col-md-4 col-md-offset-0 col-sm-offset-1">{input}</div>{hint}{error}</div></br>',
                'labelOptions' => ['class' => 'control-label textSize']
            ],
        ]);
?>

<?= $form->field($entryProject, 'name') ?>
<?= $form->field($entryProject, 'description')->textArea(['rows' => 7]) ?>

<?php ?>
<div class="col-sm-12 col-md-12 myRow">
    <div id="panelCharact" class="panel-default mypanel backgroundColor">
        <div class="panel-heading mypanelheading backgroundColor">
            <div class="row margin-top-5">
                <div class="col-xs-8 col-sm-5 col-md-3">
                    <p class="textSize"><b>Сотрудники</b></p>
                </div>
                <div class="col-xs-2 col-md-2">
                    <button data-toggle="collapse" type="button" data-target="#staff" class="btn-characteristiks" id="btnstaff" >
                        <span id="spanstaff1" class="glyphicon glyphicon-chevron-down padingLeft" aria-hidden="true"></span>
                        <span id="spanstaff2" class="glyphicon glyphicon-chevron-up padingLeft hidden" ></span>
                    </button>
                    <script>
                        // Using multiple unit types within one animation.
                        $("#btnstaff").click(function () {

                            if (document.getElementById("spanstaff1").className === "glyphicon glyphicon-chevron-down padingLeft hidden")
                            {
                                document.getElementById("spanstaff1").className = "glyphicon glyphicon-chevron-down padingLeft";
                                document.getElementById("spanstaff2").className = "glyphicon glyphicon-chevron-up padingLeft hidden";
                            } else
                            {

                                document.getElementById("spanstaff1").className = "glyphicon glyphicon-chevron-down padingLeft hidden";
                                document.getElementById("spanstaff2").className = "glyphicon glyphicon-chevron-up padingLeft";

                            }
                        });
                    </script>
                </div>
            </div>
        </div>
        <div id="staff" class="collapse">
            <div class="panel-body" style="max-height: 300px;overflow-y: scroll;">
                <?php if (!empty($itemsStaff)): ?>
                    <?= $form->field($entryProject, 'staff')->checkboxList($itemsStaff)->label(false); ?>
                    <?php foreach ($itemsStaff as $key => $itemStaff): ?> 
                        <?php $checked = false; ?>
                        <?php if (!empty($entryProject->staff)): ?>
                            <?php foreach ($entryProject->staff as $keyStaffProject => $staffProject): ?>
                                <?php if ($key == $keyStaffProject): ?>
                                    <?php
                                    $checked = true;
                                    break;
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-12 col-md-12 myRow2 marginTop30">
    <?php
    $optionsStatuses = ['value' => $entryProject->statuses_id, 'class' => 'btn  dropdown-toggle dropdown-my btn-lg', id => 'dropdownStatuses'];
    ?>

<?= $form->field($entryProject, 'statuses_id')->dropDownList($itemsStatuses, $optionsStatuses); ?>
</div>
<div class="row">
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn myBtn btn-primary col-xs-4 col-sm-2 col-md-2 col-md-offset-3 col-sm-offset-5']) ?>
<?= Html::button('Отмена', [ 'type' => 'reset', 'class' => 'btn myBtn btn-primary col-xs-4 col-sm-2 col-md-2 col-md-offset-2 col-sm-offset-2  col-xs-offset-1']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>