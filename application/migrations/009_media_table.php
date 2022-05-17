<?php

class Media_Table extends Migration
{
	public function up()
	{
		$this->create_table('media', array
			(
				'path' =>			array('string[200]', 'null' => FALSE),
				'thumb_path' =>		array('string[200]', 'null' => FALSE),
				'date_uploaded' =>	array('datetime', 'null' => FALSE),
				'type' =>			array('string[20]', 'null' => FALSE),
			)
		);
	}
	
	public function down()
	{
		$this->drop_table('media');
	}
}