<?php

use yii\db\Migration;

/**
 * Class m220624_061906_addRealtionTable
 */
class m220624_061906_addRealtionTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('packages_transport_companies', [
            'id'=>$this->primaryKey(),
            'package_id'=>$this->integer(),
            'company_id'=>$this->integer()
        ]);
        $this->addColumn('packages','type', $this->string()->comment("Тип посылки - slow - медленная, fast - быстрая"));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('packages_transport_companies');
        $this->dropColumn('packages', 'type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220624_061906_addRealtionTable cannot be reverted.\n";

        return false;
    }
    */
}
