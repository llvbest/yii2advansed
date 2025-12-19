<?php

namespace common\models\states;

use common\models\FruitStatus;
use common\models\FruitInterface;
use common\models\states\StateInterface;
use DomainException;

class OnTreeState implements StateInterface
{
    public function fall(FruitInterface $entity): void
    {
        $entity->fall_date = date('Y-m-d H:i:s');
        $entity->setState(new OnGroundState());
    }

    public function eat(FruitInterface $entity, int $percent): void
    {
        throw new DomainException('Нельзя есть яблоко на дереве');
    }

    public function isRotten(FruitInterface $entity): bool
    {
        return false;
    }

    public function getName(): string
    {
        return FruitStatus::STATE_ON_TREE;
    }
}
