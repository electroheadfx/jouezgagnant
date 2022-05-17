<?php

class Pages extends Migration
{
	public function up()
	{
		$this->create_table('pages', array
			(
				'name' =>			array('string[40]', 'null' => FALSE),
				'content' =>		array('text', 'null' => FALSE),
				'active' =>			array('boolean', 'null' => FALSE),
				'last_updated' =>	array('timestamp', 'null' => FALSE),
			)
		);
		$this->add_index('pages', 'page_name', 'name', 'unique');
	}
	
	public function down()
	{
		$this->drop_table('pages');
	}
}