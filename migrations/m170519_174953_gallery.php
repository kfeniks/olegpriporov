<?php

use yii\db\Schema;
use yii\db\Migration;

class m170519_174953_gallery extends Migration
{
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql'){
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%posts}}', [
            'id' =>Schema::TYPE_PK,
            'title' =>Schema::TYPE_STRING . '(150) NOT NULL ',
            'cat_id' =>Schema::TYPE_INTEGER . ' NOT NULL ',
            'img' =>Schema::TYPE_STRING . '(32) NOT NULL ',
            'text' =>Schema::TYPE_TEXT . ' NOT NULL ',
            'hits' =>Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0 ',
            'hide' =>Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1 ',
            'date' =>Schema::TYPE_TIMESTAMP . ' NOT NULL ',
            'date_event' =>Schema::TYPE_DATETIME . ' NOT NULL ',
        ],
            $tableOptions);

        $this->addForeignKey("FK_GALLERY_CAT", '{{%posts}}', '{{cat_id}}', '{{%category}}', '{{id}}');
    }
    public function down(){
        $this->dropForeignKey("FK_GALLERY_CAT", '{{%posts}}');
        $this->dropTable('{{%posts}}');
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
