<?php

namespace common\models;

use yii\db\ActiveRecord;

use yii;

class Apple extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{apples}}';
    }

}