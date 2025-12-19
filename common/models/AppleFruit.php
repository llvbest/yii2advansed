<?php

namespace common\models;

use common\models\FruitStatus;
use yii\db\ActiveRecord;
use common\models\FruitInterface;
use common\models\states\{
    StateInterface,
    OnTreeState,
    OnGroundState,
    RottenState
};

use yii;

class AppleFruit extends Apple implements FruitInterface
{
    public StateInterface $state;

    //hook event
    public function afterFind()
    {
        parent::afterFind();
        $this->state = $this->restoreState();
    }

    public function restoreState(): StateInterface
    {
        return match ($this->status) {
            FruitStatus::STATE_ON_TREE => new OnTreeState(),
            FruitStatus::STATE_ON_GROUND => new OnGroundState(),
            FruitStatus::STATE_ROTTEN => new RottenState(),
            default => new OnTreeState(),
        };
    }

    /* ========== Fruit interface ========== */

    public function fallToGround(): void
    {
        $this->state->fall($this);
        $this->syncState();
    }

    public function eat(int $percent): void
    {
        $this->state->eat($this, $percent);
        $this->syncState();
    }

    /* ========== State Handling ========== */

    public function setState(StateInterface $state): void
    {
        $this->state = $state;
        $this->status = $state->getName();
    }

    public function syncState(): void
    {
        if ($this->state->isRotten($this)) {
            $this->setState(new RottenState());
        }
        $this->save(false);
    }

}