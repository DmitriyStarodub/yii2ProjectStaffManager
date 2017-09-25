<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php $this->registerJsFile('@web/js/scripts.js', ['depends' => 'yii\web\YiiAsset']) ?>

<ol class="breadcrumb">
    <li><a href="/home/index">Home</a></li>
    <li class="active">Project</li>
</ol>
<h1 align="center">Список проектов</h1>
<nav class="navbar navbar-default" id ="<?= $mod->id ?>" >
    <div class="container">
        <div>
            <p class="navbar-text sizeName"><b>Название проекта</b></p>
            <p class="navbar-text sizeDescription"><b>Описание</b></p>
            <p class="navbar-text sizeName"><b>Сотрудники</b></p>
            <p class="navbar-text sizePosition"><b>Позиция</b></p>
            <p class="navbar-text sizeStatus"><b>Статус выполнения</b></p>
        </div>
    </div>
</nav>
<?php if (!empty($model)): ?>
    <?php foreach ($model as $mod): ?>
        <nav class="navbar navbar-default" id ="<?= $mod->id ?>" >
            <div class="container">
                <div >
                    <p class="navbar-text sizeName"><?= $mod->name ?></p>
                    <p class="navbar-text sizeDescription"><?= $mod->description ?></p>
                    <p class="navbar-text sizeName">
                        <?php if (!empty($mod->staff)): ?>
                            <?php foreach ($mod->staff as $key => $staff): ?>
                                <?= $staff->name ?>
                                <br>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </p>
                    <p class="navbar-text sizePosition">
                        <?php if (!empty($mod->staff)): ?>
                            <?php foreach ($mod->staff as $key => $staff): ?>
                                <?= $position[$staff->positions_id - 1]->name ?>
                                <br>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </p>
                    <p class="navbar-text sizeStatus"><?= $mod->status[0]->name ?></p>

                    <a data-target="#btn<?= "$mod->id" ?>" class="navbar-brand navbar-right marginRight " data-toggle="modal">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>

                    <!— Modal —>
                    <div class="modal fade" id="<?php echo"btn$mod->id" ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true»">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
                                <h3 id="myModalLabel">Подтверждение</h3>
                            </div>
                            <div class="modal-body">
                                <p>Вы действительно хотите удалить <?= $mod->name ?></p>
                            </div>
                            <div class="modal-footer"> 
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Отмена</button>
                                <a id="<?php echo"btnRemove$mod->id" ?>" href="/project/remove" 
                                   class="btn btn-primary" data-dismiss="modal" data-target="#<?= $mod->id ?>" 
                                   onclick="OnClickRemoveProject(<?= $mod->id ?>)">Удалить</a>
                            </div>
                        </div>
                    </div>
                    <!— /Modal —>

                    <a class="navbar-brand navbar-right marginRight" href="<?= yii\helpers\Url::to(['project/addition', 'id' => $mod->id]) ?>">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                </div>
        </nav>
    <?php endforeach; ?>
<?php endif; ?>
<div class="floatLeft"><?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
</div>
<div align="right">
    <a href="/project/addition" class="btn btn-default btn-primary myBtn marginTop20">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"> </span>
        Добавить проект
    </a>
</div>
