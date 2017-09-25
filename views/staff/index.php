<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php $this->registerJsFile('@web/js/scripts.js', ['depends' => 'yii\web\YiiAsset']) ?>

<ol class="breadcrumb">
        <li><a href="/home/index">Home</a></li>
        <li class="active">Staff</li>
    </ol>
<h1 align="center">Список сотрудников</h1>
<?php if (!empty($users)): ?>
    <?php foreach ($users as $user): ?>
        <nav class="navbar navbar-default" id ="<?= $user->id ?>">
            <div class="container">
                <div>
                    <p class="navbar-text sizeName"><?= $user->name ?></p>
                    <p class="navbar-text sizeName"><?= $user->email ?></p>
                    <p class="navbar-text size"><?= $user->city[0]->name ?></p>
                    <p class="navbar-text size"><?= $user->position[0]->name ?></p>
                    <a data-target="#btn<?="$user->id" ?>" class="navbar-brand navbar-right marginRight " data-toggle="modal">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>

                    <!— Modal —>
                <div class="modal fade" id="<?php echo"btn$user->id"  ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true»">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">?</button>
                        <h3 id="myModalLabel">Подтверждение</h3>
                    </div>
                    <div class="modal-body">
                        <p>Вы действительно хотите удалить <?=$user->name?></p>
                    </div>
                    <div class="modal-footer"> 
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Отмена</button>
                        <a id="<?php echo"btnRemove$user->id"?>" href="/staff/remove" class="btn btn-primary" data-dismiss="modal" data-target="#<?= $user->id ?>" onclick="OnClickRemoveStaff(<?= $user->id ?>)">Удалить</a>
                    </div>
                </div>
                    </div>
                    
                    <!— /Modal —>
                    <a class="navbar-brand navbar-right marginRight" href="<?= yii\helpers\Url::to(['/staff/addition', 'id' => $user->id]) ?>">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                </div>
        </nav>
    <?php endforeach; ?>
<?php endif; ?>
<div class="floatLeft"><?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
</div>
<div align="right">
    <a href="/staff/addition" class="btn btn-default btn-primary myBtn marginTop20">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"> </span>
                Добавить сотрудника
            </a>
</div>