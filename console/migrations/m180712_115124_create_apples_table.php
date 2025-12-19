<?php

use yii\db\Migration;
use common\models\Apple;

/**
 * Handles the creation of table `apples`.
 */
class m180712_115124_create_apples_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('apples', [
            'id' => $this->primaryKey(),
            'color' => $this->string(100),
            'size' => $this->tinyInteger()->unsigned()->defaultValue(100),
            'status' => $this->tinyInteger()->unsigned()->defaultValue(1),
            'creation_date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'fall_date' => $this->timestamp()->defaultExpression('NULL'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('apples');
    }
}
