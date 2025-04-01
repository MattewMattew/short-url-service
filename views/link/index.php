<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="link-form-container">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="card-title text-center mb-4">Сократить ссылку</h2>

                            <?php $form = ActiveForm::begin([
                                'id' => 'link-form',
                                'options' => ['class' => 'form-horizontal'],
                                'fieldConfig' => [
                                    'template' => "{input}\n{error}",
                                    'inputOptions' => ['class' => 'form-control'],
                                    'errorOptions' => ['class' => 'invalid-feedback']
                                ]
                            ]); ?>

                            <div class="input-group mb-3">
                                <?= $form->field($model, 'url', [
                                    'options' => ['class' => 'flex-grow-1']
                                ])->textInput([
                                    'placeholder' => 'Введите URL',
                                    'class' => 'form-control form-control-lg'
                                ]) ?>

                                <?= Html::submitButton('Сократить', [
                                    'class' => 'btn btn-primary btn-lg position-relative',
                                    'style' => 'width: 150px;'
                                ]) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                    <div id="result-container" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>

<?php
$this->registerCss(<<<CSS
.link-form-container {
    padding: 20px 0;
}
.card {
    border-radius: 15px;
    border: none;
}
.form-control {
    height: 50px;
    border-radius: 8px;
}
#result-container {
    transition: all 0.3s ease;
    max-width: 100%;
}
.btn-loading .btn-text {
    opacity: 0.5;
}
.btn-loading .loader {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 24px;
    height: 24px;
    border: 3px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    border-top-color: #fff;
    animation: spin 1s ease-in-out infinite;
}
@keyframes spin {
    to { transform: translate(-50%, -50%) rotate(360deg); }
}

/* Адаптивные настройки */
@media (min-width: 1200px) {
    .col-xl-6 {
        flex: 0 0 66.666667%;
        max-width: 66.666667%;
    }
}
CSS
);

$this->registerJs(<<<JS
$('#link-form').on('beforeSubmit', function(e) {
    e.preventDefault();
    
    const form = $(this);
    const submitBtn = form.find('button[type=submit]');
    
    submitBtn.prop('disabled', true)
             .addClass('btn-loading')
             .append('<div class="loader"></div>');
    
    $.ajax({
        url: '/link/create',
        type: 'POST',
        data: form.serialize(),
        success: function(response) {
            $('#result-container').hide().html(response).fadeIn(300);
        },
        error: function() {
            $('#result-container').html(
                '<div class="alert alert-danger">Произошла ошибка. Пожалуйста, попробуйте позже.</div>'
            ).fadeIn(300);
        },
        complete: function() {
            submitBtn.prop('disabled', false)
                    .removeClass('btn-loading')
                    .find('.loader').remove();
        }
    });
    
    return false;
});
JS
);
?>