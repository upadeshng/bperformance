<?php

class m220529_013605_tbl_user extends CDbMigration
{
	public function up()
	{
        $this->createTable('tbl_user', [
            'id' => 'pk',
            'username' => 'string',
            'password' => 'text',
            'name' => 'string',
            'email' => 'string',
            'mobile' => 'string',
            'createdAt' => 'datetime',
            'updatedAt' => 'datetime',
        ]);
	}

	public function down()
	{
		echo "m220529_013605_tbl_user does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}