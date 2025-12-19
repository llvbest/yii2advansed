<?php
namespace common\models;

use Yii;
use common\models\{FruitInterface,RepositoryInterface};
use yii\db\ActiveRecord;

use common\models\states\{
    StateInterface,
    OnTreeState,
    OnGroundState,
    RottenState
};

class FruitRepository implements RepositoryInterface
{
    public function create(FruitInterface $entity): FruitInterface
    {
        $entity = new $entity();
        $entity->color = self::randomColor();
        $entity->size = 100;
        $entity->state = new OnTreeState();
        $entity->status = $entity->state->getName();
        $entity->creation_date = date('Y-m-d H:i:s');
        $entity->save(false);
        return $entity;
    }

    public static function getList(string $className = 'AppleFruit')
    {
        $className = '\common\models\\'.$className;
        return $className::find()
            ->select('id, color, size, status, creation_date, fall_date')
            //->where(['state'=>[AppleStatus::STATE_ON_GROUND,AppleStatus::STATE_ON_TREE,AppleStatus::STATE_ROTTEN]])
            ->asArray()
            ->all();
    }

    public static function generate(string $className = 'AppleFruit'): void
    {
        $className = '\common\models\\'.$className;
        $tableName = preg_replace('/{{|}}/', '', $className::tableName());

        Yii::$app->db->createCommand()->truncateTable($tableName)->execute();

        $apples_count = rand(20, 30);

        for ($i = 0; $i < $apples_count; $i++) {
            $apple = new $className();
            $apple->color = FruitRepository::randomColor();

            $start = time() - 86400;//so that different times are generated
            $end = time();

            $apple->creation_date = date(
                'Y-m-d H:i:s',
                mt_rand($start, $end),
            );
            $apple->save();
        }
    }

    public static function randomColor(): string
    {
        return ['black', 'green', 'white', 'blue', 'orange'][array_rand(
            ['black', 'green', 'white', 'blue', 'orange'],
        )];
    }
}

