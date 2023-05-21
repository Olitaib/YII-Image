<?php

use yii\grid\GridView;
use yii\helpers\Html;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'image',
        'created_at',
        [
            'attribute' => 'image',
            'format' => 'html',
            'label' => 'Preview',
            'value' => function ($data) {
                return Html::img($data['image'], ['width' => '150']);
            },
        ],
        ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
    ]
]);

?>
