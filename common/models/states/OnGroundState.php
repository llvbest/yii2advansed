<?php

namespace common\models\states;

use common\models\FruitStatus;
use common\models\FruitInterface;
use common\models\states\StateInterface;
use DomainException;

class OnGroundState implements StateInterface
{
    private const ROTTEN_TIME = 5 * 60 * 60;

    public function fall(FruitInterface $entity): void
    {
        throw new DomainException('Яблоко уже на земле');
    }

    public function eat(FruitInterface $entity, int $percent): void
    {
        if ($this->isRotten($entity)) {
            $entity->setState(new RottenState());
            throw new DomainException('Яблоко испортилось');
        }

        if ($percent <= 0) {
            throw new DomainException('Некорректный процент');
        }

        if ($entity->size - $percent < 0) {
            throw new DomainException('Нельзя съесть больше, чем есть');
        }

        $entity->size -= $percent;

        if ($entity->size === 0) {
            $entity->status = FruitStatus::STATE_EATEN;
            //$entity->delete();
        } else {
            $entity->save(false);
        }
    }

    public function isRotten(FruitInterface $entity): bool
    {
        return (time() - strtotime($entity->fall_date)) >= self::ROTTEN_TIME;
    }

    public function getName(): string
    {
        return FruitStatus::STATE_ON_GROUND;
    }

    private function getFallenAt(): int
    {
        return $this->fall_date ?? 0;
    }
}
