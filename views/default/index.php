<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii2mod\editable\EditableColumn;
use niolab\settings\models\enumerables\SettingStatus;
use niolab\settings\models\enumerables\SettingType;
use niolab\settings\models\SettingModel;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \niolab\settings\models\search\SettingSearch */

$this->title = Yii::t('niolab.settings', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-index">
    <h1><?php echo Html::encode($this->title); ?></h1>

    <p><?php echo Html::a(Yii::t('niolab.settings', 'Create Setting'), ['create'], ['class' => 'btn btn-success']); ?></p>
    <?php Pjax::begin(['timeout' => 10000, 'enablePushState' => false]); ?>
    <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                ],
                [
                    'attribute' => 'type',
                    'filter' => SettingType::listData(),
                    'filterInputOptions' => ['prompt' => Yii::t('niolab.settings', 'Select Type'), 'class' => 'form-control'],
                ],
                [
                    'attribute' => 'section',
                    'filter' => ArrayHelper::map(SettingModel::find()->select('section')->distinct()->all(), 'section', 'section'),
                    'filterInputOptions' => ['prompt' => Yii::t('niolab.settings', 'Select Section'), 'class' => 'form-control'],
                ],
                'key',
                'value:ntext',
                [
                    'class' => EditableColumn::class,
                    'attribute' => 'status',
                    'url' => ['edit-setting'],
                    'value' => function ($model) {
                        return SettingStatus::getLabel($model->status);
                    },
                    'type' => 'select',
                    'editableOptions' => function ($model) {
                        return [
                            'source' => SettingStatus::listData(),
                            'value' => $model->status,
                        ];
                    },
                    'filter' => SettingStatus::listData(),
                    'filterInputOptions' => ['prompt' => Yii::t('niolab.settings', 'Select Status'), 'class' => 'form-control'],
                ],
                'description:ntext',
                [
                    'header' => Yii::t('niolab.settings', 'Actions'),
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}{delete}',
                ],
            ],
        ]
    ); ?>
    <?php Pjax::end(); ?>
</div>
