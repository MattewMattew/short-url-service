<?php
/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <title><?= Html::encode($this->title) ?> | Сервис коротких ссылок</title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
            'brandLabel' => 'Сервис коротких ссылок',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark',
                'style' => 'background: linear-gradient(to right, #3498db, #2c3e50);'
            ]
        ]);

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ms-auto'],
            'items' => [
                ['label' => 'Главная', 'url' => ['/site/index']],
                ['label' => 'Статистика', 'url' => ['/site/stats']],
            ]
        ]);

        NavBar::end();
        ?>
    </header>

    <main class="flex-shrink-0">
        <div class="container py-4">
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    &copy; <?= date('Y') ?> Сервис коротких ссылок
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="/privacy" class="text-white mx-2">Политика конфиденциальности</a>
                    <a href="/terms" class="text-white mx-2">Условия использования</a>
                </div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>

<?php
$this->registerCss(<<<CSS
body {
    background-color: #f8f9fa;
}

.navbar {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.nav-link {
    padding: 0.5rem 1rem;
    transition: all 0.3s;
    border-radius: 4px;
    color: rgba(255,255,255,0.85) !important;
}

.nav-link:hover {
    background-color: rgba(255,255,255,0.1);
    color: white !important;
}

.navbar-toggler {
    border-color: rgba(255,255,255,0.1);
}

main {
    padding-bottom: 2rem;
}

.footer {
    box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
}

.footer a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
}

.footer a:hover {
    color: white;
    text-decoration: underline;
}

@media (max-width: 768px) {
    .navbar-collapse {
        padding: 1rem;
        background-color: rgba(0,0,0,0.9);
        margin-top: 0.5rem;
        border-radius: 0 0 8px 8px;
    }
    
    .footer .row > div {
        margin-bottom: 1rem;
    }
}
CSS
);
?>
