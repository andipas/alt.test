<?php

use yii\db\Schema;
use yii\db\Migration;

class m200929_134826_Mass extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable('{{%image}}',[
            'id'=> $this->primaryKey(11),
            'post_id'=> $this->integer(11)->notNull(),
            'name'=> $this->string(255)->notNull(),
            'parse_url'=> $this->string(255)->null()->defaultValue(null),
            'created_at'=> $this->timestamp()->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('page_id','{{%image}}',['post_id'],false);

        $this->createTable('{{%post}}',[
            'id'=> $this->primaryKey(11),
            'title'=> $this->string(255)->notNull(),
            'body'=> $this->text()->notNull(),
            'parse_url'=> $this->string(255)->null()->defaultValue(null),
            'parsed_at'=> $this->timestamp()->null()->defaultValue(null),
            'created_at'=> $this->timestamp()->null()->defaultValue(null),
            'updated_at'=> $this->timestamp()->null()->defaultValue(null),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_alt_image_post_id',
            '{{%image}}', 'post_id',
            '{{%post}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
            $this->dropForeignKey('fk_alt_image_post_id', '{{%image}}');
            $this->dropTable('{{%image}}');
            $this->dropTable('{{%post}}');
    }
}
