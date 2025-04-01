<?php
use yii\bootstrap5\Html;

// Убедитесь, что jQuery подключена
$this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js', ['position' => \yii\web\View::POS_HEAD]);

// Убедитесь, что Bootstrap JS подключена
$this->registerJsFile('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', ['position' => \yii\web\View::POS_END]);
?>

    <div class="result-card card border-success mt-4">
        <div class="card-header bg-success text-white">
            <i class="fas fa-check-circle"></i> Ваша ссылка готова!
        </div>
        <div class="card-body">
            <div class="result-content">
                <div class="short-url-container mb-4">
                    <h5 class="mb-3"><i class="fas fa-link"></i> Короткая ссылка:</h5>
                    <div class="input-group">
                        <input type="text"
                               class="form-control form-control-lg"
                               value="<?= Html::encode($shortUrl) ?>"
                               id="shortUrlInput"
                               readonly>
                        <button class="btn btn-success copy-btn"
                                type="button"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Скопировать">
                            <i class="far fa-copy"></i>
                        </button>
                    </div>
                </div>

                <div class="qr-code-container text-center">
                    <h5 class="mb-3"><i class="fas fa-qrcode"></i> QR-код:</h5>
                    <div class="qr-code-wrapper d-inline-block p-3 border rounded">
                        <img src="<?= $qrCode ?>"
                             alt="QR Code"
                             class="qr-code-img img-fluid"
                             style="max-width: 200px;">
                    </div>
                    <div class="mt-2">
                        <a href="<?= $qrCode ?>"
                           class="btn btn-outline-success btn-sm"
                           download="qr-code.png">
                            <i class="fas fa-download"></i> Скачать QR-код
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
$this->registerCss(<<<CSS
    .result-card {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border-radius: 10px;
        overflow: hidden;
    }
    .result-content {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
    }
    .short-url-container {
        flex: 1;
        min-width: 300px;
    }
    .qr-code-container {
        flex: 0 0 auto;
    }
    .qr-code-wrapper {
        background: white;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .copy-btn {
        transition: all 0.3s ease;
    }
    .copy-btn:hover {
        background-color: #198754;
        color: white;
    }
CSS
);

$this->registerJs(<<<JS
    // Инициализация тултипов
    $(document).ready(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Копирование ссылки, не будет работать на http
        $('.copy-btn').click(function() {
            const input = $('#shortUrlInput');
            if (!input || !input.val()) {
                console.error('Поле ввода не найдено или пустое');
                return;
            }

            navigator.clipboard.writeText(input.val()).then(() => {
                // Временное изменение иконки
                const icon = $(this).find('i');
                icon.removeClass('fa-copy').addClass('fa-check');

                // Возвращаем исходную иконку через 2 секунды
                setTimeout(() => {
                    icon.removeClass('fa-check').addClass('fa-copy');
                }, 2000);
            }).catch(err => {
                console.error('Не удалось скопировать текст: ', err);
            });
        });
    });
JS
);
?>