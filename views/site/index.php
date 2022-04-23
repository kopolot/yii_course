<?php

/** @var yii\web\View $this */
use yii\helpers\Html;
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <?php foreach($articles as $article): ?>
            <div class="col-lg-4">
                <?= Html::tag('h1',Html::encode($article->title)) ?>
                <!-- trzeba to zrobic inaczej bo ucina wyrazy -->
                <?= substr(Html::tag('h5',Html::encode($article->text)),0,300) ?>
            </div>
            <?php endforeach ?>
        </div>

    </div>
</div>
