<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = "历史开奖数据";

?>
<div class="user-index">
    <div class="box box-primary">
        <div class="box-header ui-sortable-handle" style="cursor: move;">
            <i class="fa fa-fw fa-list"></i>
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'datenumber',
                    'red1',
                    'red2',
                    'red3',
                    'red4',
                    'red5',
                    'red6',
                    'blue',
                    'bonus',
                    'goldnum',
                    'goldamount',
                    'goldnum2',
                    'goldamount2',
                    'sumamount',
                    'date',
                ],
            ]); ?>
        </div>
    </div>
</div>
