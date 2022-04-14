<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\SingUpForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$script = <<< JS
    let button = document.querySelector('#randpass')
    button.addEventListener('click',function (){
        let result = "asi329assjA"
        let char = "AGYGFIYUIUFHIOSJPidgjsdhgsojvhadhq375403409380jJdjsapojp1305865781491wirqowturioyuasldfkgdsfhnvbmxcONBCDSAQWRTYUIOOPKJFSZCVBM"
        let charLenght = char.length;
        for (let i = 0; i <= 20; i++){
            result += char.charAt(Math.floor(Math.random()*charLenght))
        }
        console.log(result)
        return document.querySelector('#pass').value = result;
    })
JS;
$this->registerJs($script);

?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'password_repeat')->passwordInput() ?>

        <?= $form->field($model, 'suggested_password')->textInput(['readonly'=> true , 'id' => 'pass' ]) ?>


        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => ' bi bi-send btn btn-success ', 'name' => 'login-button']) ?>
                <?= Html::button('Generate password',['id' => 'randpass', 'class' => 'btn btn-primary', 'style' => 'margin-left:3rem;']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>