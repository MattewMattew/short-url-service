<?php
use yii\helpers\Html;
?>

    <div class="error-card card border-danger mb-4">
        <div class="card-header bg-danger text-white d-flex align-items-center">
            <i class="fas fa-exclamation-circle me-2"></i>
            <span>Ошибка</span>
        </div>
        <div class="card-body">
            <ul class="error-list mb-0">
                <?php if (is_array($errors)): ?>
                    <?php foreach ($errors as $attribute => $errorMessages): ?>
                        <?php if (is_array($errorMessages)): ?>
                            <?php foreach ($errorMessages as $message): ?>
                                <li><?= Html::encode($message) ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><?= Html::encode($errorMessages) ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li><?= Html::encode($errors) ?></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

<?php
$this->registerCss(<<<CSS
    .error-card {
        border-radius: 10px;
        box-shadow: 0 0.5rem 1rem rgba(220, 53, 69, 0.15);
        border-width: 2px;
    }
    .error-list {
        padding-left: 1.5rem;
    }
    .error-list li {
        margin-bottom: 0.5rem;
        position: relative;
        line-height: 1.5;
    }
    .error-list li:before {
        content: "•";
        color: #dc3545;
        font-weight: bold;
        position: absolute;
        left: -1rem;
    }
    .error-list li:last-child {
        margin-bottom: 0;
    }
CSS
);
?>