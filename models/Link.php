<?php

namespace app\models;

use yii\db\ActiveRecord;

class Link extends ActiveRecord
{
    public static function tableName()
    {
        return 'links';
    }
}