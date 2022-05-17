<?php

class User_Timezone extends Migration
{
	public function up()
	{
		$this->add_column('users', 'timezone', array('string[40]', 'default' => 'Europe/Paris', 'null' => FALSE));
	}
	
	public function down()
	{
		$this->remove_column('users', 'timezone');
	}
}