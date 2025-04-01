<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

$this->title = $name;
?>
    <div class="error-container">
        <div class="error-card card shadow-lg mt-4">
            <div class="card-body text-center p-5">
                <div class="error-icon mb-4">
                    <?php if ($exception->statusCode == 404): ?>
                        <i class="fas fa-exclamation-triangle text-warning fa-5x"></i>
                    <?php else: ?>
                        <i class="fas fa-times-circle text-danger fa-5x"></i>
                    <?php endif; ?>
                </div>

                <h1 class="error-title display-4 mb-3">
                    <?= Html::encode($this->title) ?>
                </h1>

                <div class="error-message lead mb-4">
                    <?= nl2br(Html::encode($message)) ?>
                </div>

                <div class="error-actions">
                    <a href="<?= Url::home() ?>" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-home me-2"></i> На главную
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php
$this->registerCss(<<<CSS
.error-container {
    padding: 2rem 1rem;
}
.error-card {
    max-width: 600px;
    margin: 0 auto;
    border: none;
    border-radius: 15px;
}
.error-icon {
    margin-bottom: 2rem;
}
.error-title {
    font-weight: 700;
    color: #dc3545;
}
.error-message {
    color: #6c757d;
    font-size: 1.25rem;
}
CSS
);
?>