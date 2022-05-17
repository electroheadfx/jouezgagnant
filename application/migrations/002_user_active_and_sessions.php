<?php

class User_Active_And_Sessions extends Migration
{
	public function up()
	{
		$this->add_column('users', 'active', array('boolean', 'default' => TRUE, 'null' => FALSE));
		
		$this->create_table('sessions', array
			(
				'session_id' => array('string[40]', 'null' => FALSE),
				'last_activity' => array('integer', 'null' => FALSE),
				'data' => array('text', 'null' => FALSE),
			)
		);
	}
	
	public function down()
	{
		$this->remove_column('users', 'active');
		$this->drop_table('sessions');
	}
}