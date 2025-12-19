<?php

namespace common\service;

use common\models\{Apple,FruitStatus};
use common\models\FruitRepository;
use common\models\AppleFruit;
use yii\db\ActiveRecord;
use yii;

class FruitService
{
    public static $className = '\common\models\\AppleFruit';

    public function __construct(string $className = 'AppleFruit')
    {
        self::$className = '\common\models\\'.$className;
    }

    public static function drop(int $id): void
    {
        $entity = (self::$className)::find()
            ->where([
                'id'     => $id,
                'status' => FruitStatus::STATE_ON_TREE,
            ])->one();

        if ($entity) {
            $entity->fallToGround();
        }
    }

    public static function eat(int $id, $eat): void
    {
        $entity = (self::$className)::find()
            ->where([
                'id'     => $id,
                'status' => FruitStatus::STATE_ON_GROUND,
            ])->one();

        if ($entity) {
            $entity->eat($eat);
        }
    }

    public static function spoiler(): void
    {
        //SELECT * FROM `apples` WHERE NOW() > fall_date + INTERVAL 5 HOUR;
        (self::$className)::updateAll(['status' => FruitStatus::STATE_ROTTEN, 'size' => 0], [
            '>',
            new \yii\db\Expression('NOW()'),
            new \yii\db\Expression('fall_date + INTERVAL 5 HOUR'),
        ]);
    }
}