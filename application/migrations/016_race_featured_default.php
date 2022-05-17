<?php

class Race_Featured_Default extends Migration {
	
	public function up() 
	{
		$this->change_column('races', 'featured', array('boolean', 'default' => 0, 'null' => FALSE));
	}

	public function down()
	{
		$this->change_column('races', 'featured', array('boolean', 'default' => 1, 'null' => FALSE));
	}	
}