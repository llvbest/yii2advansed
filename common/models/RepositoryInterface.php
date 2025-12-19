<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\FruitInterface;

interface RepositoryInterface
{
    public function create(FruitInterface $entity): FruitInterface;
    public static function getList(string $className);

}

