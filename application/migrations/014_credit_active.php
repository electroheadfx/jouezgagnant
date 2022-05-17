<?php

class Credit_Active extends Migration {

	public function up()
	{
		$this->add_column('credits', 'active', array('boolean', 'default' => '1', 'null' => FALSE, 'after' => 'expiry_date'));
	}
		
	public function down()
	{
		$this->remove_column('credits', 'active');
	}
}