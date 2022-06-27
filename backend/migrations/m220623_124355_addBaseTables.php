<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m220623_124355_addBaseTables
 */
class m220623_124355_addBaseTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('packages', [
            'id'=>$this->primaryKey(),
            'source_kladr'=>$this->string()->comment('Адрес отправки в формате КЛАДР'),
            'target_kladr'=>$this->string()->comment('Адрес доаствки в формате КЛАДР'),
            'weight'=>$this->integer()->comment('Вес в граммах'),
            'created'=>$this->timestamp()->defaultValue(new Expression('NOW()'))
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('packages');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220623_124355_addBaseTables cannot be reverted.\n";

        return false;
    }
    */
}
