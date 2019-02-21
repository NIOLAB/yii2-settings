<?php

use yii\db\Migration;

/**
 * Class m150227_114524_init
 */
class m150227_114524_init extends Migration
{
    /**
     * This method contains the logic to be executed when applying this migration.
     */
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%setting}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(10)->notNull(),
            'input' => $this->string()->null(),
            'section' => $this->string()->notNull(),
            'key' => $this->string()->notNull(),
            'value' => $this->text()->null(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'description' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('section_key','{{%setting}}',['section','key']);
    }

    /**
     * This method contains the logic to be executed when removing this migration.
     */
    public function down()
    {
        $this->dropTable('{{%Setting}}');
    }
}
