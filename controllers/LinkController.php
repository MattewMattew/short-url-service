<?php

namespace app\controllers;

use app\models\Link;
use app\models\LinkForm;
use app\models\LinkLog;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class LinkController extends Controller
{
    public function actionIndex()
    {
        $model = new LinkForm();
        return $this->render('index', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new LinkForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $link = new Link();
                $link->original_url = $model->url;
                $link->short_code = Yii::$app->security->generateRandomString(6);

                if ($link->save()) {
                    return $this->renderPartial('_result', [
                        'shortUrl' => Yii::$app->urlManager->createAbsoluteUrl($link->short_code),
                        'qrCode' => $this->generateQrCode($link->short_code)
                    ]);
                }
                return $this->renderPartial('_error', [
                    'errors' => 'Не удалось сохранить ссылку в базе данных'
                ]);
            }
            return $this->renderPartial('_error', [
                'errors' => $model->getErrors() ?: 'Неизвестная ошибка валидации'
            ]);
        }
        return $this->redirect(['link/index']);
    }

    private function generateQrCode($shortCode)
    {
        $qrCode = new QrCode(Yii::$app->urlManager->createAbsoluteUrl($shortCode));
        $writer = new PngWriter();
        return $writer->write($qrCode)->getDataUri();
    }

    public function actionRedirect($shortCode)
    {
        $link = Link::findOne(['short_code' => $shortCode]);
        if ($link) {
            // Логирование перехода
            $log = new LinkLog();
            $log->link_id = $link->id;
            $log->ip_address = Yii::$app->request->userIP;
            $log->save();

            return $this->redirect($link->original_url);
        }
        throw new NotFoundHttpException('Ссылка не найдена');
    }

    public function actionStats($shortCode)
    {
        $link = Link::findOne(['short_code' => $shortCode]);
        if (!$link) {
            throw new NotFoundHttpException('Ссылка не найдена');
        }

        $totalClicks = LinkLog::find()->where(['link_id' => $link->id])->count();
        $lastClicks = LinkLog::find()
            ->where(['link_id' => $link->id])
            ->orderBy(['accessed_at' => SORT_DESC])
            ->limit(10)
            ->all();

        return $this->render('stats', [
            'link' => $link,
            'totalClicks' => $totalClicks,
            'lastClicks' => $lastClicks
        ]);
    }
}