<?php

class m220529_013329_tbl_student extends CDbMigration
{
	public function up()
	{
        $this->createTable('tbl_student', [
            'id' => 'pk',
            'firstName' => 'string',
            'lastName' => 'string',
            'email' => 'string',
            'dob' => 'date',
            'createdAt' => 'datetime',
            'updatedAt' => 'datetime',
        ]);
	}

	public function down()
	{
		echo "m220529_013329_tbl_student does not support migration down.\n";
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