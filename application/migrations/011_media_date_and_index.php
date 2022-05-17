<?php

class Media_Date_And_Index extends Migration {
	
	public function up() 
	{
		$this->change_column('media', 'date_uploaded', array('timestamp', 'null' => FALSE, 'default' => 'CURRENT_TIMESTAMP'));
		$this->add_index('media', 'path', 'path', 'unique');
	}

	public function down()
	{
		$this->change_column('media', 'date_uploaded', array('datetime', 'null' => FALSE));
		$this->remove_index('media', 'path');
	}	
}