<?php

class User_Level_And_Media extends Migration
{
	public function up()
	{
		$this->remove_column('media', 'thumb_path');
		$this->add_column('users', 'user_level', array('string[10]', 'default' => 'standard', 'null' => FALSE));
	}
	
	public function down()
	{
		$this->add_column('media', 'thumb_path', array('string[200]', 'null' => FALSE));
		$this->remove_column('users', 'user_level');
	}
}