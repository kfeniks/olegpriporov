<?php

use yii\db\Migration;

class m170519_201914_mailer extends Migration
{
    public function up()
    {



        $this->createTable('mail', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull(),
        ]);

    }
    public function down(){
        $this->dropTable('mail');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
