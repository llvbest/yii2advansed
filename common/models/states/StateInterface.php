<?php

namespace common\models\states;

use common\models\AppleFruit;

interface StateInterface
{
    public function fall(AppleFruit $entity): void;
    public function eat(AppleFruit $entity, int $percent): void;
    public function isRotten(AppleFruit $entity): bool;
    public function getName(): string;
}
