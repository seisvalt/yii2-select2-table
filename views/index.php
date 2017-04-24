<?php

use kartik\helpers\Html;
use kartik\widgets\Select2;
use leandrogehlen\treegrid\TreeGrid;

/* @var $this yii\web\View */
/* @var $data_select ArrayObject */
/* @var $link_select string */
/* @var $data_table ArrayObject */
/* @var $columns ArrayObject */
/* @var $id string */
/* @var $title string */

$this->registerJs("$('#ajax_link_01').click(handleAjaxLink);", \yii\web\View::POS_READY);
$this->registerJs("$('#icon_link').click(handleAjaxLink);", \yii\web\View::POS_READY);

?>
<div id="id_select2table" class="col-md-12">
    <div class="row">
        <?= Select2::widget([
            'id' => 'blinbid1',
            'name' => 'state_200',
            'data' => $data_select,
            'size' => Select2::MEDIUM,
            'addon' => [
                'prepend' => [
                    'content' => Html::icon('globe')
                ],
                'append' => [
                    'content' => Html::a(
                        Html::icon('map-marker', ['href' => "../$link_select"]),
                        [$link_select],
                        [
                            'id' => 'ajax_link_01',
                            'data-on-done' => 'simpleDone',
                            'class' => 'btn btn-primary',
                            'title' => 'Agregar Hijo',
                            'data-toggle' => 'tooltip',
                        ]
                    ),
                    'asButton' => true
                ]
            ]
        ]);
        ?>
    </div>
    <div class="row">
        <?= TreeGrid::widget([
            'dataProvider' => $data_table,
            'keyColumnName' => 'id',
            'parentColumnName' => 'parent',
            'columns' => $columns
        ]); ?>

    </div>
</div>
