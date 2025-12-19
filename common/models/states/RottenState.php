<?php

namespace common\models\states;

use common\models\FruitStatus;
use common\models\FruitInterface;
use common\models\states\StateInterface;
use DomainException;

class RottenState implements StateInterface
{
    public function fall(FruitInterface $entity): void
    {
        throw new DomainException('Гнилое яблоко уже на земле');
    }

    public function eat(FruitInterface $entity, int $percent): void
    {
        throw new DomainException('Нельзя есть гнилое яблоко');
    }

    public function isRotten(): bool
    {
        return true;
    }

    public function getName(): string
    {
        return FruitStatus::STATE_ROTTEN;
    }
}