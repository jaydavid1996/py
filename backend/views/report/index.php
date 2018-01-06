<?php
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\helpers\Html;
$gridColumns = [
    // ['class' => 'yii\grid\SerialColumn'],
    'id',
    // 'name',
    // [
    //     'attribute'=>'author_id',
    //     'label'=>'Author',
    //     'vAlign'=>'middle',
    //     'width'=>'190px',
    //     'value'=>function ($model, $key, $index, $widget) {
    //         return Html::a($model->author->name, '#', []);
    //     },
    //     'format'=>'raw'
    // ],
    // 'color',
    // 'publish_date',
    // 'status',
    // ['attribute'=>'buy_amount','format'=>['decimal',2], 'hAlign'=>'right', 'width'=>'110px'],
    // ['attribute'=>'sell_amount','format'=>['decimal',2], 'hAlign'=>'right', 'width'=>'110px'],
    // ['class' => 'kartik\grid\ActionColumn', 'urlCreator'=>function(){return '#';}]
];

$fullExportMenu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'target' => ExportMenu::TARGET_BLANK,
    'fontAwesome' => true,
    'pjaxContainerId' => 'kv-pjax-container',
    'dropdownOptions' => [
        'label' => 'Full',
        'class' => 'btn btn-default',
        'itemsBefore' => [
            '<li class="dropdown-header">Export All Data</li>',
        ],
    ],
]);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'pjax' => true,
    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Library</h3>',
    ],
    // set a label for default menu
    'export' => [
        'label' => 'Page',
        'fontAwesome' => true,
    ],
    // your toolbar can include the additional full export menu
    'toolbar' => [
        '{export}',
        $fullExportMenu,
        ['content'=>
            Html::button('<i class="glyphicon glyphicon-plus"></i>', [
                'type'=>'button',
                'title'=>Yii::t('kvgrid', 'Add Book'),
                'class'=>'btn btn-success'
            ]) . ' '.
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
                'data-pjax'=>0,
                'class' => 'btn btn-default',
                'title'=>Yii::t('kvgrid', 'Reset Grid')
            ])
        ],
    ]
]);
