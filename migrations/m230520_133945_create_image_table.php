<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 */

class m230520_133945_create_image_table extends Migration
{
    public function up()
    {
        $this->createTable('image', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    public function down()
    {
        $this->dropTable('image');
    }

}
