<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $model \niolab\settings\models\SettingModel */

$this->title = Yii::t('niolab.settings', 'Create Setting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('niolab.settings', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-create">

    <h1><?php echo Html::encode($this->title); ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
