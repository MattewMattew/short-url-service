<?php

namespace app\models;

class LinkForm extends \yii\db\ActiveRecord
{
    public $url;

    public function rules()
    {
        return [
            ['url', 'required'],
            ['url', 'url'],
            ['url', 'validateUrlAvailability'],
        ];
    }

    public function validateUrlAvailability($attribute)
    {
        if (!$this->hasErrors()) {
            $ch = curl_init($this->$attribute);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($code < 200 || $code >= 400) {
                $this->addError($attribute, 'Данный URL не доступен');
            }
        }
    }
}