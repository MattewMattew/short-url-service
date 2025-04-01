<?php

namespace app\models;

use yii\db\ActiveRecord;

class LinkLog extends ActiveRecord
{
    public static function tableName()
    {
        return 'link_logs';
    }
}