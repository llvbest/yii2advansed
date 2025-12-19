<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index apples">
    <div class='row'>
        <div class='col-lg-6'>
            <a id="generate" class="btn btn-lg btn-success" href="#">Генерировать яблоки</a></div>
        <div class='col-lg-6 text-right'>Всего <?= sizeof($items); ?></div>
    </div>

    <h2>На дереве</h2>
    <div class="row alist" id="tree-apples-list">
        <?php foreach ($items as $item): ?>
            <?php if ($item['status'] == 1): ?>
                <div id="<?= $item['id']; ?>" class="col-lg-2" style="background: <?= $item['color']; ?>">
                    <div>Яблоко №<?= $item['id']; ?> Создано: <?= $item['creation_date']; ?></div>
                    <button class="btn btn-sm btn-warning dropApple">Упасть</button>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <h2>На земле</h2>
    <div class="row alist" id="ground-apples-list">
        <?php foreach ($items as $item): ?>
            <?php if ($item['status'] == 2 || $item['status'] == 3): ?>
                <div id="<?= $item['id']; ?>" class="col-lg-2" style="background: <?= $item['color']; ?>">
                    <div>№<?= $item['id']; ?> Создано: <?= $item['creation_date']; ?></div>
                    <div>Упало: <?= $item['fall_date']; ?></div>
                    <?php if ($item['status'] == 2): ?>
                        <div>Здоровье: <?= $item['size']; ?>%</div>
                        <div>
                            <div class="input-group">
                                <input type="number" min="0" max="<?= $item['size']; ?>" class="form-control" value="" />
                                <div class="input-group-addon">%</div>
                            </div>
                            <button class="btn btn-sm btn-warning eatsApple"">Съесть</button>
                        </div>
                    <?php else: ?>
                        <div><b>Гнилое</b></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <!--<h2>Съеденные</h2>
    <div class="row alist" id="ground-apples-list">
        <?php foreach ($items as $item): ?>
            <?php if ($item['status'] == 4): ?>
                <div id="<?= $item['id']; ?>" class="col-lg-2"  style="background: white">
                    <div>Яблоко №<?= $item['id']; ?></div>
                    <div> Съедено</div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>-->
</div>
<?php
$scripts = [
    'Main.init();',
];
$this->registerJs(implode("\n", $scripts), \yii\web\View::POS_READY);
?>
<?php $this->registerJsFile('/js/main.js'); ?>

