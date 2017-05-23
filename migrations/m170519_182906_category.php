<?php

use yii\db\Schema;
use yii\db\Migration;

class m170519_182906_category extends Migration
{
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql'){
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' =>Schema::TYPE_PK,
            'cat_name' =>Schema::TYPE_STRING . '(150) NOT NULL ',
        ],
            $tableOptions);
    }
    public function down(){
        $this->dropTable('{{%category}}');
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
