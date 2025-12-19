<?php

namespace common\models;

class FruitStatus
{
    const STATE_ON_TREE = 1; //висит на дереве
    const STATE_ON_GROUND = 2; //лежит на земле
    const STATE_ROTTEN = 3; //гнилое
    const STATE_EATEN = 4; //съедено
}