<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\states\{
    StateInterface,
    OnTreeState,
    OnGroundState,
    RottenState
};

interface FruitInterface
{
    public function afterFind();
    public function restoreState(): StateInterface;
    public function fallToGround(): void;
    public function eat(int $percent): void;
    public function setState(StateInterface $state): void;
    public function syncState(): void;
}

